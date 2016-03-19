@extends('layouts.layout')

@section('title', 'Todos tus inbodies')

@section('current', 'Todos tus inbodies')

@section('breadcrumb','<li class="active">Inbodies</li>')

@section('content')
	{{-- Carbon Translator Plugin --}}
	{{--*/ use Jenssegers\Date\Date /*--}}
	{{ Date::setLocale('es')}}

	@if($inbodies->count() > 0)
		@include('partials.deletemodal')
		<div class="row dash-cols">
			<div class="col-md-12">
				<div class="block-flat">
					<div class="header">
						<h1>Tus inbodies
							<a href="{{ route('inbody.create') }}" class="btn btn-warning pull-right" data-placement="top" data-toggle="tooltip" data-original-title="Crear nuevo"><i class="fa fa-plus"></i></a> 
						</h1>
					</div>
					<div class="content">
						<div class="table-responsive">
							<table class="table no-border hover">
								<thead class="no-border">
									<tr>
										<th><strong>Fecha</strong></th>
										<th><strong>Peso</strong></th>
										<th><strong>IMC</strong></th>
										<th><strong>Masa Muscular</strong></th>
										<th><strong>% Grasa</strong></th>
										<th><strong>Metabolismo</strong></th>
										<th></th>
										<th></th>
									</tr>
								</thead>					
								<tbody class="capitalize no-border-y">
									@foreach($inbodies as $inbody)
										<tr data-id="{{ $inbody->id }}">
											<td class="capitalize">{{ Date::parse($inbody->created_at)->format('l \&\n\b\s\p; j-M-Y') }}</td>
											<td>{{ $inbody->weight }}</td>
											<td>{{ $inbody->imc }}</td>
											<td>{{ $inbody->muscle_weight }}</td>
											<td>{{ $inbody->fat_percent }}</td>
											<td>{{ $inbody->metabolism }}</td>
											<td>
											<a href="{{ route('inbody.edit', ['id' => $inbody->id]) }}" class="btn btn-success" data-placement="top" data-toggle="tooltip" data-original-title="Editar"><i class="fa fa-pencil"></i></a>
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
	{!! Form::open(['route' => ['inbody.destroy', ':INBODY_ID'], 'method' => 'DELETE', 'id' => 'form-delete']) !!}
	{!! Form::close() !!}

	@else

		<div class="row alert alert-info alert-white rounded text-center">
			<div class="icon"><i class="fa fa-info-circle"></i></div> 
			<div class="col-xs-12">
				<h1>Aún no has añadido ningún inbody!</h1>
				<a href="{{ route('inbody.create') }}" class="btn btn-warning">Añade tu primer inbody</a>
			</div>
		</div>

	@endif
@endsection

@section('scripts')
	{{-- INBODY AJAX DELETE --}}
	<script type="text/javascript">
		$(document).ready(function() {
			$('.btn.btn-danger.btn-flat.md-trigger').click(function(e) {
				e.preventDefault();

				var row = $(this).parents('tr');
				var id = row.data('id');
				var form = $('#form-delete');

				var url = form.attr('action').replace(':INBODY_ID', id);
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
