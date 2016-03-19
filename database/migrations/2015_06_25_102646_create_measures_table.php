<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeasuresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('measures', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->foreign('user_id')
					->references('id')
					->on('users')
					->onDelete('cascade');
			$table->float('m_neck')->nullable();
			$table->float('m_chest')->nullable();
			$table->float('m_forearm')->nullable();
			$table->float('m_waist')->nullable();
			$table->float('m_calf')->nullable();
			$table->float('m_leg')->nullable();
			$table->float('m_biceps')->nullable();
			$table->float('m_back')->nullable();
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
		Schema::drop('measures');
	}

}
