<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title></title>

  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,400italic,700,800' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Raleway:300,200,100' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Oswald" />


  <!-- Bootstrap core CSS -->
  <link href="{{asset('theme/js/bootstrap/dist/css/bootstrap.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('theme/fonts/font-awesome-4/css/font-awesome.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('theme/js/bootstrap.datetimepicker/css/bootstrap-datetimepicker.min.css')}}" />

  <!-- Custom styles for this template -->
  <link href="{{asset('css/style.css')}}" rel="stylesheet" />
  <link href="{{asset('css/custom.css')}}" rel="stylesheet" />

  <style type="text/css">
    body { background: url({{ asset("images/bg.jpg") }}); }
  </style>

</head>
<body>
	<div id="cl-wrapper" class="login-container" style="margin-top: 0px !important; padding:0">
			<div class="middlee-login" style="margin: 100px auto; width:600px;">
				<div class="block-flat">
					<div class="header">              
	           			<h3 class="text-center"><img style="width:13%" class="logo-img" src="{{ asset('images/fitprogress2.png') }}" alt="logo">Fit Progress</h3>
	        		</div>
					<div class="panel-body">
						@include('partials.errors')
						{!! Form::open(['url' => 'auth/register' , 'files' => true, 'class' => 'form-horizontal group-border-dashed']) !!}
							<div class="form-group">
								{!! Form::label('email','Email', ['class' => 'col-sm-3 control-label']) !!}
								<div class="col-sm-6">
									{!! Form::email('email', null , ['class' => 'form-control']) !!}
								</div>
							</div>
							<div class="form-group">
								{!! Form::label('password','Contraseña', ['class' => 'col-sm-3 control-label']) !!}
								<div class="col-sm-6">
									{!! Form::password('password' , ['class' => 'form-control']) !!}
								</div>
							</div>
							<div class="form-group">
								{!! Form::label('password_confirmation','Repetir Contraseña', ['class' => 'col-sm-3 control-label']) !!}
								<div class="col-sm-6">
									{!! Form::password('password_confirmation' , ['class' => 'form-control']) !!}
								</div>
							</div>
							<div class="form-group text-center">
								{!! Form::submit('Comenzar', ['class' => 'form-control btn btn-primary', 'style' => 'width: 50%']) !!}
							</div>
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>


	<script src="{{asset('theme/js/jquery.js')}}"></script>
	<script src="{{asset('theme/js/jquery.select2/select2.min.js')}}" type="text/javascript"></script>
	<script src="{{asset('theme/js/jquery.parsley/parsley.js')}}" type="text/javascript"></script>
	<script src="{{asset('theme/js/bootstrap.slider/js/bootstrap-slider.js')}}" type="text/javascript"></script>
	{{-- <script type="text/javascript" src="{{asset('theme/js/fuelux/loader.min.js')}}"></script>  --}}
	{{-- <script src="{{asset('theme/js/modernizr.js')}}" type="text/javascript"></script> --}}
	<script type="text/javascript" src="{{asset('theme/js/jquery.nanoscroller/jquery.nanoscroller.js')}}"></script>
	<script type="text/javascript" src="{{asset('theme/js/jquery.nestable/jquery.nestable.js')}}"></script>
	<script type="text/javascript" src="{{asset('theme/js/behaviour/general.js')}}"></script>
	<script src="{{asset('theme/js/jquery.ui/jquery-ui.js')}}" type="text/javascript"></script>
	<script type="text/javascript" src="{{asset('theme/js/bootstrap.switch/bootstrap-switch.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('theme/js/bootstrap.datetimepicker/js/bootstrap-datetimepicker.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('theme/js/jquery.icheck/icheck.min.js')}}"></script>
	<script type="text/javascript">
		$(document).ready(function(){
		  //initialize the javascript
		  App.init();
		  $('#age').datetimepicker({
		  		format: "dd MM yyyy" 
		  });
		});
	</script>

	<script src="{{asset('theme/js/behaviour/voice-commands.js')}}"></script>
	<script src="{{ asset('js/bootstrap.min.js')}}"></script>
</body>
</html>

