<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateMeasureRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'm_biceps' 	=> 'required_without_all:m_forearm,m_leg,m_calf,m_waist,m_chest,m_back,m_neck|numeric',
			'm_forearm' => 'required_without_all:m_biceps,m_leg,m_calf,m_waist,m_chest,m_back,m_neck|numeric',
			'm_leg' 	=> 'required_without_all:m_biceps,m_forearm,m_calf,m_waist,m_chest,m_back,m_neck|numeric',
			'm_calf' 	=> 'required_without_all:m_biceps,m_forearm,m_leg,m_waist,m_chest,m_back,m_neck|numeric',
			'm_waist' 	=> 'required_without_all:m_biceps,m_forearm,m_leg,m_calf,m_chest,m_back,m_neck|numeric',
			'm_chest' 	=> 'required_without_all:m_biceps,m_forearm,m_leg,m_calf,m_waist,m_back,m_neck|numeric',
			'm_back' 	=> 'required_without_all:m_biceps,m_forearm,m_leg,m_calf,m_waist,m_chest,m_neck|numeric',
			'm_neck' 	=> 'required_without_all:m_biceps,m_forearm,m_leg,m_calf,m_waist,m_chest,m_back|numeric',
		];
	}

	public function messages()
	{
	  $messages = [ 
	  	'm_biceps.numeric' 	=> 'Biceps: El valor a introducir ha de ser numérico',
	  	'm_forearm.numeric' => 'Antebrazo: El valor a introducir ha de ser numérico',
	  	'm_leg.numeric' 	=> 'Muslo: El valor a introducir ha de ser numérico',
	  	'm_calf.numeric' 	=> 'Gemelo: El valor a introducir ha de ser numérico',
	  	'm_waist.numeric' 	=> 'Cintura: El valor a introducir ha de ser numérico',
	  	'm_chest.numeric' 	=> 'Pecho: El valor a introducir ha de ser numérico',
	  	'm_back.numeric' 	=> 'Espalda: El valor a introducir ha de ser numérico',
	  	'm_neck.numeric' 	=> 'Cuello: El valor a introducir ha de ser numérico',

	  	'm_biceps.required_without_all' => 'Al menos has de rellenar un valor !',
	  	'm_forearm.required_without_all'=> 'Al menos has de rellenar un valor !',
	  	'm_leg.required_without_all' 	=> 'Al menos has de rellenar un valor !',
	  	'm_calf.required_without_all' 	=> 'Al menos has de rellenar un valor !',
	  	'm_waist.required_without_all' 	=> 'Al menos has de rellenar un valor !',
	  	'm_chest.required_without_all' 	=> 'Al menos has de rellenar un valor !',
	  	'm_back.required_without_all' 	=> 'Al menos has de rellenar un valor !',
	  	'm_neck.required_without_all' 	=> 'Al menos has de rellenar un valor !',
	  	];

	  return $messages;
	}

}
