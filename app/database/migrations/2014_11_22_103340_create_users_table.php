<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('username')->unique();
			$table->string('email')->unique();
			$table->string('password', 60);
			$table->integer('permission');
                        $table->rememberToken();
			$table->timestamps();
		});
                
                // Insert default users
                DB::table('users')->insert(array(
                    array(
                        'username' => 'admin',
                        'email' => 'name@domain.com',
                        'password' => Hash::make('test'),
                        'permission' => '1'
                    ),
                    array(
                        'username' => 'user',
                        'email' => 'name2@domain.com',
                        'password' => Hash::make('test'),
                        'permission' => '0'
                    ),
                    array(
                        'username' => 'super-admin',
                        'email' => 'name3@domain.com',
                        'password' => Hash::make('test'),
                        'permission' => '1'
                    ),
                ));
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
