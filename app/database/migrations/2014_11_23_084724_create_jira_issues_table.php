<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateJiraIssuesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('jira_issues', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('issue_id');
			$table->integer('issue_key');
			$table->string('issue_name');
			$table->text('issue_description');
			$table->string('status_name');
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
		Schema::drop('jira_issues');
	}

}
