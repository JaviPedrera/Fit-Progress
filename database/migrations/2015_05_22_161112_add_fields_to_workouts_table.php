<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToWorkoutsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('workouts', function(Blueprint $table)
		{
			$table->text('musc_group')->nullable();
			$table->text('comment')->nullable();
			$table->text('img')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('workouts', function(Blueprint $table)
		{
			$table->dropColumn('musc_group');
			$table->dropColumn('comment');
			$table->dropColumn('img');
		});
	}

}
