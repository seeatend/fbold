<?php namespace SocialBid\Commands;

use Illuminate\Console\Command;
use DB, User,SocialAccount,Order,ServiceBid;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ClearDbCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'db:clean';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Clears database.';

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
		DB::statement('SET FOREIGN_KEY_CHECKS=0');
		User::truncate();
		SocialAccount::truncate();
		Order::truncate();
		ServiceBid::truncate();
		DB::table('blocked_users')->truncate();
		DB::table('user_settings')->truncate();
		Db::table('users_social_accounts')->truncate();
		DB::statement('SET FOREIGN_KEY_CHECKS=1');
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array();
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array();
	}

}
