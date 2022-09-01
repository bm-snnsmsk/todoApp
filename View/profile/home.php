
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
                <h3 class="card-title">Profile Bilgileriniz</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form id="profile" action="#" method="post"> <!-- action="#"  => form aynı sayfada dönmüş olacak yani route değeri categories/add olacak yine -->
                <div class="card-body">
                <?php
                  // test($_SESSION);
                   echo get_session('error') ? '<div class="alert alert-'.$_SESSION['error']['type'].'">'.$_SESSION['error']['message'].'</div>' : null ;
                ?>

                  <div class="form-group">
                    <label for="isim">İsim</label>
                    <input type="text" class="form-control" name="isim" id="isim"  value="<?= ucwords(get_session('usersName')) ?>">
                  </div>
                  <div class="form-group">
                    <label for="soyisim">Soyisim</label>
                    <input type="text" class="form-control" name="soyisim" id="soyisim"  value="<?= mb_strtoupper(get_session('usersSurname')) ?>" >
                  </div>
                  <div class="form-group">
                    <label for="email">Email Adresiniz</label>
                    <input type="email" class="form-control" name="email" id="email" value="<?= get_session('usersEmail') ?>">
                  </div>
        
                 
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="submit" value="1" class="btn btn-primary"><?= lang('Güncelle'); ?></button>
                </div>
              </form>
            </div>
            </div>
            
          </div>
          <div class="col-lg-12">
          
          <div class="card">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Prola Güncelleme</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form id="password_change" action="#" method="post"> <!-- action="#"  => form aynı sayfada dönmüş olacak yani route değeri categories/add olacak yine -->
              <div class="card-body">
              <?php
               // test($_SESSION);
                 echo get_session('error') ? '<div class="alert alert-'.$_SESSION['error']['type'].'">'.$_SESSION['error']['message'].'</div>' : null ;
              ?>

                <div class="alert alert-primary d-none" id="myalert" role="alert">
                  
                </div>

                <div class="form-group">
                  <label for="old_pw">Mevcut parolanız</label>
                  <input type="password" class="form-control" name="old_pw" id="old_pw">
                </div>
                <div class="form-group">
                  <label for="pass">Yeni bir parola giriniz</label>
                  <input type="password" class="form-control" name="pass" id="pass" >
                </div>
                <div class="form-group">
                  <label for="pass2">Yeni parolanızı tekrar giriniz</label>
                  <input type="password" class="form-control" name="pass2" id="pass2" >
                </div>
      
               
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" name="submit" value="1" class="btn btn-primary"><?= lang('Güncelle'); ?></button>
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
  let a = document.getElementById('isim') ;
  a.focus();

  // JS ile veri gönderme
  let profile = document.querySelector('#profile');
  let password_change = document.querySelector('#password_change');
  let myalert = document.querySelector('#myalert');


  profile.addEventListener('submit',(e) => {
    // console.log("submit test edildi");
    let isim = document.querySelector('#isim').value;
    let soyisim = document.querySelector('#soyisim').value;
    let email = document.querySelector('#email').value;
    

    let formData = new FormData();
    formData.append('isim',isim) ;
    formData.append('soyisim',soyisim) ;
    formData.append('email',email) ;

    axios.post('<?= url('api/profile') ?>', formData).then(res => { 
    
          Swal.fire(
          res.data.title,
          res.data.msg,
          res.data.status
        );
         
console.log(res) ;
}).catch(err => console.log(err)) ;

    e.preventDefault() ; // php üzerinden gönderim durduruldu (sayfa yenilenmesine gerek kalmadan) javascriptle göndermek için
  }) ;


  password_change.addEventListener('submit',(e) => {
    // console.log("submit test edildi");
    let old_pw = document.querySelector('#old_pw').value;
    let pass = document.querySelector('#pass').value;
    let pass2 = document.querySelector('#pass2').value;
    

    let formData = new FormData();
    formData.append('old_pw',old_pw) ;
    formData.append('pass',pass) ;
    formData.append('pass2',pass2) ;

    axios.post('<?= url('api/change_password') ?>', formData).then(res => { 
    
       if(res.data.redirect){
        document.querySelector('#old_pw').value = "" ;
        document.querySelector('#pass').value = "" ;
        document.querySelector('#pass2').value = "" ;
        alert("Şifreniz başarılı bir şekilde güncellendi !") ;
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

