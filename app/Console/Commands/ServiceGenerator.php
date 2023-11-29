<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ServiceGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service
                            {class_name : Service class name}
                            {repository : Repository class name, you should create repository before create this service}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to create service file';

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
        $repoName = $this->argument('repository');
        $datetime = date('m/d/Y H:i:s');

        $basePath = 'App\Services\\';
        if (PHP_OS != 'Windows') {
            $basePath = 'App/Services/';
        }

        // create folder and validate file
        $fileLocation = $basePath . $className . ".php";
        if (file_exists($fileLocation)) {
            echo 'Service already exists!';
            exit();
        }

        if (!file_exists(app_path('Services'))) {
            mkdir(app_path('Services'), 0777, true);
        }

        $skeleton = $this->getTemplate();
        $template = $this->generateTemplate($className, $datetime, $repoName, $skeleton);

        // create file
        $this->createFile($fileLocation, $template);
    }

    private function getTemplate()
    {
        return file_get_contents(__DIR__ . "/../../../stubs/service.stub");
    }

    private function  generateTemplate($className, $datetime, $repoName, $skeleton)
    {
        return str_replace(
            ["{{class_name}}", "{{datetime}}", "{{repository_name}}"],
            [$className, $datetime, $repoName],
            $skeleton
        );
    }

    private function createFile($path, $file)
    {
        file_put_contents($path, $file);
        echo "Service has been created! \n";
    }
}
