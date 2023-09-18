<?php
require_once 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin tài khoản</title>
    <?php require_once 'header.php' ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <?php if (isset($_SESSION['taiKhoan'])) { ?>
        <?php require_once 'navigation.php' ?>

        <h1 style="text-align: center;">Thông tin tài khoản của bạn</h1>

        <div class="container mt-3">
            <br>

            <!-- Nav pills -->
            <ul class="nav nav-pills" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="pill" href="#home">Tài khoản</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="pill" href="#menu1">Danh sách đơn hàng</a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div id="home" class="container tab-pane active"><br>
                    <?php
                    $sql = "SELECT * FROM khach_hang WHERE taiKhoan = '" . $_SESSION['taiKhoan'] . "'";
                    $result = select_database($sql);

                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $tenKH = $row['tenKH'];
                        $taiKhoan = $row["taiKhoan"];
                        $email = $row["email"];
                        $dienThoai = $row["dienThoai"];
                        $diaChi = $row["diaChi"];
                    ?>

                        <section>
                            <div class="container py-5">
                                <div class="row">
                                    <div class="col-lg-2"></div>
                                    <div class="col-lg-8">
                                        <div class="card mb-4">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="mb-0">Họ và tên</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted mb-0"><?php echo $tenKH ?></p>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="mb-0">Tài khoản</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted mb-0"><?php echo $taiKhoan ?></p>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="mb-0">Email</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted mb-0"><?php echo $email ?></p>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="mb-0">Số điện thoại</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted mb-0"><?php echo $dienThoai ?></p>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="mb-0">Địa chỉ</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <p class="text-muted mb-0"><?php echo $diaChi ?></p>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <p class="mb-0">Mật khẩu</p>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                                                            Đổi mật khẩu
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    <?php
                    } else {
                        echo "<h2 style=\"text-align: center;\">Không tìm thấy thông tin tài khoản</h2>";
                    }
                    ?>
                </div>

                <div id="menu1" class="container tab-pane"><br>
                    <?php
                    $sql = "SELECT * FROM hoa_don WHERE maKH = " . $_SESSION['maKH'];
                    $result = select_database($sql);

                    if ($result->num_rows > 0) {
                    ?>
                        <div style="display: flex;flex-direction: column;">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Mã hóa đơn</th>
                                        <th>Họ tên người nhận</th>
                                        <th>Địa chỉ</th>
                                        <th>SĐT</th>
                                        <th>Email</th>
                                        <th>Thanh toán</th>
                                        <th>Tổng tiền</th>
                                        <th>Ngày đặt hàng</th>
                                        <th>Chi tiết hóa đơn</th>
                                        <th>Trạng thái</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    while ($row = $result->fetch_assoc()) {
                                        $maHD = $row["maHD"];
                                        $hoTenNguoiNhan = $row["hoTenNguoiNhan"];
                                        $diaChiNguoiNhan = $row["diaChiNguoiNhan"];
                                        $dienThoaiNguoiNhan = $row["dienThoaiNguoiNhan"];
                                        $diaChiEmail = $row["diaChiEmail"];
                                        $ngayHoaDon = $row["ngayHoaDon"];
                                        $tongTien = $row["tongTien"];
                                        $trangThai = $row["trangThai"];

                                        echo "<tr>
                                        <td>$maHD</td>
                                        <td>$hoTenNguoiNhan</td>
                                        <td>$diaChiNguoiNhan</td>
                                        <td>$dienThoaiNguoiNhan</td>
                                        <td>$diaChiEmail</td>
                                        <td>$ngayHoaDon</td>
                                        <td>" . currency_format($tongTien) . "</td>
                                        <td>$ngayHoaDon</td>
                                        <td>
                                            <a href=\"#\" class=\"btn btn-light\" data-bs-toggle=\"modal\" data-bs-target=\"#myModal-" . $maHD . "\">Chi tiết</a>

                                            <!-- Modal -->
                                            <div class=\"modal fade\" id=\"myModal-" . $maHD . "\" tabindex=\"-1\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">
                                                <div class=\"modal-dialog\">
                                                    <div class=\"modal-content\">
                                                        <div class=\"modal-header\">
                                                            <h4 class=\"modal-title\">Chi tiết hóa đơn $maHD</h4>
                                                            <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"modal\"></button>
                                                        </div>

                                                        <div class=\"modal-body\">
                                                            <table class=\"table table-bordered\">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Tên sản phẩm</th>
                                                                        <th>Số lượng</th>
                                                                        <th>Đơn giá</th>
                                                                        <th>Thành tiền</th>
                                                                    </tr>
                                                                </thead>

                                                                <tbody>";

                                        // Lấy chi tiết đơn hàng tương ứng với mã hóa đơn
                                        $sql_cthd = "SELECT ct.so_luong, sp.tenSP, sp.anhSP, cthd.giaBan FROM ct_hoa_don cthd
                                            JOIN san_pham_ct ct ON ct.maSPCT = cthd.maSPCT
                                            JOIN san_pham sp ON sp.maSP = ct.maSP
                                            WHERE cthd.maHD = $maHD";
                                        $result_cthd = select_database($sql_cthd);

                                        // Hiển thị chi tiết đơn hàng
                                        $total_amount = 0;
                                        foreach ($result_cthd as $cthd) {
                                            $total_amount += $cthd["so_luong"] * $cthd["giaBan"];
                                            echo "<tr>
                                            <td>    
                                            " . $cthd['tenSP'] . "<img src=\"./uploads/" . $cthd['anhSP'] . "\" width=\"100px\" >    
                                            </td>
                                                <td>" . $cthd["so_luong"] . "</td>
                                                <td>" . currency_format($cthd["giaBan"]) . "</td>
                                                <td>" . currency_format($cthd["so_luong"] * $cthd["giaBan"]) . "</td>
                                            </tr>";
                                        }

                                        echo "</tbody>
                                                                <tfoot>
                                                                    <tr>
                                                                        <th colspan=\"3\">Tổng tiền:</th>
                                                                        <td>" . currency_format($total_amount) . "</td>
                                                                    </tr>
                                                                </tfoot>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Modal -->

                                        </td>";

                                        echo "<td>";
                                        if ($trangThai == 1) {
                                            echo "Giao hàng";
                                        } else {
                                            echo "Hoàn thành";
                                        }
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    <?php
                    } else {
                        echo "<h2 style=\"text-align: center;\">Bạn chưa có đơn hàng nào</h2>";
                    }
                    ?>
                </div>
            </div>

            <!-- The Modal -->
            <div class="modal" id="myModal">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Đổi mật khẩu</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                                <form method="post">
                                    <div class="form-outline mb-4">
                                        <input type="text" readonly id="form3Example3" name="username" class="form-control form-control-lg" value="<?php echo $_SESSION['taiKhoan'] ?>" placeholder="Tài khoản" />
                                        <label class="form-label" for="form3Example3"></label>
                                    </div>
                                    <div class="form-outline mb-4">
                                        <input type="password" id="form3Example3" name="oldPass" class="form-control form-control-lg" placeholder="Mật khẩu cũ" />
                                        <label class="form-label" for="form3Example3"></label>
                                    </div>
                                    <div class="form-outline mb-4">
                                        <input type="password" id="form3Example3" name="newPass" class="form-control form-control-lg" placeholder="Mật khẩu mới" />
                                        <label class="form-label" for="form3Example3"></label>
                                    </div>
                                    <div class="form-outline mb-4">
                                        <input type="submit" id="form3Example3" name="btnUpdate" value="Cập nhật" class="btn btn-primary" />
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        </div>

                    </div>
                </div>
            </div>
            <?php

            if (isset($_POST['btnUpdate'])) {
                $pass = md5($_POST['oldPass']);
                echo $pass;
                $repass = md5($_POST['newPass']);
                $sql = "SELECT * FROM khach_hang where maKH = " . $_SESSION['maKH'] . "";
                $result = mysqli_query($conn, $sql);

                foreach ($result as $row) {

                    if ($pass == $row['matKhau']) {
                        $sql = "UPDATE khach_hang SET matKhau = '$repass' WHERE taiKhoan = '" . $_SESSION['taiKhoan'] . "'";
                        $result = mysqli_query($conn, $sql);
                        if ($result) {
                            echo "<script>alert('Đổi mật khẩu thành công!');</script>";
                            echo "<script>window.location.href='profile.php';</script>";
                        }
                    } else {
                        echo "<script>alert('Mật khẩu không khớp!');</script>";
                    }
                }
            }
            ?>
        <?php } else {
        echo "<script>alert('Bạn cần đăng nhập để sử dụng chức năng này')</script>";
        echo "<script>window.location.replace('login.php')</script>";
    } ?>

        <footer style="background-color: whitesmoke; width: auto">
            <?php require_once 'footer.php'; ?>
        </footer>

        </div>



</body>

</html>