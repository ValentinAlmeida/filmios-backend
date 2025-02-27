<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class GenerateJwtSecret extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jwt:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a new JWT secret key and update .env file';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $key = Str::random(32);

        $this->updateEnvFile($key);

        $this->info("JWT secret generated successfully: $key");
    }

    /**
     * Update the .env file with the new JWT secret key.
     */
    protected function updateEnvFile(string $key)
    {
        $envPath = base_path('.env');
        $envContent = file_get_contents($envPath);

        if (strpos($envContent, 'JWT_SECRET=') !== false) {
            $envContent = preg_replace('/^JWT_SECRET=.*/m', "JWT_SECRET=$key", $envContent);
        } else {
            $envContent .= "\nJWT_SECRET=$key\n";
        }

        file_put_contents($envPath, $envContent);
    }
}
