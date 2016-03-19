{{--*/ $totalWeightsMonth0 = "" /*--}}
@if ( ! $workoutsMonth0->isEmpty())
	@foreach ($workoutsMonth0 as $workout)
		{{--*/ $month0 = $workout->created_at->formatLocalized('%B') /*--}}

		@foreach($workout->workoutexercises()->get() as $exercise)
			{{--*/ $weights0 = array_sum(explode("-",$exercise->weights)) /*--}} 
		@endforeach
		
		{{--*/ $totalWeightsMonth0 = array_sum($weights0) /*--}}
	@endforeach
@endif


{{--*/ $totalWeightsMonth1 = "" /*--}}
@if(!$workoutsMonth1->isEmpty())
	@foreach ($workoutsMonth1 as $workout)
		{{--*/ $month1 = $workout->created_at->formatLocalized('%B') /*--}}
		
		@foreach($workout->workoutexercises()->get() as $exercise)
			{{--*/ $weights1 = explode("-",$exercise->weights) /*--}} 
		@endforeach
		
		{{--*/ $totalWeightsMonth1 .= array_sum($weights1) /*--}}
		
	@endforeach
@endif

{{--*/ $totalWeightsMonth2 = "" /*--}}
@foreach ($workoutsMonth2 as $workout)
	{{--*/ $month2 = $workout->created_at->formatLocalized('%B') /*--}}
	
	@foreach($workout->workoutexercises()->get() as $exercise)
		{{--*/ $weights2 = explode("-",$exercise->weights) /*--}} 
	@endforeach

	{{--*/ $totalWeightsMonth2 .= array_sum($weights2) /*--}}
	
@endforeach

{{--*/ $totalWeightsMonth3 = "" /*--}}
@foreach ($workoutsMonth3 as $workout)
{{--*/ $month3 = $workout->created_at->formatLocalized('%B') /*--}}
	
	@foreach($workout->workoutexercises()->get() as $exercise)
		{{--*/ $weights3 = explode("-",$exercise->weights) /*--}} 
	@endforeach

	{{--*/ $totalWeightsMonth3 .= array_sum($weights3) /*--}}
	
@endforeach

{{--*/ $totalWeightsMonth4 = "" /*--}}
@foreach ($workoutsMonth4 as $workout)
{{--*/ $month4 = $workout->created_at->formatLocalized('%B') /*--}}
	
	@foreach($workout->workoutexercises()->get() as $exercise)
		{{--*/ $weights4 = explode("-",$exercise->weights) /*--}} 
	@endforeach

	{{--*/ $totalWeightsMonth4 .= array_sum($weights4) /*--}}
	
@endforeach

{{--*/ $totalWeightsMonth5 = "" /*--}}
@foreach ($workoutsMonth5 as $workout)
{{--*/ $month5 = $workout->created_at->formatLocalized('%B') /*--}}
	
	@foreach($workout->workoutexercises()->get() as $exercise)
		{{--*/ $weights5 = explode("-",$exercise->weights) /*--}} 
	@endforeach

	{{--*/ $totalWeightsMonth5 .= array_sum($weights5) /*--}}
	
@endforeach