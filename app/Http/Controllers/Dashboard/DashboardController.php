<?php namespace App\Http\Controllers\Dashboard;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Auth;
use App\Models\Workout;
use App\Models\User;
use Illuminate\Support\Facades\Input;

// Gallery classes
use Carbon\Carbon;
use App\Models\Picture;
use \Intervention\Image\Facades\Image;
use File;

class DashboardController extends Controller {

	/**
	 *	Return the homepage
	 */
	public function home()
	{
		return view('home.index');
	}

	/**
	 *	Return the dashboard index with the necessary variables for displaying charts
	 */
	public function index($message = null)
	{
		$user = Auth::user();

		// Force the user to fill the name
		if ($user->name == "") {
			return view('dashboard.registration');
		}

		// Workouts
		$workouts = $user->workouts()->get();
		$workoutsDesc = $user->workouts()->orderBy('created_at','desc')->take(5);

		// Inbodies
		$inbodies = $user->inbodies()->take(5)->get();
		$lastInbody = $user->inbodies()->orderBy('created_at','desc')->get()->first();
		if ($inbodies->count() > 1) {
			$penInbody = $user->inbodies()->orderBy('created_at','desc')->get()->offSetGet(1);
		}

		// Measures
		$measures = $user->measures()->get();
		$lastMeasure = $user->measures()->orderBy('created_at','desc')->first();
		if($measures->count() > 1) {
			$penMeasure = $user->measures()->orderBy('created_at','desc')->get()->offSetGet(1);
		}

		// Events
		// Getting all collections
 		$workoutCollection = Auth::user()->workouts->all();
 		$measuresCollection = Auth::user()->measures->all();
 		$inbodiesCollection = Auth::user()->inbodies->all();
 		$picturesCollection = Auth::user()->pictures->all();

 		// Merging and sorting the new collection
 		$eventsCollection = collect(array_merge($workoutCollection, $measuresCollection, $inbodiesCollection, $picturesCollection));
 		$lastFourEvents = $eventsCollection->sortByDesc('created_at')->take(4);
		
		if ($message == null) {
			return view('dashboard.index', compact('user', 'workoutsDesc', 'workouts', 'lastInbody', 'inbodies', 'measures', 'lastMeasure', 'penMeasure', 'lastFourEvents'));
		} else {
			return view('dashboard.index', compact('user', 'workoutsDesc', 'workouts', 'lastInbody', 'inbodies', 'measures', 'lastMeasure', 'penMeasure', 'message'));
		}
	}

	/**
	 *	Return the registration view
	 */
	public function getRegistration()
 	{
 		if (Auth::user()->name == "") {
 			return view('dashboard.registration');
 		} else {
 			return redirect('dashboard');
 		}
 	}

 	/**
 	 * Handle the register
 	 */
 	public function postRegistration(Requests\CompleteUserDataRequest $request)
 	{
 		$user = Auth::user();

 		// User picture
		if (Input::file('image')) {
			$image = Image::make(Input::file('image'));
			$extension = Input::file('image')->getClientOriginalExtension();
			$fullName = Input::file('image')->getClientOriginalName();

			$pathToCreate = public_path() .'/images/'. Auth::user()->email . '/';
			$fullPath = $pathToCreate . Auth::user()->email . '.' . $extension;
			$pathDatabase = 'images/' . Auth::user()->email . '/' . Auth::user()->email . '.' .$extension;

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
	 *	Return view to gallery with all uploaded pictures
	 */
	public function getGallery()
	{
		$user = Auth::user();

		// Take all pictures
		$pictures = $user->pictures;

		return view ('dashboard.gallery', compact('pictures'));
	}

	/**
	 * 	This method will save the uploaded image with its respective thumbnail.
	 *  Raw: 		public/user@mail.com/imageuploaded.jpg
	 *  Thumbnail: 	public/user@mail.com/thumbnails/thumbnail-imageuploaded.jpg
	 */
	public function storeGallery(Request $request)
	{
		$image = Image::make(Input::file('image'));
		$originalName = Input::file('image')->getClientOriginalName();
		// $originalExtension = Input::file('image')->getClientOriginalExtension();

		// Local save path
		$path = public_path() .'/images/'. Auth::user()->email . '/';
		// Database path	
		$pathDatabase = 'images/' . Auth::user()->email . '/';
		
		// Creating directories if they don't exist
		// Raw image path 
		File::exists($path) or File::makeDirectory($path);
		// Thumbnail image path
		File::exists($path . 'thumbnails/') or File::makeDirectory($path . 'thumbnails/');

		// Raw image
		$image->save($path . $originalName);

		// Thumbnail image
		$image  ->resize(null, 400, function ($constraint) {$constraint->aspectRatio();})
				->crop(400,400)
				->save($path . 'thumbnails/thumbnail-' . $originalName);

		// Saving to database
		$picture = new Picture;
		$picture->user_id = Auth::user()->id;

		$pathToDisplay = $pathDatabase . $originalName;
		$pathToDisplayThumbnail = $pathDatabase . 'thumbnails/thumbnail-' . $originalName;

		$picture->route = $pathToDisplay;
		$picture->thumbnail = $pathToDisplayThumbnail;
		$picture->save();

		return redirect()->route('gallery.index');
	}

	/**
	 * This method will delete a picture previously uploaded
	 */
	public function deletePic($id)
	{
		$picture = Picture::findOrFail($id);
		$picture->delete();

		return redirect()->route('gallery.index');
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

 	public function editProfile(Request $request)
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

	 		return redirect()->route('dashboard.index');
		} else {

			$user = User::findOrFail(Auth::user()->id);

	 		$user->name = $request->name;
	 		$user->surname = $request->surname;
	 		$user->height = $request->height;
	 		$user->email = $request->email;

	 		$user->password = bcrypt($request->password);

	 		$user->save();

	 		return redirect()->route('dashboard.index');
		}
 	}

 	public function getCalendar()
 	{
 		return view('dashboard.calendar');
 	}

 	public function getTimeLine()
 	{
		// Getting all collections
 		$workouts = Auth::user()->workouts->all();
 		$measures = Auth::user()->measures->all();
 		$inbodies = Auth::user()->inbodies->all();
 		$pictures = Auth::user()->pictures->all();

 		// Merging and sorting the new collection
 		$eventsCollection = collect(array_merge($workouts, $measures, $inbodies, $pictures));
 		$eventsCollection->sortByDesc('created_at');

 		return view('timeline.index', compact('eventsCollection'));
 	}
}
