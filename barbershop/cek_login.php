<?php 
session_start();
if(!isset($_SESSION['username']) ){
    echo "<script type='text/javascript'>
            alert('Anda belum login');
            window.location.replace('login.php');
          </script>";

    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>asd</title>
</head>
<body>
<p>Cuma cek kalau login level user berhasil ;V</p>
<a href="logout.php" class="logout">Logout</a> <br>
<a href="index.php" class="logout">balik ke index</a>

</body>
</html>