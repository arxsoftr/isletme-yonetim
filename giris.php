<?php
session_start();
require_once 'config.php';

if (!$conn) {
  die("Veritabanına bağlanılamadı: " . mysqli_connect_error());
}

$errors = array();

if(isset($_POST['kullaniciadi']) && isset($_POST['sifre'])){
  $kullaniciadi = mysqli_real_escape_string($conn, $_POST['kullaniciadi']);
  $sifre = mysqli_real_escape_string($conn, $_POST['sifre']);

  if(empty($kullaniciadi)){
    $errors[] = 'Kullanıcı adı boş bırakılamaz.';
  }

  if(empty($sifre)){
    $errors[] = 'Şifre boş bırakılamaz.';
  }

  if(count($errors) > 0){
    $_SESSION['errors'] = $errors;
    header("Location: index.php");
    exit();
  }

  $sql = "SELECT * FROM kullanicilar WHERE kullaniciadi='$kullaniciadi' AND sifre='$sifre'";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) == 1) {
    $_SESSION['kullaniciadi'] = $kullaniciadi;
    header("Location: panel.php");
    exit();
  } else {
    $errors[] = 'Kullanıcı adı veya şifre hatalı!';
    $_SESSION['errors'] = $errors;
    header("Location: index.php");
    exit();
  }
}
?>
