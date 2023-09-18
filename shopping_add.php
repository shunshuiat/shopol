<?php
session_start();
if (isset($_GET["maSP"])) {
  $maSP = $_GET["maSP"];
 
  // Kiểm tra đã có biến session giỏ hàng chưa
  if (isset($_SESSION["cart"][$maSP])) {
    $_SESSION["cart"][$maSP] += 1;
   
  } else {
    $_SESSION["cart"][$maSP] = 1;
    
  }

  header("Location: shopping_cart.php"); // Chuyển hướng về trang giỏ hàng
}
?>