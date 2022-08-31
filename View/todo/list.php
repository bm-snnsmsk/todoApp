
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
                      <th>Kategori</th>
                      <th>Başlangıç Tarihi</th>
                      <th>Bitiş Tarihi</th>
                      <th>İlerleme</th>
                      <th>Durum</th>
                      <th style="width: 40px">İşlem</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  // test($data);
// hata mesajı GET ile gönderildiği için
echo get('message') ? '<div class="alert alert-'.get('type').'">'.get('message').'</div>' : null ;
?>
                    <?php $count = 1 ; foreach($data as $key => $value){ ?>
                    <tr id="rowID-<?= $value['todoID']?>">
                      <td> <?=  $count++ ; ?> </td>
                      <td> <?= $value['categoriesTitle'] ;  ?></td>
                      <td> <?= $value['todoTitle'] ; ?></td>
                      <td> <?= $value['todoStartDate'] ;  ?></td>
                      <td> <?= $value['todoEndDate'] ; ?></td>
                      <td> 
                      %<?= $value['todoProgress'] ; ?>
                        <div class="progress progress-xs">
                          <div class="progress-bar progress-bar-danger" style="width:<?= $value['todoProgress'] ; ?>%"></div>
                        </div>
                      </td> 
                      <td> <span class="badge bg-<?= $value['todoStatus'] == 'a' ? "warning" : "success"; ?>"><?= $value['todoStatus'] == 'a' ? "Devam eden" : "Biten"; ?></span>
                      </td>
                      <td>
                        <div class="btn-group btn-group-sm">
                          <button type="button" class="btn btn-danger btn-sm" onclick="removeTodo('<?= $value['todoID'] ?>')">Sil</button>
                          <a href="<?= url('todo/edit/'.$value['todoID'])?>" class="btn btn-warning btn-sm ml-1" >Güncelle</a>
                        </div>
                    </td> 
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
<script src="<?= assets('plugins/bootstrap/js/bootstrap.bundle.min.js') ; ?> "></script><script src="<?= assets('plugins/sweetalert2/sweetalert2.all.js') ; ?> "></script>
<!-- AdminLTE App -->
<script src="<?= assets('js/adminlte.min.js') ; ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.27.2/axios.min.js" integrity="sha512-odNmoc1XJy5x1TMVMdC7EMs3IVdItLPlCeL5vSUPN2llYKMJ2eByTTAIiiuqLg+GdNr9hF6z81p27DArRFKT7A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
  let a = document.getElementById('title') ;
  a.focus();

  function removeTodo(id){
    let formData = new FormData();
    formData.append('id',id) ;

    axios.post('<?= url('api/removetodo') ?>', formData).then(res => {      
      if(res.data.id){
        let removeRow = document.querySelector('#rowID-'+res.data.id) ;
        removeRow.remove() ;
      }
          Swal.fire(
          res.data.title,
          res.data.msg,
          res.data.status
        );
         
console.log(res) ;
}).catch(err => console.log(err)) ;
  }

 
</script>
</body>
</html>


