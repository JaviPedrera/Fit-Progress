@extends('layouts.layout')

@section('title', 'Panel de control')

@section('current','Panel de control')

@section('content')
	<?php $colCount = 0; ?>
	{{-- Carbon Translator Plugin --}}
	{{--*/ use Jenssegers\Date\Date /*--}}
	{{ Date::setLocale('es') }}

	{{-- Include modal if is the first time --}}
	@if($inbodies->isEmpty() && $workouts->isEmpty() && $measures->isEmpty())
		@include('partials.modal', [
			'header' 	=>	'¡Bienvenido ' . Auth::user()->name . '!',
			'content' 	=>	'Todo está listo! Éste es tu panel de control, aquí encontrarás un resumen gráfico de todos tus datos a medida que vayas creando rutinas, inbodies y mediciones.',
		])
	@endif

	{{----------------------------------------------------------------------------------------------------}}
	{{--------------------------------------------- WORKOUTS ---------------------------------------------}}
	{{----------------------------------------------------------------------------------------------------}}
	<?php 
	// Get workouts group by month
	$workoutsMonth0 = $user->workouts()->lastMonth()->get();
	$workoutsMonth1 = $user->workouts()->betweenMonths(1,0)->get();
	$workoutsMonth2 = $user->workouts()->betweenMonths(2,1)->get();
	$workoutsMonth3 = $user->workouts()->betweenMonths(3,2)->get();
	$workoutsMonth4 = $user->workouts()->betweenMonths(4,3)->get();
	$workoutsMonth5 = $user->workouts()->betweenMonths(5,4)->get();

	/**
	 * TOTAL WEIGHT BLOCK-FLAT
	 */
	for ($i=0; $i<6; $i++) {
		// Declaring totalWeights variables for debugging foreach error
		${"workoutWeights" . $i} = array();
		${"totalWeightsMonth" . $i} = "";
		// Check if there are any workout before enter the loop
		if ( ! ${"workoutsMonth" . $i}->isEmpty()) {

			foreach (${"workoutsMonth" . $i} as $workout) {
				// Get month name
				${"monthTotalWeightName" . $i} = $workout->created_at->formatLocalized('%B');

				// Loop each exercise and get the total amount of weight
				foreach ($workout->workoutexercises as $exercise) {
					// Explode the exercise weights (40-50-60-60)
					$exerciseWeights = explode("-", $exercise->weights);
					// Sum the exercise weights and insert into an array
					${"workoutWeights" . $i}[] = array_sum($exerciseWeights);
				}

				// Insert into array the workouts total weights sum
				${"totalWeightsMonth" . $i} = array_sum(${"workoutWeights" . $i});
			}

		}
	}

	$totalWeights = [
		$totalWeightsMonth0, 
		$totalWeightsMonth1, 
		$totalWeightsMonth2, 
		$totalWeightsMonth3, 
		$totalWeightsMonth4, 
		$totalWeightsMonth5
	];
	?>

	@if( ! $user->workouts->isEmpty())
		<?php 
		/**
		 * REST BLOCK-FLAT
		 *
		 * MUSCULAR RESUME BLOCK-FLAT
		 */
		// Emptying count variables for debugging Chart.js error. It's needed to pass at least an empty variable
		$lastMonthChestCount = "";
		$lastMonthBackCount = "";
		$lastMonthShoulderCount = "";
		$lastMonthLegsCount = "";
		$lastMonthAbsCount = "";
		$lastMonthBicepsCount = "";
		$lastMonthTricepsCount = "";

		// Catching hours and workouts count group by muscular group
		// Hours since last CHEST workout and total CHEST workout count
		if ($user->workouts()->filterByMuscle('Pectoral')->get()->isEmpty()) {
			$chestHours = 72;
			$lastMonthChestCount = 0;
		} else {
			$chestHours = $user->workouts()->filterByMuscle('Pectoral')->get()->last()->getDiffHours();
			$lastMonthChestCount = $user->workouts()->filterByMuscle('Pectoral')->lastMonth()->count();
		}

		// Hours since last BACK workout and total BACK workout count
		if ($user->workouts()->filterByMuscle('Espalda')->get()->isEmpty()) {
			$backHours = 72;
			$lastMonthBackCount = 0;
		} else {
			$backHours = $user->workouts()->filterByMuscle('Espalda')->get()->last()->getDiffHours();
			$lastMonthBackCount = $user->workouts()->filterByMuscle('Espalda')->lastMonth()->count();
		}

		// Hours since last SHOULDER workout and total SHOULDER workout count
		if ($user->workouts()->filterByMuscle('Hombros')->get()->isEmpty()) {
			$shoulderHours = 72;
			$lastMonthShoulderCount = 0;
		} else {
			$shoulderHours = $user->workouts()->filterByMuscle('Hombros')->get()->last()->getDiffHours();
			$lastMonthShoulderCount = $user->workouts()->filterByMuscle('Hombros')->lastMonth()->count();
		}

		// Hours since last LEGS workout and total LEGS workout count
		if ($user->workouts()->filterByMuscle('Piernas')->get()->isEmpty()) {
			$legsHours = 72;
			$lastMonthLegsCount = 0;
		} else {
			$legsHours = $user->workouts()->filterByMuscle('Piernas')->get()->last()->getDiffHours();
			$lastMonthLegsCount = $user->workouts()->filterByMuscle('Piernas')->lastMonth()->count();
		}

		// Hours since last ABS workout and total ABS workout count
		if ($user->workouts()->filterByMuscle('Abdomen')->get()->isEmpty()) {
			$absHours = 72;
			$lastMonthAbsCount = 0;
		} else {
			$absHours = $user->workouts()->filterByMuscle('Abdomen')->get()->last()->getDiffHours();
			$lastMonthAbsCount = $user->workouts()->filterByMuscle('Abdomen')->lastMonth()->count();
		}

		// Hours since last BICEPS workout and total BICEPS workout count
		if ($user->workouts()->filterByMuscle('Biceps')->get()->isEmpty()) {
			$bicepsHours = 72;
			$lastMonthBicepsCount = 0;
		} else {
			$bicepsHours = $user->workouts()->filterByMuscle('Biceps')->get()->last()->getDiffHours();
			$lastMonthBicepsCount = $user->workouts()->filterByMuscle('Biceps')->lastMonth()->count();
		}

		// Hours since last TRICEPS workout and total TRICEPS workout count
		if ($user->workouts()->filterByMuscle('Triceps')->get()->isEmpty()) {
			$tricepsHours = 72;
			$lastMonthTricepsCount = 0;
		} else {
			$tricepsHours = $user->workouts()->filterByMuscle('Triceps')->get()->last()->getDiffHours();
			$lastMonthTricepsCount = $user->workouts()->filterByMuscle('Triceps')->lastMonth()->count();
		}

		?>

		{{-- Starting variable colCount for grouping columns in rows of three --}}
		{{--*/ $colCount += 3 /*--}}
		<div class="row">
			<div class="col-lg-12">
				<!-- WORKOUT RESUME ROW  -->
				<div class="block-flat">
					<div class="header">
						<h1>Tus últimas rutinas
							<div class="pull-right">
								<a data-placement="top" data-toggle="tooltip" data-original-title="Ver todas" href="{{ route('workout.index') }}" class="btn btn-primary"><i class="fa fa-list"></i></a>
								<a data-placement="top" data-toggle="tooltip" data-original-title="Crear nueva" href="{{ route('workout.create') }}" class="btn btn-warning"><i class="fa fa-plus"></i></a>
							</div>
						</h1>
					</div>
					<div class="content">
						<div class="table-responsive">
							<table class="table no-border hover">
								<thead class="no-border">
									<tr>
										<th><strong>Nombre</strong></th>
										<th><strong>Fecha</strong></th>
										<th><strong>Grupos Musculares</strong></th>
										<th></th>
										<th><strong>Acciones</strong></th>
									</tr>
								</thead>					
								<tbody class="no-border-y">
									@foreach($workoutsDesc->get() as $workout)
										<tr>
											<td>{{ $workout->name }}</td>
											<td class="capitalize">{{ Date::parse($workout->created_at)->format('l \&\n\b\s\p; j-M-Y \&\n\b\s\p; H:i') }}</td>
											<td>{{ $workout->musc_group }}</td>
											<td></td>
			        						<td>
			          							<a data-placement="top" data-toggle="tooltip" data-original-title="Ver" href="{{ route('workout.show', ['id' => $workout->id]) }}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
												<a data-placement="top" data-toggle="tooltip" data-original-title="Editar" href="{{ route('workout.edit', ['id' => $workout->id]) }}" class="btn btn-success"><i class="fa fa-pencil"></i></a>
												{!! Form::open(['route' => ['workout.destroy', $workout->id], 'style' =>'display:inline-block;', 'method' => 'DELETE']) !!}
													<button data-placement="top" data-toggle="tooltip" data-original-title="Eliminar" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
												{!! Form::close() !!}
			        						</td>
										</tr>						
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>

		@if($colCount % 3 == 0)
			<div class="row">
		@endif
		{{--*/ $colCount++ /*--}}
		
		<!-- REST BLOCK-FLAT -->
		<div class="col-lg-4 force-height">
			<div class="block-flat force-height" style="height: 100%">
				<div class="header">
					<h1 class="responsive-header">Recuperación muscular</h1>
				</div>
				<div class="content">
					<div class="progress">
					  <div class="{{ printColorBar($chestHours) }}" role="progressbar" aria-valuenow="50" aria-valuemin="72" aria-valuemax="" style="width:{{ $chestHours*1.39 }}%"><span class="pull-left" style="color:black; margin-left:20px;">Pectoral</span></div>
					</div>
					<div class="progress">
					  <div class="{{ printColorBar($backHours) }}" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="72" style="width: {{ $backHours*1.39 }}%"><span class="pull-left" style="color:black; margin-left:20px;">Espalda</span> </div>
					</div>
					<div class="progress">
					  <div class="{{ printColorBar($shoulderHours) }}" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="72" style="width: {{ $shoulderHours*1.39 }}%"><span class="pull-left" style="color:black; margin-left:20px;">Hombros</span></div>
					</div>
					<div class="progress">
					  <div class="{{ printColorBar($legsHours) }}" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="72" style="width: {{ $legsHours*1.39 }}%"><span class="pull-left" style="color:black; margin-left:20px;">Piernas</span></div>
					</div>
					<div class="progress">
					  <div class="{{ printColorBar($absHours) }}" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: {{ $absHours*1.39 }}%"><span class="pull-left" style="color:black; margin-left:20px;">Abdomen</span></div>
					</div>
					<div class="progress">
					  <div class="{{ printColorBar($bicepsHours) }}" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: {{ $bicepsHours*1.39 }}%"><span class="pull-left" style="color:black; margin-left:20px;">Biceps</span></div>
					</div>
					<div class="progress">
					  <div class="{{ printColorBar($tricepsHours) }}" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: {{ $tricepsHours*1.39 }}%"><span class="pull-left" style="color:black; margin-left:20px;">Triceps</span></div>
					</div>
			  	</div>
			  </div>
		</div>

		@if($colCount % 3 == 0)
			</div>
			<div class="row">
		@endif
		{{--*/ $colCount++ /*--}}
		<!-- MUSCULAR RESUME BLOCK-FLAT  -->
		<div class="col-lg-4">
			<div class="block-flat force-height">
				<div class="header">
					<h1 class="responsive-header">Trabajo muscular <small>(Último mes)</small></h1>
				</div>
				<div class="content">
					<div>
						<canvas id="muscular_resume" height="54px" width="100%"></canvas>
					</div>
					<div class="text-center" >
						<ul>
							<p>
								<li style="display:inline; text-decoration: none"><canvas width="12" height="12" style="background-color: #008BFF; border-radius:3px"></canvas> Pectoral</li>
								<li style="display:inline; text-decoration: none"><canvas width="12" height="12" style="background-color: #FF0000; border-radius:3px"></canvas> Espalda</li>
								<li style="display:inline; text-decoration: none"><canvas width="12" height="12" style="background-color: #00E2FF; border-radius:3px"></canvas> Hombro</li>
								<li style="display:inline; text-decoration: none"><canvas width="12" height="12" style="background-color: #68CF00; border-radius:3px"></canvas> Pierna</li>
							</p>
							<p>
								<li style="display:inline; text-decoration: none"><canvas width="12" height="12" style="background-color: #F6FF00; border-radius:3px"></canvas> Abdomen</li>
								<li style="display:inline; text-decoration: none"><canvas width="12" height="12" style="background-color: #FF8C8C; border-radius:3px"></canvas> Biceps</li>
								<li style="display:inline; text-decoration: none"><canvas width="12" height="12" style="background-color: #C4F8FF; border-radius:3px"></canvas> Triceps</li>
							</p>
						</ul>
					</div>
				</div>
			</div>
		</div>
		@if($colCount % 3 == 0)
			</div>
		@endif
		
		@if ( ! $workoutsMonth0->isEmpty() && ! $workoutsMonth1->isEmpty())
			@if($colCount % 3 == 0)
				<div class="row">
			@endif
			<!-- TOTAL WEIGHT BLOCK-FLAT -->
			{{--*/ $colCount++ /*--}}
			<div class="col-lg-4 force-height">
				<div class="block-flat force-height">
					<div class="header">
						<h1 class="responsive-header">Peso Levantado</h1>
					</div>
					<div class="content">
						<div>
							<canvas id="total_weight" height="70px" width="100%"></canvas>
						</div>
					</div>
				</div>
			</div>
			@if($colCount % 3 == 0)
				</div>
			@endif
		@endif
	@else
		@if($colCount % 3 == 0)
			<div class="row" style="margin: 10px 0">
		@endif
		{{--*/ $colCount++ /*--}}
		<div class="col-lg-4">
			<div class="alert alert-info alert-white rounded text-center force-height">
				<div class="icon"><i class="fa fa-info-circle"></i></div> 
				<div class="col-xs-12" style="margin-top: 23%">
					<h1>Aún no has añadido ninguna rutina!</h1>
					<a href="{{ route('workout.create') }}" class="btn btn-warning">Añade tu primera rutina</a>
				</div>
			</div>
		</div>
		@if($colCount % 3 == 0)
			</div>
		@endif
	@endif

	{{----------------------------------------------------------------------------------------------------}}
	{{--------------------------------------------- INBODIES ---------------------------------------------}}
	{{----------------------------------------------------------------------------------------------------}}

	@if(!$inbodies->isEmpty())
		@if($colCount % 3 == 0)
			<div class="row">
		@endif
		{{--*/ $colCount++ /*--}}
		<div class="col-lg-4 force-height">
			<div class="block-flat force-height" style="height:100%">
				<div class="header">							
					<h1 class="responsive-header">Tu último Inbody
						<a href="{{ route('inbody.create') }}" class="btn btn-warning" data-placement="top" data-toggle="tooltip" data-original-title="Crear nuevo"><i class="fa fa-plus"></i></a>
					</h1>
				</div>
				<div class="content">
					<table class="no-border hover">
						<tbody class="no-border-y">
							<tr>
								<td style="width:50%;"></i>Peso</td>
								<td>{{ ($lastInbody->weight == 0) ? '-' : $lastInbody->weight . ' kg'}}</td>
							</tr>
							<tr>
								<td style="width:50%;">Masa Muscular</td>
								<td>{{ ($lastInbody->muscle_weight == 0) ? '-' : $lastInbody->muscle_weight . ' kg'}}</td>
							</tr>
							<tr>
								<td style="width:50%;">Metabolismo</td>
								<td>{{ ($lastInbody->metabolism == 0) ? '-' : $lastInbody->metabolism }}</td>
							</tr>
							<tr>
								<td style="width:50%;">Grasa</td>
								<td>{{ ($lastInbody->fat_weight == 0) ? '-' : $lastInbody->fat_weight . ' kg'}}</td>
							</tr>
							<tr>
								<td style="width:50%;">IMC</td>
								<td>{{ ($lastInbody->imc == 0) ? '-' : $lastInbody->imc . ' kg/m&sup2;'}}</td>
							</tr>
							<tr>
								<td style="width:50%;">% Grasa</td>
								<td>{{ ($lastInbody->fat_percent == 0) ? '-' : $lastInbody->fat_percent . ' %'}}</td>
							</tr>
						</tbody>
					</table>	
										
				</div>
			</div>
		</div>
		@if($colCount % 3 == 0)
			</div>
		@endif

		
		{{-- Take last 10 inbodies and extract their info --}}
		{{--*/ $allWeights = "" /*--}}
		{{--*/ $allMonths = "" /*--}}
		@if($inbodies->count() > 1)

			@foreach($inbodies as $inbody)
				{{--*/ $months[] = $inbody->created_at->formatLocalized('%B')  /*--}}
				{{--*/ $weights[] = $inbody->weight  /*--}}
			@endforeach

			@foreach($weights as $weight)
				<?php $allWeights .= $weight . ","; ?>
			@endforeach

			@foreach($months as $month)
				<?php $allMonths .= "\"". $month . "\","; ?>
			@endforeach

			@if($colCount % 3 == 0)
				<div class="row">
			@endif
			{{--*/ $colCount++ /*--}}
			<div class="col-lg-4 force-height">
				<div class="block-flat force-height">
					<div class="header">
						<h1 class="responsive-header">Tus dos últimos inbodies</h1>
					</div>
					<div class="content">
						<div>
							<canvas id="inbody_resume" height="317" width="450"></canvas>
						</div>
					</div>
				</div>
			</div>
			@if($colCount % 3 == 0)
				</div>
				<div class="row">
			@endif
			{{--*/ $colCount++ /*--}}
			<!-- WEIGHT BLOCK-FLAT -->
			<div class="col-lg-4 force-height">
				<div class="block-flat force-height">
					<div class="header">
						<h1 class="responsive-header">Tu peso</h1>
					</div>
					<div class="content">
						<div>
							<canvas id="weight_resume" height="317" width="450"></canvas>
						</div>
					</div>
				</div>
			</div>
			@if($colCount % 3 == 0)
				</div>
			@endif
		@endif
	@else
		@if($colCount % 3 == 0)
			<div class="row">
		@endif
		{{--*/ $colCount ++ /*--}}
		<div class="col-lg-4">
			<div class="alert alert-info alert-white rounded text-center force-height">
				<div class="icon"><i class="fa fa-info-circle"></i></div> 
				<div class="col-xs-12" style="margin-top: 23%">
					<h1>Aún no has añadido ningun inbody!</h1>
					<a href="{{ route('inbody.create') }}" class="btn btn-warning">Añade tu primer inbody</a>
				</div>
			</div>
		</div>
		@if($colCount % 3 == 0)
			</div>
		@endif
	@endif

	{{----------------------------------------------------------------------------------------------------}}
	{{--------------------------------------------- MEASURES ---------------------------------------------}}
	{{----------------------------------------------------------------------------------------------------}}

	@if(!$measures->isEmpty())
		@if($colCount % 3 == 0)
			<div class="row">
		@endif
		{{--*/ $colCount++ /*--}}
		{{-- BLOCKFLAT - LAST MEASURE  --}}
		<div class="col-lg-4 force-height">
			<div class="block-flat force-height">
				<div class="header">							
					<h1 class="responsive-header">Tu última medición
						<a href="{{ route('measure.create') }}" class="btn btn-warning" data-placement="top" data-toggle="tooltip" data-original-title="Crear nueva"><i class="fa fa-plus"></i></a>
					</h1>
				</div>
				<div class="content">
					<table class="no-border hover">
						<tbody class="no-border-y">
							<tr>
								<td style="width:50%;"></i>Biceps</td>
								<td>@if($lastMeasure->m_biceps == 0) - @else {{ $lastMeasure->m_biceps }} cm @endif</td>
							</tr>
							<tr>
								<td style="width:50%;">Antebrazo</td>
								<td>@if($lastMeasure->m_forearm == 0) - @else {{ $lastMeasure->m_forearm }} cm @endif</td>
							</tr>
							<tr>
								<td style="width:50%;">Muslo</td>
								<td>@if($lastMeasure->m_leg == 0) - @else {{ $lastMeasure->m_leg }} cm @endif</td>
							</tr>
							<tr>
								<td style="width:50%;">Gemelo</td>
								<td>@if($lastMeasure->m_calf == 0) - @else {{ $lastMeasure->m_calf }} cm @endif</td>
							</tr>
							<tr>
								<td style="width:50%;">Cintura</td>
								<td>@if($lastMeasure->m_waist == 0) - @else {{ $lastMeasure->m_waist }} cm @endif</td>
							</tr>
							<tr>
								<td style="width:50;">Pecho</td>
								<td>@if($lastMeasure->m_chest == 0) - @else {{ $lastMeasure->m_chest }} cm @endif</td>
							</tr>
							<tr>
								<td style="width:50%;">Espalda</td>
								<td>@if($lastMeasure->m_back == 0) - @else {{ $lastMeasure->m_back }} cm @endif</td>
							</tr>
							<tr>
								<td style="width:50%;">Cuello</td>
								<td>@if($lastMeasure->m_neck == 0) - @else {{ $lastMeasure->m_neck }} cm @endif</td>
							</tr>
						</tbody>
					</table>	
				</div>
			</div>
		</div>
		@if($colCount % 3 == 0)
			</div>
		@endif

		@if($measures->count() > 1)
			@if($colCount % 3 == 0)
				<div class="row">
			@endif
			{{--*/ $colCount++ /*--}}
			{{-- BLOCKFLAT - LAST TWO MEASURES --}}
			<div class="col-lg-4 force-height">
				<div class="block-flat force-height">
					<div class="header">
						<h1 class="responsive-header">Tus dos últimas mediciones</h1>
					</div>
					<div class="content">
						<div>
							<canvas id="measure_resume" height="317" width="450"></canvas>
						</div>
					</div>
				</div>
			</div>
			@if($colCount % 3 == 0)
				</div>
			@endif
		@endif

	@else
		@if($colCount % 3 == 0)
			<div class="row">
		@endif
		{{--*/ $colCount++ /*--}}
		{{-- BLOCK-FLAT NO MEASURES  --}}
		<div class="col-lg-4">
			<div class="alert alert-info alert-white rounded text-center force-height">
				<div class="icon"><i class="fa fa-info-circle"></i></div> 
				<div class="col-xs-12" style="margin-top: 23%">
					<h1>Aún no has añadido ninguna medición!</h1>
					<a href="{{ route('measure.create') }}" class="btn btn-warning">Añade tu primera medición</a>	
				</div>
			</div>
		</div>
		@if($colCount % 3 == 0)
			</div>
		@endif
	@endif

@endsection

@section('scripts')
<script src="{{ asset('js/Chart.js')}}"></script>

<script type="text/javascript">

	// WEIGHT RESUME
	<?php if($inbodies->count() > 1) { ?>
		var lineChartData2	 = {
			labels : [<?php foreach($inbodies as $inbody){
								echo "\"" . Date::parse($inbody->created_at)->format('j-M-Y') . "\",";
							} ?>],
			datasets : [
				{
					label: "My First dataset",
					fillColor : "rgba(255,135,0,1)",
					strokeColor : "rgba(220,220,220,1)",
					pointColor : "rgba(220,220,220,1)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(220,220,220,1)",
					data : [<?php foreach($inbodies as $inbody){
										echo $inbody->weight . ',';
									} ?>]
				}
			]
		}
	<?php } ?>

	// TOTAL WEIGHT RESUME
	<?php if( ! $workoutsMonth0->isEmpty() && ! $workoutsMonth1->isEmpty()) { ?>
		var lineChartData = {
			labels : ["<?php echo $monthTotalWeightName0 ?>","<?php echo $monthTotalWeightName1 ?>"],
			datasets : [
				{
					label: "My First dataset",
					fillColor : "rgba(220,220,220,0.2)",
					strokeColor : "rgba(220,220,220,1)",
					pointColor : "rgba(220,220,220,1)",
					pointStrokeColor : "#fff",
					pointHighlightFill : "#fff",
					pointHighlightStroke : "rgba(220,220,220,1)",
					data : [{{$totalWeightsMonth0}},{{$totalWeightsMonth1}}]
				}
			]
		}
	<?php } ?>

	// MUSCULAR RESUME
	<?php if($workoutsDesc->count() > 0) { ?>
		var doughnutData = [
		    {
		        value: {{ $lastMonthChestCount }},
		        color: "#008BFF",
		        highlight: "#008BFF", 
		        label: "Pectoral"
		    },
		    {
		        value: {{ $lastMonthBackCount }},
		        color: "#FF0000",
		        highlight: "#FF9494",
		        label: "Espalda"
		    },
		    {
		        value: {{ $lastMonthShoulderCount }},
		        color:"#00E2FF",
		        highlight: "#A3F5FF",
		        label: "Hombros"
		    },
		    {
		        value: {{ $lastMonthLegsCount }},
		        color:"#68CF00",
		        highlight: "#9CCC6C",
		        label: "Pierna"
		    },
		    {
		        value: {{ $lastMonthAbsCount }},
		        color: "#F6FF00",
		        highlight: "#FCFFA8",
		        label: "Abdomen"
		    },
		    {
		        value: {{ $lastMonthBicepsCount }},
		        color: "#FF8C8C",
		        highlight: "#FFC7C7",
		        label: "Biceps"
		    },
		     {
		        value: {{ $lastMonthTricepsCount }},
		        color: "#C4F8FF",
		        highlight: "#EDFDFF",
		        label: "Triceps"
		    }
		]
	<?php } ?>

	// INBODY RESUME
	<?php if($inbodies->count() > 1) { ?>
		var radarChartData = {
			labels: ["Peso", "Masa Muscular", "Grasa", "IMC", "% Grasa"],
			datasets: [
				{
					label: "My First dataset",
					fillColor: "rgba(220,220,220,0.2)",
					strokeColor: "rgba(220,220,220,1)",
					pointColor: "rgba(220,220,220,1)",
					pointStrokeColor: "#fff",
					pointHighlightFill: "#fff",
					pointHighlightStroke: "rgba(220,220,220,1)",
					data: [<?php echo $lastInbody->weight; ?>, <?php echo $lastInbody->muscle_weight; ?>, <?php echo $lastInbody->fat_weight ?>, <?php echo $lastInbody->imc ?>, <?php echo $lastInbody->fat_percent ?>]
				},
				{
					label: "My Second dataset",
					fillColor: "rgba(151,187,205,0.2)",
					strokeColor: "rgba(151,187,205,1)",
					pointColor: "rgba(151,187,205,1)",
					pointStrokeColor: "#fff",
					pointHighlightFill: "#fff",
					pointHighlightStroke: "rgba(151,187,205,1)",
					data: [<?php echo $penInbody->weight; ?>, <?php echo $penInbody->muscle_weight; ?>, <?php echo $penInbody->fat_weight ?>, <?php echo $penInbody->imc ?>, <?php echo $penInbody->fat_percent ?>]
				}
			]
		};
	<?php } ?>

	// MEASURE RESUME
	<?php if($measures->count() > 1) { ?>
		var barChartData = {
			labels: ["Cuello","Pecho","Antebrazo","Cintura","Gemelo","Pierna","Biceps","Espalda"],
			datasets : [
					{
					label: "My First dataset",
					fillColor: "rgba(220,220,220,0.2)",
					strokeColor: "rgba(220,220,220,1)",
					pointColor: "rgba(220,220,220,1)",
					pointStrokeColor: "#fff",
					pointHighlightFill: "#fff",
					pointHighlightStroke: "rgba(220,220,220,1)",
					data: [<?php echo $lastMeasure->m_neck ?>, <?php echo $lastMeasure->m_chest ?>, <?php echo $lastMeasure->m_forearm ?>, <?php echo $lastMeasure->m_waist ?>, <?php echo $lastMeasure->m_calf ?>, <?php echo $lastMeasure->m_leg ?>, <?php echo $lastMeasure->m_biceps ?>, <?php echo $lastMeasure->m_back ?>]
				},
				{
					label: "My Second dataset",
					fillColor: "rgba(151,187,205,0.2)",
					strokeColor: "rgba(151,187,205,1)",
					pointColor: "rgba(151,187,205,1)",
					pointStrokeColor: "#fff",
					pointHighlightFill: "#fff",
					pointHighlightStroke: "rgba(151,187,205,1)",
					data: [<?php echo $penMeasure->m_neck ?>,<?php echo $penMeasure->m_chest ?>,<?php echo $penMeasure->m_forearm ?>, <?php echo $penMeasure->m_waist ?>, <?php echo $penMeasure->m_calf ?>, <?php echo $penMeasure->m_leg ?>, <?php echo $penMeasure->m_biceps ?>, <?php echo $penMeasure->m_back ?>]
				}
			]	
		};
	<?php } ?>

	window.onload = function(){

		// WEIGHT_RESUME
		<?php if($inbodies->count() > 1) { ?>
			var ctx = document.getElementById("weight_resume").getContext("2d");
			window.myLine = new Chart(ctx).Line(lineChartData2, {
				responsive: true
			});
		<?php } ?>

		// MUSCULAR_RESUME
		<?php if($workoutsDesc->count() > 0) { ?>
			var ctx = document.getElementById("muscular_resume").getContext("2d");
			window.myDoughnut = new Chart(ctx).Doughnut(doughnutData, {responsive : true ,showTooltips: true});
		<?php } ?>

		// INBODY_RESUME
		<?php if($inbodies->count() > 1) { ?>
			window.myRadar = new Chart(document.getElementById("inbody_resume").getContext("2d")).Radar(radarChartData, {
				responsive: true
			});
		<?php } ?>

		// MEASURE_RESUME
		<?php if($measures->count() > 1) { ?>
			var ctx2 = document.getElementById("measure_resume").getContext("2d");
				window.myBar = new Chart(ctx2).Bar(barChartData, {
					responsive : true
				});
		<?php } ?>

		// TOTAL WEIGHT
		<?php if(!$workoutsMonth0->isEmpty() && !$workoutsMonth1->isEmpty()) { ?>
			var ctx = document.getElementById("total_weight").getContext("2d");
			window.myLine = new Chart(ctx).Line(lineChartData, {
				responsive: true
			});
		<?php } ?>
	};
</script>

<script type="text/javascript">
	$(document).ready(function() {
		$('.md-trigger').modalEffects();
		$('#md-fall').niftyModal("show");

		// Ajax delete
		// $('.btn-delete').click(function(e) {

		// 	e.preventDefault();

		// 	var row = $(this).parents('tr');
		// 	var id = row.data('id');
		// 	var form = $('#form-delete');

		// 	var url = form.attr('action').replace(':USER_ID', id);
		// 	var data = form.serialize();

		// 	$.post(url, data, function(result){
		// 		row.fadeOut(200);
		// 	});

		// });

		<?php if (isset($message)) { ?>
			alert('message is set');
			$('#not-primary').click(function(){ 
	      $.gritter.add({
	        title: 'Primary',
	        text: '<?php echo $message; ?>',
	        class_name: 'primary'
	      });
	    });
	    $('#not-primary').click();
		<?php } ?>
	});
</script>

@endsection

@stop