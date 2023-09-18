<?php
require_once 'connection.php';
if (isset($_GET["invoiceId"])) {	
	$id = $_GET["invoiceId"];	
	
	// Cập nhật trạng thái đơn hàng
	$sql = "UPDATE `hoa_don` SET `trangThai`=2 WHERE `maHD` = ".$id;
	if (mysqli_query($conn, $sql)) {
		header("Location: quan-ly-hoa-don.php");
	} else {
		echo "Lỗi: " . $sql . "<br>" . mysqli_error($conn);
	}
}
?>