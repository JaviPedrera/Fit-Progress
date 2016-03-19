@extends('layouts.layout')

@section('title', 'Editar rutina')

@section('current', 'Editar rutina')

@section('breadcrumb','<li><a href="dashboard/workout">Rutinas</a></li><li class="active">Editar</li>')

@section('content')
  <div class="row">
    <div class="col-xs-12">
      <div class="block-flat">
        <div class="header">
          <h3>Editar rutina</h3>
        </div>
      <div class="content">
      {!! Form::model($workout, ['method' => 'PATCH', 'route' => ['workout.update', $workout->id]]) !!}
        <div class="form-group">
          {!! Form::label('name','Nombre') !!}
          {!! Form::text('name', null, ['class' => 'form-control','autofocus'] ) !!}
        </div>
        <div class="form-group">
          <label for="musc_group">Fecha</label>
          <div class="input-group date datetime col-lg-2 col-md-6 col-sm-12 col-xs-12" data-start-view="2" data-date="{{ \Carbon\Carbon::now() }}" data-date-format="dd-mm-yyyy - HH:ii" data-link-field="dtp_input1">
            <input class="form-control" size="16" type="text" value="{{ $workout->created_at }}">
            <span class="input-group-addon btn btn-primary"><span class="glyphicon glyphicon-th"></span></span>
          </div>                  
        </div>
        <div class="exercises">
          @foreach($workout->workoutexercises as $exercise)
            <div class="row" id="exercise-row">
              <div class="col-lg-2">
                <div class="form-group">
                  {!! Form::label('muscular_group','Grupo') !!}
                  {!! Form::text('muscular_group[]', $exercise->muscular_group, ['class' => 'form-control']) !!}
                </div>   
              </div>
              <div class="col-lg-2">
                <div class="form-group">
                  {!! Form::label('exercise_name','Ejercicio') !!}
                  {!! Form::text('exercise_name[]', $exercise->exercise_name, ['class' => 'form-control']) !!}
                </div>
              </div>
              <div class="col-lg-1">
                <div class="form-group">
                      {!! Form::label('sets','Series') !!}
                      {!! Form::text('sets[]', $exercise->sets, ['class' => 'form-control']) !!}
                </div>
              </div>
              <div class="col-lg-2">
                <div class="form-group">
                  {!! Form::label('reps','Repeticiones') !!}
                  {!! Form::text('reps[]', $exercise->reps, ['class' => 'form-control']) !!}
                </div>
              </div>
              <div class="col-lg-2">
                <div class="form-group">
                  {!! Form::label('weights','Pesos') !!}
                  {!! Form::text('weights[]', $exercise->weights, ['class' => 'form-control']) !!}
                </div>
              </div>
              <div class="col-lg-2">
                <div class="form-group">
                  {!! Form::label('rest_time','Descansos') !!}
                  {!! Form::text('rest_time[]', $exercise->rest_time, ['class' => 'form-control']) !!}
                </div>
              </div>
              <div class="col-lg-1">
                <div class="form-group">
                  <br/>
                  <a class="btn btn-primary add" data-placement="top" data-toggle="tooltip" data-original-title="Añadir Ejercicio"><i class="fa fa-plus"></i></a>
                </div>
              </div>
            </div>
          @endforeach
        </div>
          <div class="form-group">
            {!! Form::label('comment','Comentarios') !!}
            {!! Form::textarea('comment', null, ['class' => 'form-control'] ) !!}
          </div>
          <div class="form-group">
            {!! Form::submit('Actualizar Rutina', ['class' => 'btn btn-success']) !!}
          </div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
  <script type="text/javascript">
    $(document).ready(function() {
      // Add exercise row
      var max_fields      = 20;
      var wrapper         = $(".exercises");
      var add_button      = $(".btn.btn-primary.add");
      var row             = $("#exercise-row");

      var x = 1;
      $(add_button).click(function(e) {
          e.preventDefault();
          if (x < max_fields) {
              x++;
              var rowCloned = row.clone();
              rowCloned.find('#add_exercise').html('<div class="form-group" style="margin-top:37px"><a class="btn btn-danger" data-placement="top" data-toggle="tooltip" data-original-title="Eliminar Ejercicio"><i class="fa fa-trash-o"></i></a><a class="btn btn-primary add hidden-lg"><i class="fa fa-plus"></i></a></div>');
              rowCloned.find("select[name='exercise_name']").select2();
              rowCloned.appendTo(wrapper);
              rowCloned.find('#s2id_autogen3').hide();
              $('div.select2-container').css('width','100%');
          }
      });

      // Remove exercise row
      $(wrapper).on("click",".btn.btn-danger", function(e) {
          e.preventDefault(); $(this).closest('.row').fadeOut(300, function() {$(this).closest('.row').remove(); }); x--;
      });

      // No space fix
      $(".nospace").keyup(function(){
          str = $(this).val()
          str = str.replace(/\s/g,'-')
          $(this).val(str)
      });
    });
  </script>
@endsection