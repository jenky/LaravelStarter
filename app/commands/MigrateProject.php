<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class MigrateProject extends Command 
{

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'migrate:project';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Run migration and publishes configuration for all packages.';

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
	 * @return mixed
	 */
	public function fire()
	{
		$this->info('Staring...');

        $this->runAllCommands();

        $this->info('All Done.');
	}

    protected function runAllCommands()
    {
        // TODO: create log file and detect if command already used
        $_commands = Config::get('project');

        foreach ($_commands as $commandName => $commands) 
        {
            foreach ($commands as $command) 
            {
                foreach ($command as $key => $value) 
                {
                    if (in_array($key, array('argument', 'option')))
                    {
                        $key = '';                       
                    }            

                    $text = $commandName;

                    $text .= " {$key} {$value}";
                }

                $this->info("Calling: {$text}");
                $this->call($commandName, $command);
            }        
        }
    }
}
