<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;

class VueFilesCommand extends Command
{

  /**
   * The name of argument being used.
   *
   * @var string
   */
  protected $argumentName = 'name';

  /**
   * The console command name.
   *
   * @var string
   */
  protected $name = 'module:make-files';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Command create vue files';

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
   * Get the console command arguments.
   *
   * @return array
   */
  protected function getArguments()
  {
    return [
      ['name', InputArgument::REQUIRED, 'The name of the command.'],
      ['module', InputArgument::OPTIONAL, 'The name of module will be used.'],
    ];
  }

  /**
   * Execute the console command.
   *
   * @return mixed
   */
  public function handle()
  {
    $this->call('module:make-state', ['name' => ucfirst(strtolower($this->argument('name'))), 'module' => $this->argument('module')]);
    $this->call('module:make-getters', ['name' => ucfirst(strtolower($this->argument('name'))), 'module' => $this->argument('module')]);
    $this->call('module:make-mutations', ['name' => ucfirst(strtolower($this->argument('name'))), 'module' => $this->argument('module')]);
    $this->call('module:make-actions', ['name' => ucfirst(strtolower($this->argument('name'))), 'module' => $this->argument('module')]);
    $this->call('module:make-list', ['name' => ucfirst(strtolower($this->argument('name'))), 'module' => $this->argument('module')]);
    $this->call('module:make-edit', ['name' => ucfirst(strtolower($this->argument('name'))), 'module' => $this->argument('module')]);
    $this->call('module:make-api', ['name' => ucfirst(strtolower($this->argument('name'))), 'module' => $this->argument('module')]);

  }
}
