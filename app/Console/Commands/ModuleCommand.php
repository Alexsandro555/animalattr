<?php

namespace App\Console\BaseCommands;

use Nwidart\Modules\Commands\GeneratorCommand;
use Nwidart\Modules\Traits\ModuleCommandTrait;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use App\Console\Commands\ReStub;

class ModuleCommand extends GeneratorCommand
{
  use ModuleCommandTrait;

  /**
   * The name of argument being used.
   *
   * @var string
   */
  protected $argumentName = 'name';


  protected function getNameArg() {
    return ucfirst(strtolower($this->argument('name')));
  }

  /**
   * Get path state.
   *
   * @return string
   */
  public function getDestinationFilePath()
  {
    $path = $this->laravel['modules']->getModulePath($this->getModuleName());
    return $path . 'Resources/assets/js/state.js';
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
      'NAME'    => $this->getNameArg()
    ]))->render();
  }

  /**
   * Get the stub file name based on the plain option
   * @return string
   */
  private function getStubName()
  {
    return '/stubs/tate.stub';
  }
}
