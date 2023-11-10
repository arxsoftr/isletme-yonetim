<?php
$servername = "localhost"; // Sunucu adı girin
$username = "alkumru_hd"; // Kullanıcı adı girin
$password = "alkumru.4321"; // Kullanıcı şifresi girin
$dbname = "alkumru_db"; // Veritabanı adı

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Veritabanına bağlantı başarısız.: " . $conn->connect_error);
}
?>