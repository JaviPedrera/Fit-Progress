<?php namespace App\Http\Controllers\User;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Auth;
use App\Picture;
use Illuminate\Support\Facades\Input;
use \Intervention\Image\Facades\Image;
use File;
use Carbon\Carbon;

class UserController extends Controller {

	public function getRegistration()
 	{
 		if (Auth::user()->name == "") {
 			return view('dashboard.registration');
 		} else {
 			return redirect('dashboard');
 		}
 	}

	public function postRegistration(Requests\CompleteUserDataRequest $request)
 	{
 		$user = Auth::user();

 		// User picture
		if (Input::file('image')) {
			$image = Image::make(Input::file('image'));
			$fullName = Input::file('image')->getClientOriginalName();
			$extension = Input::file('image')->getClientOriginalExtension();

			$pathToCreate = public_path() .'/images/'. $user->email . '/';
			$fullPath = $pathToCreate . $user->email . '.' . $extension;
			$pathDatabase = 'images/' . $user->email . '/' . $user->email . '.' .$extension;

			// Creating directory if it does not exists
			File::exists($pathToCreate) or File::makeDirectory($pathToCreate);

			$image->resize(null, 145, function ($constraint) { $constraint->aspectRatio(); })
				->crop(130,130)
				->save($fullPath);

			$user->picture = $pathDatabase;
		}

		// Birthday fix
		$birthday = Carbon::parse($request['age']);
		$age = $birthday->diffInYears(Carbon::now());

 		$user->name = $request->name;
 		$user->surname = $request->surname;
 		$user->sex = $request->sex;
 		$user->age = $age;
 		$user->height = $request->height;

 		$user->save();

 		return redirect('dashboard');
 	}

 	/**
 	 * [profile]
 	 * Get Profile view
 	 */
 	public function getProfile()
 	{
		$user = Auth::user();
 		
 		// Check if the user has already saved a weight
 		( ! $user->inbodies->isEmpty()) 
 			? $lastWeight = $user->inbodies()->first()->weight 
 			: $lastWeight = "-"; 

 		return view('dashboard.profile', compact('lastWeight'));
 	}

	public function postProfile(Request $request)
 	{
 		if(Input::file('image')) {
			$user = User::findOrFail(Auth::user()->id);

			$image = Image::make(Input::file('image'));
			$extension = Input::file('image')->getClientOriginalExtension();
			$fullName = Input::file('image')->getClientOriginalName();

			$pathToCreate = public_path() .'/images/'. Auth::user()->email . '/';
			$fullPath = $pathToCreate . Auth::user()->email . '.' . $extension;
			$pathDatabase = 'images/' . Auth::user()->email . '/' . Auth::user()->email . '.' .$extension;

			// Creating directory if it does not exists
			File::exists($pathToCreate) or File::makeDirectory($pathToCreate);

			$image->resize(null, 145, function ($constraint) {$constraint->aspectRatio();})
					->crop(130,130)
					->save($fullPath);

			$user->picture = $pathDatabase;
	 		$user->save();

	 		return redirect('dashboard');

		} else {
			$user = Auth::user();

	 		$user->name = $request->name;
	 		$user->surname = $request->surname;
	 		$user->height = $request->height;

	 		//	Has to be changed
	 		$user->email = $request->email;
	 		$user->password = bcrypt($request->password);

	 		$user->save();

	 		return redirect('dashboard');
		}
 	}
}