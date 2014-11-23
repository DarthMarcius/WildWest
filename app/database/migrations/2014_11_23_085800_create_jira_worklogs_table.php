<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateJiraWorklogsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('jira_worklogs', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('user_name');
			$table->text('user_comment');
			$table->date('log_date');
			$table->integer('log_time_in_seconds');
			$table->string('issue_key');
			$table->string('issue_name');
			$table->string('issue_icon_url');
			$table->string('project_name');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('jira_worklogs');
	}

}
