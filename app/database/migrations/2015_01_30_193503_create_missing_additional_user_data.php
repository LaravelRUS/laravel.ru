<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use LaravelRU\User\Models\User;
use LaravelRU\User\Models\UserInfo;
use LaravelRU\User\Models\UserSocialNetwork;

class CreateMissingAdditionalUserData extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		$users = User::with(['social', 'info'])->get();

		foreach ($users as $user)
		{
			if ( ! $user->info)
			{
				$user->info()->save(new UserInfo);
			}

			if ( ! $user->social)
			{
				$user->social()->save(new UserSocialNetwork);
			}
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
