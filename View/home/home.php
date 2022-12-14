
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
 
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
      
      <h5 class="mt-4 mb-2">Güncel Durumunuz <code><?= date('Y-m-d') ?></code></h5>
        <div class="row">
          <?php foreach($data['istatistik'] as $row){ ?>
            <?php // test($row) ; ?>
          <div class="col-md-4 col-sm-6 col-12">
            <div class="info-box bg-<?= status($row['todoStatus'])['color'] ?> ">
              <span class="info-box-icon"><i class="<?= status($row['todoStatus'])['ikon'] ?>"></i></span>

              <div class="info-box-content">
                <span class="info-box-text"> <?= status($row['todoStatus'])['title'] ?> </span>
                <span class="info-box-number"> <?= $row['toplam'] ?> </span>

                <div class="progress">
                  <div class="progress-bar" style="width:<?= number_format($row['yuzde'],2) ?>%"></div>
                </div>
                <span class="progress-description">
                <?= number_format($row['yuzde'],2) ?> % 
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <?php } ?>
          <!-- /.col -->
        </div>
        <div class="row">
          <div class="col-md-12">
            <!-- The time line -->
            <div class="timeline">
              <!-- timeline time label -->
              <?php foreach($data['surec'] as $todo){ ?>
              <div class="time-label">
                <span class="bg-red"><?= date('d-m-Y',strtotime($todo['todoStartDate']))  ?></span>
              </div>
              <!-- /.timeline-label -->
              <!-- timeline item -->
              <div>
                <i class="fas fa-check" style="background-color:<?= $todo['todoColor'] ?>"></i>

                <div class="timeline-item">
                  <span class="time"><i class="fas fa-clock"></i> <?= date('H:i',strtotime($todo['todoStartDate']))  ?></span>
                  <h3 class="timeline-header"> <span class="badge bg-success"> <?= $todo['categoriesTitle']  ?></span>  <?= $todo['todoTitle'] ?></h3>

                  <div class="timeline-body"> 
                    <?= $todo['todoDescription'] ?> <br>
                    %<?= $todo['todoProgress'] ; ?>
                        <div class="progress progress-xs">
                          <div class="progress-bar progress-bar-danger" style="width:<?= $todo['todoProgress'] ; ?>%"></div>
                        </div>
                  </div>
                  <div class="timeline-footer">
                    <a href="<?= url('todo/edit/'.$todo['todoID']) ?>" class="btn btn-primary btn-sm">Git</a>
                  </div>
                </div>









              </div>
              <!-- END timeline item -->
              <?php } ?>
              <div>
                <i class="fas fa-clock bg-gray"></i>
              </div>
            </div>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
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
<!-- AdminLTE App -->
<script src="<?= assets('js/adminlte.min.js') ; ?>"></script>
</body>
</html>
