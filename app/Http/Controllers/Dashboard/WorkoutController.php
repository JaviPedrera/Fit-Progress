<?php namespace App\Http\Controllers\Dashboard;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Workout;
use App\Models\WorkoutExercise;
use App\User;
use Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Input;

class WorkoutController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$user = Auth::user();		

		$workouts = $user->workouts()->createdAtDesc()->paginate(10);

		return view('dashboard.workout.index', compact('workouts'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('dashboard.workout.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$workout = new Workout;

		$workout->name = $request->name;
		$workout->user_id = Auth::user()->id;
		// Loop through muscular groups added	
		foreach ($request->musc_group as $musc_group) {
			$workout->musc_group .= $musc_group . " ";
		}
		$workout->comment = $request->comment;
		$workout->save();

		// Exercises that belongs to the workout
		// Get the workout id after saving it
		$workoutId = $workout->id;

		$exercisesCount = count($request['exercise_name']);
		// Loop each one of the exercises added
		for ($e=0 ; $e<$exercisesCount ; $e++) {
			$workoutExercise = new WorkoutExercise;
			$workoutExercise->muscular_group = $request->muscular_group[$e];
			$workoutExercise->exercise_name = $request->exercise_name[$e];
			$workoutExercise->sets = $request->sets[$e];
			$workoutExercise->reps = $request->reps[$e];
			$workoutExercise->weights = $request->weights[$e];
			$workoutExercise->rest_time = $request->rest_time[$e];
			$workoutExercise->workout_id = $workoutId;

			$workoutExercise->save();
		}
		return redirect('dashboard');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$workout = Workout::findOrFail($id);
		
		// Check if the user who is requesting the workout is the owner
		if (Auth::user()->id == $workout->owner()->first()->id)	{
			$exercises = $workout->workoutexercises->all();
			$muscle = $workout->musc_group;

			return view('dashboard.workout.show', compact('workout','exercises'));
		} else {
			return redirect('dashboard');
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$workout = Workout::findOrFail($id);

		return view('dashboard.workout.edit', compact('workout'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request,$id)
	{
		$workout = Workout::findOrFail($id);

		if (Auth::user()->id == $workout->user_id) {
			$workout->name = $request->name;
			$workout->comment = $request->comment;
			$workout->save();

			$workoutId = $workout->id;

			$i = 0;
			foreach($workout->workoutexercises()->get() as $exercise) {
				$exercise = WorkoutExercise::findOrFail($exercise->id);
				$exercise->muscular_group = $request->muscular_group[$i];
				$exercise->exercise_name = $request->exercise_name[$i];
				$exercise->sets = $request->sets[$i];
				$exercise->reps = $request->reps[$i];
				$exercise->weights = $request->weights[$i];
				$exercise->rest_time = $request->rest_time[$i];
				$exercise->workout_id = $workoutId;

				$exercise->save();

				$i++;
			}

			if ($request->exercise_name_new) {
				$n = 0;

				foreach ($request->exercise_name_new as $newExercise) {
					$newExercise = new WorkoutExercise;

					$newExercise->muscular_group = $request->muscular_group_new[$n];
					$newExercise->exercise_name = $request->exercise_name_new[$n];
					$newExercise->sets = $request->sets_new[$n];
					$newExercise->reps = $request->reps_new[$n];
					$newExercise->weights = $request->weights_new[$n];
					$newExercise->rest_time = $request->rest_time_new[$n];
					$newExercise->workout_id = $workoutId;
					$newExercise->save();

					$n++;
				}
			}
			return redirect()->route('dashboard.index');
		} else {
			return "jeje";
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id, Request $request)
	{
		$workout = Workout::findOrFail($id);
	   	$workout->delete();
	   	$message = "Su rutina fue borrada con éxito !";

	   	return redirect()->route('dashboard.index', $message);
	}

	public function getComparator()
	{
		$user = Auth::user();

		// Check if there are enough workouts to compare
		$workoutsCount = $user->workouts()->count();

		if($workoutsCount < 2) {
			$error = "Aún no dispones de rutinas suficientes para comparar";
			return view('dashboard.workout.comparator', compact ('error'));	
		}
		
		return view('dashboard.workout.comparator');	
	}
}
