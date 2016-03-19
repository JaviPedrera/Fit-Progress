@extends('layouts.layout')

@section('title', 'Perfil')

@section('current', 'Perfil')

@section('breadcrumb','<li class="active">Perfil</li>')

@section('content')
  {{--*/ use Jenssegers\Date\Date /*--}}
  {{ Date::setLocale('es')}}
  <div class="row">
    <div class="col-sm-12">
      <div class="block-flat profile-info">
        <div class="row">
          <div class="col-sm-2">
            <div class="avatar">
              <img src=" {{ asset(Auth::user()->picture) }}" class="profile-avatar">
            </div>
          </div>
          <div class="col-sm-6">
            <h1>Cambiar foto de perfil</h1>
            {!! Form::open(['url' => 'dashboard/gallery' , 'files' => true, 'style' => 'padding:5px']) !!}
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
          <div class="col-sm-3">
            <div class="butpro butstyle flat" style="width:100%; max-width: 100%">
              <div class="sub"><h2>ERES MIEMBRO DESDE HACE</h2><span>{{ Auth::user()->created_at->diffInDays() }} Días</span></div>
              <div class="stat"><i class="fa fa-calendar"></i> {{ Date::parse(Auth::user()->created_at)->format('j-M-Y')}}</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  	<div class="col-sm-12">
      <div class="tab-container">
        <ul class="nav nav-tabs">
          <li class="active"><a data-toggle="tab" href="#home">Información</a></li>
          <li class=""><a data-toggle="tab" href="#settings">Editar</a></li>
        </ul>
        <div class="tab-content">
          <div id="home" class="tab-pane cont active">
            <table class="no-border no-strip information">
              <tbody class="no-border-x no-border-y">
                <tr>
                  <td style="width:20%;" class="category"><strong>DATOS</strong></td>
                  <td>
                    <table class="no-border no-strip skills">
                      <tbody class="no-border-x no-border-y">
                        <tr><td style="width:20%;"><b>Nombre</b></td><td>{{ Auth::user()->name }}</td></tr>
                        <tr><td style="width:20%;"><b>Apellidos</b></td><td>{{ Auth::user()->surname }}</td></tr>
                        <tr><td style="width:20%;"><b>E-mail</b></td><td>{{ Auth::user()->email }}</td></tr>
                        <tr><td style="width:20%;"><b>Altura</b></td><td>{{ Auth::user()->height }} cm</td></tr>
                      </tbody>
                    </table>
                  </td>
                </tr>
                </tr>
                <tr>
                  <td class="category"><strong>OPCIONES</strong></td>
                  <td> 
                    <button class="btn btn-danger btn-large">Eliminar cuenta</button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div id="settings" class="tab-pane">
            {!! Form::open(['url' => 'dashboard/editProfile', 'class' => 'form-horizontal']) !!}
              <div class="form-group">
                <label class="col-sm-3 control-label" for="nick">Nombre</label>
                <div class="col-sm-6">
                  <input type="text" name="name" value="{{ Auth::user()->name }}" id="nick" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label" for="name">Apellidos</label>
                <div class="col-sm-6">
                  <input type="text" name="surname" value="{{ Auth::user()->surname }}" id="name" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label" for="name">Altura</label>
                <div class="col-sm-6">
                  <input type="text" name="height" value="{{ Auth::user()->height }}" id="name" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label" for="inputEmail3">Email</label>
                <div class="col-sm-6">
                  <input type="email" name="email" value="{{ Auth::user()->email }}" id="inputEmail3" class="form-control">
                </div>
              </div>
              <div class="form-group spacer2">
                <div class="col-sm-3"></div>
                <label class="col-sm-6" for="inputPassword3">Cambiar contraseña</label>

              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label" for="inputPassword3">Antigua Contraseña</label>
                <div class="col-sm-6">
                  <input type="password" name="" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label" for="inputPassword3">Nueva Contraseña</label>
                <div class="col-sm-6">
                  <input type="password" name="password" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label" for="inputPassword4">Repita Contraseña</label>
                <div class="col-sm-6">
                  <input type="password" class="password-confirmation">
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                  {!! Form::submit('Actualizar', ['class' => 'form-control btn btn-primary', 'style' => 'width: 50%']) !!}
                </div>
              </div>
            {!! Form::close() !!}
          <div class="md-overlay"></div>
          </div>
        </div>
      </div>    
    </div>
	</div>
@endsection

@section('scripts')
  <script type="text/javascript">
    $(document).ready(function(){

      // Placeholder for input file
      document.getElementById("uploadBtn").onchange = function () {
          document.getElementById("uploadFile").value = this.value;
      };

    });
  </script>
@endsection