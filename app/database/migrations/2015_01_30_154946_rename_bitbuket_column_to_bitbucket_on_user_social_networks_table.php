<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameBitbuketColumnToBitbucketOnUserSocialNetworksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('user_social_networks', function (Blueprint $table)
		{
			$table->renameColumn('bitbuket', 'bitbucket');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('user_social_networks', function (Blueprint $table)
		{
			$table->renameColumn('bitbucket', 'bitbuket');
		});
	}

}
