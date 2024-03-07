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
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary bg-info text-white border-bottom border-light">
  <div class="container">
    <a class="navbar-brand text-dark" href="index.php">Website Galerry Foto</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse mt-2" id="navbarNavAltMarkup">
    <div class="navbar-nav me-auto"></div>
    <ul class="navbar-nav">
       <li class="nav-item"><a href="home.php" class="nav-link text-white"><i class="bi bi-house-door-fill">Home</i></a></li>
       <a href="album.php" class="nav-link text-white"><i class="bi bi-journal-album">Album</i></a>
       <a href="foto.php" class="nav-link text-white"><i class="bi bi-file-image">Foto</i></a>
        </div>
        <a href="../config/proses_logout.php" class="btn btn-outline-danger m-1 text-white"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z"/>
  <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
</svg></a>
        </ul>
    </div>
  </div>
</nav>

<div class="container mt-3">
<div class="row">
  <?php 
$query=mysqli_query($conn, "SELECT * FROM foto inner join user on foto.userid=user.userid inner join album on foto.albumid=album.albumid");
while($data = mysqli_fetch_array($query)) {
?>
<div class="col-md-3 mt-2">
    <a type="button" data-bs-toggle="modal" data-bs-target="#komentar<?php echo $data['fotoid'] ?>">
      
        <div class="card mb-2">
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
    <?php } ?>
</div>
</div>



<footer class="d-flex justify-content-center border-top mt-3 bg-secondary fixed-bottom">
    <p>&copy; UKK RPL 2024 | Siti Eliyani</p>
</footer>
 
<script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
</body>
</html>
