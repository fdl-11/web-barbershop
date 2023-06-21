<?php

// CONNECT DB
$conn = mysqli_connect("localhost", "root", "", "barbershop");

// REGISTRASI
function registrasi($data){
	global $conn;

	$email = $data["email"];
	$username = strtolower(stripslashes($data['username']));
	$password = mysqli_real_escape_string($conn, $data["password"]);
	$password2 = mysqli_real_escape_string($conn, $data["password2"]);
	$level = "USER";

	// cek username udah ada belum
	$result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
	$result2 = mysqli_query($conn, "SELECT email FROM user WHERE email = '$email'");

	if( mysqli_fetch_assoc($result) ) {
		echo "<script>
				alert('Username sudah terdaftar !');
			  </script>
		";		

		return false;
	}

	if( mysqli_fetch_assoc($result2) ) {
		echo "<script>
				alert('Email sudah terdaftar !');
			  </script>
		";		

		return false;
	}

	// cek konfirmasi password
	if( $password !== $password2 ) {
		echo "<script>
				alert('konfirmasi password tidak sesuai');
			  </script>
		";

		return false;
	}

	// enkripsi password
	$password = password_hash($password, PASSWORD_DEFAULT);

	// tambahkan userbaru ke database
	mysqli_query($conn, "INSERT INTO user VALUES('', '$email', '$username', '$password', '$level')");

	return mysqli_affected_rows($conn);
}

// INSERT POTONGAN RAMBUT
if (isset($_POST['insertpotongan'])) {
    $id_potongan = $_POST['id_potongan'];
    $nama_potongan = $_POST['nama_potongan'];
    
    $gambar = upload();
    if( !$gambar ) {
        return false;
    }

    $tambahpotongan = mysqli_query($conn, "insert into potongan_rambut (id_potongan, nama_potongan, gbr_potongan) values ('$id_potongan', '$nama_potongan', '$gambar')");

    if ($tambahpotongan) {
        header('location:potongan_rambut.php');
    } else {
        header('location:../index.php');
    }
}

function upload() {

	$namaFile = $_FILES['gambar']['name'];
	$ukuranFile = $_FILES['gambar']['size'];
	$error = $_FILES['gambar']['error'];
	$tmpName = $_FILES['gambar']['tmp_name'];

	// cek ada gambar yang diupload tidak
	if( $error === 4 ) {
		echo "
			<script>
				alert('pilih gambar dulu !');
			</script>
		";

		return false;
	}

	// cek apakah yang diupload adalah gambar
	$ekstensiGambarValid = ['jpg', 'jpeg', 'png', 'gif'];
	$ekstensiGambar = explode('.', $namaFile);				
	$ekstensiGambar = strtolower(end($ekstensiGambar));			
																
	// cek apakah ekstensi sesuai atau tidak
	if( !in_array($ekstensiGambar, $ekstensiGambarValid) ) {	
		echo "
			<script>
				alert('yang anda upload bukan gambar !');
			</script>
		";

		return false;
	}

	// cek ukuran gambar
	if( $ukuranFile > 3000000 ) {	// max 3 MB
		echo "
			<script>
				alert('ukuran terlalu besar !');
			</script>
		";

		return false;
	}
 
	// generate nama gambar baru agar tidak sama
	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiGambar;

	move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

	return $namaFileBaru;

}

//UPDATE POTONGAN RAMBUT
if (isset($_POST['updatepotongan'])) {
    $id_potongan = $_POST['id_potongan'];
    $nama_potongan = $_POST['nama_potongan'];
	$gambarLama = $_POST['gambarLama'];

	// cek apa user pilih gambar baru tidak
	if( $_FILES['gambar']['error'] === 4 ) {		// user tidak upload gambar baru
		$gambar = $gambarLama;
	} else {
		$gambar = upload();

		if( !$gambar ) {
			return false;
		}
	}

	$ubahpotongan = mysqli_query($conn, "update potongan_rambut set nama_potongan='$nama_potongan', gbr_potongan='$gambar' where potongan_rambut.id_potongan='$id_potongan' ");
	if ($ubahpotongan) {
		header('location:potongan_rambut.php');
	} else {
		header('location:../index.php');
	}
}

//DELETE POTONGAN RAMBUT
if (isset($_POST['deletepotongan'])) {
	$id_potongan = $_POST['id_potongan'];
    
	$hapuspotongan = mysqli_query($conn, "delete from potongan_rambut where id_potongan='$id_potongan'");
	if ($hapuspotongan) {
		header('location:potongan_rambut.php');
	} else {
		header('location:../index.php');
	}
}

// INSERT LAYANAN TAMBAHAN
if (isset($_POST['insertlayanan'])) {
    $id_layanan= $_POST['id_layanan'];
    $nama_layanan = $_POST['nama_layanan'];
    $harga_layanan = $_POST['harga_layanan'];
    
    $tambahlayanan = mysqli_query($conn, "insert into layanan_tambahan (id_layanan, nama_layanan, harga_layanan) values ('$id_layanan', '$nama_layanan', '$harga_layanan')");

    if ($tambahlayanan) {
        header('location:layanan_tambahan.php');
    } else {
        header('location:../index.php');
    }
}

//UPDATE LAYANAN TAMBAHAN
if (isset($_POST['updatelayanan'])) {
    $id_layanan = $_POST['id_layanan'];
    $nama_layanan= $_POST['nama_layanan'];
    $harga_layanan = $_POST['harga_layanan'];

	$ubahlayanan = mysqli_query($conn, "update layanan_tambahan set nama_layanan='$nama_layanan', harga_layanan='$harga_layanan' where layanan_tambahan.id_layanan='$id_layanan' ");
	if ($ubahlayanan) {
		header('location:layanan_tambahan.php');
	} else {
		header('location:../index.php');
	}
}

//DELETE LAYANAN TAMBAHAN
if (isset($_POST['deletelayanan'])) {
	$id_layanan = $_POST['id_layanan'];
    
	$hapuslayanan = mysqli_query($conn, "delete from layanan_tambahan where id_layanan='$id_layanan'");
	if ($hapuslayanan) {
		header('location:layanan_tambahan.php');
	} else {
		header('location:../index.php');
	}
}

// // INSERT TRANSAKSI
// if(isset($_POST['insertsewa'])){
//     $nama = $_POST['nama'];
//     $no_hp = $_POST['no_hp'];
//     $kategori = $_POST['kategori'];
//     $tanggal = $_POST['tanggal'];
//     $waktu_pelayanan = $_POST['waktu_pelayanan'];
//     $id_potongan = $_POST['id_potongan'];
// 	$id_layanan = $_POST['id_layanan'];


// 	// $tambahtransaksi = mysqli_query($conn, "INSERT INTO `pesan` (`id_transaksi`, `nama`, `no_hp`, `kategori`, `tanggal`, `waktu_pelayanan`, `id_potongan`, `id_layanan`, `total_harga`) VALUES (NULL, 'Adi', '08522526819', 'DEWASA', '1 januari 2003', '13.00-14.00', 'ptg02', 'zz1', '40000')");
// 	$tambahtransaksi = mysqli_query($conn, "insert into pesan (nama, no_hp, kategori, tanggal, waktu_pelayanan, id_potongan, id_layanan, total_harga) values ('$nama', '$no_hp', '$kategori', '$tanggal', '$waktu_pelayanan', '$id_potongan', '$id_layanan', '$hargaAwal'");

// }

if(isset($_POST['insertsewa'])){
    $nama = $_POST['nama'];
    $no_hp = $_POST['no_hp'];
    $kategori = $_POST['kategori'];
    $tanggal = $_POST['tanggal'];
    $waktu_pelayanan = $_POST['waktu_pelayanan'];
    $id_potongan = $_POST['id_potongan'];
	$id_layanan = $_POST['id_layanan'];
	// $hargas = $_POST['harga'];

	// var_dump($nama.$no_hp.$kategori.$tanggal.$waktu_pelayanan.$id_potongan.$id_layanan.$hargas);

	if($kategori == "DEWASA"){
		$hargaAwal = 25000;
	} else if($kategori == "ANAK"){
		$hargaAwal = 15000;
	}

	$layanann = mysqli_query($conn, "select * from layanan_tambahan");
	while ($fetcharray = mysqli_fetch_array($layanann)) {
		$id_layanan2 = $fetcharray['id_layanan'];
		$harga_layanan = $fetcharray['harga_layanan'];

		if($id_layanan == $id_layanan2){
			$hargaExtra = $harga_layanan;
		}
	}

    $harga = $hargaAwal + $hargaExtra;

    $tambahtransaksi = mysqli_query($conn, "insert into pesan (id_transaksi, nama, no_hp, kategori, tanggal, waktu_pelayanan, id_potongan, id_layanan, total_harga) values ('', '$nama', '$no_hp', '$kategori', '$tanggal', '$waktu_pelayanan', '$id_potongan', '$id_layanan', '$harga')");
	if ($tambahtransaksi) {
		header('location:transaksi.php');
	} else {
		header('location:../index.php');
	}

}

if(isset($_POST['updatesewa'])){
	$id_transaksi = $_POST['id_transaksi'];
    $nama = $_POST['nama'];
    $no_hp = $_POST['no_hp'];
    $kategori = $_POST['kategori'];
    $tanggal = $_POST['tanggal'];
    $waktu_pelayanan = $_POST['waktu_pelayanan'];
    $id_potongan = $_POST['id_potongan'];
	$id_layanan = $_POST['id_layanan'];
	// $hargas = $_POST['harga'];

	// var_dump($nama.$no_hp.$kategori.$tanggal.$waktu_pelayanan.$id_potongan.$id_layanan.$hargas);

    $ubahtransaksi = mysqli_query($conn, "update pesan set nama='$nama', no_hp='$no_hp', kategori='$kategori', tanggal='$tanggal', waktu_pelayanan='$waktu_pelayanan', id_potongan='$id_potongan', id_layanan='$id_layanan' where pesan.id_transaksi='$id_transaksi'");
	if ($ubahtransaksi) {
		header('location:transaksi.php');
	} else {
		header('location:../index.php');
	}
}

if(isset($_POST['deletesewa'])){
	$id_transaksi = $_POST['id_transaksi'];

	// $hargas = $_POST['harga'];

	// var_dump($nama.$no_hp.$kategori.$tanggal.$waktu_pelayanan.$id_potongan.$id_layanan.$hargas);

    $hapustransaksi = mysqli_query($conn, "delete from pesan where id_transaksi='$id_transaksi'");
	if ($hapustransaksi) {
		header('location:transaksi.php');
	} else {
		header('location:../index.php');
	}
}

if(isset($_POST['insertsewa2'])){
    $nama = $_POST['nama'];
    $no_hp = $_POST['no_hp'];
    $kategori = $_POST['kategori'];
    $tanggal = $_POST['tanggal'];
    $waktu_pelayanan = $_POST['waktu_pelayanan'];
    $id_potongan = $_POST['id_potongan'];
	$id_layanan = $_POST['id_layanan'];
	// $hargas = $_POST['harga'];

	// var_dump($nama.$no_hp.$kategori.$tanggal.$waktu_pelayanan.$id_potongan.$id_layanan.$hargas);

	if($kategori == "DEWASA"){
		$hargaAwal = 25000;
	} else if($kategori == "ANAK"){
		$hargaAwal = 15000;
	}

	$layanann = mysqli_query($conn, "select * from layanan_tambahan");
	while ($fetcharray = mysqli_fetch_array($layanann)) {
		$id_layanan2 = $fetcharray['id_layanan'];
		$harga_layanan = $fetcharray['harga_layanan'];

		if($id_layanan == $id_layanan2){
			$hargaExtra = $harga_layanan;
		}
	}

    $harga = $hargaAwal + $hargaExtra;

    $tambahtransaksi = mysqli_query($conn, "insert into pesan (id_transaksi, nama, no_hp, kategori, tanggal, waktu_pelayanan, id_potongan, id_layanan, total_harga) values ('', '$nama', '$no_hp', '$kategori', '$tanggal', '$waktu_pelayanan', '$id_potongan', '$id_layanan', '$harga')");
	if ($tambahtransaksi) {
		header('location:dashboard/cetak.php');
	} else {
		header('location:404.php');
	}

}
?>