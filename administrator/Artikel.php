<?php
include "inc.session.php"; 
include "../librari/inc.koneksidb.php";
?>

<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--><html class="no-js"><!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>
    Administrator - Pakar Tanaman Kopi
  </title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width">

  <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,300,600,700" rel="stylesheet" type="text/css">
  <link href="../css/bootstrap.min.css" media="all" rel="stylesheet" type="text/css" id="bootstrap-css">
  <link href="../css/adminflare.min.css" media="all" rel="stylesheet" type="text/css" id="adminflare-css">
  </script>
  
  <script src="../js/modernizr-jquery.min.js" type="text/javascript"></script>
  <script src="../js/adminflare-demo.min.js" type="text/javascript"></script>
  <script src="../js/bootstrap.min.js" type="text/javascript"></script>
  <script src="../js/adminflare.min.js" type="text/javascript"></script>
  
  <script type="text/javascript">
    $(document).ready(function() {
      prettyPrint();
    });
  </script>

  <style type="text/css">
    .box, .well { padding-bottom: 0; }
  </style>
</head>
<body>
<script type="text/javascript">demoSetBodyLayout();</script>
  <!-- Main navigation bar
    ================================================== -->
  <header class="navbar navbar-fixed-top" id="main-navbar">
    <div class="navbar-inner">
      <div class="container">
        <a class="logo" href="#"><img alt="Af_logo" src="../images/af-logo.png"></a>

        <a class="btn nav-button collapsed" data-toggle="collapse" data-target=".nav-collapse">
          <span class="icon-reorder"></span>
        </a>

        <div class="nav-collapse collapse">
          <ul class="nav">
            <li class="divider-vertical"></li>
            <li class="active"><a href="../"><i class="icon-home"></i> FRONT PAGE</a></li>
            <li class="divider-vertical"></li>
            <li><a href="Pages.php"><i class="icon-home"></i> HALAMAN STATIS</a></li>
            <?php
            if(!empty($_SESSION['username_admin']))
            {
            ?>
            <li class="divider-vertical"></li>
            <li><a href="../index.php?page=logout"><i class="icon-off"></i> LOG OUT</a></li>
            <?php } ?>
          </ul>
          <ul class="nav  pull-right">
            <li><a href="#"><i class="icon-user"></i> Welcome, <?php echo $_SESSION['username_admin']; ?></a></li>
          </ul>
        </div>
      </div>
    </div>
  </header>
  <!-- / Main navigation bar -->
  
  <!-- Left navigation panel
    ================================================== -->
  <nav id="left-panel">
    <div id="left-panel-content">
      <ul>
        <li>
          <a href="index.php"><span class="icon-home"></span>Beranda</a>
        </li>
        <li>
          <a href="Artikel.php"><span class="icon-dashboard"></span>Artikel</a>
        </li>
        <li>
          <a href="PenyakitTampil.php"><span class="icon-th-large"></span>Data Penyakit</a>
        </li>
        <li>
          <a href="GejalaTampil.php"><span class="icon-edit"></span>Daftar Gejala</a>
        </li>
        <li>
          <a href="SolusiTampil.php"><span class="icon-table"></span>Data Solusi</a>
        </li>
        
        <li>
          <a href="AdminTampil.php"><span class="icon-inbox"></span>Daftar Admin</a>
        </li>
        
        <li>
          <a href="PenggunaTampil.php"><span class="icon-share"></span>Pengguna</a>
        </li>
        <li>
          <a href="LaporanTampil.php"><span class="icon-share"></span>Laporan</a>
        </li>
      </ul>
    </div>
    <div class="icon-caret-down"></div>
    <div class="icon-caret-up"></div>
  </nav>
  <!-- / Left navigation panel -->
  
  <!-- Page content
    ================================================== -->
  <section class="container">
  
    <!-- Headings
      ================================================== -->
    <section class="row-fluid">
      <h4><span class='icon-leaf'></span> Administrator - Sistem Pakar Diagnosa Hama dan Penyakit Tanaman Kopi</h4>
      <div class="box">
        <div class="well">

<?php 

$batas   = 5;//banyaknya data yang ditampilkan 
$halaman = $_GET['halaman']; 
if(empty($halaman)){ 
    $posisi=0; 
    $halaman=1; 
} 
else{ 
    $posisi = ($halaman-1) * $batas; 
} 
 
//Sesuaikan perintah SQL 
$tampil="select * from artikel limit $posisi,$batas"; 
$hasil=mysql_query($tampil); 

echo "<table class='table table-striped table-condensed'>";
$no=$posisi+1; // Agar angka (penomoran) mengikuti paging 
while ($data=mysql_fetch_array($hasil)){ 
  echo "<tr><td>$no</td><td>".$data['judul']."</td><td>".substr($data['artikel'],0,100)."...</td>
  <td>
    <a href='EditArtikel.php?id_artikel=".$data['id_artikel']."' class='btn'>Edit</a>
    <a href='HapusArtikel.php?id_artikel=".$data['id_artikel']."' class='btn'>Hapus</a>
  </td>
  </tr>"; 
  $no++; 
} 
echo "<tr><td></td><td></td><td></td>
  <td>
    <a href='TambahArtikel.php' class='btn'>Tambah</a>
  </td>
  </tr>"; 
echo "</table>"; 
 
//Hitung total data dan halaman serta link 1,2,3 ... 
echo "<br>Halaman : "; 
$file="index.php"; 
 
$tampil2="select * from artikel"; 
$hasil2=mysql_query($tampil2); 
$jmldata=mysql_num_rows($hasil2); 
$jmlhalaman=ceil($jmldata/$batas); 
 
for($i=1;$i<=$jmlhalaman;$i++) 
if ($i != $halaman) 
{ 
    echo " <a href=Artikel.php?halaman=$i>$i</A> | "; 
} 
else 
{ 
    echo " <b>$i</b> | "; 
} 
echo "<p>Total Data Artikel : <b>$jmldata</b> artikel</p>"; 
?>

        </div>
      </div>
    </section>
    
    <footer id="main-footer">
      Perancangan Aplikasi Sistem Pakar Berbasis Website Untuk Para Petani Tanaman Kopi
    </footer>
    <!-- / Page footer -->
  </section>
</body>
</html>
