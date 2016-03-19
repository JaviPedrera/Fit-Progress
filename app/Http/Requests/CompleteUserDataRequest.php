<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class CompleteUserDataRequest extends Request {

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
			'name' 		=> 	'required|max:50',
			'surname' 	=>	'max:100',
			'age'		=>	'required',
			'height' 	=>  'required|numeric|max:240'
		];
	}

	public function messages()
	{
		$messages = [
			'name.required' 	=> 'Es necesario que introduzcas tu nombre.',
			'name.max' 			=> 'El nombre introducido es demasiado largo.',
			'surname.alpha' 	=> 'El apellido no puede contener carácteres especiales o numéricos.',
			'surname.max'	 	=> 'El apellido introducido es demasiado largo.',
			'age.required'	 	=> 'Es necesario que introduzcas una fecha de nacimiento.',
			'height.required' 	=> 'Es necesario que introduzcas tu altura.',
			'height.numeric' 	=> 'El valor introducido para la altura ha de ser numérico.',
			'height.max:240'	=> 'El valor introducido para la altura no es válido.',
		];

		return $messages;
	}

}
