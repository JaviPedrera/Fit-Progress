<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Fit Progress</title>

  <link rel="icon" type="image/ico" href="{{asset('images/fitprogress.ico')}}"/>
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
  <link href="{{asset('css/custom.css')}}" rel="stylesheet" />
  <style type="text/css">
    /* Background image for rows */
    #row2, #row3{
      background: url('{{asset('images/bg.jpg')}}');
    }

    /* Overlay with filter */
    @if (!count($errors) > 0)

      /* Background image overlaying */
      @keyframes pulse {
        0% {
          opacity: 0;
        }
        100% {
          opacity: 1;
        }
      }

      .overlay{
        background:black;
      }

    @endif

    header{
      height:1000px;
      background: url('http://www.hdwallpaperscool.com/wp-content/uploads/2014/07/fitness-body-hd-wallpapers-of-high-quality.jpg');
      @if (!count($errors) > 0) animation: pulse 6s; @endif
      background-position: center center;
      background-repeat: no-repeat;
      background-size: cover;
    }

    .col-sm-7.wow.fadeInRight { 
        background: url({{asset('images/fitprogressapple.png')}}) 50% 50% / 80% no-repeat !important;
      }

    @media only screen and (max-width : 479px) {
      header {
        height:700px;
        background: url({{asset('images/fit_background1.gif')}}); 
        background-position: center center;
        background-repeat: no-repeat;
        background-size: cover; 
      }

      .col-sm-7.wow.fadeInRight { 
        background: url({{asset('images/fitprogressapple.png')}}) 50% 10% / 80% no-repeat !important;
      }

  </style>

</head>
<body>
  @if (!count($errors) > 0)<div class="overlay">@endif
    <header>
    <div class="container">
      <div class="row">

        <div id="cl-wrapper-index" class="login-container">
          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 header-block">
            <div class="home-text">
              <div class="element"></div>
              <h1 id="header-home1" style="text-align: center" @if (!count($errors) > 0) class="wow fadeInDown" data-wow-delay="2s"> @else > @endif ANOTA TUS MARCAS</h1>
              <h1 id="header-home2" style="text-align: center" @if (!count($errors) > 0) class="wow fadeInUp" data-wow-delay="3s"> @else > @endif CONSIGUE TU META</h1>
            </div>
          </div>

        {{-- LOGIN --}}
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 header-block">
          @if (count($errors) > 0)<div class="middle-login"> @else <div class="middle-login wow fadeIn" data-wow-delay="4s" style="margin: 0 auto"> @endif
            <div class="block-flat" id="login">
              <div class="header">              
              <h3 class="text-center"><img style="width:13%"class="logo-img" src="{{asset('images/fitprogress2.png')}}" alt="logo"/>Fit Progress</h3>
              </div>
              <div>
                <form style="margin-bottom: 0px !important;" role="form" class="form-horizontal" action="{{ url('/auth/login')}}" method="POST">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="content">
                    <h4 class="title" style="text-align:center;">Inicia Sesión</h4>
                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                      <ul>
                        @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                        @endforeach
                      </ul>
                    </div>
                    @endif
                    <div class="form-group">
                      <div class="col-sm-12">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-user"></i></span>
                          <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-sm-12">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                          <input type="password" class="form-control" name="password">
                        </div>
                      </div>
                    </div>

                  </div>
                  <div class="foot">
                    <a class="btn btn-link" href="{{ url('/password/email') }}">¿ Olvidaste tu contraseña ?</a>
                    <button class="btn btn-primary" data-dismiss="modal" type="submit">Iniciar Sesión</button>
                  </div>
                  <hr>
                  <div class="foot">
                    <p style="color: #4783BA; display:inline-block">¿ Aún no tienes cuenta ?</p>
                    <a class="btn btn-success btn-large show-register" href="#">Registrate</a>
                  </div>
                </form>
              </div>
            </div>

            {{-- REGISTER --}}
            <div class="block-flat" id="register">
              <div class="header">              
              <h3 class="text-center"><img style="width:13%"class="logo-img" src="{{asset('images/fitprogress2.png')}}" alt="logo"/>Fit Progress</h3>
              </div>
                {!! Form::open(['url' => 'auth/register']) !!}
                  
                    <div class="content">
                    <h4 class="title" style="text-align:center;">Registrate</h4>
                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                      <ul>
                        @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                        @endforeach
                      </ul>
                    </div>
                    @endif
                   
                   
                      <div class="form-group">
                        {!! Form::label('email','E-Mail') !!}
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                          {!! Form::email('email', null , ['class' => 'form-control']) !!}
                        </div>
                      </div>
                    
                      <div class="form-group">
                        {!! Form::label('password','Contraseña') !!}
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                          {!! Form::password('password' , ['class' => 'form-control']) !!}
                        </div>
                      </div>
                   
                      <div class="form-group">
                        {!! Form::label('password_confirmation','Repetir Contraseña') !!}
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                          {!! Form::password('password_confirmation' , ['class' => 'form-control']) !!}
                        </div>
                      </div>
                    </div>  


                  <div class="foot">
                    {!! Form::submit('Comenzar', ['class' => 'form-control btn btn-success', 'style' => 'width: 50%']) !!}
                  </div>
                {!! Form::close() !!}
              </div>
            </div>
          <div class="text-center out-links wow fadeIn" data-wow-delay="4s" style="color:white">&copy;&nbsp; <?php echo date('Y'); ?> Fit Progress</div>
          </div>
          </div>
        </div>

        {{-- REGISTER --}}
      </div>
    </div>
  </header>
  </h1>
  </div>
  </div>
    

  <div class="container-fluid" id="row1" style="overflow:hidden">
    <div class="container">
      <div class="row">
        <div class="col-sm-5 wow fadeInLeft" data-wow-duration="2s">
        <h1 class="header-oswald">LA APLICACIÓN QUE ESTABAS BUSCANDO</h1>
          <p id="description">Ahora podrás almacenar todas tus rutinas de gimnasio y ver tus progresos. En FitProgress queremos que no pierdas detalle de toda tu evolución. Para ello te hemos traído esta aplicación en la que podrás almacenar todas tus rutinas, inbodies, medidas y fotos. Estamos trabajando para hacer tu meta más llevadera.</p>
        </div>
        <div class="col-sm-7 wow fadeInRight" data-wow-delay="0.4s" data-wow-duration="2s" style="background: url({{asset('images/fitprogressapple.png')}}) no-repeat;"></div>
      </div>
    </div>
  </div>

  <div class="container-fluid" id="row2">
    <div class="container" id="container-icons">
      <div class="row text-center">
        <h1 class="header-oswald wow fadeIn" data-wow-delay="0.4s" style="margin-bottom:50px">QUÉ OFRECE FIT PROGRESS</h1>
      </div>
      <div class="row">
        <div class="col-md-2 text-center wow rollIn" data-wow-delay="0.4s">
        <i class="fa fa-archive"></i>
          <h2>Rutinas</h2>
          <p>Almacena todas tus rutinas con todo detalle, series, repeticiones, pesos, tiempos de descanso.</p>
        </div>
        <div class="col-md-2 text-center wow rollIn" data-wow-delay="0.4s">
          <i class="fa fa-male"></i>
          <h2>Inbodies</h2>
          <p>Si te realizas algún inbody te hemos preparado esta sección para que guardes sus datos.</p>
        </div>
        <div class="col-md-2 text-center wow rollIn" data-wow-delay="0.4s">
          <i class="fa fa-bar-chart-o"></i>
          <h2>Mediciones</h2>
          <p>Toma medidas de tus musculos y archívalas aquí para que no pierdas detalle de tus progresos.</p>
        </div>
        <div class="col-md-2 text-center wow rollIn" data-wow-delay="0.4s">
          <i class="fa fa-eye"></i>
          <h2>Comparador</h2>
          <p>Hemos incluido este comparador para que puedas analizar y comparar tus rutinas.</p>
        </div>
        <div class="col-md-2 text-center wow rollIn" data-wow-delay="0.4s">
          <i class="fa fa-camera"></i>
          <h2>Galería</h2>
          <p>Galería privada para que subas tus fotos y no pierdas motivación.</p>
        </div>
        <div class="col-md-2 text-center wow rollIn" data-wow-delay="0.4s">
          <i class="fa fa-calendar"></i>
          <h2>Calendario</h2>
          <p>Calendario en el que puedes programar posteriores rutinas y anotar las ya realizadas.</p>
        </div>
      </div>
    </div>
  </div>
  
  <div class="container-fluid" id="row3">
    <div class="container">
      <div class="row text-center" id="prefooter">
        <h1 class="header-oswald wow fadeIn" style="margin:50px 0" data-wow-delay="0.4s" style="margin-bottom:50px">NUESTRO PROYECTO A LARGO PLAZO</h1>
        <ul class="cbp_tmtimeline wow zoomIn" data-wow-delay="0.5s">
          <li> 
            <div class="cbp_tmicon hidden-xs"></div>
            <div class="cbp_tmlabel">
              <h2 style="font-weight:600">SOPORTE PARA ENTRENADORES PERSONALES</h2>
              <p>Queremos hacer el trabajo de entrenadores personales más llevadero con la idea de que éstos puedan supervisar y organizar los eventos de sus clientes. Para ello hemos pensado en dar la posibilidad de asignar rutinas a personas y crear así un sistema de relación entre entrenador y cliente.</p>
            </div>
          </li>
          <li>
            <div class="cbp_tmicon hidden-xs"></div>
            <div class="cbp_tmlabel">
              <h2 style="font-weight:600">INTEGRACIÓN DE SECCIÓN DIETÉTICA</h2>
              <p>Sabemos que la nutrición es un factor imprescindible para conseguir tu meta y por eso queremos cubrir la necesidad de tener que organizar tus dietas sin que pierdas detalle.</p>
            </div>
          </li>
          <li>
            <div class="cbp_tmicon hidden-xs"></div>
            <div class="cbp_tmlabel">
              <h2 style="font-weight:600">HACER DE FITPROGRESS UNA APLICACIÓN SOCIAL</h2>
              <p>Para que no te sientas solo hemos pensado que poder comparar tus rutinas con las cualquier amigo es una gran idea.</p>
            </div>
          </li>
        </ul>
      </div>
      
    </div>
  </div>

  <footer>
    <div class="container-fluid">
      <div class="container text-center">
        <a href=""><i class="fa fa-facebook"></i></a>
        <a href=""><i class="fa fa-twitter"></i></a>
      </div>
    </div>
  </footer>


<script src="{{asset('theme/js/jquery.timeline/js/modernizr.custom.js')}}"></script>
<script src="{{asset('theme/js/jquery.js')}}"></script>
<script type="text/javascript" src="{{asset('theme/js/behaviour/general.js')}}"></script>
<script src="{{asset('theme/js/behaviour/voice-commands.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('theme/js/modernizr.js')}}" type="text/javascript"></script>
<script src="{{asset('js/wow.min.js')}}"></script>
<script>
$(document).ready(function (){
  // Initialize WOW plugin
  new WOW().init();

  // Footer icons effects
  $('.container.text-center i').mouseenter(function (){
    $(this).addClass('animated shake');
  });

  $(".container.text-center i").on("webkitAnimationEnd mozAnimationEnd oAnimationEnd animationEnd", function(event) {
      $(this).removeClass("animated shake");
  });

  $('#register').hide();

  // Show register
  $('.show-register').click(function(e){
    e.preventDefault();
    $('#login').hide();
    $('#register').fadeIn();
    
  });
});
</script>
</body>
</html>