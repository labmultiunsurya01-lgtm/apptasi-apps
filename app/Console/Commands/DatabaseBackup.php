<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DatabaseBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:backup';
    protected $description = 'Melakukan backup database ke storage/app/backups';

    public function handle()
    {
        $filename = "backup-" . date('Y-m-d_H-i-s') . ".sql";
        $path = storage_path("app/backups/");

        if (!file_exists($path)) {
            mkdir($path, 0755, true);
        }

        $command = sprintf(
            'mysqldump --user=%s --password=%s --host=%s %s > %s',
            config('database.connections.mysql.username'),
            config('database.connections.mysql.password'),
            config('database.connections.mysql.host'),
            config('database.connections.mysql.database'),
            $path . $filename
        );

        $output = null;
        $resultCode = null;
        exec($command, $output, $resultCode);

        if ($resultCode === 0) {
            $this->info("Backup berhasil disimpan: backups/{$filename}");
        } else {
            $this->error("Gagal melakukan backup database. Pastikan mysqldump tersedia di PATH.");
        }
    }
}
