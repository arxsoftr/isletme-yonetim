<?php
session_start();
if (!isset($_SESSION['kullaniciadi'])) {
  header("Location: index.php");
  exit();
}

$kullaniciadi = $_SESSION['kullaniciadi'];
require_once 'config.php';
$errors = array();

if ($conn->connect_error) {
  die("Bağlantı hatası: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $personel_ad = $_POST["personel_ad"];
  $personel_soyad = $_POST["personel_soyad"];
  $personel_yetki = $_POST["personel_yetki"];
  $personel_tel = $_POST["personel_tel"];
  echo '<script>
          function validateForm() {
            var personel_ad = document.getElementById("personel_ad").value;
            var personel_soyad = document.getElementById("personel_soyad").value;

            var personel_yetki = document.getElementById("personel_yetki").value;
            var personel_tel = document.getElementById("personel_tel").value;

            if (personel_ad === "" || personel_soyad === "" || personel_yetki === "" || personel_tel === "") {
              alert("Lütfen tüm alanları doldurun.");
              return false;
            }
            return true;
          }
        </script>';

  if (empty($personel_ad) || empty($personel_soyad) || empty($personel_yetki) || empty($personel_tel)) {
    echo "Lütfen tüm alanları doldurun.";
  } else {
    $sql = "INSERT INTO personeller (personel_ad, personel_soyad, personel_yetki, personel_tel) VALUES ('$personel_ad', '$personel_soyad', '$personel_yetki', '$personel_tel')";

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
    <h1>Personel Ekleme</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="return validateForm();">
      <label for="personel_ad"> Personel Adı:</label>
      <input type="text" id="personel_ad" name="personel_ad">

      <label for="personel_soyad">Personel Soyad:</label>
      <input type="text" id="personel_soyad" name="personel_soyad">

      <label for="personel_yetki">Personel Yetki:</label>
      <input type="text" id="personel_yetki" name="personel_yetki">

      <label for="personel_tel">Personel Telefon Numarası</label>
      <input type="text" id="personel_tel" name="personel_tel">

      <input type="submit" value="Kaydet">
    </form>
  </div>
</body>
</html>
