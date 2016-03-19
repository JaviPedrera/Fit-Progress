<?php namespace App\Http\Controllers\Dashboard;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Inbody;
use Illuminate\Support\Facades\Input;
use App\User;
use Auth;
use Intervention\Image\Facades\Image;
use File;
use \App\Measure;

class MeasureController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$user = Auth::user();
		$measures = $user->measures()->orderBy('created_at','desc')->paginate(10);

		return view('dashboard.measure.index', compact('measures'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('dashboard.measure.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Requests\CreateMeasureRequest $request)
	{
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

		return redirect()->route('measure.index');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$measure = Measure::findOrFail($id);

		return view('dashboard.measure.edit',compact('measure'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
		$measure = Measure::findOrFail($id);
		$measure->update($request->all());
		
		return redirect()->route('measure.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$measure = Measure::findOrFail($id);
		$measure->delete();

		return redirect()->route('measure.index');
	}

}
