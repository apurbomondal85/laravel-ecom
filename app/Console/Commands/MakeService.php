<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class MakeService extends Command
{
    protected $signature = 'make:service {name}';
    protected $description = 'Create a new service class';

    public function handle()
    {
        $name = ucfirst($this->argument('name'));
        $file = new Filesystem();

        // Define service directory path
        $servicePath = app_path('Library/Service');

        // Create the directory if it doesn’t exist
        if (!$file->exists($servicePath)) {
            $file->makeDirectory($servicePath, 0777, true, true);
        }

        // Define the full file path
        $serviceFile = "{$servicePath}/{$name}.php";

        if ($file->exists($serviceFile)) {
            $this->error("Service already exists!");
            return false;
        }

        // Generate the service class content
        $serviceTemplate = <<<PHP
        <?php

        namespace App\Library\Service;

        class {$name}
        {
            public function __construct()
            {
                // Constructor Logic
            }
        }
        PHP;

        // Create the service file
        $file->put($serviceFile, $serviceTemplate);

        $this->info("Service {$name} created successfully!");
    }
}
