<?php

namespace App\Console\Commands;

use Nwidart\Modules\Commands\GeneratorCommand;
use Nwidart\Modules\Traits\ModuleCommandTrait;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class VuexActionsCommand extends GeneratorCommand
{
  use ModuleCommandTrait;

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
  protected $name = 'module:make-actions';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Command create actions file';

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
   * Get path state.
   *
   * @return string
   */
  public function getDestinationFilePath()
  {
    $path = $this->laravel['modules']->getModulePath($this->getModuleName());
    return $path . 'Resources/assets/js/vuex/'.$this->argument('name').'/actions.js';
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
   * Get the console command options.
   *
   * @return array
   */
  protected function getOptions()
  {
    return [
      ['command', null, InputOption::VALUE_OPTIONAL, 'The terminal command that should be assigned.', null],
    ];
  }

  /**
   * @return string
   */
  protected function getTemplateContents()
  {
    return (new ReStub($this->getStubName(), [
      'NAME'    => $this->argument('name')
    ]))->render();
  }

  /**
   * Get the stub file name based on the plain option
   * @return string
   */
  private function getStubName()
  {
    return '/stubs/actions.stub';
  }
}
