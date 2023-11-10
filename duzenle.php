<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/panel.css">
</head>
<body>

  <?php
  session_start();
  if (!isset($_SESSION['kullaniciadi'])) {
    header("Location: index.php");
    exit();
  }
  $kullaniciadi = $_SESSION['kullaniciadi'];
  $is_admin = ($kullaniciadi == 'admin'); 
  require_once 'config.php';
  $errors = array();
  
  if (isset($_GET['id'])) {
    $productId = $_GET['id'];

    $query = "SELECT * FROM urunler WHERE id = $productId";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $barkod = $row['barkod'];
      $urun_ad = $row['urun_ad'];
      $yetkili = $row['yetkili'];
      $tarih = $row['tarih'];
      $aciklama = $row['aciklama'];
    } else {
      echo "Ürün bulunamadı.";
    }
  }
  ?>
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
  <h1>Ürünü Düzenle</h1>
<div id="form-container">
  <form action="duzenle.php" method="POST">
    <input type="hidden" name="product_id" value="<?php echo $productId; ?>">
    <label for="barkod">Barkod:</label>
    <input type="text" id="barkod" name="barkod" value="<?php echo $barkod; ?>"><br>

    <label for="urun_ad">Ürün Adı:</label>
    <input type="text" id="urun_ad" name="urun_ad" value="<?php echo $urun_ad; ?>"><br>

    <label for="yetkili">Yetkili:</label>
<select id="yetkili" name="yetkili" disabled>
  <option value="<?php echo $kullaniciadi; ?>"><?php echo $kullaniciadi; ?></option>
</select>

    <label for="tarih">Tarih:</label>
    <input type="text" id="tarih" name="tarih" value="<?php echo $tarih; ?>"><br>

    <label for="aciklama">Açıklama:</label>
    <input type="text" id="aciklama" name="aciklama" value="<?php echo $aciklama; ?>"><br>

    <input type="submit" value="Güncelle">
  </form>
</div>
  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productId = $_POST["product_id"];
    $barkod = $_POST["barkod"];
    $urun_ad = $_POST["urun_ad"];
    $tarih = $_POST["tarih"];
    $aciklama = $_POST["aciklama"];

    $updateQuery = "UPDATE urunler SET barkod='$barkod', urun_ad='$urun_ad', tarih='$tarih', aciklama='$aciklama' WHERE id=$productId";

    if ($conn->query($updateQuery) === TRUE) {
      echo "Ürün başarıyla güncellendi.";
    } else {
      echo "Güncelleme hatası: " . $conn->error;
    }
  }
  ?>
</body>
</html>
