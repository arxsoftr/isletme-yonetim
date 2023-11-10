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
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/panel.css">
    <style>
        .barcode-container {
            text-align: center;
        }

        .barcode {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .copy-button {
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
        }

        .copy-button:hover {
            background-color: #0056b3;
        }
    </style>
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
    <div class="barcode-container">
        <div class="barcode" id="barcode">
            <?php
            function generateRandomBarcode($length) {
                $characters = '0123456789';
                $randomBarcode = '';
                for ($i = 0; $i < $length; $i++) {
                    $randomBarcode .= $characters[rand(0, strlen($characters) - 1)];
                }
                return $randomBarcode;
            }

            if (isset($_POST['generateBarcode'])) {
                $barcode = generateRandomBarcode(11);
            }
            else {
                $barcode = ''; //
            }

            echo $barcode;
            ?>
        </div>
        <form method="POST">
            <button class="copy-button" name="generateBarcode">Oluştur</button>
        </form>
        <button class="copy-button" onclick="copyToClipboard()">Kopyala</button>
    </div>

    <script>
        function copyToClipboard() {
            var barcodeText = document.getElementById('barcode');
            var tempInput = document.createElement('input');
            document.body.appendChild(tempInput);
            tempInput.value = barcodeText.textContent;
            tempInput.select();
            document.execCommand('copy');
            document.body.removeChild(tempInput);
            alert('Barkod Kopyalandı: ' + barcodeText.textContent);

            window.location.href = 'kaydet.php?barcode=' + barcodeText.textContent;
        }
    </script>
</body>
</html>
