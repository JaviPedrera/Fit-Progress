@extends('layouts.layout')

@section('title', 'Editar medición')

@section('current', 'Editar medición')

@section('breadcrumb','<li><a href="{{ route(\'measure.index\') }}">Mediciones</a></li><li class="active">Editar</li>')

@section('content')
  <div class="row">
    <div class="col-xs-12">
      <div class="block-flat">
        <div class="header">              
          <h1>Editar Medición</h1>
        </div>
        <div class="content">
         {!! Form::model($measure, ['method' => 'PATCH', 'rote' => ['measure.update', $measure->id]]) !!}
            <div class="form-group">
              {!! Form::label('m_neck','Cuello') !!}
              {!! Form::text('m_neck', null, ['class' => 'form-control nocomma'] ) !!}
            </div>
            <div class="form-group">
              {!! Form::label('m_chest','Pecho') !!}
              {!! Form::text('m_chest', null, ['class' => 'form-control nocomma'] ) !!}
            </div>
            <div class="form-group">
              {!! Form::label('m_forearm','Antebrazo') !!}
              {!! Form::text('m_forearm', null, ['class' => 'form-control nocomma'] ) !!}
            </div>
            <div class="form-group">
              {!! Form::label('m_waist','Cintura') !!}
              {!! Form::text('m_waist', null, ['class' => 'form-control nocomma'] ) !!}
            </div>
            <div class="form-group">
              {!! Form::label('m_calf','Gemelo') !!}
              {!! Form::text('m_calf', null, ['class' => 'form-control nocomma'] ) !!}
            </div>
            <div class="form-group">
              {!! Form::label('m_leg','Muslo') !!}
              {!! Form::text('m_leg', null, ['class' => 'form-control nocomma'] ) !!}
            </div>
            <div class="form-group">
              {!! Form::label('m_biceps','Biceps') !!}
              {!! Form::text('m_biceps', null, ['class' => 'form-control nocomma'] ) !!}
            </div>
            <div class="form-group">
              {!! Form::label('m_back','Espalda') !!}
              {!! Form::text('m_back', null, ['class' => 'form-control nocomma'] ) !!}
            </div>
            <div class="form-group">
              {!! Form::submit('Editar Medición', ['class' => 'btn btn-success form-control']) !!}
            </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
@stop

@section('scripts')
  <script>
    $(document).ready(function() {
      // Replace comma for dot
      $(".nocomma").keyup(function(){
          str = $(this).val()
          str = str.replace(/\,/,'.')
          $(this).val(str)
      });
    });
  </script>
@stop