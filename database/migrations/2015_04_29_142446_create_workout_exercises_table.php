<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkoutExercisesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('workout_exercises', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('exercise_name');
			$table->string('muscular_group');
			$table->integer('workout_id')->unsigned();
			$table->foreign('workout_id')
					->references('id')
					->on('workouts')
					->onDelete('cascade');
			$table->string('sets');
			$table->string('reps');
			$table->string('weights');
			$table->string('rest_time');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('workout_exercises');
	}

}
