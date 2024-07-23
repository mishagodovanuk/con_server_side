<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class SetFilePermissions extends Command
{
    protected $signature = 'permissions:set';

    protected $description = 'Set default file permissions for the project';

    public function handle()
    {
        $files = File::allFiles(base_path());

        foreach ($files as $file) {
            $path = $file->getRealPath();
            exec('chmod 644 "'.$path.'"');
        }

        $this->info('Default file permissions set for the project.');
    }
}
