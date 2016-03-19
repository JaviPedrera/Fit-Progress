<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="images/favicon.png">

	<title>Fit Progress - Inicia sesión</title>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,400italic,700,800' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Raleway:300,200,100' rel='stylesheet' type='text/css'>

	<!-- Bootstrap core CSS -->
	<link href="{{asset('theme/js/bootstrap/dist/css/bootstrap.css')}}" rel="stylesheet">

	<link rel="stylesheet" href="{{asset('theme/fonts/font-awesome-4/css/font-awesome.min.css')}}">

	<!-- Custom styles for this template -->
	<link href="{{asset('css/style.css')}}" rel="stylesheet" />

</head>

<body class="texture">

	<div id="cl-wrapper" class="login-container">
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

		<div class="middlee-login" style="margin:200px auto; width:400px;">
			<div class="block-flat">
				<div class="header">							
					<h3 class="text-center"><img class="logo-img" style="width:13%" src="{{asset('images/fitprogress2.png')}}" alt="logo"/>Fit Progress</h3>
				</div>
				<div>
					<form style="margin-bottom: 0px !important;" role="form" class="form-horizontal" action="{{ url('/auth/login')}}" method="POST">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="content">
							<h4 class="title">Inicia sesión</h4>
								<div class="form-group">
									<div class="col-sm-12">
										<div class="input-group">
											<span class="input-group-addon"><i class="icon-user"></i></span>
											<input type="email" class="form-control" name="email" value="{{ old('email') }}">
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="col-sm-12">
										<div class="input-group">
											<span class="input-group-addon"><i class="icon-lock"></i></span>
											<input type="password" class="form-control" name="password">
										</div>
									</div>
								</div>
						</div>
						<div class="foot">
							<button class="btn btn-primary" data-dismiss="modal" type="submit">Iniciar sesión</button>
							<a class="btn btn-link" href="{{ url('/password/email') }}">¿ Olvidaste tu contraseña ?</a>
						</div>
					</form>
				</div>
			</div>
			<div class="text-center out-links"><a href="#">&copy; <?php echo date('Y') ?> Fit Progress</a></div>
		</div> 
	</div>

	<script src="{{ asset('theme/js/jquery.js') }}"></script>
	<script src="{{ asset('theme/js/behaviour/general.js')}} "></script>
	<script src="{{ asset('theme/js/behaviour/voice-commands.js') }}"></script>
	<script src="{{ asset('js/bootstrap.min.js')}}"></script>

</body>
</html>