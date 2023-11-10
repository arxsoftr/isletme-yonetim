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

if(isset($_GET['delete'])){
  $id = $_GET['delete'];
  $conn->query("DELETE FROM kitaplar WHERE id=$id");
  header('location: kitaplar.php');
}
if(isset($_POST['edit'])){
  $barkod = $_POST['barkod'];
  $urun_ad = $_POST['urun_ad'];
  $yetkili = $_POST['yetkili'];
  $tarih = $_POST['tarih'];   
  
  $aciklama = $_POST['aciklama'];
  
  $conn->query("UPDATE urunler SET barkıd='$barkod', urun_ad='$urun_ad', yetkili='$yetkili', tarih='$tarih', 'aciklama'=$aciklama ");
  header('location: kitaplar.php');
}

$sql = "SELECT * FROM urunler";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css/panel.css">
  <link rel="stylesheet" href="css/link.css">
  <link rel="stylesheet" href="/font-awesome/css/font-awesome.min.css">

  <link rel="stylesheet" href="css/guncellemeler.css">

  <style>
    #search-container {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 10px;
      background-color: #f2f2f2;
    }

    #search-input {
      flex: 1;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    #search-button {
      margin-left: 10px;
      padding: 10px 20px;
      background-color: #007BFF;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    #search-button:hover {
      background-color: #0056b3;
    }
  </style>
  <meta charset="UTF-8">
  <title>Ürün Listesi</title>
</head>
<body>
<nav class="navbar">
<nav class="navbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a href="panel.php" class="nav-link"><i class="fa fa-home"></i> Panel</a>
      </li>
      <li class="nav-item">
        <a href="https://discord.gg/xFsKXkmnbJ" class="nav-link"><i class="fa fa-link"></i> Discord</a>
      </li>
    </ul>

  </nav>
  </nav>
  <div id="search-container">
    <input type="text" id="search-input" placeholder="Ürün Ara...">
    <button id="search-button">Ara</button>
  </div>
  <div>
    <h1>Ürün Listesi</h1>
    <table>
      <thead>
        <tr>
          <th>Barkod</th>
          <th>Ürün Adı</th>
          <th>Yetkili</th>
          <th>Tarih</th>
          <th>Açıklama</th>
          <th></th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?php echo $row['barkod']; ?></td>
          <td><?php echo $row['urun_ad']; ?></td>
          <td><?php echo $row['yetkili']; ?></td>

          <td><?php echo $row['tarih']; ?></td>
          <td><?php echo $row['aciklama']; ?></td>

          <?php if ($is_admin) { 
            ?>
          <?php echo "<td> <a href='sil.php?id=".$row['id']."' id=".$row['id']."'>Sil</a></td>"; ?>
          <?php echo "<td> <a href='duzenle.php?id=".$row['id']."' id=".$row['id']."'>Düzenle</a></td>"; ?>
          <?php } ?>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
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
<script>
  const searchButton = document.getElementById("search-button");
  const searchInput = document.getElementById("search-input");
  const tableRows = document.querySelectorAll("tbody tr");

  searchButton.addEventListener("click", () => {
    const searchTerm = searchInput.value.toLowerCase();
    tableRows.forEach((row) => {
      const rowText = row.textContent.toLowerCase();
      if (rowText.includes(searchTerm)) {
        row.style.display = "";
      } else {
        row.style.display = "none";
      }
    });
  });
</script>
</html>

