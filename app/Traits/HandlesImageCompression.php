<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;

trait HandlesImageCompression
{
    /**
     * Compress and store an uploaded image using PHP's native GD library.
     *
     * @param  \Illuminate\Http\UploadedFile  $file
     * @param  string  $folder
     * @param  int  $maxWidth
     * @param  int  $quality
     * @return string  The path of the stored file inside the public disk.
     */
    public function compressAndStoreImage(UploadedFile $file, string $folder, int $maxWidth = 1200, int $quality = 75): string
    {
        // Prevent memory limit exhaustion when processing large images
        @ini_set('memory_limit', '256M');

        $extension = strtolower($file->getClientOriginalExtension());
        $tempPath = $file->getRealPath();

        // Get original dimensions and type
        list($origWidth, $origHeight, $imageType) = getimagesize($tempPath);

        // Load image based on type
        switch ($imageType) {
            case IMAGETYPE_JPEG:
                $sourceImage = imagecreatefromjpeg($tempPath);
                break;
            case IMAGETYPE_PNG:
                $sourceImage = imagecreatefrompng($tempPath);
                if ($sourceImage) {
                    imagealphablending($sourceImage, true);
                    imagesavealpha($sourceImage, true);
                }
                break;
            case IMAGETYPE_GIF:
                $sourceImage = imagecreatefromgif($tempPath);
                break;
            case 3: // WebP constant definition
                if (function_exists('imagecreatefromwebp')) {
                    $sourceImage = imagecreatefromwebp($tempPath);
                } else {
                    $sourceImage = false;
                }
                break;
            default:
                $sourceImage = false;
        }

        // Fallback to standard Laravel store if GD fails or type is not supported
        if (!$sourceImage) {
            return $file->store($folder, 'public');
        }

        // Calculate new dimensions keeping the aspect ratio
        $newWidth = $origWidth;
        $newHeight = $origHeight;

        if ($origWidth > $maxWidth) {
            $newWidth = $maxWidth;
            $newHeight = (int) round(($origHeight / $origWidth) * $maxWidth);
        }

        // Create the canvas
        $targetImage = imagecreatetruecolor($newWidth, $newHeight);

        // Handle transparency for PNG
        if ($imageType === IMAGETYPE_PNG) {
            imagealphablending($targetImage, false);
            imagesavealpha($targetImage, true);
            $transparent = imagecolorallocatealpha($targetImage, 255, 255, 255, 127);
            imagefilledrectangle($targetImage, 0, 0, $newWidth, $newHeight, $transparent);
        }

        // Resample the image to new dimensions
        imagecopyresampled(
            $targetImage,
            $sourceImage,
            0, 0, 0, 0,
            $newWidth,
            $newHeight,
            $origWidth,
            $origHeight
        );

        // Generate unique filename preserving original extension format (JPEG/PNG)
        $fileName = uniqid() . '.' . ($extension === 'png' ? 'png' : 'jpg');
        $destPath = storage_path('app/public/' . $folder . '/' . $fileName);

        // Ensure destination folder exists
        if (!file_exists(storage_path('app/public/' . $folder))) {
            mkdir(storage_path('app/public/' . $folder), 0755, true);
        }

        // Output file with compression
        if ($extension === 'png') {
            // PNG quality: compression level 0-9 (higher is more compression)
            $pngCompression = (int) round((100 - $quality) / 10);
            if ($pngCompression > 9) $pngCompression = 9;
            imagepng($targetImage, $destPath, $pngCompression);
        } else {
            // JPEG quality: 0-100
            imagejpeg($targetImage, $destPath, $quality);
        }

        // Free memory
        imagedestroy($sourceImage);
        imagedestroy($targetImage);

        return $folder . '/' . $fileName;
    }

    /**
     * Compress and store an uploaded image using PHP's native GD library,
     * ensuring that the final file size on disk is strictly less than 1MB.
     *
     * @param  \Illuminate\Http\UploadedFile  $file
     * @param  string  $folder
     * @return string  The path of the stored file inside the public disk.
     */
    public function compressAndStoreUnderOneMegabyte(\Illuminate\Http\UploadedFile $file, string $folder): string
    {
        @ini_set('memory_limit', '256M');

        $extension = strtolower($file->getClientOriginalExtension());
        $tempPath = $file->getRealPath();

        // Get original dimensions and type
        list($origWidth, $origHeight, $imageType) = getimagesize($tempPath);

        // Load image based on type
        switch ($imageType) {
            case IMAGETYPE_JPEG:
                $sourceImage = imagecreatefromjpeg($tempPath);
                break;
            case IMAGETYPE_PNG:
                $sourceImage = imagecreatefrompng($tempPath);
                if ($sourceImage) {
                    imagealphablending($sourceImage, true);
                    imagesavealpha($sourceImage, true);
                }
                break;
            case IMAGETYPE_GIF:
                $sourceImage = imagecreatefromgif($tempPath);
                break;
            case 3: // WebP constant definition
                if (function_exists('imagecreatefromwebp')) {
                    $sourceImage = imagecreatefromwebp($tempPath);
                } else {
                    $sourceImage = false;
                }
                break;
            default:
                $sourceImage = false;
        }

        // Fallback to standard Laravel store if GD fails
        if (!$sourceImage) {
            return $file->store($folder, 'public');
        }

        // Generate unique filename preserving original extension format (JPEG/PNG)
        $fileName = uniqid() . '.' . ($extension === 'png' ? 'png' : 'jpg');
        $destPath = storage_path('app/public/' . $folder . '/' . $fileName);

        // Ensure destination folder exists
        if (!file_exists(storage_path('app/public/' . $folder))) {
            mkdir(storage_path('app/public/' . $folder), 0755, true);
        }

        $quality = 85;
        $scale = 1.0;
        $maxDimension = 2000; // max initial dimension for clarity

        // Determine initial new dimensions
        $newWidth = $origWidth;
        $newHeight = $origHeight;
        if ($origWidth > $maxDimension || $origHeight > $maxDimension) {
            if ($origWidth > $origHeight) {
                $newWidth = $maxDimension;
                $newHeight = (int) round(($origHeight / $origWidth) * $maxDimension);
            } else {
                $newHeight = $maxDimension;
                $newWidth = (int) round(($origWidth / $origHeight) * $maxDimension);
            }
        }

        // Loop to reduce size under 1MB (1048576 bytes)
        $attempts = 0;
        $fileSize = 0;
        
        do {
            // Apply scale factor
            $w = (int) round($newWidth * $scale);
            $h = (int) round($newHeight * $scale);

            // Keep minimum boundary dimensions
            if ($w < 100 || $h < 100) {
                break;
            }

            // Create canvas
            $targetImage = imagecreatetruecolor($w, $h);

            // Handle transparency for PNG
            if ($imageType === IMAGETYPE_PNG) {
                imagealphablending($targetImage, false);
                imagesavealpha($targetImage, true);
                $transparent = imagecolorallocatealpha($targetImage, 255, 255, 255, 127);
                imagefilledrectangle($targetImage, 0, 0, $w, $h, $transparent);
            }

            // Resample
            imagecopyresampled(
                $targetImage,
                $sourceImage,
                0, 0, 0, 0,
                $w,
                $h,
                $origWidth,
                $origHeight
            );

            // Output temporary file
            if ($extension === 'png') {
                $pngCompression = (int) round((100 - $quality) / 10);
                if ($pngCompression > 9) $pngCompression = 9;
                imagepng($targetImage, $destPath, $pngCompression);
            } else {
                imagejpeg($targetImage, $destPath, $quality);
            }

            imagedestroy($targetImage);

            // Check file size
            $fileSize = file_exists($destPath) ? filesize($destPath) : 0;

            if ($fileSize <= 1048576) {
                break; // Success! Under 1MB
            }

            // Iteratively reduce parameters
            $scale *= 0.8; // scale down dimensions by 20%
            $quality -= 10; // reduce quality

            $attempts++;
        } while ($fileSize > 1048576 && $quality > 15 && $attempts < 8);

        imagedestroy($sourceImage);

        return $folder . '/' . $fileName;
    }
}
