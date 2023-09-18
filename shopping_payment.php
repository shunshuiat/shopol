
<?php
require_once 'connection.php';
require_once 'header.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>KINGOFSHOES</title>
	<link rel="shortcut icon" href="./image/icon.png" type="image/x-icon">

	<script type="text/javascript" src="js/main_script.js"></script>

</head>

<body onabort="">
	<!-- Header -->
	<header><?php require_once 'navigation.php'; ?></header>
	<section class="vh-100">
		<div class="container-fluid h-custom">
			<div class="row d-flex justify-content-center align-items-center h-100">

				<div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
					<h2>Thông tin giao hàng</h2>
					<form method="post">
						<div hidden class="form-outline mb-4">
							<input type="text" name="maKH" id="maKH" readonly value="<?php echo $_SESSION["maKH"] ?>" class="form-control form-control-lg">
							<label class="form-label" for="form3Example3">Mã khách</label>
						</div>
						<div class="form-outline mb-4">
							<label class="form-label" for="form3Example3">
								<h4>Tên người nhận<span style="color: red;">*</span></h4>
							</label>
							<input type="text" name="tenKH" id="tenKH" required="" value="<?php echo $_SESSION["tenKH"] ?>" class="form-control form-control-lg">
						</div>
						<div class="form-outline mb-3">
							<label class="form-label" for="form3Example4">
								<h4>Số điện thoại người nhận<span style="color: red;">*</span></h4>
							</label>
							<input type="text" id="form3Example4" name="dienThoai" id="dienThoai" required="" value="<?php echo $_SESSION["dienThoai"] ?>" class="form-control form-control-lg">
						</div>
						<div class="form-outline mb-3">
							<label class="form-label" for="form3Example4">
								<h4>Email người nhận<span style="color: red;">*</span></h4>
							</label>
							<input type="text" id="form3Example4" name="email" id="email" required="" value="<?php echo $_SESSION["email"] ?>" class="form-control form-control-lg">
						</div>
						<div class="form-outline mb-3">
							<label class="form-label" for="form3Example4">
								<h4>Địa chỉ người nhận<span style="color: red;">*</span></h4>
							</label>
							<input type="text" id="form3Example4" name="diaChi" id="diaChi" value="<?php echo $_SESSION["diaChi"] ?>" class="form-control form-control-lg">
						</div>
						<div class="form-outline mb-3">
							<label class="form-label" for="form3Example4">
								<h4>Phương thức thanh toán<span style="color: red;">*</span></h4>
							</label>
							<input type="text" id="form3Example4" name="thanhToan" id="thanhToan" required class="form-control form-control-lg">
						</div>
						<div class="text-center text-lg-start mt-4 pt-2">
							<button type="submit" name="submit" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">Đặt hàng</button>
							<button type="reset" class="btn btn-success btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">Làm lại</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
	
		<!-- Xử lý đơn hàng gửi đi -->
		<?php

		if (isset($_POST["submit"])) {
			$sqlhd = "INSERT INTO `hoa_don`(`maKH`, `hoTenNguoiNhan`, `diaChiNguoiNhan`, `dienThoaiNguoiNhan`,`diaChiEmail`,`tongTien`) 
				
				VALUES (?,?,?,?,?,?)";
			$stmthd = mysqli_prepare($conn, $sqlhd); // Chuẩn bị kết nối

			// Đổ dữ liệu prepare
			mysqli_stmt_bind_param($stmthd, "ssssss", $_POST["maKH"], $_POST["tenKH"], $_POST["diaChi"], $_POST["dienThoai"], $_POST["email"], $_SESSION["totalBill"]);

			$sqltt = "INSERT INTO `pt_thanh_toan`(`tenPTTT`) VALUES (?)";
			$stmttt = mysqli_prepare($conn, $sqltt); // Chuẩn bị kết nối

			// Đổ dữ liệu prepare
			mysqli_stmt_bind_param($stmttt, "s", $_POST["thanhToan"]);
			// Kích hoạt lệnh
			if (mysqli_stmt_execute($stmthd)) {
				echo "<script>alert('Đặt hàng thành công')</script>";
				echo "<script>window.location.href='index.php'</script>";
				$idhd = mysqli_stmt_insert_id($stmthd); // Lấy id hóa đơn sau khi thêm >>> đổ lên Hóa Đơn Chi Tiết

				$arrCart = $_SESSION["cart"]; // Biến mảng (từ session) chứa các sản phẩm trong giỏ hàng

				$sql = ""; // Lệnh truy vấn	
				foreach ($arrCart as $key => $value) {
					$sqlspct = "INSERT INTO `san_pham_ct`(`so_luong`, `maSP`) VALUES (" . $value . "," . $key . ")";
					$result = mysqli_query($conn, $sqlspct);
					$idspcts[] = mysqli_insert_id($conn);
				}

				foreach ($arrCart as $key => $value) {
					$idspct = array_shift($idspcts);
					$sql .= "INSERT INTO `ct_hoa_don`(`maHD`, `maSPCT`, `soLuongBan`, `giaBan`) VALUES (" . $idhd . "," . $idspct . "," . $value . ", (SELECT `giaMoi` FROM `san_pham` WHERE `maSP` = " . $key . "));";
				}
				// die($sql);
				// (SELECT`price` FROM `product` WHERE `id` = ".$key.") >>> là lệnh truy vấn con lồng trong lệnh INSERT
				// >>> phát triển lên có thể là lệnh truy vấn bảng dữ liệu khuyến mại
				// echo $sql;
				if (mysqli_multi_query($conn, $sql)) {
					echo "<h3 hidden style='text-align:center'>Thêm chi tiết Hóa Đơn thành công</h3>";
				} else {
					echo "<span hidden style='color:red'>Lỗi thêm Chi Tiết Hóa Đơn: " . mysqli_error($conn) . "</span>";
				}

				// Làm sạch giỏ hàng sau khi thanh toán
				unset($_SESSION["cart"]);
				unset($_SESSION["totalBill"]);
			}
		}


		?>

	</div>
	<footer style="background-color: whitesmoke;">
		<?php
		require_once 'footer.php';
		?>
	</footer>

</body>

</html>