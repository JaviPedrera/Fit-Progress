
<!DOCTYPE html>
<html lang="es">
<head>
  <!-- 
       ██╗ █████╗ ██╗   ██╗██╗███████╗██████╗     ██████╗ ███████╗██████╗ ██████╗ ███████╗██████╗  █████╗ 
       ██║██╔══██╗██║   ██║██║██╔════╝██╔══██╗    ██╔══██╗██╔════╝██╔══██╗██╔══██╗██╔════╝██╔══██╗██╔══██╗
       ██║███████║██║   ██║██║█████╗  ██████╔╝    ██████╔╝█████╗  ██║  ██║██████╔╝█████╗  ██████╔╝███████║
  ██   ██║██╔══██║╚██╗ ██╔╝██║██╔══╝  ██╔══██╗    ██╔═══╝ ██╔══╝  ██║  ██║██╔══██╗██╔══╝  ██╔══██╗██╔══██║
  ╚█████╔╝██║  ██║ ╚████╔╝ ██║███████╗██║  ██║    ██║     ███████╗██████╔╝██║  ██║███████╗██║  ██║██║  ██║
   ╚════╝ ╚═╝  ╚═╝  ╚═══╝  ╚═╝╚══════╝╚═╝  ╚═╝    ╚═╝     ╚══════╝╚═════╝ ╚═╝  ╚═╝╚══════╝╚═╝  ╚═╝╚═╝  ╚═╝

  Hello Codeman ;)
  -->
  <!-- Metadata -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="author" content="Javier Pedrera">
  <meta name="description" content="Guarda tus rutinas">

  <!-- Icon -->
  <link rel="icon" type="image/ico" href="{{asset('images/fitprogress.ico')}}"/>

  <!-- Title -->
  <title>Fit Progress - @yield('title') </title>

  <!-- Fonts -->
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,400italic,700,800' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Raleway:100' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700' rel='stylesheet' type='text/css'>

  <!-- Plugins -->
  <link href="{{ asset('theme/js/bootstrap/dist/css/bootstrap.css') }}" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="{{asset('theme/js/bootstrap.datetimepicker/css/bootstrap-datetimepicker.min.css')}}" />
  <link rel="stylesheet" type="text/css" href="{{asset('theme/js/jquery.select2/select2.css')}}" />
  <link rel="stylesheet" type="text/css" href="{{asset('theme/js/bootstrap.slider/css/slider.css')}}" />
  <link href="{{asset('theme/js/fuelux/css/fuelux.css')}}" rel="stylesheet">
  <link href="{{asset('theme/js/fuelux/css/fuelux-responsive.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('theme/fonts/font-awesome-4/css/font-awesome.min.css')}}">
  <link rel="stylesheet" href="{{asset('theme/css/pygments.css')}}">
  <link rel="stylesheet" href="{{asset('theme/js/jquery.nanoscroller/nanoscroller.css')}}" type="text/css"/>
  <link rel="stylesheet" type="text/css" href="{{asset('theme/js/bootstrap.switch/bootstrap-switch.css')}}" />
  <link rel="stylesheet" type="text/css" href="{{asset('theme/js/jquery.niftymodals/css/component.css')}}" />
  <link rel='stylesheet' type='text/css' href="{{asset('theme/js/jquery.fullcalendar/fullcalendar/fullcalendar.css')}}" />
  <link rel='stylesheet' type='text/css' href="{{asset('theme/js/jquery.fullcalendar/fullcalendar/fullcalendar.print.css')}}"  media='print' />
  <link rel="stylesheet" type="text/css" href="{{asset('theme/js/jquery.gritter/css/jquery.gritter.css')}}" />
  <link rel="stylesheet" href="{{asset('theme/js/jquery.icheck/skins/square/blue.css')}}">
  <link rel="stylesheet" href="{{asset('css/hover-min.css')}}">

  <!-- Custom styles for this template -->
  <link href="{{asset('css/style.css')}}" rel="stylesheet" type="text/css"/>  
  <link href="{{asset('css/custom.css')}}" rel="stylesheet" type="text/css" >

  <!-- Custom plugins -->
  @yield('plugins')
</head>
<body>
  <!-- Contact modal -->
  @include('partials.contactmodal')
  <!-- Fixed navbar -->
  @include('partials.fixednavbar')

  <div id="cl-wrapper" class="fixed-menu">
    {{-- Filter for the fixed menu --}}
    @if(!Auth::user()->name == "")
      @include('partials.fixedmenu')
    @endif

  	<!-- Container -->
    <div class="container-fluid" id="pcont">
  		<div class="page-head">
  			<h2>@yield('current')</h2>
  			<ol class="breadcrumb">
  			  <li><a href="/dashboard"><i class="fa fa-home"></i> Inicio</a></li>
          @yield('breadcrumb')
  			</ol>
  		</div>
      <div class="cl-mcont">
        @include('flash::message')
      	@yield('content')
      </div>
    </div>
  </div>

  <script src="{{asset('theme/js/jquery.js')}}"></script>
  <script src="{{asset('theme/js/jquery.select2/select2.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('theme/js/jquery.parsley/parsley.js')}}" type="text/javascript"></script>
  <script src="{{asset('theme/js/bootstrap.slider/js/bootstrap-slider.js')}}" type="text/javascript"></script>
  <script src="{{asset('theme/js/fuelux/loader.min.js')}}" type="text/javascript" ></script> 
  <script src="{{asset('theme/js/modernizr.js')}}" type="text/javascript"></script>
  <script src="{{asset('theme/js/jquery.nanoscroller/jquery.nanoscroller.js')}}" type="text/javascript"></script>
  <script src="{{asset('theme/js/bootstrap.switch/bootstrap-switch.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('theme/js/jquery.nestable/jquery.nestable.js')}}" type="text/javascript" ></script>
  <script src="{{asset('theme/js/bootstrap.datetimepicker/js/bootstrap-datetimepicker.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('theme/js/jquery.icheck/icheck.min.js')}}" type="text/javascript"></script>
  <script src="{{asset('theme/js/behaviour/general.js')}}" type="text/javascript" ></script>
  <script src="{{asset('theme/js/jquery.ui/jquery-ui.js')}}" type="text/javascript"></script>
  <script src="{{asset('theme/js/jquery.niftymodals/js/jquery.modalEffects.js')}}" type="text/javascript"></script>
  <script src="{{asset('theme/js/jquery.gritter/js/jquery.gritter.js')}}" type="text/javascript"></script>
  <script src="{{asset('theme/js/jquery.fullcalendar/fullcalendar/fullcalendar.js')}}" type='text/javascript'></script>

  @yield('scripts')

  <script type="text/javascript">
    $(document).ready(function(){
      //initialize the javascript
      App.init();

      // Contact Button Success
      $('#success').click(function(){
        $.gritter.add({
          title: 'Tu mensaje se ha enviado correctamente',
          text: '',
          class_name: 'success'
        });
      });
    });
  </script>
  <script src="{{asset('theme/js/behaviour/voice-commands.js')}}"></script>
</body>
</html>
