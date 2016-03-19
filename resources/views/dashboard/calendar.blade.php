@extends('layouts.layout')

@section('title', 'Calendario')

@section('current', 'Calendario')

@section('breadcrumb','<li class="active">Calendario</li>')

@section('content')

  @include('partials.modaltoextend',[
    'icon' => 'fa fa-info',
    'title' => 'Información', 
    'body' => 'En breves esta sección estará disponible'
  ])

  <div class="row">
    <div class="col-md-9">
        <div class="block-flat">
          <div class="header">              
            <h3>Agenda</h3>
          </div>
          <div class="content">
            <div id='calendar'></div>
          </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="block-flat">
        <div class="header">              
          <h3>Eventos para arrastrar</h3>
        </div>
        <div class="content">
          <div id='external-events'>
            <div class='external-event'>Pectoral</div>
            <div class='external-event'>Piernas</div>
            <div class='external-event'>Cardio</div>
            <div class='external-event'>Abdomen</div>
            <p><input type='checkbox' id='drop-remove' /> <label for='drop-remove'>Borrar al insertar</label></p>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
  <script type="text/javascript">
    $(document).ready(function() {

      $('#md-fall').niftyModal("show");

        // page is now ready, initialize the calendar...
        
        /* initialize the external events
      -----------------------------------------------------------------*/
    
      $('#external-events div.external-event').each(function() {
      
        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
        // it doesn't need to have a start or end
        var eventObject = {
          title: $.trim($(this).text()) // use the element's text as the event title
        };
        
        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject);
        
        // make the event draggable using jQuery UI
        $(this).draggable({
          zIndex: 999,
          revert: true,      // will cause the event to go back to its
          revertDuration: 0  //  original position after the drag
        });
        
      });
      var date = new Date();
      var d = date.getDate();
      var m = date.getMonth();
      var y = date.getFullYear();

      $('#calendar').fullCalendar({
        header: {
          lang: 'es',
          left: 'title',
          center: '',
          right: 'month,agendaWeek,agendaDay, today, prev,next',
        },
        editable: true,
        events: [
          {
            title: 'Pectoral',
            start: new Date(y, m, 1)
          },
          {
            title: 'Cardio por la mañana',
            start: new Date(y, m, d-5),
            end: new Date(y, m, d-2)
          },
          {
            title: 'Pectoral',
            start: new Date(y, m, d, 10, 30),
            allDay: false
          },
          {
            title: 'Cardio',
            start: new Date(y, m, d, 12, 0),
            end: new Date(y, m, d, 14, 0),
            allDay: false
          },
          {
            title: 'Piernas + Abdomen',
            start: new Date(y, m, d+1, 19, 0),
            end: new Date(y, m, d+1, 22, 30),
            allDay: false
          }
        ],
        droppable: true, // this allows things to be dropped onto the calendar !!!
        drop: function(date, allDay) { // this function is called when something is dropped
        
          // retrieve the dropped element's stored Event Object
          var originalEventObject = $(this).data('eventObject');
          
          // we need to copy it, so that multiple events don't have a reference to the same object
          var copiedEventObject = $.extend({}, originalEventObject);
          
          // assign it the date that was reported
          copiedEventObject.start = date;
          copiedEventObject.allDay = allDay;
          
          // render the event on the calendar
          // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
          $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
          
          // is the "remove after drop" checkbox checked?
          if ($('#drop-remove').is(':checked')) {
            // if so, remove the element from the "Draggable Events" list
            $(this).remove();
          }
        }
      });
    });
  </script>
  @endsection
