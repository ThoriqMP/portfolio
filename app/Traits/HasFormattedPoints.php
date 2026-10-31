<?php

namespace App\Traits;

trait HasFormattedPoints
{
    /**
     * Parse description into an array of clean bullet points.
     *
     * @return array<int, string>
     */
    public function getPointsAttribute(): array
    {
        if (empty($this->description)) {
            return [];
        }

        $raw = trim($this->description);

        // 1. Try decoding JSON if stored as JSON list (from CMS list editor)
        if ((str_starts_with($raw, '[') && str_ends_with($raw, ']')) || (str_starts_with($raw, '{') && str_ends_with($raw, '}'))) {
            $decoded = json_decode($raw, true);
            if (is_array($decoded)) {
                $cleaned = [];
                foreach ($decoded as $item) {
                    if (is_string($item) && trim($item) !== '') {
                        $cleaned[] = trim($item);
                    }
                }
                if (!empty($cleaned)) {
                    return $cleaned;
                }
            }
        }

        // 2. Split by newlines
        $lines = preg_split('/(\r\n|\n|\r)/', $raw);
        $points = [];
        $hasExplicitBullets = false;

        foreach ($lines as $line) {
            $trimmed = trim($line);
            if ($trimmed === '') {
                continue;
            }

            // Check if line starts with bullet marker: -, *, •, +, or 1., 2), etc.
            if (preg_match('/^([•\-\*\+]|\d+[\.\)])\s*(.+)$/u', $trimmed, $matches)) {
                $hasExplicitBullets = true;
                $points[] = trim($matches[2]);
            } else {
                $points[] = $trimmed;
            }
        }

        // If there are multiple lines or explicit bullets, return as points
        if ($hasExplicitBullets || count($points) > 1) {
            return $points;
        }

        // 3. Fallback: Check if a single line contains inline bullet separators like "•"
        if (str_contains($raw, '•')) {
            $parts = array_filter(array_map('trim', explode('•', $raw)));
            if (count($parts) > 1) {
                return array_values($parts);
            }
        }

        return $points;
    }

    /**
     * Check if description should be displayed as a bulleted list.
     */
    public function getHasBulletPointsAttribute(): bool
    {
        $raw = trim($this->description ?? '');
        if (empty($raw)) {
            return false;
        }

        // JSON array check
        if (str_starts_with($raw, '[') && str_ends_with($raw, ']')) {
            $decoded = json_decode($raw, true);
            return is_array($decoded) && count($decoded) > 0;
        }

        $points = $this->points;
        return count($points) > 1 || (count($points) === 1 && preg_match('/^[•\-\*\+]|\d+[\.\)]/u', $raw));
    }
}

