<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="images/favicon.png">

	<title>Fit Progress - Restaurar contraseña</title>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,400italic,700,800' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Raleway:300,200,100' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Oswald" />

	<!-- Bootstrap core CSS -->
	<link href="{{asset('theme/js/bootstrap/dist/css/bootstrap.css')}}" rel="stylesheet">

	<link rel="stylesheet" href="{{asset('theme/fonts/font-awesome-4/css/font-awesome.min.css')}}">
	<link rel="stylesheet" href="{{asset('theme/js/animate/animate.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('theme/js/jquery.timeline/css/component.css')}}" />

	<!-- Custom styles for this template -->
	<link href="{{asset('css/style.css')}}" rel="stylesheet" />

</head>

<body class="texture">

	<div id="cl-wrapper" class="forgotpassword-container">

		<div class="container">
			<div class="middle-login" style="margin:200px auto; width:400px;">
				<div class="block-flat">
					<div class="header">							
						<h3 class="text-center"><img style="width:13%" class="logo-img" src="{{asset('images/fitprogress2.png')}}" alt="logo"/> Fit Progress</h3>
					</div>
					<div>
						<form style="margin-bottom: 0px !important;" class="form-horizontal" action="index.html" parsley-validate novalidate>
							<div class="content">
								<h5 class="title text-center"><strong>¿Olvidaste tu contraseña?</strong></h5>
		            <p class="text-center" style="color:#555">No te preocupes te enviamos un correo con las instrucciones para restaurarla</p>
		            @if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
		            <hr/>
					<div class="form-group">
						<div class="col-sm-12">
							<div class="input-group">
								<span class="input-group-addon"><i class="icon-envelope"></i></span>
								<input type="email" name="email" parsley-trigger="change" parsley-error-container="#email-error" required class="form-control">
							</div>
	        				<div id="email-error"></div>
						</div>
					</div>
		           	<p class="spacer text-center" style="color:#555">¿No recuerdas tu correo? <a href="#">Contacta con nosotros</a>.</p>
		          	<button class="btn btn-block btn-primary btn-rad btn-lg" type="submit">Restaurar contraseña</button>	
							</div>
					  </form>
					</div>
				</div>
				<div class="text-center out-links"><a href="#">&copy; <?php echo date('Y') ?> Fit Progress</a></div>
			</div> 
		</div>
	</div>

	<script src="{{ asset('theme/js/jquery.js') }}"></script>	
	<script src="{{ asset('theme/js/behaviour/general.js') }}"></script>
	<script src="{{ asset('theme/js/behaviour/voice-commands.js') }}"></script>
	<script src="{{ asset('js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('theme/js/modernizr.js') }}" type="text/javascript"></script>
</body>
</html>