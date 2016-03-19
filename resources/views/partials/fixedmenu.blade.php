<div class="cl-sidebar" data-position="right" data-step="1">
  <div class="cl-toggle">
    <i class="fa fa-bars"></i>
  </div>
  <div class="cl-navblock">
    <div class="menu-space">
      <div class="content">
        <div class="side-user">
          <a href="{{ route('profile.index') }}"><div class="avatar"><img class"img-circle" src="{{ asset(Auth::user()->picture) }}" alt="" style="border-radius: 50%; width: 60px;"/> </div></a>
          <a href="{{ route('profile.index') }}"><div class="info"><h5 style="color:white; text-transform:uppercase">{{ Auth::user()->name }} </h5></div></a>
        </div>
        <ul class="cl-vnavigation">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-home"></i><span>Inicio</span></a></li>
            <li><a href="#"><i class="fa fa-archive"></i><span>Rutinas</span></a>
                <ul class="sub-menu">
                    <li><a href="{{ route('workout.index') }}">Ver todas</a></li>
                    <li><a href="{{ route('workout.create') }}">Crear Nueva Rutina</a></li>
                </ul>
            </li>
            <li><a href="#"><i class="fa fa-male"></i><span>Inbodies</span></a>
                <ul class="sub-menu">
                    <li><a href="{{ route('inbody.index') }}">Ver todos</a></li>
                    <li><a href="{{ route('inbody.create') }}">Crear Nuevo Inbody</a></li>
                </ul>
            </li>
            <li><a href="#"><i class="fa fa-bar-chart-o"></i><span>Mediciones</span></a>
                <ul class="sub-menu">
                    <li><a href="{{ route('measure.index') }}">Ver todas</a></li>
                    <li><a href="{{ route('measure.create') }}">Crear Nueva Medición</a></li>
                </ul>
            </li>
            <li><a href="{{ route('comparator.index') }}"><i class="fa fa-eye"></i><span>Comparador</span></a></li>
            <li><a href="{{ route('gallery.index') }}"><i class="fa fa-camera"></i></i><span>Galería</span></a></li>
            <li><a href="{{ route('calendar.index') }}"><i class="fa fa-calendar"></i></i><span>Calendario</span></a></li>
        </ul>
      </div>
    </div>
    <div class="text-right collapse-button" style="padding:7px 9px;">
      <button id="sidebar-collapse" class="btn btn-default" style=""><i style="color:#fff;" class="fa fa-angle-left"></i></button>
    </div>
  </div>
</div>