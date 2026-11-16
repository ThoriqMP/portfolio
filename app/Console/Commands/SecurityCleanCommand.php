<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SecurityCleanCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'security:clean {--fix : Automatically quarantine rogue files and enforce security .htaccess}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scan project and public files for SEO spam, webshell backdoors, and clear caches';

    /**
     * Suspicious keywords related to gambling & spam injection.
     */
    protected array $spamKeywords = [
        'zona66', 'togel', 'slot gacor', 'slot online', 'judi online',
        'sbobet', 'pragmatic play', 'maxwin', 'bandar togel', 'situs judi',
        'pkv games', 'dominoqq'
    ];

    /**
     * Suspicious PHP function signatures used in webshells.
     */
    protected array $maliciousSignatures = [
        'eval(base64_decode',
        'eval(gzinflate',
        'eval(gzuncompress',
        'base64_decode($_POST',
        'base64_decode($_GET',
        'base64_decode($_REQUEST',
        'assert($_POST',
        'assert($_GET',
        'assert($_REQUEST',
        'system($_GET',
        'system($_POST',
        'shell_exec($_GET',
        'shell_exec($_POST',
        'passthru($_GET',
        'passthru($_POST',
        'preg_replace("/.*/e"',
        '\x65\x76\x61\x6c', // eval in hex
    ];

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info("=================================================");
        $this->info("   PORTOFOLIO SECURITY SCANNER & CLEANER        ");
        $this->info("=================================================");

        $threatsFound = 0;

        // 1. Inspect public directory
        $this->line("\n[1/5] Memeriksa direktori public/ ...");
        $publicPath = public_path();
        $allowedPublicFiles = ['index.php', '.htaccess', 'robots.txt', 'favicon.ico', 'favicon.svg', 'logo-thoriq.svg', 'storage'];

        if (is_dir($publicPath)) {
            $files = scandir($publicPath);
            foreach ($files as $file) {
                if ($file === '.' || $file === '..') continue;

                if (!in_array($file, $allowedPublicFiles)) {
                    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                    if (in_array($ext, ['php', 'phtml', 'html', 'sh', 'py', 'pl', 'cgi', 'quarantine']) || str_starts_with($file, 'google') || str_ends_with($file, '.quarantine')) {
                        $this->error("  [!] DITEMUKAN FILE MENCURIGAKAN: public/{$file}");
                        $threatsFound++;
                        if ($this->option('fix')) {
                            @unlink($publicPath . '/' . $file);
                            $this->info("      -> File {$file} BERHASIL DIHAPUS PERMANEN.");
                            $threatsFound--;
                        }
                    }
                }
            }
        }

        // 2. Check public/index.php integrity
        $indexPhpPath = public_path('index.php');
        $indexInfected = false;
        if (file_exists($indexPhpPath)) {
            $indexContent = file_get_contents($indexPhpPath);
            foreach ($this->maliciousSignatures as $sig) {
                if (stripos($indexContent, $sig) !== false) {
                    $this->error("  [!] INJEKSI TERDETEKSI DI public/index.php (Signature: {$sig})");
                    $threatsFound++;
                    $indexInfected = true;
                    break;
                }
            }
            if (!$indexInfected && (stripos($indexContent, 'googlebot') !== false || stripos($indexContent, 'zona66') !== false)) {
                $this->error("  [!] BOT CLOAKING INJECTION TERDETEKSI DI public/index.php!");
                $threatsFound++;
                $indexInfected = true;
            }

            if ($indexInfected && $this->option('fix')) {
                // Backup infected file
                $backupPath = public_path('index.php.infected_' . date('Ymd_His'));
                @copy($indexPhpPath, $backupPath);

                // Write pristine clean Laravel 11 index.php
                $cleanIndexContent = <<<'PHP'
<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
/** @var Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';

$app->handleRequest(Request::capture());
PHP;
                @file_put_contents($indexPhpPath, $cleanIndexContent);
                $this->info("      -> public/index.php BERHASIL DIBERSIHKAN & DIPULIHKAN ke kondisi original!");
                $this->line("      -> Backup file terinfeksi disimpan di: {$backupPath}");
                $threatsFound--;
            }
        }

        // 3. Inspect storage/app/public for rogue scripts
        $this->line("\n[2/5] Memeriksa storage/app/public untuk file berbahaya ...");
        $storagePublicPath = storage_path('app/public');
        if (is_dir($storagePublicPath)) {
            $iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($storagePublicPath));
            foreach ($iterator as $file) {
                if ($file->isFile()) {
                    $ext = strtolower($file->getExtension());
                    if (in_array($ext, ['php', 'phtml', 'phar', 'sh', 'cgi', 'pl', 'py', 'htm', 'html', 'shtml'])) {
                        $this->error("  [!] SCRIPT EKSEKUTABEL DI STORAGE: " . $file->getPathname());
                        $threatsFound++;
                        if ($this->option('fix')) {
                            @unlink($file->getPathname());
                            $this->warn("      -> Script berbahaya berhasil dihapus.");
                        }
                    }
                }
            }
        }

        // 4. Scan application source code (app, routes, resources)
        $this->line("\n[3/5] Memindai source code aplikasi (app, routes, resources) ...");
        $scanDirs = [app_path(), resource_path('views'), base_path('routes')];
        foreach ($scanDirs as $dir) {
            if (!is_dir($dir)) continue;
            $iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($dir));
            foreach ($iterator as $file) {
                if ($file->getFilename() === 'SecurityCleanCommand.php') continue;
                if ($file->isFile() && $file->getExtension() === 'php') {
                    $content = @file_get_contents($file->getPathname());
                    if (!$content) continue;

                    foreach ($this->maliciousSignatures as $sig) {
                        if (stripos($content, $sig) !== false) {
                            $this->error("  [!] SIGNATURE BERBAHAYA di " . $file->getPathname() . " ({$sig})");
                            $threatsFound++;
                        }
                    }

                    foreach ($this->spamKeywords as $keyword) {
                        if (stripos($content, $keyword) !== false) {
                            $this->error("  [!] KATA KUNCI SPAM/JUDOL di " . $file->getPathname() . " ({$keyword})");
                            $threatsFound++;
                        }
                    }
                }
            }
        }

        // 5. Scan database tables
        $this->line("\n[4/5] Memindai basis data dari konten spam/judol ...");
        $tablesToScan = ['users', 'projects', 'testimonials'];
        foreach ($tablesToScan as $table) {
            if (Schema::hasTable($table)) {
                $rows = DB::table($table)->get();
                foreach ($rows as $row) {
                    $rowStr = json_encode($row);
                    foreach ($this->spamKeywords as $keyword) {
                        if (stripos($rowStr, $keyword) !== false) {
                            $this->error("  [!] KATA KUNCI SPAM di tabel {$table} (ID: " . ($row->id ?? '?') . ")");
                            $threatsFound++;
                        }
                    }
                }
            }
        }

        // 6. Security configurations check & Cache Clearing
        $this->line("\n[5/5] Membersihkan cache aplikasi dan mengonfirmasi pengamanan ...");
        
        Artisan::call('optimize:clear');
        $this->info("  [✓] Cache aplikasi Laravel berhasil dibersihkan (view, route, config, cache).");

        // Verify storage .htaccess
        $storageHtaccess = storage_path('app/public/.htaccess');
        if (!file_exists($storageHtaccess)) {
            $this->warn("  [!] storage/app/public/.htaccess belum ada. Membuat proteksi eksekusi...");
            @file_put_contents($storageHtaccess, "# Prevent script execution\n<FilesMatch \"\.(php|php[0-9]|phtml|phar|sh|cgi|html)$\">\nDeny from all\n</FilesMatch>\nOptions -ExecCGI -Indexes\n");
            $this->info("  [✓] Proteksi eksekusi script storage berhasil dibuat.");
        } else {
            $this->info("  [✓] Proteksi eksekusi storage aktif.");
        }

        if (config('app.debug') && config('app.env') === 'production') {
            $this->warn("  [!] PERINGATAN: APP_DEBUG aktif di production! Disarankan set APP_DEBUG=false di .env.");
        }

        $this->line("\n-------------------------------------------------");
        if ($threatsFound === 0) {
            $this->info("HASIL PEMINDAIAN: Bersih! Tidak ditemukan file berbahaya atau injeksi.");
        } else {
            $this->error("HASIL PEMINDAIAN: Ditemukan {$threatsFound} potensi ancaman!");
            $this->line("Jalankan `php artisan security:clean --fix` untuk karantina/perbaikan otomatis.");
        }
        $this->line("-------------------------------------------------\n");

        return $threatsFound === 0 ? Command::SUCCESS : Command::FAILURE;
    }
}
