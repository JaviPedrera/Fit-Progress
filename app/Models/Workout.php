<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Workout extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'workouts';

	/**
	 * 
	 *	Massive assignable fields
	 * 
	 */
	protected $fillable = ['name','user_id','created_at'];

	/**
	 * 
	 *	Relations
	 * 
	 */
	public function owner()
	{
		return $this->belongsTo('App\Models\User','user_id','id');
	}

	public function workoutexercises()
	{
		return $this->hasMany('App\Models\WorkoutExercise','workout_id','id');
	}

	/**
	 * 
	 *	Scopes
	 * 
	 */
	public function scopeFilterByMuscle($query,$muscle)
	{
		$query->where('musc_group','LIKE',"%" . $muscle . "%");
	}

	public function scopeLastMonth($query)
	{
		$query->where('created_at','>=',Carbon::now()->startOfMonth());
	}

	public function scopeCreatedAtDesc($query)
	{
		$query->orderBy('created_at', 'desc');
	}

	/**
	 *	scopeBetweenMonths will perform a where clause between the beggining of the two selected months
	 */
	public function scopeBetweenMonths($query, $month1, $month2 = null)
	{
		$query->where('created_at','>',Carbon::now()->startOfMonth()->subMonth($month1))
			->where('created_at','<',Carbon::now()->startOfMonth()->subMonth($month2));
	}

	/**
	 * 
	 *	More methods
	 * 
	 */
	public function lastMonthMuscleCount($muscle)
	{
		return $this->scopeFilterByMuscle($muscle)
				->lastMonth()
				->count();
	}
	
	public function getDiffHours()
	{
		return $this->created_at->diffInHours();
	}
	
}