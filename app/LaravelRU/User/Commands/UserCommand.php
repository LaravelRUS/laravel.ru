<?php namespace LaravelRU\User\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use User;
use Role;

class UserCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'su:create_user';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Creating user.';

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
		$name = $this->argument("username");
		$password = $this->argument("password");
		$email = $this->argument("email");
		$isAdmin = $this->option("admin");

		$roleName = $isAdmin ? 'administrator' : 'user';

		$role = Role::whereName($roleName)->first();

		$user = User::create(['name'=>$name, 'password'=>$password, 'email'=>$email]);
		$user->is_confirmed = 1;

		$role->users()->save($user);



		$this->info("User $name created.");

	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
				array('username', InputArgument::REQUIRED, 'User Name.'),
				array('password', InputArgument::REQUIRED, 'User Password.'),
				array('email', InputArgument::REQUIRED, 'User Email.'),
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
				array('admin', 'a', InputOption::VALUE_NONE, 'Set admin permissions', null),
		);
	}

}
