<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ControllerGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:crud-controller
                            {class_name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create custom controller for crud';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $className = $this->argument('class_name');
        $controllerName = "{$className}Controller";

        $basePath = 'App\Http\Controllers\Api\\';
        if (PHP_OS != 'Windows') {
            $basePath = 'App/Http/Controllers/Api/';
        }

        // create folder and validate file
        $fileLocation = $basePath . $controllerName . ".php";
        if (file_exists($fileLocation)) {
            echo 'Controller already exists!';
            exit();
        }

        if (!file_exists(app_path('Http/Controllers/Api'))) {
            mkdir(app_path('Http/Controllers/Api'), 0777, true);
        }

        $skeleton = $this->getTemplate();
        $template = $this->generateTemplate(
            $className,
            $skeleton
        );

        // create file
        $this->createFile($fileLocation, $template);
    }

    private function getTemplate()
    {
        return file_get_contents(__DIR__ . "/../../../stubs/controller.crud.stub");
    }

    private function  generateTemplate(
        $className,
        $skeleton
    )
    {
        $controllerName = "{$className}Controller";
        $serviceName = "{$className}Service";

        return str_replace(
            ["{{controllerName}}", "{{className}}", "{{serviceName}}"],
            [$controllerName, $className, $serviceName],
            $skeleton
        );
    }

    private function createFile($path, $file)
    {
        file_put_contents($path, $file);
        echo "Controller has been created! \n";
    }
}
