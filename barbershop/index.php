<?php
include 'dashboard/functions.php';
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="stylez.css">
       <!--  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
    <title>GOATBERSHOP</title>
    <script type="text/javascript">
        function a(){
            alert('Login dulu baru bisa pesan :)');
        }
    </script>
</head>
<body>
    <div class="container2">
        <div class="header">
            <img src="xsz.png" class="logo">
            <nav>
                <ul>
                    <li><a href="">Home</a></li>
                    <li><a href="potonganRambut.php">Potongan Rambut</a></li>
                    <li><a href="layananExtra.php">Layanan Extra</a></li>
                    <?php if(!isset($_SESSION['username']) ){ ?>
                        <li><a class="btns btn-primary btn-sm" href="login.php">LOGIN</a></li>
                    <?php } else { ?>
                        <li><a class="btns btn-primary btn-sm" href="logout.php">LOGOUT</a></li>
                    <?php } ?>
                </ul>
            </nav>
        </div>
        <div class="content">
            <div class="text">
            <h1>Rambut adalah Mahkota...</h1>
            <p>Kamu nanya ?? Kamu bertanya-tanya tempat dimana kamu bisa potong rambut dengan harga yang terjangkau dan tentunya berkualitas ?? Kamu bertanya dimana tempatnya ?? Ya di GoatBershop Tempatnya ...
<br><br>
                    <?php if(!isset($_SESSION['username']) ){ ?>
                        <a class="btns btn-primary btn-lg" onclick="a();" style="text-decoration: none; margin-left: 70px;">Potong Rambut Sekarang !!</a>
                    <?php } else { ?>
                        <a class="btns btn-primary btn-lg" href="#sewapotong" data-toggle="modal" style="text-decoration: none; margin-left: 70px;">Potong Rambut Sekarang !!</a>
                    <?php } ?>
            </p>
           </div>

       </div>
    </div>
</body>

<div class="modal fade" id="sewapotong" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pesan Potong Rambut</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST">
                <div class="modal-body">
                    <div class="col-xl-11">
                        <input type="text" name="nama" placeholder="nama" class="form-control" required>
                    </div>
                    <br/>
                    <div class="col-xl-11">
                    <input type="text" name="no_hp" placeholder="nomor hp" class="form-control" required>
                   </div>
                    <br/>
                    <div class="col-xl-auto">
                    <select name="kategori" id="kategori" class="form-control">
                        <option value="DEWASA">DEWASA</option>
                        <option value="ANAK">ANAK</option>
                    </select>
                </div>
                    <br/>
                    <div class="col-xl-11">
                    <input type="text" name="tanggal" placeholder="tanggal" class="form-control" required>
                    </div>
                    <br>
                    <div class="col-auto">
                    <select name="waktu_pelayanan" class="form-control" >
                        <option value="13.00-14.00">13.00-14.00</option>
                        <option value="14.00-15.00">14.00-15.00</option>
                        <option value="15.00-16.00">15.00-16.00</option>
                        <option value="16.00-17.00">16.00-17.00</option>
                        <option value="17.00-18.00">17.00-18.00</option>
                        <option value="18.00-19.00">18.00-19.00</option>
                        <option value="19.00-20.00">19.00-20.00</option>
                    </select>
                </div>
                    <br>
                    <div class="col-xl-auto">
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
                </div>
                    <br />
                    <div class="col-xl-auto">
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
                </div>
                    <br />
                    <button type="submit" name="insertsewa2" class="btn btn-primary">Pesan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- MODAL TAMBAH -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="js/my-login.js"></script>
</html>