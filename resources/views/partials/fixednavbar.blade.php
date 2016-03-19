<div id="head-nav" class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="fa fa-gear"></span>
      </button>
      <a class="navbar-brand" href="{{ route('dashboard.index') }} "><span>Fit Progress </span></a>
    </div>
    <div class="navbar-collapse collapse">
      <ul class="nav navbar-nav navbar-right user-nav">
        <li class="dropdown profile_menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img style="width: 30px" alt="Avatar" src="{{ asset(Auth::user()->picture) }}" /> {{ Auth::user()->name }} <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="{{ route('profile.index') }}">Perfil</a></li>
            <li class="divider"></li>
            <li><a class="md-trigger" data-modal="form-primary">Contacto</a></li>
            <li class="divider"></li>
            <li><a href="{{ url('auth/logout') }}">Desconectar</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</div>