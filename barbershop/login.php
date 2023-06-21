<?php 

require 'dashboard/functions.php';

session_start();
if(isset($_SESSION['username']) ){
    echo "<script type='text/javascript'>
            alert('Anda sudah login!');
            window.location.replace('index.php');
          </script>";
    exit;
}

if( isset($_POST["register"]) ) {
	if( registrasi($_POST) > 0 ) {
		echo "
			<script>
				alert('Anda berhasil membuat akun!');
			</script>
		";
	} else {
		echo mysqli_error($conn);
	}
}


if( isset($_POST["login"]) ) {
  if ($_POST["captcha_code"] == $_SESSION["captcha_code"]) {
  	$username = $_POST["username"];
  	$password = $_POST["password"];

  	$result = mysqli_query($conn, "SELECT * FROM user WHERE username='$username'");
  	
  	// cek username
  	if( mysqli_num_rows($result) === 1 ) {
  		
  		// cek Password
  		$row = mysqli_fetch_assoc($result);
  		if( password_verify($password, $row["password"]) ) {
  			// set session agar user login dulu baru bisa akses ke halaman lain
  			$_SESSION["username"] = $row['username'];
  			$_SESSION["level"] = $row['level'];
  			
  			if($_SESSION["level"] == "ADMIN") {
  				header("Location: dashboard/transaksi.php");
  			} else {
  				header("Location: index.php");
  			}
  			
  			exit;
  		} else {
        echo "<script>
            alert('Username / Password tidak tepat !!');
          </script>
        ";
      }
    } 
	}  else {
          echo "
            <script>
              alert('Captcha salah');
            </script>
          ";
    }
}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="log.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body>
    <div class="container">
      <form action="" method="post">
        <div class="title">Login</div>
        <div class="input-box underline">
          <input type="text" name="username" id="username" placeholder="Masukkan Username" required>
          <div class="underline"></div>
        </div>
        <div class="input-box">
          <input type="password" name="password" id="password" placeholder="Masukkan Password" required>
          <div class="underline"></div>
        </div><br>
        <img src='captcha.php' />
        <div class="input-box">
          <input name='captcha_code' type='text' placeholder="Tuliskan Captcha Code">
          <div class="underline"></div>
        </div>
        <div class="input-box button">
          <input type="submit" name="login" value="Login">
        </div>
      </form>
        <a href="#regmodal" data-toggle="modal"><small>Belum punya akun?</small></a>
    </div>

<!-- Modal Sign Up -->
<div id="regmodal" class="modal fade">
  <div class="modal-dialog modal-login modal-dialog-centered modal-sm">
    <div class="modal-content">
      <form action="" method="post">
        <div class="modal-header">        
          <h4 class="modal-title">Sign Up</h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">  
          <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
          </div>      
          <div class="form-group">
            <label>Username</label>
            <input type="text" class="form-control" id="username" name="username" required>
          </div>
          <div class="form-group">
            <div class="clearfix">
              <label>Password</label>
            </div>
            <input type="password" class="form-control" name="password" id="password" required>
          </div>
          <div class="form-group">
            <div class="clearfix">
              <label>Konfirmasi Password</label>
            </div>
            <input type="password" class="form-control" name="password2" id="password2" required>
          </div>
        </div>
        <div class="modal-footer justify-content-center">
          <input type="submit" class="btn btn-primary" name="register" value="Sign Up">
        </div>
      </form>
    </div>
  </div>
</div>    
<!-- Modal Sign Up -->

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="js/my-login.js"></script>
  </body>
</html>