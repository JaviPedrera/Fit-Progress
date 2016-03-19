<?php namespace App\Http\Controllers\Dashboard;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Inbody;
use App\Models\Measure;
use Illuminate\Support\Facades\Input;
use App\Models\User;
use Auth;
use Intervention\Image\Facades\Image;
use File;

class InbodyController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$user = Auth::user();
		$inbodies = $user->inbodies()->take(10)->get();

		return view('dashboard.inbody.index',compact('inbodies'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$user = Auth::user();
		$inbodiesCount = $user->inbodies->count();

		return view('dashboard.inbody.create', compact('inbodiesCount'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		Inbody::create([
			'user_id' 	 	=> Auth::user()->id,
			'weight'	 	=> $request->weight,
			'imc'		 	=> $request->imc,
			'metabolism'	=> $request->metabolism,
			'muscle_weight' => $request->muscle_weight,
			'fat_weight' 	=> $request->fat_weight,
			'fat_percent' 	=> $request->fat_percent,
		]);

		if ($request->has('m_neck')) {
			Measure::create([
				'user_id' 	=> Auth::user()->id,
				'm_neck' 	=> $request->m_neck,
				'm_chest' 	=> $request->m_chest,
				'm_forearm' => $request->m_forearm,
				'm_waist' 	=> $request->m_waist,
				'm_calf' 	=> $request->m_calf,
				'm_leg' 	=> $request->m_leg,
				'm_biceps' 	=> $request->m_biceps,
				'm_back' 	=> $request->m_back
			]);
		}

		return redirect()->route('inbody.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$inbody = Inbody::findOrFail($id);

		$user = Auth::user();

		if($user->id == $inbody->owner->id) {
			return view('dashboard.inbody.show', compact('inbody'));
		} else {
			$error = "Acceso restringido! El inbody al que intentas acceder es de otra persona.";
			return view('errors.503', compact('error'));
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
		$inbody = Inbody::find($id);

		if (Auth::user()->id == $inbody->user_id) {
			return view('dashboard.inbody.edit', compact('inbody'));	
		} else {
			$error = "No eres el propietario de éste inbody !";	
			return view('errors.503', compact('error'));
		}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id,Request $request)
	{
		$inbody = Inbody::findOrFail($id);

		if(Auth::user()->id == $inbody->user_id)
		{
			$inbody->update($request->all());
			return redirect()->route('inbody.index');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$inbody = Inbody::findOrFail($id);
		$inbody->delete();

		return redirect()->route('inbody.index');
	}

}
