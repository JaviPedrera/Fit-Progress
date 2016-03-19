@extends('layouts.layout')

@section('title', 'Crear inbody')

@section('current', 'Crear inbody')

@section('breadcrumb','<li><a href="/dashboard/inbody">Inbodies</a></li><li class="active">Crear</li>')

@section('content')

@include('partials.errors')

@if($inbodiesCount == 0)
  @include('partials.inbodymodal')
@endif  
<div class="row">
  <div class="col-md-12">
    <div class="block-flat">
      <div class="header">              
        <h3>Nuevo Inbody</h3>
      </div>
      <div class="content">
        {!! Form::open(['route' => 'inbody.store']) !!}
          {{-- <div class="form-group">
            {!! Form::label('created_at','Fecha') !!}
            {!! Form::input('date','created_at', date('Y-m-d'), ['class' => 'form-control']) !!}
          </div> --}}
          <div class="form-group">
             <label for="musc_group" class="control-label">Fecha</label>
                <div class="input-group date datetime col-md-5 col-xs-7" data-min-view="4" data-start-view="2" data-date="{{ date('d-m-Y') }}" data-date-format="dd-mm-yyyy" data-link-field="dtp_input1" id="age">
                  <input name="age" class="form-control" size="16" type="text" value="{{ date('d-m-Y') }}" />
                  <span class="input-group-addon btn btn-primary"><span class="glyphicon glyphicon-th"></span></span>
                </div>                  
            </div>

          <div class="form-group">
            {!! Form::label('weight','Peso') !!}
            {!! Form::text('weight', null, ['class' => 'form-control', 'id' => 'weight'] ) !!}
          </div>

          <div class="form-group">
            {!! Form::label('imc','I.M.C') !!}
            {!! Form::text('imc', null, [
                                'class' => 'form-control',
                                'id' => 'imc',
                                'data-popover' => 'popover', 
                                'data-original-title' => 'Atención',
                                'data-content' => 'Éste IMC es un cálculo aproximado que hemos concluido con tus datos.',
                                'data-placement' => 'top',
                                'data-triger' => 'focus']) !!}
          </div>

          <div class="form-group">
            {!! Form::label('metabolism','Metabolismo') !!}
            {!! Form::text('metabolism', null, [
                                'class' => 'form-control',
                                'id' => 'metabolism',
                                'data-popover' => 'popover', 
                                'data-original-title' => 'Atención',
                                'data-content' => 'Éste metabolismo basal es un cálculo aproximado que hemos concluido con tus datos.',
                                'data-placement' => 'top',
                                'data-triger' => 'focus']) !!}
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
            <a href="#collapse1" class="btn btn-success nav-toggle pull-right"><i class="fa fa-bar-chart-o"></i> Añadir medidas</a>
          </div>

          <div id="collapse1" style="display:none; margin-top:60px">
            <div class="header">              
              <h3>Medidas</h3>
            </div>
            <div class="form-group">
              {!! Form::label('m_neck','Cuello') !!}
              {!! Form::text('m_neck', null, ['class' => 'form-control'] ) !!}
            </div>

            <div class="form-group">
              {!! Form::label('m_chest','Pecho') !!}
              {!! Form::text('m_chest', null, ['class' => 'form-control'] ) !!}
            </div>

            <div class="form-group">
              {!! Form::label('m_forearm','Antebrazo') !!}
              {!! Form::text('m_forearm', null, ['class' => 'form-control'] ) !!}
            </div>

            <div class="form-group">
              {!! Form::label('m_waist','Cintura') !!}
              {!! Form::text('m_waist', null, ['class' => 'form-control'] ) !!}
            </div>

            <div class="form-group">
              {!! Form::label('m_calf','Gemelo') !!}
              {!! Form::text('m_calf', null, ['class' => 'form-control'] ) !!}
            </div>

            <div class="form-group">
              {!! Form::label('m_leg','Muslo') !!}
              {!! Form::text('m_leg', null, ['class' => 'form-control'] ) !!}
            </div>

            <div class="form-group">
              {!! Form::label('m_biceps','Biceps') !!}
              {!! Form::text('m_biceps', null, ['class' => 'form-control'] ) !!}
            </div>

            <div class="form-group">
              {!! Form::label('m_back','Espalda') !!}
              {!! Form::text('m_back', null, ['class' => 'form-control'] ) !!}
            </div>
          </div>

          <div class="form-group">
            {!! Form::submit('Crear Inbody', ['class' => 'btn btn-primary form-control']) !!}
          </div>
        {!! Form::close() !!}

      </div>
    </div>
  </div>

</div>

@section('scripts')
<script>
$(document).ready(function() {
    $('.nav-toggle').click(function(){
    //get collapse content selector
    var collapse_content_selector = $(this).attr('href');         

    //make the collapse content to be shown or hide
    var toggle_switch = $(this);
    $(collapse_content_selector).toggle(function(){
            if($(this).css('display')=='none'){
              //change the button label to be 'Show'
              toggle_switch.html('Añadir medidas');
            }else{
              //change the button label to be 'Hide'
              toggle_switch.html('Esconder medidas');
            }
      });


    }); 

  var height = {{ Auth::user()->height }};
  var age = {{ Auth::user()->age }};

  $("#weight").focusout(function() {
    var weight = document.getElementById('weight').value;
    var imc = weight / Math.pow((height/100),2);

    $('#imc').val(imc).css({'background-color':'#D2E2FF','-webkit-transition':'background-color 2s','transition':'background-color 2s'});

    var metabolism = 66 + (13.8 * weight) + (5 * height) - (6.8 * age);
    var metabolism2 = (10 * weight) + (6.25 * height) - (5 * age) + 5 ;

    $('#metabolism').val(metabolism).css({'background-color':'#D2E2FF','-webkit-transition':'background-color 2s','transition':'background-color 2s'});

  });

  $('#md-fall').niftyModal("show");

});
</script>
@endsection
@stop
