<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Measure extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'measures';

	/**
	* 
	* Massive assignable fields
	*
	**/
	protected $fillable = ['user_id','m_neck','m_chest','m_forearm','m_waist','m_calf','m_leg','m_biceps','m_back'];

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
