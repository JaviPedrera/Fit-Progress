@extends('layouts.layout')

@section('title', 'Crear medición')

@section('current', 'Crear medición')

@section('breadcrumb','<li><a href="/dashboard/measure">Mediciones</a></li><li class="active">Crear</li>')

@section('content')

  @include('partials.errors')
    
  <div class="row">
    <div class="col-xs-12">
      <div class="block-flat">
        <div class="header">              
          <h3>Nueva Medición</h3>
        </div>
        <div class="content">
          {!! Form::open(['route' => 'measure.store']) !!}
            <div class="form-group">
              {!! Form::label('m_biceps','Biceps') !!}
              {!! Form::text('m_biceps', null, ['class' => 'form-control nocomma'] ) !!}
            </div>
            <div class="form-group">
              {!! Form::label('m_forearm','Antebrazo') !!}
              {!! Form::text('m_forearm', null, ['class' => 'form-control nocomma'] ) !!}
            </div>
            <div class="form-group">
              {!! Form::label('m_leg','Muslo') !!}
              {!! Form::text('m_leg', null, ['class' => 'form-control nocomma'] ) !!}
            </div>
            <div class="form-group">
              {!! Form::label('m_calf','Gemelo') !!}
              {!! Form::text('m_calf', null, ['class' => 'form-control nocomma'] ) !!}
            </div>
            <div class="form-group">
              {!! Form::label('m_waist','Cintura') !!}
              {!! Form::text('m_waist', null, ['class' => 'form-control nocomma'] ) !!}
            </div>
            <div class="form-group">
              {!! Form::label('m_chest','Pecho') !!}
              {!! Form::text('m_chest', null, ['class' => 'form-control nocomma'] ) !!}
            </div>
            <div class="form-group">
              {!! Form::label('m_back','Espalda') !!}
              {!! Form::text('m_back', null, ['class' => 'form-control nocomma'] ) !!}
            </div>
            <div class="form-group">
              {!! Form::label('m_neck','Cuello') !!}
              {!! Form::text('m_neck', null, ['class' => 'form-control'] ) !!}
            </div>
            <div class="form-group">
              {!! Form::submit('Crear Medición', ['class' => 'btn btn-primary form-control']) !!}
            </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
@endsection
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
@endsection
