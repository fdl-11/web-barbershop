<?php

require 'functions.php';
session_start();
if(!isset($_SESSION['username']) ){
    echo "<script type='text/javascript'>
            alert('Anda belum login');
            window.location.replace('../login.php');
          </script>";

    exit;
}

if($_SESSION['level'] == 'USER') {
    echo "<script type='text/javascript'>
            alert('Anda bukan Admin');
            window.location.replace('../404.php');
          </script>";

    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Data Transaksi</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
 
    <script src="https://use.fontawesome.com/afbcd49e3d.js"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand" href="">Barbershop</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
        <a class="btn btn-danger btn-sm" href="../logout.php" style="margin-left: 1000px">LOGOUT</a>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                            <div>
                                <h3 class="sb-sidenav-menu-heading" style="margin-left: 34px;">DB Barbershop</h3>
                                <img src="assets/img/settings.png" alt="" style="margin-left: 70px;">
                            </div>

                            <div class="sb-sidenav-menu-heading">Menu</div>
                        <a class="nav-link" href="potongan_rambut.php">
                            <div class="sb-nav-link-icon"><i class="fa fa-scissors"></i></div>
                            Jenis Potongan
                        </a>
                        <a class="nav-link" href="layanan_tambahan.php">
                            <div class="sb-nav-link-icon"><i class="fa fa-plus-square"></i></div>
                            Layanan Extra
                        </a>
                        <a class="nav-link" href="transaksi.php">
                            <div class="sb-nav-link-icon"><i class="fa fa-credit-card"></i></div>
                            Transaksi
                        </a>
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <h1 class="mt-4">Data Transaksi</h1>
                    <div class="card mb-4">
                        <div class="card-header">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#transaksimodal">
                                Tambah Sewa
                            </button>
                            <a class="btn btn-success" href="cetak_transaksi.php">Cetak</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID Transakai</th>
                                            <th>Nama</th>
                                            <th>Nomor HP</th>
                                            <th>Kategori</th>
                                            <th>Tanggal</th>
                                            <th>Waktu</th>
                                            <th>Jenis Potongan</th>
                                            <th>Layanan</th>
                                            <th>Total Harga</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // $tampiltransaksi = mysqli_query($conn, "select * from sewa left join mobil on sewa.id_mobil=mobil.id_mobil left join peminjam on sewa.nik=peminjam.nik left join pegawai on sewa.id_pegawai=pegawai.id_pegawai");
                                        $tampiltransaksi = mysqli_query($conn, "select * from pesan left join layanan_tambahan on pesan.id_layanan=layanan_tambahan.id_layanan left join potongan_rambut on pesan.id_potongan=potongan_rambut.id_potongan");
                                        // $tampiltransaksi = mysqli_query($conn, "select * from pesan, layanan_tambahan, potongan_rambut where layanan_tambahan.id_layanan = pesan.id_layanan and potongan_rambut.id_potongan = pesan.id_potongan");
                                        while ($data = mysqli_fetch_array($tampiltransaksi)) {
                                            $id_transaksi = $data['id_transaksi'];
                                            $nama = $data['nama'];
                                            $no_hp = $data['no_hp'];
                                            $kategori = $data['kategori'];
                                            $tanggal = $data['tanggal'];
                                            $waktu_pelayanan = $data['waktu_pelayanan']; 
                                            $nama_potongan = $data['nama_potongan'];
                                            $nama_layanan = $data['nama_layanan'];
                                            $total_harga = $data['total_harga'];
                                            $id_potongan = $data['id_potongan'];
                                            $id_layanan = $data['id_layanan'];

                                        ?>
                                            <tr>
                                                <td><?= $id_transaksi; ?></td>
                                                <td><?= $nama; ?></td>
                                                <td><?= $no_hp; ?></td>
                                                <td><?= $kategori; ?></td>
                                                <td><?= $tanggal; ?></td>
                                                <td><?= $waktu_pelayanan; ?></td>
                                                <td><?= $nama_potongan; ?></td>
                                                <td><?= $nama_layanan; ?></td>
                                                <td><?= $total_harga; ?></td>
                                                <td>
                                                <button style="margin: 2px;" type="button" class="btn btn-warning" data-toggle="modal" data-target="#updatesewa<?= $id_transaksi; ?>">Edit</button>
                                                    <button style="margin: 2px;" type="button" class="btn btn-danger" data-toggle="modal" data-target="#deletesewa<?= $id_transaksi; ?>">Hapus</button>
                                                </td>
                                            </tr>

                                            <!-- MODAL UPDATE -->
                                            <div class="modal fade" id="updatesewa<?= $id_transaksi; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Update Data Transaksi</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form method="POST">
                                                            <div class="modal-body">
                                                            <input type="text" name="nama" placeholder="nama" class="form-control" value="<?= $nama; ?>" required>
                    <br/>
                    <input type="text" name="no_hp" placeholder="nomor hp" class="form-control" value="<?= $no_hp; ?>" required>
                    <br/>
                    <select name="kategori" id="kategori" class="form-control">
                        <option value="DEWASA">DEWASA</option>
                        <option value="ANAK">ANAK</option>
                    </select>
                    <br/>
                    <input type="text" name="tanggal" placeholder="tanggal" class="form-control" value="<?= $tanggal; ?>" required>
                    <br>
                    <select name="waktu_pelayanan" class="form-control" >
                        <option selected value="<?= $waktu_pelayanan; ?>"><?= $waktu_pelayanan; ?></option>
                        <option value="13.00-14.00">13.00-14.00</option>
                        <option value="14.00-15.00">14.00-15.00</option>
                        <option value="15.00-16.00">15.00-16.00</option>
                        <option value="16.00-17.00">16.00-17.00</option>
                        <option value="17.00-18.00">17.00-18.00</option>
                        <option value="18.00-19.00">18.00-19.00</option>
                        <option value="19.00-20.00">19.00-20.00</option>
                    </select>
                    <br>
                    <select name="id_potongan" class="form-control">
                        <option selected value="<?= $id_potongan; ?>"><?= $nama_potongan; ?></option>
                        <?php
                        $tampilpotongan = mysqli_query($conn, "select * from potongan_rambut");
                        while ($fetcharray = mysqli_fetch_array($tampilpotongan)) {
                            $id_potongan = $fetcharray['id_potongan'];
                            $nama_potongan = $fetcharray['nama_potongan'];
                        ?>
                            <option value="<?= $id_potongan; ?>"><?= $nama_potongan; ?></option>

                        <?php
                        }
                        ?>
                    </select>
                    <br />
                    <select name="id_layanan" class="form-control">
                        <option selected value="<?= $id_layanan; ?>"><?= $nama_layanan; ?></option>
                        <?php
                        $tampillayanan = mysqli_query($conn, "select * from layanan_tambahan");
                        while ($fetcharray = mysqli_fetch_array($tampillayanan)) {
                            $nama_layanan = $fetcharray['nama_layanan'];
                            $id_layanan = $fetcharray['id_layanan'];
                        ?>
                            <option value="<?= $id_layanan; ?>"><?= $nama_layanan; ?></option>

                        <?php
                        }
                        ?>
                    </select>
                                                                
                                                                <input type="hidden" name="id_transaksi" value="<?= $id_transaksi; ?>"><br>
                                                                <button type="submit" name="updatesewa" class="btn btn-success">Update</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- MODAL UPDATE -->

                                            <!-- DELETE -->
                                            <div class="modal fade" id="deletesewa<?= $id_transaksi; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form method="POST">
                                                            <div class="modal-body">
                                                                Apakah anda ingin menghapus data transaksi ini? &nbsp;&nbsp;
                                                                <input type="hidden" name="id_transaksi" value="<?= $id_transaksi; ?>">
                                                                <button type="submit" name="deletesewa" class="btn btn-danger btn-sm">Hapus</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- DELETE -->

                                        <?php
                                        };

                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">

            </footer>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/datatables-demo.js"></script>
</body>

<!-- MODAL TAMBAH -->
<div class="modal fade" id="transaksimodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <input type="text" name="nama" placeholder="nama" class="form-control" required>
                    <br/>
                    <input type="text" name="no_hp" placeholder="nomor hp" class="form-control" required>
                    <br/>
                    <select name="kategori" id="kategori" class="form-control">
                        <option value="DEWASA">DEWASA</option>
                        <option value="ANAK">ANAK</option>
                    </select>
                    <br/>
                    <input type="text" name="tanggal" placeholder="tanggal" class="form-control" required>
                    <br>
                    <select name="waktu_pelayanan" class="form-control" >
                        <option value="13.00-14.00">13.00-14.00</option>
                        <option value="14.00-15.00">14.00-15.00</option>
                        <option value="15.00-16.00">15.00-16.00</option>
                        <option value="16.00-17.00">16.00-17.00</option>
                        <option value="17.00-18.00">17.00-18.00</option>
                        <option value="18.00-19.00">18.00-19.00</option>
                        <option value="19.00-20.00">19.00-20.00</option>
                    </select>
                    <br>
                    <select name="id_potongan" class="form-control">
                        <option selected value="<?= $id_potongan; ?>">pilih potongan</option>
                        <?php
                        $tampilpotongan = mysqli_query($conn, "select * from potongan_rambut");
                        while ($fetcharray = mysqli_fetch_array($tampilpotongan)) {
                            $id_potongan = $fetcharray['id_potongan'];
                            $nama_potongan = $fetcharray['nama_potongan'];
                        ?>
                            <option value="<?= $id_potongan; ?>"><?= $nama_potongan; ?></option>

                        <?php
                        }
                        ?>
                    </select>
                    <br />
                    <select name="id_layanan" class="form-control">
                        <option selected value="<?= $id_layanan; ?>">pilih layanan</option>
                        <?php
                        $tampillayanan = mysqli_query($conn, "select * from layanan_tambahan");
                        while ($fetcharray = mysqli_fetch_array($tampillayanan)) {
                            $nama_layanan = $fetcharray['nama_layanan'];
                            $id_layanan = $fetcharray['id_layanan'];
                        ?>
                            <option value="<?= $id_layanan; ?>"><?= $nama_layanan; ?></option>

                        <?php
                        }
                        ?>
                    </select>
                    <br />
                    <button type="submit" name="insertsewa" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- MODAL TAMBAH -->

</html>