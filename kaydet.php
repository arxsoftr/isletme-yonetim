<?php
session_start();
if (!isset($_SESSION['kullaniciadi'])) {
  header("Location: index.php");
  exit();
}

$kullaniciadi = $_SESSION['kullaniciadi'];
require_once 'config.php';
$errors = array();

$yetkili = $kullaniciadi;

if ($conn->connect_error) {
  die("Bağlantı hatası: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $barkod = $_POST["barkod"];
  $urun_ad = $_POST["urun_ad"];
  $yetkili = $kullaniciadi;
  $tarih = date("Y-m-d H:i:s");
  $aciklama = $_POST["aciklama"];
  echo '<script>
          function validateForm() {
            var barkod = document.getElementById("barkod").value;
            var urun_ad = document.getElementById("urun_ad").value;

            var tarih = document.getElementById("tarih").value;
            var aciklama = document.getElementById("aciklama").value;

            if (barkod === "" || urun_ad === "" || tarih === "" || aciklama === "") {
              alert("Lütfen tüm alanları doldurun.");
              return false;
            }
            return true;
          }
        </script>';

  if (empty($barkod) || empty($urun_ad) || empty($tarih) || empty($aciklama)) {
    echo "Lütfen tüm alanları doldurun.";
  } else {
    $sql = "INSERT INTO urunler (barkod, urun_ad, yetkili, tarih, aciklama) VALUES ('$barkod', '$urun_ad', '$yetkili', '$tarih', '$aciklama')";

    if ($conn->query($sql) === TRUE) {
      header('Location: kaydedildi.php');
      exit;
    } else {
      echo "Hata: " . $sql . "<br>" . $conn->error;
    }
  }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/panel.css">

  <meta charset="UTF-8">
  <title>Ürün Ekle</title>
</head>
<body>
<nav class="navbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a href="panel.php" class="nav-link"><i class="fa fa-home"></i> Panel</a>
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

  
  <div id="form-container">
    <h1>Ürün Ekleme Formu</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="return validateForm();">
      <label for="barkod"> Barkod:</label>
      <input type="text" id="barkod" name="barkod">

      <label for="urun_ad">Ürün Adı:</label>
      <input type="text" id="urun_ad" name="urun_ad">

      <label for="yetkili">Yetkili:</label>
<select id="yetkili" name="yetkili" disabled>
  <option value="<?php echo $kullaniciadi; ?>"><?php echo $kullaniciadi; ?></option>
</select>


      <label for="aciklama">Açıklama</label>
      <textarea id="aciklama" name="aciklama" rows="15" cols="65"></textarea>

      <input type="submit" value="Kaydet">
    </form>
  </div>
</body>
</html>
