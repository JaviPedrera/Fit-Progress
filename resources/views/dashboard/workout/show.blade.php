@extends('layouts.layout')

@section('title', 'Dashboard')

@section('current', 'Mostrar rutina')

@section('breadcrumb','<li><a href="/dashboard/workout">Rutinas</a></li><li class="active">Mostrar</li>')

@section('content')
  <div class="row dash-cols">
    <div class="col-md-12">
      <div class="block-flat">
        <div class="header">              
            <h3>{{ $workout->name }}</h3>
        </div>
        <div class="content">
          <div class="table-responsive">
            <table class="table no-border hover">
              <thead class="no-border">
                <tr>
                  <th style="width:10%;"><strong>Grupo Muscular</strong></th>
                  <th class="width:15%;"><strong>Ejercicio</strong></th>
                  <th style="width:5%;"><strong>Series</strong></th>
                  <th style="width:15%;"><strong>Repeticiones</strong></th>
                  <th style="width:15%;"><strong>Descansos</strong></th>
                  <th style="width:15%;"><strong>Pesos</strong></th>
                </tr>
              </thead>
              <tbody class="no-border-y">
                @foreach ($exercises as $exercise)
                  <tr>
                    <td>{{ $exercise->muscular_group }}</td>
                    <td>{{ $exercise->exercise_name }}</td>
                    <td>{{ $exercise->sets }}</td>
                    <td>{{ $exercise->reps }}</td>
                    <td>{{ $exercise->rest_time }}</td>
                    <td>{{ $exercise->weights }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>    
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection