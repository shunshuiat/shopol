<?php
session_start();
if (isset($_GET["maSP"])) {	
	$maSP = $_GET["maSP"];	
	
	// Kiểm tra đã có biến session giỏ hàng chưa
	if (isset($_SESSION["cart"][$maSP])) {
		unset($_SESSION["cart"][$maSP]); // Loại sản phẩm khỏi giỏ hàng
		echo "";
		
	} 
	
	header("Location: shopping_cart.php");
	// echo "Sản phẩm mã ". $_GET["maSP"] . " đã có " . $_SESSION["cart"][$maSP];
}
?>