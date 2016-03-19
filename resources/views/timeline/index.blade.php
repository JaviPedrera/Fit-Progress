@extends('layouts.layout')

@section('title', 'Todas tus mediciones')

@section('actual', 'Todas tus mediciones')

@section('breadcrumb','<li class="active">Mediciones</li>')

@section('content')
	{{-- Carbon Translator Plugin --}}
	{{--*/ use Jenssegers\Date\Date /*--}}
	{{ Date::setLocale('es') }}

{{-- 	<div class="col-lg-6">
		<ul class="timeline">
			@foreach ($eventsCollection as $event)
				<li>
				  <i class="{{ $event->printIcon() }}"></i>
				  <div class="content">
				    <p><strong>{{ $event->translateEvent() }}</strong> ({{ Date::parse($event->created_at)->format('l \&\n\b\s\p; j-M-Y \&\n\b\s\p; H:i') }})</p>
				  </div>
				</li>
			@endforeach
		</ul>
	</div><!-- end col-lg-6 --> --}}

	

@endsection