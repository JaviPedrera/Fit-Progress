@extends('layouts.layout')

@section('title', 'Crear rutina')

@section('current', 'Crear rutina')

@section('breadcrumb','<li><a href="workout/create">Rutinas</a></li><li class="active">Crear</li>')

@section('content')

  @include('partials.errors')
  <div class="row">
    <div class="col-xs-12">
      <div class="block-flat">
        <!-- Rutina -->
        <div class="header">
          <h3>Nueva Rutina</h3>
        </div>
        <div class="content">
          {!! Form::open(['route' => 'workout.store' ]) !!}
            <div class="form-group control-group">
              {!! Form::label('name','Nombre de la rutina') !!}
              {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'workout_name'] ) !!}
            </div>
            <div class="form-group">
              <label for="musc_group">Fecha</label>
              <div class="input-group date datetime col-lg-2 col-lg-6 col-sm-12 col-xs-12" data-start-view="2" data-date="{{ \Carbon\Carbon::now() }}" data-date-format="dd/mm/yyyy - HH:ii" data-link-field="dtp_input1" style="padding:0">
                <input class="form-control" size="16" type="text" value="{{ \Carbon\Carbon::now()->format('d/m/Y - H:i') }}">
                <span class="input-group-addon btn btn-primary"><span class="glyphicon glyphicon-th"></span></span>
              </div>                  
            </div>
            <div class="form-group">
              <label>Grupo Muscular</label>
                <select multiple class="select2" name="musc_group[]" class="form-control" style="padding:0" required>
                  <option value="Pectoral">Pectoral</option>
                  <option value="Espalda">Espalda</option> 
                  <option value="Hombros">Hombros</option> 
                  <option value="Pierna">Pierna</option> 
                  <option value="Biceps">Biceps</option> 
                  <option value="Triceps">Triceps</option> 
                  <option value="Abdomen">Abdomen</option> 
                </select>
            </div>
        </div>

        <!-- Exercises -->
        <div class="header">
          <h3>Ejercicios</h3>
        </div>
        <div class="content">
          <div class="exercises">
            <div class="row" id="exercise-row">
              <div class="col-lg-2">
                <div class="form-group">
                  <label>Grupo Muscular</label>
                  <select name="muscular_group[]" class="form-control">
                  <option selected disabled>Selecciona</option>
                    <option value="Pectoral">Pectoral</option>
                    <option value="Espalda">Espalda</option> 
                    <option value="Hombros">Hombros</option> 
                    <option value="Pierna">Pierna</option> 
                    <option value="Biceps">Biceps</option> 
                    <option value="Triceps">Triceps</option> 
                    <option value="Abdomen">Abdomen</option> 
                  </select>
                </div>
              </div>
              @include('partials.exerciselist')
              <div class="col-lg-1">
                <div class="form-group">
                  {!! Form::label('sets','Series') !!}
                  {!! Form::selectRange('sets[]', 1, 10, 1, ['class' => 'form-control','id' => 'sets']) !!}
                </div>
              </div>
              <div class="col-lg-2">
                <div class="form-group">
                  {!! Form::label('reps','Repeticiones') !!}
                  {!! Form::text('reps[]', null, ['class' => 'form-control nospace','id' => 'reps', 'placeholder' => 'Ej: 12-10-10-8']) !!}
                </div>
              </div>
              <div class="col-lg-2">
                <div class="form-group">
                  {!! Form::label('weights','Pesos') !!}
                  {!! Form::text('weights[]', null, ['class' => 'form-control nospace','id' => 'weights', 'placeholder' => 'Ej: 40-50-50-55']) !!}
                </div>
              </div>
              <div class="col-lg-2">
                <div class="form-group">
                  {!! Form::label('rest_time','Descansos') !!}
                  {!! Form::text('rest_time[]', null, ['data-mask' => 'taxid','placeholder' => 'Ej: 1:30-1:30-1:30-2:00','class' => 'form-control nospace','id' => 'rest_time']) !!}
                </div>
              </div>
              <div class="col-lg-1" id="add_exercise">
                <div class="form-group" style="margin-top:37px">
                  <a class="btn btn-primary add" data-placement="top" data-toggle="tooltip" data-original-title="Añadir Ejercicio"><i class="fa fa-plus"></i></a>
                </div>
              </div>
            </div>
          </div>
        <div class="form-group">
          {!! Form::label('comment','Comentarios') !!}
          {!! Form::textarea('comment', null, ['class' => 'form-control'] ) !!}
        </div>
        <div class="form-group">
          {!! Form::submit('Crear Rutina', ['class' => 'btn btn-primary form-control']) !!}
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
  <!-- Maskedinput Plugin -->
  <!-- 
  <script src="{{ asset('js/jquery.maskedinput.min.js')}}"></script>
  <script>
    $("#sets").focusout(function() {
      var setInput = document.getElementById('sets').value;
      
      var finalMask = "99?";

      for(i = 1; i < setInput; i++) {
        finalMask += "-99?";
      }

      $("#reps").mask(finalMask);
      $("#weights").mask(finalMask);
      $("#rest_time").mask(finalMask);
    });    
  </script>
  -->
@endsection