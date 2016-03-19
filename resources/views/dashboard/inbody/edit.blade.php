@extends('layouts.layout')

@section('title', 'Editar inbody')

@section('current', 'Editar inbody')

@section('breadcrumb','<li><a href="/dashboard/inbody">Inbodies</a></li><li class="active">Editar</li>')

@section('content')
  
  <div class="row">
    <div class="col-xs-12">
      <div class="block-flat">
        <div class="header">              
          <h3>Editar Inbody</h3>
        </div>
        <div class="content">
           {!! Form::model($inbody, ['method' => 'PUT', 'route' => ['inbody.update', $inbody->id]]) !!}
            <div class="form-group">
              {!! Form::label('created_at','Fecha') !!}
              {!! Form::input('date','created_at', date('Y-m-d'), ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
              {!! Form::label('weight','Peso') !!}
              {!! Form::text('weight', null, ['class' => 'form-control', 'id' => 'weight'] ) !!}
            </div>

            <div class="form-group">
              {!! Form::label('imc','I.M.C') !!}
              {!! Form::text('imc', null, ['class' => 'form-control','id' => 'imc'] ) !!}
            </div>

            <div class="form-group">
              {!! Form::label('metabolism','Metabolismo') !!}
              {!! Form::text('metabolism', null, ['class' => 'form-control'] ) !!}
            </div>

            <div class="form-group">
              {!! Form::label('muscle_weight','Masa Muscular') !!}
              {!! Form::text('muscle_weight', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
              {!! Form::label('fat_weight','Peso Grasa') !!}
              {!! Form::text('fat_weight', null, ['class' => 'form-control','id' => 'tin']) !!}
            </div>

            <div class="form-group">
              {!! Form::label('fat_percent','Porcentaje de Grasa') !!}
              {!! Form::text('fat_percent', null, ['class' => 'form-control'] ) !!}
            </div>

            <div class="form-group">
              {!! Form::submit('Editar Inbody', ['class' => 'btn btn-success form-control']) !!}
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
    $('.nav-toggle').click(function(){
      // get collapse content selector
      var collapse_content_selector = $(this).attr('href');         

      // make the collapse content to be shown or hide
      var toggle_switch = $(this);
      $(collapse_content_selector).toggle(function(){
        if($(this).css('display')=='none'){
        // change the button label to be 'Show'
        toggle_switch.html('Añadir medidas');
        }else{
        // change the button label to be 'Hide'
        toggle_switch.html('Esconder medidas');
        }
      });
    });

    var height = {{ Auth::user()->height }};
    var age = {{ Auth::user()->age }};

    $("#weight").focusout(function() {
      var weight = document.getElementById('weight').value;
      var imc = weight / Math.pow((height/100),2);

      $('#imc').val(imc);

      var metabolism = 66 + (13.8 * weight) + (5 * height) - (6.8 * age);
      var metabolism2 = (10 * weight) + (6.25 * height) - (5 * age) + 5 ;

      $('#metabolism').val(metabolism);
    });

  }); 
  </script>
@endsection
