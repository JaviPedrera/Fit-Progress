<!DOCTYPE html>
<html lang="en">
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
	<link href="{{ asset('theme/js/bootstrap/dist/css/bootstrap.css') }}" rel="stylesheet">

	<link rel="stylesheet" href="{{ asset('theme/fonts/font-awesome-4/css/font-awesome.min.css') }}">
	<link rel="stylesheet" href="{{ asset('theme/js/animate/animate.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('theme/js/jquery.timeline/css/component.css') }}" />

	<!-- Custom styles for this template -->
	<link href="{{ asset('css/style.css') }}" rel="stylesheet" />
	<link href="{{ asset('css/custom.css') }}" rel="stylesheet" />	
</head>

<body class="texture">

	<div id="cl-wrapper" class="forgotpassword-container">

	<div class="container-fluid">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">Reset Password</div>
					<div class="panel-body">
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

						<form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input type="hidden" name="token" value="{{ $token }}">
							<div class="content">
								<h5 class="title text-center"><strong>Forgot your password?</strong></h5>
					            <p class="text-center">Don't worry, we'll send you an email to reset your password.</p>
				              	<hr/>
								<div class="form-group">
									<div class="col-sm-12">
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
											<input type="email" name="email" parsley-trigger="change" parsley-error-container="#email-error" required value="{{ old('email') }}" class="form-control">
										</div>
	                  					<div id="email-error"></div>
									</div>
								</div>
					            <p class="spacer text-center">Don't remember your email? <a href="#">Contact Support</a>.</p>
					            <button class="btn btn-block btn-primary btn-rad btn-lg" type="submit">Reset Password</button>
							</div>
						</form>
					</div>
				</div>
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
