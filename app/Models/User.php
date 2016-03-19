<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'surname', 'email', 'sex', 'password', 'age', 'height','picture'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	/**
	 * 
	 *	Relations
	 * 
	 */
	public function workouts()
	{
		return $this->hasMany('App\Models\Workout', 'user_id', 'id');
	}

	public function inbodies()
	{
		return $this->hasMany('App\Models\Inbody','user_id','id');
	}

	public function measures()
	{
		return $this->hasMany('App\Models\Measure','user_id','id');
	}

	public function pictures()
	{
		return $this->hasMany('App\Models\Picture','user_id','id');
	}

}
