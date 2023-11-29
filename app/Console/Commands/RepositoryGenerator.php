<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RepositoryGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository {class_name} {model_name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to create new repository';

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
        $modelName = $this->argument('model_name');
        $className = $this->argument('class_name');

        $basePath = 'App\Repositories\\';
        if (PHP_OS != 'Windows') {
            $basePath = 'App/Repositories/';
        }

        // create folder and validate file
        $fileLocation = $basePath . $className . ".php";
        if (file_exists($fileLocation)) {
            echo 'Repository already exists!';
            exit();
        }

        if (!file_exists(app_path('Repositories'))) {
            mkdir(app_path('Repositories'), 0777, true);
        }

        $skeleton = $this->getTemplate();
        $template = $this->generateTemplate($className, $modelName, $skeleton);

        // create file
        $this->createFile($fileLocation, $template);
    }

    private function getTemplate()
    {
        return file_get_contents(__DIR__ . "/../../../stubs/repository.stub");
    }

    private function  generateTemplate($className, $model, $skeleton)
    {
        return str_replace(
            ["{{class_name}}", "{{model}}"],
            [$className, $model],
            $skeleton
        );
    }

    private function createFile($path, $file)
    {
        file_put_contents($path, $file);
        echo "Repository has been created! \n";
    }
}
