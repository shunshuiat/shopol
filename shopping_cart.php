<?php
require_once 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>KINGOFSHOES</title>
	<link rel="shortcut icon" href="./image/icon.png" type="image/x-icon">
	<link rel="stylesheet" href="css/main_style.css">
	<script type="text/javascript" src="js/main_script.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
	<style>
		#dlAnh {
			width: 30px;
		}
	</style>
</head>

<body>
		
	<?php
	
	require_once 'navigation.php';
	require_once 'shopping_update.php';

	?>
	<div class="content-center main-body" style="text-align: center;">
		<!-- Giỏ hàng -->
		<h1>Giỏ Hàng</h1>
		<?php
		if (isset($_SESSION["cart"])) {

			$arrCart = $_SESSION["cart"]; // Biến mảng (từ session) chứa các sản phẩm trong giỏ hàng

			$item = array(); // Mảng chứa ID sản phẩm có trong giỏ hàng
			foreach ($arrCart as $key => $value) {
				$item[] = $key;
			}
			if ($_SESSION["cart"] > 0) {
				if (is_array($item) && !empty($item)) {
					echo "<hr>Số sản phẩm trong giỏ hàng là: " . count($_SESSION["cart"]);
					$paramIN = implode(",", $item);
					$sql = "SELECT * FROM `san_pham` WHERE maSP IN (" . $paramIN . ")"; // Lấy thông tin các sản phẩm trong giỏ hàng
					$result = select_database($sql);
				} else {
					echo "Không có sản phẩm trong giỏ hàng";
					echo "<br>";
					echo "<a href=\"index.php\" class=\"nav-link\" style=\"color: red;\">Quay lại trang chủ</a>";
				}
			}
			echo "<br>";
		?>
			<form action="" method="post">
				<?php
				if ($_SESSION["cart"] > 0) {
					if (is_array($item) && !empty($item)) { ?>

						<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
						<div class="container">
							<table id="cart" class="table table-hover table-condensed">
								<?php
								$totalBill = 0;
								if ($_SESSION["cart"] > 0) {
									if (is_array($item) && !empty($item)) {

								?>
										<thead>
											<tr>
												<th style="width:50%">Sản phẩm</th>
												<th style="width:10%">Giá</th>
												<!-- <th style="width:10%">Size</th> -->
												<th style="width:8%">Số lượng</th>
												<th style="width:22%" class="text-center">Tổng cộng</th>
												<th style="width:10%"></th>
											</tr>
										</thead>
										<?php while ($row = $result->fetch_assoc()) { ?>
											<tbody>
												<tr>
													<td data-th="Product">
														<div class="row">
															<div class="col-sm-2 hidden-xs"><?php echo "<img width='100' height='100' src='./uploads/" . $row["anhSP"] . "' alt='Lỗi hiển thị ảnh'>" ?></div>
															<div class="col-sm-10">
																<h4 class="nomargin"><?php echo $row['tenSP'] ?></h4>
															</div>
														</div>
													</td>
													<td data-th="Price"><?php echo currency_format($row['giaMoi']); ?></td>
													<!-- <td>
														<div class="col-sm-10">
															<h4 class="nomargin">
																<?php
																$maSP = $row["maSP"];
																if (isset($_SESSION["maSize"][$maSP])) {
																	echo $_SESSION["tenSize"][$maSP]; // Hiển thị tenSize
																} else {
																	echo "-"; // Hiển thị nếu không có giá trị maSize
																}
																?>
															</h4>
														</div>
													</td> -->
													<td data-th="Quantity">
														<?php echo "<input type='number' id=\"num-f\" name='soluong[" . $row["maSP"] . "]' min='1' value=" . $arrCart[$row["maSP"]] . "></td>"; ?>
													</td>
													<td data-th="Subtotal" class="text-center">
														<?php
														$totalBill += ($arrCart[$row["maSP"]] * $row["giaMoi"]);
														echo  currency_format($arrCart[$row["maSP"]] * $row["giaMoi"]);
														?>
													</td>
													<td class="actions" data-th="">
														<?php
														echo "<a type=\"submit\" class=\"btn btn-danger btn-sm\" onclick=\"checkDelete(" . $row["maSP"] . ",'" . $row["tenSP"] . "')\"><i class=\"fa fa-trash-o\"></i></a>";
														?>
													</td>
												</tr>
											</tbody>
										<?php } ?>
										<?php $_SESSION["totalBill"] = $totalBill; ?>
										<tfoot>
											<tr>
												<td><a href="index.php" class="btn btn-warning"><i class="fa fa-angle-left"></i> Quay lại trang mua hàng</a></td>
												<td colspan="2" class="hidden-xs"><strong>Thành tiền</strong></td>
												<td style="display: flex; flex-direction: column;">
													<?php
													echo "<span class=\"hidden-xs text-center\"><strong>" . currency_format($totalBill) . "</strong></span>";
													echo "<span  class=\"hidden-xs text-center\"><button type=\"submit\" class=\"btn btn-primary\" name=\"submitup\">Cập nhật giỏ hàng</button></span>";
													?>
												</td>
												<td>
													<?php
													if (isset($_SESSION["cart"]) && $_SESSION["cart"] > 0) {
														if (is_array($item) && !empty($item)) {
															// Kiểm tra nếu đã đăng nhập thì hiển thị nút THANH TOÁN >< hiển thị nút yêu cầu ĐĂNG NHẬP
															if (isset($_SESSION["taiKhoan"])) {
																echo "<button class=\"btn btn-primary\" name=\"btn-pay\"><a href=\"shopping_payment.php\" class=\"nav-link\">Thanh toán</a></button>";
															} else {
																echo "<button style=\"height: 60px\; width: 200px\" class=\"btn btn-primary\"><a href=\"login.php\" class=\"nav-link\">Đăng nhập để mua hàng</a></button>";
															}
														}
													}
													?>
												</td>
											</tr>
										</tfoot>

							</table>
						</div>
		<?php }
								}
							}
						} ?>

			</form>


		<?php
		} else {
			echo "Không có sản phẩm trong GIỎ HÀNG!";
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