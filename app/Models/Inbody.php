<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inbody extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'inbody';

	/**
	* 
	* Massive assignable fields
	*
	*/
	protected $fillable = ['user_id','weight','imc','metabolism','muscle_weight','fat_weight','fat_percent'];

	/**
	 * 
	 *	Relations
	 * 
	 */
	public function owner()
	{
		return $this->belongsTo('App\Models\User','user_id','id');
	}
	
}