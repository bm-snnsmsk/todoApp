
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
                <h3 class="card-title">Yapılacaklar Listesi Ekleyin</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="todo" action="#" method="post"> <!-- action="#"  => form aynı sayfada dönmüş olacak yani route değeri categories/add olacak yine -->
                <div class="card-body">
                <?php
                 // test($data);
                   echo get_session('error') ? '<div class="alert alert-'.$_SESSION['error']['type'].'">'.$_SESSION['error']['message'].'</div>' : null ;
                ?>
                  <div class="form-group">
                      <label for="title">Kategori Seçiniz</label>
                      <select class="form-control" name="title" id="category_id" >
                          <option value="0">Kategori seçimi yapınız</option>
                          <?php foreach($data as $key => $value){ ?>
                          <option value="<?= $value['categoriesID'] ?>"><?= $value['categoriesTitle'] ?></option>
                           <?php } ?>
                      </select>
                  </div>
                  <div class="form-group">
                    <label for="title">Başlık</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="Todo başlığı giriniz..." >
                  </div>
                  <div class="form-group">
                    <label for="description">Açıklama</label>
                    <input type="text" class="form-control" name="description" id="description" placeholder="Todo açıklaması giriniz..." >
                  </div>
                  <div class="form-group">
                    <label for="status">Durum</label>
                    <select class="form-control" id="status" >
                          <option value="p">Pasif</option>
                          <option value="a">Aktif</option>
                          <option value="s">Süreçte</option>
                      </select>
                  </div>
                  <div class="form-group">
                    <label for="range">İlerleme</label>
                    <input type="range" class="form-control" name="range" id="range" min="0" max="100">
                  </div>
                  <div class="form-group">
                    <label for="color">Renk seçiniz</label>
                    <input type="color" class="form-control" name="color" id="color" value="#007bff" >
                  </div>
                  <div class="form-group">
                    <label for="start_date">Başlangıç tarihi</label>
                   <div class="row">
                   <input type="date" class="form-control col-8" name="start_date" id="start_date" value="<?= date('Y-m-d') ?>">
                   <input type="time" class="form-control col-4" name="start_time" id="start_time" value="<?= date('H:i') ?>">
                   </div>
                  </div>
                  <div class="form-group">
                    <label for="finish_date">Bitiş tarihi</label>
                    <div class="row">
                    <input type="date" class="form-control col-8" name="finish_date" id="finish_date" value="<?= date('Y-m-d') ?>">
                   <input type="time" class="form-control col-4" name="finish_time" id="finish_time" value="<?= date('H:i') ?>">
                   </div>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="submit" value="1" class="btn btn-primary"><?= lang('Ekle'); ?></button>
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





<!-- jQuery -->
<script src="<?= assets('plugins/jquery/jquery.min.js') ; ?> "></script>
<!-- Bootstrap 4 -->
<script src="<?= assets('plugins/bootstrap/js/bootstrap.bundle.min.js') ; ?> "></script>
<script src="<?= assets('plugins/sweetalert2/sweetalert2.all.js') ; ?> "></script>
<!-- AdminLTE App -->
<script src="<?= assets('js/adminlte.min.js') ; ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.27.2/axios.min.js" integrity="sha512-odNmoc1XJy5x1TMVMdC7EMs3IVdItLPlCeL5vSUPN2llYKMJ2eByTTAIiiuqLg+GdNr9hF6z81p27DArRFKT7A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
  let a = document.getElementById('title') ;
  a.focus();

  // JS ile veri gönderme
  let todo = document.querySelector('#todo');
  todo.addEventListener('submit',(e) => {
    // console.log("submit test edildi");
    let title = document.querySelector('#title').value;
    let description = document.querySelector('#description').value;
    let category_id = document.querySelector('#category_id').value;
    let color = document.querySelector('#color').value;
    let start_date = document.querySelector('#start_date').value;
    let finish_date = document.querySelector('#finish_date').value;
    let start_time = document.querySelector('#start_time').value;
    let finish_time = document.querySelector('#finish_time').value;
    let status = document.querySelector('#status').value;
    let range = document.querySelector('#range').value;
    

    let formData = new FormData();
    formData.append('title',title) ;
    formData.append('description',description) ;
    formData.append('category_id',category_id) ;
    formData.append('color',color) ;
    formData.append('start_date',start_date) ;
    formData.append('finish_date',finish_date) ;
    formData.append('start_time',start_time) ;
    formData.append('finish_time',finish_time) ;
    formData.append('status',status) ;
    formData.append('range',range) ;

    axios.post('<?= url('api/addtodo') ?>', formData).then(res => { 
      if(res.data.redirect){
        window.location.href = res.data.redirect ;
      }else{
          Swal.fire(
          res.data.title,
          res.data.msg,
          res.data.status
        );
      }     
console.log(res) ;
}).catch(err => console.log(err)) ;

 

    e.preventDefault() ; // php üzerinden gönderim durduruldu (sayfa yenilenmesine gerek kalmadan) javascriptle göndermek için
  }) ;
</script>
</body>
</html>

