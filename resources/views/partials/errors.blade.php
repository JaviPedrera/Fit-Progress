{{-- Handling validation errors --}}
@if (count($errors) > 0)
	<div class="alert alert-warning alert-white rounded">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<div class="icon"><i class="fa fa-warning"></i></div>
			@foreach ($errors->all() as $error)
				<p style="color:#3f3f3f">{{ $error }}</p>
			@endforeach
	</div>
@endif

{{-- Handling custom error --}}
@if(isset($error))
	<div class="alert alert-warning alert-white rounded">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<div class="icon"><i class="fa fa-warning"></i></div>
		<p style="color:#3f3f3f">{{ $error }}</p>
	</div>
@endif