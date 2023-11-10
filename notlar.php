<?php
include_once 'config.php';
session_start();
$kullaniciadi = $_SESSION['kullaniciadi'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $not_ad = $_POST["not_ad"];
  $not_aciklama = $_POST["not_aciklama"];
  $not_sahip = $kullaniciadi; 

  $tarih = date("Y-m-d H:i:s");

  $query = "INSERT INTO notlar (not_ad, not_aciklama, not_sahip, tarih) VALUES ('$not_ad', '$not_aciklama', '$not_sahip', '$tarih')";

  if ($conn->query($query) === TRUE) {
    echo "Not başarıyla eklendi.";
    header('Location: notlar.php');
  } else {
    echo "Not eklenirken bir hata oluştu: " . $conn->error;
  }
}
$sql = "SELECT * FROM notlar";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="css/notlar.css">
  <meta charset="UTF-8">
  <title>Notlar</title>
</head>
<body>
  <div class="container">
    <h1><a href="panel.php">Panele Dön</a></h1>
    <div class="container">
      <div>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="return validateForm();">
          <label for="not_ad"> Not Başlığı:</label>
          <input type="text" id="not_ad" name="not_ad">
          <label for="not_aciklama">Not İçeriği:</label>
          <input type="text" id="not_aciklama" name="not_aciklama">
          <input type="submit" value="Kaydet">
        </form>
        <table>
          <h2>Eklenen Notlar</h2>
          <thead>
            <tr>
              <th>Not ID</th>
              <th>Not Başlık</th>
              <th>Not Açıklama</th>
              <th>Not Sahip</th>
              <th>Tarih</th> 
            </tr>
          </thead>
          <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
              <tr>
                <td><?php echo $row['not_id']; ?></td>
                <td><?php echo $row['not_ad']; ?></td>
                <td><?php echo $row['not_aciklama']; ?></td>
                <td><?php echo $row['not_sahip']; ?></td>
                <td><?php echo $row['tarih']; ?></td> 
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
      <?php
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<li>" . $row['not_ad, not_aciklama'] . "</li>";
        }
      } else {
        echo "Henüz not eklenmedi.";
      }
      ?>
    </div>
  </body>
  </html>
