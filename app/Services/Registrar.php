<?php namespace App\Services;

use App\Models\User;
use Validator;
use Illuminate\Contracts\Auth\Registrar as RegistrarContract;

use Carbon\Carbon;
use App\Picture;
use \Intervention\Image\Facades\Image;
use File;
use Illuminate\Support\Facades\Input;

class Registrar implements RegistrarContract {

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	public function validator(array $data)
	{
		return Validator::make($data, [
			'email' => 'required|email|max:255|unique:users',
			'password' => 'required|confirmed|min:6',
		]);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return User
	 */
	public function create(array $data)
	{
		return User::create([
			'email' => $data['email'],
			'password' => bcrypt($data['password']),
			'picture' => "images/default_avatar.png"
		]);

	}
}
