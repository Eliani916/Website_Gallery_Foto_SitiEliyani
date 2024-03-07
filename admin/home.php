<?php
session_start();
$userid = $_SESSION['userid'];
include '../config/koneksi.php';
if($_SESSION['status']!='login'){
  echo "<script>
  alert('Anda belum Login!');
  location.href='../index.php';
  </script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Gallery Foto</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary bg-info text-dark border-bottom">
  <div class="container">
    <a class="navbar-brand text-white" href="index.php">Website Galerry Foto</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse mt-2" id="navbarNavAltMarkup">
    <div class="navbar-nav me-auto"></div>
    <ul class="navbar-nav">
       <li class="nav-item"><a href="home.php" class="nav-link text-dark"><i class="bi bi-house-door-fill">Home</i></a></li>
       <a href="album.php" class="nav-link text-white"><i class="bi bi-journal-album">Album</i></a>
       <a href="foto.php" class="nav-link text-white"><i class="bi bi-file-image">Foto</i></a>
        </div>
        </ul>
      </div>
  <a href="../config/proses_logout.php" class="btn btn-outline-danger m-1 text-white"><i class="bi bi-box-arrow-right"></i></a>
</nav>

<div class="container mt-3">
Album : 
<?php
$album = mysqli_query($conn, "select * from album where userid='$userid'");
while ($row=mysqli_fetch_array($album)) { ?>
<a href="home.php?albumid=<?php echo $row['albumid'] ?>" class="btn btn-outline-primary"><?php echo $row['namaalbum'] ?></a>
 
<?php } ?>

<div class="row">
<?php
if (isset($_GET['albumid'])) {
 $albumid=$_GET['albumid'];
 $query=mysqli_query($conn, "select * from foto where userid='$userid' and albumid='$albumid'");
 while($data = mysqli_fetch_array($query)) { ?>
 <div class="col-md-3 mt-2">
        <di class="card">
            <img style="height:12rem;" src="../assets/img/<?php echo $data['lokasifile'] ?>" class="card-img-top" title="<?php echo $data['judulfoto'] ?>" >
            <div class="card-footer text-center">
                <?php
                $fotoid=$data['fotoid'];
                $ceksuka=mysqli_query($conn, "select * from likefoto where fotoid='$fotoid' and userid='$userid'");
                if (mysqli_num_rows($ceksuka) == 1) { ?>
                <a href="../config/proses_like.php?fotoid=<?php echo $data['fotoid'] ?>" type="submit" name="batalsuka"><i class="fa fa-heart"></i></a>
                <?php }else{ ?>
                <a href="../config/proses_like.php?fotoid=<?php echo $data['fotoid'] ?>" type="submit" name="suka"><i class="fa-regular fa-heart"></i></a>
                <?php }
                $like=mysqli_query($conn, "SELECT * FROM likefoto WHERE fotoid='$fotoid'");
                echo mysqli_num_rows($like). ' Suka';
                ?>
                <a href=""><i class="fa-regular fa-comment"></i></a>3 Komentar
            </div>
        </di>
    </div>


<?php } }else { 

$query=mysqli_query($conn, "SELECT * FROM foto WHERE userid='$userid'");
while($data = mysqli_fetch_array($query)) {
?>
<div class="col-md-3 mt-2">
        <di class="card">
            <img style="height:12rem;" src="../assets/img/<?php echo $data['lokasifile'] ?>" class="card-img-top" title="<?php echo $data['judulfoto'] ?>" >
            <div class="card-footer text-center">
                <?php
                $fotoid=$data['fotoid'];
                $ceksuka=mysqli_query($conn, "select * from likefoto where fotoid='$fotoid' and userid='$userid'");
                if (mysqli_num_rows($ceksuka) == 1) { ?>
                <a href="../config/proses_like.php?fotoid=<?php echo $data['fotoid'] ?>" type="submit" name="batalsuka"><i class="fa fa-heart"></i></a>
                <?php }else{ ?>
                <a href="../config/proses_like.php?fotoid=<?php echo $data['fotoid'] ?>" type="submit" name="suka"><i class="fa-regular fa-heart"></i></a>
                <?php }
                $like=mysqli_query($conn, "SELECT * FROM likefoto WHERE fotoid='$fotoid'");
                echo mysqli_num_rows($like). ' Suka';
                ?>

                <a href="#" type="button" data-bs-toggle="modal" data-bs-target="#komentar<?php echo $data['fotoid'] ?>"><i class="fa-regular fa-comment"></i></a>
                                <?php
                                $jmlkomen=mysqli_query($conn, "select * from komentarfoto where fotoid='$fotoid'");
                                echo mysqli_num_rows($jmlkomen).' Komentar';
                                ?>
                            </div>
                        </div>
                        </a>
                      

                </div>
               </div>
              </div>
            </div>
          </div>
        </div>
    </div>
    <?php } } ?>
</div>
</div>



<footer class="d-flex justify-content-center border-top mt-3 bg-secondary fixed-bottom">
    <p>&copy; UKK RPL 2024 | Siti Eliyani</p>
</footer>
 
<script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
</body>
</html>