@extends('layouts.layout')

@section('title', 'Todas tus rutinas')

@section('current','Todas tus rutinas')

@section('breadcrumb','<li class="active">Rutinas</li>')

@section('content')
	{{-- Carbon Translator Plugin --}}
	{{--*/ use Jenssegers\Date\Date /*--}}
	{{ Date::setLocale('es')}}

	@if(!$workouts->isEmpty())
		@include('partials.deletemodal')
		<div class="row">
			<div class="col-md-12">
				<div class="block-flat">
					<div class="header">
						<h1>Tus rutinas
								<div class="pull-right">
							<a href="{{ route('workout.create') }}" class="btn btn-warning" data-placement="top" data-toggle="tooltip" data-original-title="Crear nueva"><i class="fa fa-plus"></i></a>
						</div>
						</h1>
					</div>
					<div class="content">
						<div class="table-responsive">
							<table class="table no-border hover">
								<thead class="no-border">
									<tr>
										<th><strong>Nombre</strong></th>
										<th class="hidden-xs"><strong>Fecha</strong></th>
										<th><strong>Grupos Musculares</strong></th>
										<th></th>
										<th><strong>Acciones</strong></th>
									</tr>
								</thead>					
								<tbody class="no-border-y">
									@foreach($workouts as $workout)
										<tr data-id="{{ $workout->id }}">
											<td>{{ $workout->name }}</td>
											<td class="capitalize hidden-xs">{{ Date::parse($workout->created_at)->format('l \&\n\b\s\p; j-M-Y') }}</td>
											<td>{{ $workout->musc_group }}</td>
											<td></td>
											<td>
												<a href="{{ route('workout.show', ['id' => $workout->id]) }}" class="btn btn-primary" data-placement="top" data-toggle="tooltip" data-original-title="Ver"><i class="fa fa-eye"></i></a>
												<a href="{{ route('workout.edit', ['id' => $workout->id]) }}" class="btn btn-success" data-placement="top" data-toggle="tooltip" data-original-title="Editar"><i class="fa fa-pencil"></i></a>
												<a class="btn btn-danger btn-flat md-trigger" data-modal="colored-danger"><i class="fa fa-trash-o"></i></a>
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

		<!-- Pagination -->
		<div class="row text-center">
			<?php echo $workouts->render(); ?>	
		</div> 

		<!-- Hidden Form -->
		{!! Form::open(['route' => ['workout.destroy', ':WORKOUT_ID'], 'method' => 'DELETE', 'id' => 'form-delete']) !!}
		{!! Form::close() !!}
	@else
		<div class="row alert alert-info alert-white rounded text-center">
			<div class="icon"><i class="fa fa-info-circle"></i></div> 
			<div class="col-xs-12">
				<h1>Aún no has añadido ninguna rutina!</h1>
				<a href="{{ route('workout.create') }}" class="btn btn-warning">Añade Tu Primera Rutina</a>
			</div>
		</div>
	@endif
@endsection

@section('scripts')
	{{-- WORKOUT AJAX DELETE --}}
	<script type="text/javascript">
		$(document).ready(function() {
			$('.btn.btn-danger.btn-flat.md-trigger').click(function(e) {

				e.preventDefault();

				var row = $(this).parents('tr');
				var id = row.data('id');
				var form = $('#form-delete');

				var url = form.attr('action').replace(':WORKOUT_ID', id);
				var data = form.serialize();

				$('.btn.btn-danger.btn-flat.md-close.btn-delete-final').click(function(e) {
					e.preventDefault();

					$.post(url, data, function(result){
						row.fadeOut(200);
					});
				});
			});
		});
	</script>
@endsection