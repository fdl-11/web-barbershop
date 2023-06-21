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
    <title>Data Jenis Potongan Rambut</title>
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
                    <h1 class="mt-4">Data Potongan Rambut</h1>
                    <div class="card mb-4">
                        <div class="card-header">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modaltambah">
                                Tambah Potongan Rambut
                            </button>
                            <a class="btn btn-success" href="cetak_potonganRambut.php">Cetak</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID Potongan</th>
                                            <th>Nama Potongan</th>
                                            <th>Gambar</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $tampilpotongan = mysqli_query($conn, "SELECT * FROM `potongan_rambut`");
                                        while ($data = mysqli_fetch_array($tampilpotongan)) {
                                            $id_potongan = $data['id_potongan'];
                                            $nama_potongan = $data['nama_potongan'];
                                            $gambar = $data['gbr_potongan'];
                                        ?>
                                            <tr>
                                                <td><?= $id_potongan; ?></td>
                                                <td><?= $nama_potongan; ?></td>
                                                <td><img src="img/<?= $gambar; ?>" width="50"></td>
                                                <td>
                                                    <button style="margin: 2px;" type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalupdate<?= $id_potongan; ?>">Edit</button>
                                                    <button style="margin: 2px;" type="button" class="btn btn-danger" data-toggle="modal" data-target="#modaldelete<?= $id_potongan; ?>">Hapus</button>
                                                </td>
                                            </tr>
<!-- MODAL UPDATE DATA MOBIL -->
<div id="modalupdate<?= $id_potongan; ?>" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data">
                <div class="modal-header">      
                    <h4 class="modal-title">Update Data Potongan Rambut</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body"> 
                    <input type="hidden" name="gambarLama" value="<?= $gambar; ?>">
                        <div class="mb-3">
                            <label class="form-label">Nama Potongan Rambut</label>
                            <input type="text" class="form-control" name="nama_potongan" value="<?= $nama_potongan; ?>" required>
                        </div>   
                        <div class="mb-3">
                            <label class="form-label">Gambar</label>
                            <input type="file" name="gambar" id="gambar" class="form-control" value="c:img/<?= $gambar; ?>" >
                        </div>
                        <input type="hidden" name="id_potongan" value="<?= $id_potongan; ?>">
                </div>

                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Batal">
                    <input type="submit" class="btn btn-success" name="updatepotongan" value="Update">
                </div>
            </form>
        </div>
    </div>
</div>
<!-- MODAL UPDATE DATA MOBIL -->

                                            <!-- DELETE -->
                                            <div class="modal fade" id="modaldelete<?= $id_potongan; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Hapus Data Potongan Rambut</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form method="post">
                                                            <div class="modal-body">
                                                                Apakah anda yakin ingin menghapus data ini? &nbsp;&nbsp;
                                                                <input type="hidden" name="id_potongan" value="<?= $id_potongan; ?>">
                                                                <button type="submit" name="deletepotongan" class="btn btn-danger btn-sm">Hapus</button>
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

<!-- MODAL TAMBAH DATA POTONG RAMBUT -->
<div id="modaltambah" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data">
                <div class="modal-header">      
                    <h4 class="modal-title">Tambah Data Potongan Rambut</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body"> 
                        <div class="mb-3">
                            <label class="form-label">ID Potongan Rambut</label>
                            <input type="text" class="form-control" name="id_potongan" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Potongan Rambut</label>
                            <input type="text" class="form-control" name="nama_potongan" required>
                        </div>   
                        <div class="mb-3">
                            <label class="form-label">Gambar</label>
                            <input type="file" name="gambar" id="gambar" class="form-control" accept="image/*">
                        </div>
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Batal">
                    <input type="submit" class="btn btn-success" name="insertpotongan" value="Tambah">
                </div>
            </form>
        </div>
    </div>
</div>
<!-- MODAL TAMBAH DATA POTONG RAMBUT -->

</html>