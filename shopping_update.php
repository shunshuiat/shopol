<?php
if (isset($_POST["submitup"]) && isset($_POST["soluong"])) {	
	
	$soluong = $_POST["soluong"];
	
	foreach ($soluong as $key => $value) {
		$_SESSION["cart"][$key] = ($value > 0)? $value : 1; 
	}
	
	echo"<script>window.location('shopping_cart.php')</script>";
// 	header("Location: shopping_cart.php"); // Chuyển về giỏ hàng
	}
?>