<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Input;

class Picture extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'pictures';

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
