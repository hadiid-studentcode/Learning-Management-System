  {{-- <script src="{{ asset('Assets/dist/bootstrap/js/bootstrap.bundle.min.js') }}"
      integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
  </script> --}}
  <!-- jQuery -->
  
  <script src="{{ asset('Assets/dist/AdminLTE-3.2.0/plugins/jquery/jquery.min.js') }}"></script>
  <!-- jQuery UI 1.11.4 -->
  {{-- <script src="{{ asset('Assets/dist/AdminLTE-3.2.0/plugins/jquery-ui/jquery-ui.min.js') }}"></script> --}}
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  {{-- <script>
      $.widget.bridge('uibutton', $.ui.button)
  </script> --}}
  <!-- Bootstrap 4 -->
  <script src="{{ asset('Assets/dist/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- ChartJS -->
  {{-- <script src="{{ asset('Assets/dist/AdminLTE-3.2.0/plugins/chart.js/Chart.min.js') }}"></script> --}}
  <!-- Sparkline -->
  {{-- <script src="{{ asset('Assets/dist/AdminLTE-3.2.0/plugins/sparklines/sparkline.js') }}"></script> --}}
  <!-- JQVMap -->
  {{-- <script src={{ asset('Assets/dist/AdminLTE-3.2.0/"plugins/jqvmap/jquery.vmap.min.js') }}></script> --}}
  {{-- <script src="plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script> --}}
  <!-- jQuery Knob Chart -->
  {{-- <script src="{{ asset('Assets/dist/AdminLTE-3.2.0/plugins/jquery-knob/jquery.knob.min.js') }}"></script> --}}
  <!-- daterangepicker -->
  {{-- <script src="{{ asset('Assets/dist/AdminLTE-3.2.0/plugins/moment/moment.min.js') }}"></script> --}}
  {{-- <script src="{{ asset('Assets/dist/AdminLTE-3.2.0/plugins/daterangepicker/daterangepicker.js') }}"></script> --}}
  <!-- Tempusdominus Bootstrap 4 -->
  {{-- <script src="{{ asset('Assets/dist/AdminLTE-3.2.0/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script> --}}
  <!-- Summernote -->
  {{-- <script src="{{ asset('Assets/dist/AdminLTE-3.2.0/plugins/summernote/summernote-bs4.min.js') }}"></script> --}}
  <!-- overlayScrollbars -->
  {{-- <script src="{{ asset('Assets/dist/AdminLTE-3.2.0/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script> --}}
  <!-- AdminLTE App -->
  <script src="{{ asset('Assets/dist/AdminLTE-3.2.0/dist/js/adminlte.js') }}"></script>
  <!-- AdminLTE for demo purposes -->
  {{-- <script src="{{ asset('Assets/dist/AdminLTE-3.2.0/dist/js/demo.js') }}"></script> --}}
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->


  {{-- <script src="https://code.jquery.com/jquery-3.7.0.min.js"
      integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script> --}}


  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.css" />

  <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.js"></script>

  <script src="{{ asset('Assets/dist/AdminLTE-3.2.0/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

  <script src="{{ asset('Assets/dist/AdminLTE-3.2.0/plugins/toastr/toastr.min.js') }}"></script>



  {{-- <script src="{{ asset('Assets/dist/AdminLTE-3.2.0/plugins/jquery/jquery.min.js') }}"></script> --}}

  {{-- <script src="{{ asset('Assets/dist/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script> --}}

  <script src="{{ asset('Assets/dist/AdminLTE-3.2.0/plugins/jquery-ui/jquery-ui.min.js') }}"></script>

  {{-- <script src="{{ asset('Assets/dist/AdminLTE-3.2.0/dist/js/adminlte.min.js?v=3.2.0') }}"></script> --}}

  <script src="{{ asset('Assets/dist/AdminLTE-3.2.0/plugins/moment/moment.min.js') }}"></script>
  <script src="{{ asset('Assets/dist/AdminLTE-3.2.0/plugins/fullcalendar/main.js') }}"></script>

{{-- 
  <script>
    $(function () {

      /* initialize the external events
       -----------------------------------------------------------------*/
      function ini_events(ele) {
        ele.each(function () {

          // create an Event Object (https://fullcalendar.io/docs/event-object)
          // it doesn't need to have a start or end
          var eventObject = {
            title: $.trim($(this).text()) // use the element's text as the event title
          }

          // store the Event Object in the DOM element so we can get to it later
          $(this).data('eventObject', eventObject)

          // make the event draggable using jQuery UI
          $(this).draggable({
            zIndex        : 1070,
            revert        : true, // will cause the event to go back to its
            revertDuration: 0  //  original position after the drag
          })

        })
      }

      ini_events($('#external-events div.external-event'))

      /* initialize the calendar
       -----------------------------------------------------------------*/
      //Date for the calendar events (dummy data)
      var date = new Date()
      var d    = date.getDate(),
          m    = date.getMonth(),
          y    = date.getFullYear()

      var Calendar = FullCalendar.Calendar;
      var Draggable = FullCalendar.Draggable;

      var containerEl = document.getElementById('external-events');
      var checkbox = document.getElementById('drop-remove');
      var calendarEl = document.getElementById('calendar');



      // initialize the external events
      // -----------------------------------------------------------------

      new Draggable(containerEl, {
        itemSelector: '.external-event',
        eventData: function(eventEl) {
          return {
            title: eventEl.innerText,
            backgroundColor: window.getComputedStyle( eventEl ,null).getPropertyValue('background-color'),
            borderColor: window.getComputedStyle( eventEl ,null).getPropertyValue('background-color'),
            textColor: window.getComputedStyle( eventEl ,null).getPropertyValue('color'),
          };
        }
      });

      var calendar = new Calendar(calendarEl, {
        headerToolbar: {
          left  : 'prev,next today',
          center: 'title',
          right : 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        themeSystem: 'bootstrap',
        //Random default events
        events: [
            

        ],
        editable  : true,
        droppable : true, // this allows things to be dropped onto the calendar !!!
        drop      : function(info) {
          // is the "remove after drop" checkbox checked?
          if (checkbox.checked) {
            // if so, remove the element from the "Draggable Events" list
            info.draggedEl.parentNode.removeChild(info.draggedEl);
          }
        }
      });

      calendar.render();
      // $('#calendar').fullCalendar()

      /* ADDING EVENTS */
      var currColor = '#3c8dbc' //Red by default
      // Color chooser button
      $('#color-chooser > li > a').click(function (e) {
        e.preventDefault()
        // Save color
        currColor = $(this).css('color')
        // Add color effect to button
        $('#add-new-event').css({
          'background-color': currColor,
          'border-color'    : currColor
        })
      })
      $('#add-new-event').click(function (e) {
        e.preventDefault()
        // Get value and make sure it is not null
        var val = $('#new-event').val()
        if (val.length == 0) {
          return
        }

        // Create events
        var event = $('<div />')
        event.css({
          'background-color': currColor,
          'border-color'    : currColor,
          'color'           : '#fff'
        }).addClass('external-event')
        event.text(val)
        $('#external-events').prepend(event)

        // Add draggable funtionality
        ini_events(event)

        // Remove event from text input
        $('#new-event').val('')
      })
    })
  </script> --}}






  {{-- <script>
      $(window).on('load', function() {
          var Toast = Swal.mixin({
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              timer: 3000
          });

          Toast.fire({
              icon: 'success',
              title: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
          });
      });
  </script> --}}

  <script>
      $(document).ready(function() {
          $('#data_table').DataTable();
      });

        $(document).ready(function() {
          $('#data_table1').DataTable();
      });
  </script>


  {{-- <script>
      $(function() {
          /* ChartJS
           * -------
           * Here we will create a few charts using ChartJS
           */

          //--------------
          //- AREA CHART -
          //--------------

          // Get context with jQuery - using jQuery's .get() method.

          var areaChartData = {
              labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
              datasets: [{
                      label: 'Digital Goods',
                      backgroundColor: 'rgba(60,141,188,0.9)',
                      borderColor: 'rgba(60,141,188,0.8)',
                      pointRadius: false,
                      pointColor: '#3b8bba',
                      pointStrokeColor: 'rgba(60,141,188,1)',
                      pointHighlightFill: '#fff',
                      pointHighlightStroke: 'rgba(60,141,188,1)',
                      data: [28, 48, 40, 19, 86, 27, 90]
                  },
                  {
                      label: 'Electronics',
                      backgroundColor: 'rgba(210, 214, 222, 1)',
                      borderColor: 'rgba(210, 214, 222, 1)',
                      pointRadius: false,
                      pointColor: 'rgba(210, 214, 222, 1)',
                      pointStrokeColor: '#c1c7d1',
                      pointHighlightFill: '#fff',
                      pointHighlightStroke: 'rgba(220,220,220,1)',
                      data: [65, 59, 80, 81, 56, 55, 40]
                  },
              ]
          }

          var areaChartOptions = {
              maintainAspectRatio: false,
              responsive: true,
              legend: {
                  display: false
              },
              scales: {
                  xAxes: [{
                      gridLines: {
                          display: false,
                      }
                  }],
                  yAxes: [{
                      gridLines: {
                          display: false,
                      }
                  }]
              }
          }



          //-------------
          //- LINE CHART -
          //--------------
          var lineChartCanvas = $('#lineChart1').get(0).getContext('2d')
          var lineChartOptions = $.extend(true, {}, areaChartOptions)
          var lineChartData = $.extend(true, {}, areaChartData)
          lineChartData.datasets[0].fill = false;
          lineChartData.datasets[1].fill = false;
          lineChartOptions.datasetFill = false

          var lineChart = new Chart(lineChartCanvas, {
              type: 'line',
              data: lineChartData,
              options: lineChartOptions
          })



          //-------------
          //- DONUT CHART -  absen
          //-------------
          // Get context with jQuery - using jQuery's .get() method.
          var donutChartCanvas = $('#donutChart1').get(0).getContext('2d')
          var donutData = {
              labels: [
                  'Jumlah Siswa',
                  'Laki-laki',
                  'Perempuan'
              ],
              datasets: [{
                  data: [500, 400, 200],
                  backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],


              }]
          }
          var donutOptions = {
              maintainAspectRatio: false,
              responsive: true,
          }
          //Create pie or douhnut chart
          // You can switch between pie and douhnut using the method below.
          new Chart(donutChartCanvas, {
              type: 'doughnut',
              data: donutData,
              options: donutOptions
          })




          //- DONUT CHART - izin
          //-------------
          // Get context with jQuery - using jQuery's .get() method.
          var donutChartCanvas = $('#donutChart5').get(0).getContext('2d')
          var donutData = {
              labels: [
                  ''

              ],
              datasets: [{
                  data: [800, 200],
                  backgroundColor: ['#749F82'],
              }]
          }
          var donutOptions = {
              maintainAspectRatio: false,
              responsive: true,
          }
          //Create pie or douhnut chart
          // You can switch between pie and douhnut using the method below.
          new Chart(donutChartCanvas, {
              type: 'doughnut',
              data: donutData,
              options: donutOptions
          })



          //- DONUT CHART1  -  Tidak Absen
          //-------------
          // Get context with jQuery - using jQuery's .get() method.
          var donutChartCanvas = $('#donutChart3').get(0).getContext('2d')
          var donutData = {
              labels: [
                  'Siswa Yang Belum Bayar',
                  'Siswa Yang Sudah Bayar'
              ],
              datasets: [{
                  data: [800, 200],
                  backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
              }]
          }
          var donutOptions = {
              maintainAspectRatio: false,
              responsive: true,
          }
          //Create pie or douhnut chart
          // You can switch between pie and douhnut using the method below.
          new Chart(donutChartCanvas, {
              type: 'doughnut',
              data: donutData,
              options: donutOptions
          })


          //- DONUT CHART - Terlambat
          //-------------
          // Get context with jQuery - using jQuery's .get() method.
          var donutChartCanvas = $('#donutChart4').get(0).getContext('2d')
          var donutData = {
              labels: [
                  'asda'
              ],
              datasets: [{
                  data: [800, 200],
                  backgroundColor: ['#F0FF42', '#EEEEEE'],
              }]
          }
          var donutOptions = {
              maintainAspectRatio: false,
              responsive: true,
          }
          //Create pie or douhnut chart
          // You can switch between pie and douhnut using the method below.
          new Chart(donutChartCanvas, {
              type: 'doughnut',
              data: donutData,
              options: donutOptions
          })





          //-------------




      })
  </script> --}}
