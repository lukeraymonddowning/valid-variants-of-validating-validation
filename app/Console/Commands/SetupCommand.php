<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SetupCommand extends Command
{
    protected $signature = 'setup {--r|reset}';

    protected $description = "Setup this talk. It's show time.";

    public function handle(): int
    {
        // Reset git state
        $basePath = base_path();
        `cd {$basePath} && git reset --hard && git clean -f -d && git checkout HEAD`;

        // Migrate and seed the database
        $this->call('migrate:fresh', ['--seed' => true]);

        if ($this->option('reset') === null) {
            // Open the keynote presentation
            $presentation = base_path('_talk_assets/Valid Variants of Validating Validation.key');
            `open "{$presentation}"`;

            // Open the file uploads folder
            $uploads = base_path('_talk_assets/uploads');
            `open "{$uploads}"`;
        }

        return self::SUCCESS;
    }
}
