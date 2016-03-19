<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateInbodyRequest extends Request {

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
			// Inbody
			'weight' 		=> 'required|numeric',
			'imc'			=> 'numeric',
			'metabolism'	=> 'numeric',
			'muscle_weight' => 'numeric',
			'fat_weight' 	=> 'numeric',
			'fat_percent' 	=> 'numeric'

			// Measure
			// 'm_biceps' 	=> 'required_without_all:m_forearm,m_leg,m_calf,m_waist,m_chest,m_back,m_neck|numeric',
			// 'm_forearm' => 'required_without_all:m_biceps,m_leg,m_calf,m_waist,m_chest,m_back,m_neck|numeric',
			// 'm_leg' 	=> 'required_without_all:m_biceps,m_forearm,m_calf,m_waist,m_chest,m_back,m_neck|numeric',
			// 'm_calf' 	=> 'required_without_all:m_biceps,m_forearm,m_leg,m_waist,m_chest,m_back,m_neck|numeric',
			// 'm_waist' 	=> 'required_without_all:m_biceps,m_forearm,m_leg,m_calf,m_chest,m_back,m_neck|numeric',
			// 'm_chest'	=> 'required_without_all:m_biceps,m_forearm,m_leg,m_calf,m_waist,m_back,m_neck|numeric',
			// 'm_back' 	=> 'required_without_all:m_biceps,m_forearm,m_leg,m_calf,m_waist,m_chest,m_neck|numeric',
			// 'm_neck'	=> 'required_without_all:m_biceps,m_forearm,m_leg,m_calf,m_waist,m_chest,m_back|numeric'
		];
	}

	public function messages()
	{
		$messages = [
		// Inbody
		'weight.required' 		=> 'Es necesario que introduzcas tu peso.',
		'weight.numeric' 		=> 'Peso: El valor introducido ha de ser numérico.',
		'imc.numeric' 			=> 'IMC: El valor introducido  ha de ser numérico.',
		'metabolism.numeric' 	=> 'Metabolismo: El valor introducido ha de ser numérico.',
		'muscle_weight.numeric'	=> 'Peso muscular: El valor introducido ha de ser numérico.',
		'fat_weight.numeric'	=> 'Peso grasa: El valor introducido ha de ser numérico.',
		'fat_percent.numeric'	=> 'Porcentaje grasa: El valor introducido ha de ser numérico.'

		// Measure
		// 'm_biceps.numeric' 	=> 'Biceps: El valor a introducir ha de ser numérico',
	 //  	'm_forearm.numeric' => 'Antebrazo: El valor a introducir ha de ser numérico',
	 //  	'm_leg.numeric' 	=> 'Muslo: El valor a introducir ha de ser numérico',
	 //  	'm_calf.numeric' 	=> 'Gemelo: El valor a introducir ha de ser numérico',
	 //  	'm_waist.numeric' 	=> 'Cintura: El valor a introducir ha de ser numérico',
	 //  	'm_chest.numeric'	=> 'Pecho: El valor a introducir ha de ser numérico',
	 //  	'm_back.numeric' 	=> 'Espalda: El valor a introducir ha de ser numérico',
	 //  	'm_neck.numeric' 	=> 'Cuello: El valor a introducir ha de ser numérico',

	 //  	'm_biceps.required_without_all' 	=> 'Al menos has de rellenar un valor !',
	 //  	'm_forearm.required_without_all' 	=> 'Al menos has de rellenar un valor !',
	 //  	'm_leg.required_without_all' 		=> 'Al menos has de rellenar un valor !',
	 //  	'm_calf.required_without_all' 		=> 'Al menos has de rellenar un valor !',
	 //  	'm_waist.required_without_all' 		=> 'Al menos has de rellenar un valor !',
	 //  	'm_chest.required_without_all'		=> 'Al menos has de rellenar un valor !',
	 //  	'm_back.required_without_all' 		=> 'Al menos has de rellenar un valor !',
	 //  	'm_neck.required_without_all'		=> 'Al menos has de rellenar un valor !'
	  	];

	  	return $messages;
	}


}
