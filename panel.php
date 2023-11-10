<?php
session_start();
if (!isset($_SESSION['kullaniciadi'])) {
  header("Location: index.php");
  exit();
}

$kullaniciadi = $_SESSION['kullaniciadi'];
$is_admin = ($kullaniciadi == 'admin'); 
?>

<!DOCTYPE html>
<html>
<head>
  <title>Panel</title>
  <link rel="stylesheet" href="/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/panel.css">
</head>
<body>

<nav class="navbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a href="panel.php" class="nav-link"><i class="fa fa-home"></i> Panel</a>
      </li>
      <li class="nav-item">
        <a href="https://discord.gg/xFsKXkmnbJ" class="nav-link"><i class="fa fa-link"></i> Discord</a>
      </li>
    </ul>
    <ul class="navbar-profile">
      <li class="nav-item">
        <a href="#" class="nav-link">
          <div class="user-info">
            <i class="fa fa-user"></i>
            <?php echo $kullaniciadi; ?>
          </div>
        </a>
        <ul class="dropdown">
          <li><a href="profil-duzenle.php">Profil Düzenle</a></li>
          <li><a href="cikis.php">Çıkış Yap</a></li>
        </ul>
      </li>
    </ul>
  </nav>

  <div class="container">
    <main>
      <div class="boxes">
        <a href="kaydet.php" class="box">
          <div class="icon">
            <i class="fa fa-plus"></i>
          </div>
          <div class="box-text">
            <h3>Ürün Ekle</h3>
            <p>Yeni bir ürün ekleyin</p>
          </div>
        </a>

        <a href="guncelleme.php" class="box">
          <div class="icon">
            <i class="fa fa-bell"></i>
          </div>
          <div class="box-text">
            <h3>Güncellemeler</h3>
            <p>Yeni güncellemeleri kontrol edin</p>
          </div>
        </a>

        <a href="liste.php" class="box">
          <div class="icon">
            <i class="fa fa-list"></i>
          </div>
          <div class="box-text">
            <h3>Ürünler Listesi</h3>
            <p>Tüm ürünleri görüntüleyin</p>
          </div>
        </a>
        <?php if ($is_admin) { 
        ?>
        <a href="guncelleme-ekle.php" class="box">
          <div class="icon">
            <i class="fa fa-plus"></i>
          </div>
          <div class="box-text">
            <h3>Güncelleme Ekle</h3>
            <p>Güncelleme ekleyin</p>
          </div>
        </a>
        <?php } ?>
        
        <?php if ($is_admin) { 
        ?>
        <a href="personel-ekle.php" class="box">
          <div class="icon">
            <i class="fa fa-user"></i>
          </div>
          <div class="box-text">
            <h3>Personel Ekle</h3>
            <p>Personel Ekleyin</p>
          </div>
        </a>
        <?php } ?>

        <a href="personeller.php" class="box">
          <div class="icon">
            <i class="fa fa-users"></i>
          </div>
          <div class="box-text">
            <h3>Personeller</h3>
            <p>Personel bilgilerini görüntüle</p>
          </div>
        </a>

        <a href="notlar.php" class="box">
          <div class="icon">
            <i class="fa fa-sticky-note"></i>
          </div>
          <div class="box-text">
            <h3>Notlar</h3>
            <p>Notlarınızı görüntüleyin.</p>
          </div>
        </a>
        <a href="barkod.php" class="box">
          <div class="icon">
            <i class="fa fa-barcode"></i>
          </div>
          <div class="box-text">
            <h3>Barkod Oluştur</h3>
            <p>Barkod Oluştur.</p>
          </div>
        </a>
      </div>
    </main>
  </div>

</body>
<footer>
  <div>
    <style>
      footer {
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
        text-align: center;
        font-size: 12px;
        font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
      }
      .arx {
        text-decoration: none;
      }
      .arx p {
        color: #000;
      }
      .arx:hover {
        text-decoration: none;
      }

    </style>
    <img src="https://arxdevelopers.github.io/assets/img/arx-logo.png" alt="ARX" width="50" height="50">
    <div class="arx">
      <a href="https://arxdevelopers.github.io"><p>ArX Developers</p></a>
    </div>
  </div>
</footer>
</html>
