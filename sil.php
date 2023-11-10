<?php
include_once 'config.php';

if (isset($_GET['id'])) {
  $productId = $_GET['id'];
  $query = "DELETE FROM urunler WHERE id = $productId";
  if ($conn->query($query)) {
    echo json_encode(array("success" => true));
    exit;
  }
}

echo json_encode(array("success" => false));
?>
