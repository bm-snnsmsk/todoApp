
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

         <?php // test_arr($data) ; ?>
          
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title align-bottom">Kategoriler</h3>

                <div class="card-tools">
                 <a class="btn btn-dark btn-sm" href="<?= url('categories/add') ; ?>">Ekle</a>
                
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
            
                <table class="table">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Başlık</th>
                      <th>Oluşturma Tarihi</th>
                      <th>Güncelleme Tarihi</th>
                      <th style="width: 40px">İşlem</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
// hata mesajı GET ile gönderildiği için
echo get('message') ? '<div class="alert alert-'.get('type').'">'.get('message').'</div>' : null ;
?>
                    <?php $count = 1 ; foreach($data as $key => $value){ ?>
                    <tr>
                      <td> <?=  $count++ ; ?> </td>
                      <td> <?= $value['categoriesTitle'] ;  ?></td>
                      <td> <?= $value['categoriesCreatedDate'] ; ?></td>
                      <td> <?= $value['categoriesUpdatedDate'] ; ?></td>
                      <td> 
                        <div class="btn-group btn-group-sm">
                          <a class="btn btn-danger btn-sm" href="<?= url('categories/remove/'.$value['categoriesID']) ; ?>">Sil</a>
                          <a class="btn btn-warning btn-sm ml-1" href="<?= url('categories/edit/'.$value['categoriesID']) ; ?>">Güncelle</a>
                        </div>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
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
</div>
<!-- jQuery -->
<script src="<?= assets('plugins/jquery/jquery.min.js') ; ?> "></script>
<!-- Bootstrap 4 -->
<script src="<?= assets('plugins/bootstrap/js/bootstrap.bundle.min.js') ; ?> "></script>
<!-- AdminLTE App -->
<script src="<?= assets('js/adminlte.min.js') ; ?>"></script>
</body>
</html>
