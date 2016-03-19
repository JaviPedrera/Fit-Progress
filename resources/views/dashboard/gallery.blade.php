@extends('layouts.layout')

@section('title', 'Galería')

@section('current','Galería')

@section('breadcrumb','<li class="active">Galería</li>')

@section('plugins')
	<link rel="stylesheet" type="text/css" href="{{asset('theme/js/dropzone/css/dropzone.css')}}" />
	<link rel="stylesheet" href="//blueimp.github.io/Gallery/css/blueimp-gallery.min.css">
	<link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-image-gallery.css')}}">
@endsection

@section('content')
	{{--*/ use Jenssegers\Date\Date /*--}}
	{{ Date::setLocale('es')}}

	<!-- Bootstrap gallery -->
	<div id="blueimp-gallery" class="blueimp-gallery">
    <!-- The container for the modal slides -->
    <div class="slides"></div>
    <!-- Controls for the borderless lightbox -->
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
    <!-- The modal dialog, which will be used to wrap the lightbox content -->
    <div class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" aria-hidden="true">&times;</button>
            <h4 class="modal-title"></h4>
          </div>
          <div class="modal-body next"></div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left prev">
              <i class="glyphicon glyphicon-chevron-left"></i>
              Anterior
            </button>
            <button type="button" class="btn btn-primary next">
              Siguiente
              <i class="glyphicon glyphicon-chevron-right"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
	</div>

	<!-- Image upload -->
	<div class="row alert alert-info alert-white rounded">
		<div class="icon"><i class="fa fa-camera"></i></div> 
		<div class="col-sm-6">
			<h1>Sube tus últimas fotos</h1>
			{!! Form::open(['route' => 'gallery.store', 'files' => true, 'style' => 'padding:5px']) !!}
				<input id="uploadFile" placeholder="Selecciona imagen" disabled="disabled" style="width:150px"/>
				<div class="fileUpload btn btn-primary">
				    <span><i class="fa fa-camera"></i> Seleccionar</button></span>
			    	{!! Form::file('image',['class' => 'upload', 'id' => 'uploadBtn']) !!}
				</div>
		</div>
		<div class="col-sm-2 col-sm-offset-4">
			<button class="btn btn-primary form-control" type="submit" style="height: 100px;"><i class="fa fa-cloud-upload"></i> Subir Imagen</button>
			{!! Form::close() !!}
		</div>
	</div>

	<!-- Gallery -->
	<div class="gallery-cont">
		@foreach($pictures as $picture)
			<div class="item" data-id="{{ $picture->id }}">
				<div class="photo">
					<div class="head">
					  <h4 class="text-center" style="text-transform:capitalize">{{ Date::parse($picture->created_at)->format('l \&\n\b\s\p; j-M-Y') }}</h4>
					</div>
					<div class="img">
						<img src="{{asset($picture->route)}}">
						<div class="over">
							<div class="func">
							    <a href="" class="delete-button"><i class="fa fa-trash-o"></i></a>
							    <a class="image-zoom" href="{{ asset($picture->route) }}" data-gallery><i class="fa fa-search"></i></a>
							</div>
				  	</div>            
					</div>
				</div>
			</div>
		@endforeach
	</div>

	<!-- Hidden Form -->
	{!! Form::open(['action' => ['Dashboard\DashboardController@deletePic', ':PIC_ID'], 'id' => 'form-delete']) !!}
	{!! Form::close() !!}
@endsection

@section('scripts')
	<script src="//blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
	<script src="{{asset('js/bootstrap-image-gallery.js')}}" type="text/javascript"></script>
	{{-- <script type="text/javascript" src="{{asset('theme/js/dropzone/dropzone.js')}}"></script> --}}
	<script type="text/javascript" src="{{asset('theme/js/masonry.js')}}"></script>

	<script type="text/javascript">
		$(document).ready(function(){

			// Placeholder for input file
			document.getElementById("uploadBtn").onchange = function () {
			    document.getElementById("uploadFile").value = this.value;
			};

			// Masonry
			var $container = $('.gallery-cont');
			// Initialize masonry
			$container.masonry({
				columnWidth: 0,
				itemSelector: '.item'
			});

			$('.delete-button').click(function(e) {
				e.preventDefault();

				var pic = $(this).parents('.item');
				var id = pic.data('id');
				var form = $('#form-delete');

				var url = form.attr('action').replace(':PIC_ID', id);
				var data = form.serialize();

				e.preventDefault();

				$.post(url, data, function(result){
					pic.fadeOut(200);
				});

				var $container = $('.gallery-cont');

				// Masonry reload
				$container.masonry({
					columnWidth: 0,
					itemSelector: '.item',
					reload
				});
			
			});
		});
	</script>
@endsection