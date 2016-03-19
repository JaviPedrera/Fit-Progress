@extends('layouts.layout')

@section('title', 'Todas tus mediciones')

@section('current', 'Todas tus mediciones')

@section('breadcrumb','<li class="active">Mediciones</li>')

@section('content')
	{{-- Carbon Translator Plugin --}}
	{{--*/ use Jenssegers\Date\Date /*--}}
	{{ Date::setLocale('es')}}

	@if($measures->count() > 0)
		@include('partials.deletemodal')
		<div class="row">
			<div class="col-md-12">
				<div class="block-flat">
					<div class="header">
						<h1>Tus	mediciones
							<a href="{{ route('measure.create') }}" class="btn btn-warning pull-right" data-placement="top" data-toggle="tooltip" data-original-title="Crear nueva"><i class="fa fa-plus"></i></a> 
						</h1>
					</div>
					<div class="content">
						<div class="table-responsive">
							<table class="table no-border hover">
								<thead class="no-border">
									<tr>
										<th><strong>Fecha</strong></th>
										<th><strong>Biceps</strong></th>
										<th><strong>Antebrazo</strong></th>
										<th><strong>Muslo</strong></th>
										<th><strong>Gemelo</strong></th>
										<th><strong>Cintura</strong></th>
										<th><strong>Pecho</strong></th>
										<th><strong>Espalda</strong></th>
										<th><strong>Cuello</strong></th>
										<th></th>
										<th></th>
									</tr>
								</thead>					
								<tbody class="no-border-y">
									@foreach($measures as $measure)
										<tr data-id="{{ $measure->id }}">
											<td class="capitalize">{{ Date::parse($measure->created_at)->format('l \&\n\b\s\p; j-M-Y') }}</td>
											<td>@if($measure->m_biceps) {{ $measure->m_biceps }} cm @else - @endif</td>
											<td>@if($measure->m_forearm) {{ $measure->m_forearm }} cm @else - @endif</td>
											<td>@if($measure->m_leg) {{ $measure->m_leg }} cm @else - @endif</td>
											<td>@if($measure->m_calf) {{ $measure->m_calf }} cm @else - @endif</td>
											<td>@if($measure->m_waist) {{ $measure->m_waist }} cm @else - @endif</td>
											<td>@if($measure->m_chest) {{ $measure->m_chest }} cm @else - @endif</td>
											<td>@if($measure->m_back) {{ $measure->m_back }} cm @else - @endif</td>
											<td>@if($measure->m_neck) {{ $measure->m_neck }} cm @else - @endif</td>
											<td>
												<a href="{{ route('measure.edit', ['id' => $measure->id]) }}" class="btn btn-success" data-placement="top" data-toggle="tooltip" data-original-title="Editar"><i class="fa fa-pencil"></i></a>
				          					</td>
				          					<td>
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
		<!-- Hidden Form -->
		{!! Form::open(['route' => ['measure.destroy', ':MEASURE_ID'], 'method' => 'DELETE', 'id' => 'form-delete']) !!}
		{!! Form::close() !!}
	@else
		<div class="row alert alert-info alert-white rounded text-center">
			<div class="icon"><i class="fa fa-info-circle"></i></div> 
			<div class="col-xs-12">
				<h1>Aún no has añadido ninguna medición!</h1>
				<a href="{{ route('measure.create') }}" class="btn btn-warning">Añade tu primera medición</a>
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

				var url = form.attr('action').replace(':MEASURE_ID', id);
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
