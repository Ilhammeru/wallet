<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class CreateCRUDCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:crud
                            {model_name}
                            {--without-migration}
                            {--only-mvc}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to create CRUD skeleton';

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
        $serviceName = $modelName . "Service";
        $repoName = $modelName . "Repository";

        $withoutMigration = $this->option('without-migration');
        $onlyMvc = $this->option('only-mvc');

        if ($withoutMigration || $onlyMvc) {
            Artisan::call("make:model {$modelName}");
        } else {
            Artisan::call("make:model {$modelName} -m");
        }

        Artisan::call("make:repository {$repoName} {$modelName}");
        Artisan::call("make:service {$serviceName} {$repoName}");

        $storeRequestName = "Create";
        $updateRequestName = "Update";
        $storeRequest = "{$modelName}/{$storeRequestName}";
        $updateRequest = "{$modelName}/{$updateRequestName}";

        if (!$onlyMvc) {
            Artisan::call("make:request {$storeRequest}");
            Artisan::call("make:request {$updateRequest}");
        }

        // create controller
        if ($onlyMvc) {
            $controllerName = "{$modelName}Controller";
            Artisan::call("make:controller {$controllerName}");
        } else {
            Artisan::call("make:crud-controller {$modelName}");
        }
    }
}
