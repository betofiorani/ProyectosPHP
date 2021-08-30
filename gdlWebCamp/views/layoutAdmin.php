<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>GDLWEBCAMP | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  
  <link rel="stylesheet" href="../build/css/back.css">
  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="../build/img/logo.svg" alt="GDLWEBCAMPLogo" height="60" width="60">
  </div>

  <?php 
    include_once 'admin/barra.php';
    include_once 'admin/barra_lateral.php';
  
  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

  <?php
    echo $contenido;
  
  ?>

  </div>
  <!-- ./wrapper -->  
<!-- jQuery -->
<script src="../build/js/adminLTE/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../build/js/adminLTE/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../build/js/adminLTE/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="../build/js/adminLTE/Chart.min.js"></script>
<!-- jQuery Knob Chart -->
<script src="../build/js/adminLTE/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../build/js/adminLTE/moment.min.js"></script>
<script src="../build/js/adminLTE/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../build/js/adminLTE/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../build/js/adminLTE/summernote-bs4.min.js"></script>
<?php 
  if($titulo_pagina === 'Listado de Administradores' || $titulo_pagina === 'Listado de Eventos' || $titulo_pagina === 'Listado de Categorias' || $titulo_pagina === 'Listado de Invitados' || $titulo_pagina === 'Listado de Registrados'){
?>
  <script src="../build/js/adminLTE/jquery.dataTables.min.js"></script>
  <script src="../build/js/adminLTE/dataTables.bootstrap4.min.js"></script>
  <script src="../build/js/adminLTE/dataTables.responsive.min.js"></script>
  <script src="../build/js/adminLTE/responsive.bootstrap4.min.js"></script>
  <script src="../build/js/adminLTE/dataTables.buttons.min.js"></script>
  <script src="../build/js/adminLTE/buttons.bootstrap4.min.js"></script>
  <script src="../build/js/adminLTE/jszip.min.js"></script>
<script src="../build/js/adminLTE/pdfmake.min.js"></script>
<script src="../build/js/adminLTE/vfs_fonts.js"></script>
<script src="../build/js/adminLTE/buttons.html5.min.js"></script>
<script src="../build/js/adminLTE/buttons.print.min.js"></script>
<script src="../build/js/adminLTE/buttons.colVis.min.js"></script>
  <script>
  $(function () {
    $("#registros").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false, "pageLength": 10,
      "language" : {
        "paginate":{
          next: 'siguiente',
          previous: 'Anterior',
          last: 'Ultimo',
          first: 'Primero'
        },
        "info": 'Mostrando _START_ a _END_ de _TOTAL_ resultados',
        "emptyTable": 'No hay registros',
        "infoEmpty": '0 registros',
        "search": 'Buscar'
      },
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    
  });
</script>
<?php
  
  }
?>
<script src="../build/js/adminLTE/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../build/js/adminLTE/adminlte.js"></script>
<script src="../build/js/adminLTE/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../build/js/adminLTE/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../build/js/admin.min.js"></script>
<script>
  $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    //--------------
    //- AREA CHART -
    //--------------

    // Get context with jQuery - using jQuery's .get() method.
    var areaChartCanvas = $('#areaChart').get(0).getContext('2d')

    var areaChartData = {
      labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
      datasets: [
        {
          label               : 'Registrados',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [1, 2, 1, 5, 2, 4, 6]
        },
        {
          label               : 'Registrados Pagados',
          backgroundColor     : 'rgba(210, 214, 222, 1)',
          borderColor         : 'rgba(210, 214, 222, 1)',
          pointRadius         : false,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [0, 0, 1, 0, 2, 0, 0]
        },
      ]
    }

    var areaChartOptions = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : false,
          }
        }],
        yAxes: [{
          gridLines : {
            display : false,
          }
        }]
      }
    }

    // This will get the first returned node in the jQuery collection.
    new Chart(areaChartCanvas, {
      type: 'line',
      data: areaChartData,
      options: areaChartOptions
    })

    //-------------
    //- LINE CHART -
    //--------------
    var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
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
    //- DONUT CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
    var donutData        = {
      labels: [
          'Chrome',
          'IE',
          'FireFox',
          'Safari',
          'Opera',
          'Navigator',
      ],
      datasets: [
        {
          data: [700,500,400,600,300,100],
          backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
        }
      ]
    }
    var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: donutData,
      options: donutOptions
    })

    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieData        = donutData;
    var pieOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(pieChartCanvas, {
      type: 'pie',
      data: pieData,
      options: pieOptions
    })

    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = $.extend(true, {}, areaChartData)
    var temp0 = areaChartData.datasets[0]
    var temp1 = areaChartData.datasets[1]
    barChartData.datasets[0] = temp1
    barChartData.datasets[1] = temp0

    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false
    }

    new Chart(barChartCanvas, {
      type: 'bar',
      data: barChartData,
      options: barChartOptions
    })

    //---------------------
    //- STACKED BAR CHART -
    //---------------------
    var stackedBarChartCanvas = $('#stackedBarChart').get(0).getContext('2d')
    var stackedBarChartData = $.extend(true, {}, barChartData)

    var stackedBarChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      scales: {
        xAxes: [{
          stacked: true,
        }],
        yAxes: [{
          stacked: true
        }]
      }
    }

    new Chart(stackedBarChartCanvas, {
      type: 'bar',
      data: stackedBarChartData,
      options: stackedBarChartOptions
    })
  })
</script>

</body>
</html>
