
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
  <div class="content-wrapper p-5">  
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
          
            <div class="card">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Kategori Ekle</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="#" method="post">
                <div class="card-body">
                <?php

echo get_session('error') ? '<div class="alert alert-'.$_SESSION['error']['type'].'">'.$_SESSION['error']['message'].'</div>' : null ;
?>
                  <div class="form-group">
                    <label for="title">Kategori Başlığı</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="Kategori adı giriniz..." >
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="submit" value="1" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            </div>

          
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php view('static/footer') ;?>
<!-- ./wrapper -->





<script>
  let a = document.getElementById('title') ;
  a.focus();
</script>
<!-- jQuery -->
<script src="<?= assets('plugins/jquery/jquery.min.js') ; ?> "></script>
<!-- Bootstrap 4 -->
<script src="<?= assets('plugins/bootstrap/js/bootstrap.bundle.min.js') ; ?> "></script>
<!-- AdminLTE App -->
<script src="<?= assets('js/adminlte.min.js') ; ?>"></script>
</body>
</html>
