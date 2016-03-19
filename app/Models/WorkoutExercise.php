<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkoutExercise extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'workout_exercises';

	// Do not save timestamps
	public $timestamps = false;

	/**
	* 
	* Massive assignable fields
	*
	**/
	protected $fillable = ['exercise_name','muscular_group','sets','reps','weights','rest_time'];

	/**
	* 
	* Relations
	*
	**/
	public function workout()
	{
		return $this->belongsTo('App\Models\Workout','workout_id','id');
	}
	
}
