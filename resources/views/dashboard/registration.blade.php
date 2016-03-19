@extends('layouts.layout')

@section('title', 'Registro')

@section('current','Registro')

@section('breadcrumb','<li class="active">Registro</li>')

@section('content')
  @include('partials.errors')
	<div class="row wizard-row">
      <div class="col-md-12 fuelux">
        <div class="block-wizard">
          <div id="wizard1" class="wizard wizard-ux">
            <ul class="steps">
              <li data-target="#step1" class="active">Paso 1<span class="chevron"></span></li>
              <li data-target="#step2">Paso 2<span class="chevron"></span></li>
            </ul>
          </div>
          <div class="step-content">
            {!! Form::open(['route' => 'registration.index', 'files' => true, 'class' => 'form-horizontal group-border-dashed']) !!}
              <div class="step-pane active" id="step1">

                <div class="form-group no-padding">
                  <div class="col-sm-7">
                    <h3 class="hthin">Datos</h3>
                  </div>
                </div>

                <div class="form-group">
                    {!! Form::label('name','Nombre', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-6">
                      {!! Form::text('name', null , ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('surname','Apellidos', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-6">
                      {!! Form::text('surname', null, ['class' => 'form-control']) !!}
                    </div>
                </div>

                <div class="form-group">
                  {!! Form::label('age', 'Fecha de nacimiento', ['class' => 'col-sm-3 control-label']) !!}
                  <div class="col-sm-6">
                    <div class="input-group date datetime col-md-5 col-xs-7" data-min-view="2" data-start-view="4" data-date="1990-09-16T05:25:07Z" data-date-format="dd-mm-yyyy" data-link-field="dtp_input1" id="age">
                    {!! Form::text('age', null, ['class' => 'form-control', 'size' => '16']) !!}
                    <span class="input-group-addon btn btn-primary"><span class="glyphicon glyphicon-th"></span></span>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  {!! Form::label('sex', 'Sexo', ['class' => 'col-sm-3 control-label'] ) !!}
                  <div class="col-sm-6">
                    {!! Form::select('sex', ['1' =>  'Hombre','2' =>  'Mujer'], '1', ['class' => 'form-control']) !!}
                  </div>
                </div>

                <div class="form-group">
                  {!! Form::label('height','Altura (cm)', ['class' => 'col-sm-3 control-label']) !!}
                  <div class="col-sm-6">
                    {!! Form::text('height', null, ['class' => 'form-control']) !!}
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <button data-wizard="#wizard1" class="btn btn-primary wizard-next">Siguiente <i class="fa fa-caret-right"></i></button>
                  </div>
                </div>

              </div>

              <div class="step-pane" id="step2">
                <div class="form-group no-padding">
                  <div class="col-sm-7">
                    <h3 class="hthin">Imagen</h3>
                  </div>
                </div>
                <div class="form-group" style="padding-right: 30px;">
                  <div class="alert alert-info" style="width: 100%;max-width: 500px;margin-left: 14px;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <i class="fa fa-info-circle sign"></i> Puedes seleccionar tu foto de perfil y modificar tus datos más adelante.
                   </div>
                  <input id="uploadFile" placeholder="Selecciona imagen" disabled="disabled" style="margin-left: 14px;width:150px">
                  <div class="fileUpload btn btn-primary">
                      <span>Seleccionar</span>
                      {!! Form::file('image',['class' => 'upload', 'id' => 'uploadBtn']) !!}
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-12">
                    {!! Form::submit('Registrar', ['class' => 'form-control btn btn-primary', 'style' => 'width: 50%']) !!}
                  </div>
                </div>  
              </div>
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
			
@endsection

@section('scripts')

  <script type="text/javascript">
    $(document).ready(function(){
      // Run the wizard
      App.wizard();
      
      // Placeholder for input file
      document.getElementById("uploadBtn").onchange = function () {
          document.getElementById("uploadFile").value = this.value;
      };
    });
  </script>

@endsection

@stop