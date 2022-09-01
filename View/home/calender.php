
<?php view('static/header') ;?>
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo url('logout'); ?>" class="nav-link">Çıkış Yap</a>
      </li>  
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php  view('static/sidebar') ; ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper p-2">   
 
  <?php  // test($config) ; ?>
    <!-- Main content -->
    <div class="content">
      <div id="calendar">

      </div>

    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php view('static/footer') ;?>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?= assets('plugins/jquery/jquery.min.js') ; ?> "></script>
<!-- Bootstrap 4 -->
<script src="<?= assets('plugins/bootstrap/js/bootstrap.bundle.min.js') ; ?> "></script>
<script src="<?= assets('plugins/fullcalendar/main.js') ; ?> "></script>
<script src="<?= assets('plugins/fullcalendar/locales-all.js') ; ?> "></script>
<script src="<?= assets('js/adminlte.min.js') ; ?>"></script>

<script>
  document.addEventListener('DOMContentLoaded', function(){
    var calendarEl = document.getElementById('calendar') ;
    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      locale: '<?= default_lang() ?>',
      events: '<?= url('api/calendar/') ?>'
    }) ;
    calendar.render() ;
  });
</script>
</body>
</html>
