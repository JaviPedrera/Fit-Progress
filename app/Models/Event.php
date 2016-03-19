<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'events';

	/**
	* 
	* Massive assignable fields
	*
	*/
	protected $fillable = ['id','title','start','end','url','allDay'];

}
