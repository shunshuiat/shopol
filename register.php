<?php

require_once 'connection.php';
$result = null;
if (isset($_POST["txtUserName"])) {
    $tenKH = $_POST["txtUserName"];
    $taiKhoan = $_POST["txtTaiKhoan"];
    $matKhau = $_POST["txtMatKhau"];
    $diaChi = $_POST["txtDiaChi"];
    $dienThoai = $_POST["txtDienThoai"];
    $email = $_POST["txtEmail"];
    $ngaySinh = $_POST["txtNgaySinh"];
    $gioiTinh = $_POST["txtGioiTinh"];
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KINGOFSHOES</title>
    <link rel="shortcut icon" href="./image/icon.png" type="image/x-icon">

    <style>
        .divider:after,
        .divider:before {
            content: "";
            flex: 1;
            height: 1px;
            background: #eee;
        }

        .h-custom {
            height: calc(100% - 73px);
        }

        @media (max-width: 450px) {
            .h-custom {
                height: 100%;
            }
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    </form>
    <section class="vh-100">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-2">
                    <img src="./image/icon.png" class="img-fluid" alt="Sample image">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <form method="post">
                        <div class="form-outline mb-4">
                            <label id="form3Example3" for="txtUserName" class="right-form fa-2x"></label>
                            <input type="text" id="form3Example3" name="txtUserName" class="form-control form-control-lg" required placeholder="Nhập họ và tên">
                        </div>
                        <div class="form-outline mb-4">
                            <label for="txtTaiKhoan" class="right-form fa-2x"></label>
                            <input type="text number" name="txtTaiKhoan" id="form3Example4" class="form-control form-control-lg" required placeholder="Nhập tài khoản">
                            <?php
                            if (isset($_POST['txtUserName'])) {
                                $sql = "SELECT * FROM `khach_hang` WHERE `taiKhoan`= '" . $_POST['txtTaiKhoan'] . "'";
                                $result = select_database($sql);
                                if ($result->num_rows > 0) {
                                    echo "<span style=\"color: red;\">Tài khoản đã có người sử dụng</span>";
                                }
                            }
                            ?>
                        </div>
                        <div class="form-outline mb-4">
                            <label for="txtMatKhau" class="right-form fa-2x"></label>
                            <input type="password" name="txtMatKhau" id="form3Example4" class="form-control form-control-lg" required placeholder="Nhập mật khẩu">
                        </div>
                        <div class="form-outline mb-4">
                            <label for="txtDiaChi" class="right-form fa-2x"></label>
                            <input type="text" name="txtDiaChi" id="form3Example4" class="form-control form-control-lg" required placeholder="Nhập địa chỉ">
                        </div>
                        <div class="form-outline mb-4">
                            <label for="txtSoDienThoai" class="right-form fa-2x"></label>
                            <input type="text" name="txtDienThoai" id="form3Example4" class="form-control form-control-lg" required placeholder="Nhập số điện thoại">
                            <?php
                            if (isset($_POST['txtDienThoai'])) {
                                $sql = "SELECT * FROM `khach_hang` WHERE `dienThoai`= '" . $_POST['txtDienThoai'] . "'";
                                $result = select_database($sql);
                                if ($result->num_rows > 0) {
                                    echo " <span style=\"color: red;\">Số điện thoại đã có người sử dụng</span>";
                                }
                            }
                            ?>
                        </div>
                        <div class="form-outline mb-4">
                            <label for="txtEmal" class="right-form fa-2x"></label>
                            <input type="email" name="txtEmail" id="form3Example4" class="form-control form-control-lg" required placeholder="Nhập địa chỉ email">
                            <?php
                            if (isset($_POST['txtEmail'])) {
                                $sql = "SELECT * FROM `khach_hang` WHERE `email`= '" . $_POST['txtEmail'] . "'";
                                $result = select_database($sql);
                                if ($result->num_rows > 0) {
                                    echo "<span style=\"color: red;\">Địa chỉ Email đã có người sử dụng<span>";
                                }
                            }
                            ?>
                        </div>
                        <div class="form-outline mb-4">
                            <label for="txtNgaySinh" class="right-form fa-2x"></label>
                            <input type="date" name="txtNgaySinh" id="form3Example4" class="form-control form-control-lg" required placeholder="">
                        </div>
                        <div class="form-outline mb-4">
                            <label for="txtGioiTinh" class="right-form fa-2x"></label>
                            <input type="radio" name="txtGioiTinh" value="0"><span>Nam</span>
                            <input type="radio" name="txtGioiTinh" value="1"><span>Nữ</span>
                        </div>


                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="submit" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">Đăng ký</button>
                        </div>
                        <?php
                        // Lấy dữ liệu từ form
                        if (isset($_POST['txtUserName'])) {
                            $tenKH = $_POST['txtUserName'];
                            $taiKhoan = trim(stripslashes(htmlspecialchars($_POST['txtTaiKhoan'])));
                            $matKhau = trim(stripslashes(htmlspecialchars($_POST['txtMatKhau'])));
                            $diaChi = trim(stripslashes(htmlspecialchars($_POST['txtDiaChi'])));
                            $dienThoai = trim(stripslashes(htmlspecialchars($_POST['txtDienThoai'])));
                            $email = trim(stripslashes(htmlspecialchars($_POST['txtEmail'])));
                            $ngaySinh = $_POST['txtNgaySinh'];
                            $gioiTinh = $_POST['txtGioiTinh'];

                            // Kiểm tra điều kiện nhập liệu và xử lý lỗi (nếu có)
                            $error = '';
                            if (empty($tenKH) || empty($taiKhoan) || empty($matKhau) || empty($diaChi) || empty($dienThoai) || empty($email) || empty($ngaySinh)) {
                                $error = 'Vui lòng nhập đầy đủ thông tin';
                            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                $error = 'Địa chỉ Email không hợp lệ';
                            } elseif (!preg_match('/^[0-9]{10}$/', $dienThoai)) {
                                $error = 'Số điện thoại phải có 10 chữ số';
                            } elseif (strlen($matKhau) < 6) {
                                $error = 'Mật khẩu phải chứa ít nhất 6 kí tự';
                            } elseif (strlen($taiKhoan) < 6) {
                                $error = 'Tài khoản phải chứa ít nhất 6 kí tự';
                            }
                            $sql = "SELECT * FROM khach_hang WHERE taiKhoan = '" . $taiKhoan . "'";
                            $result = select_database($sql);
                            if ($result->num_rows > 0) {
                                echo "<span hidden style=\"color: red;\">Tài khoản đã có người sử dụng</span>";
                            }
                            $sql = "SELECT * FROM khach_hang WHERE email = '" . $email . "'";
                            $result = select_database($sql);
                            if ($result->num_rows > 0) {
                                echo "<span hidden style=\"color: red;\">Địa chỉ Email đã có người sử dụng<span>";
                            }
                            $sql = "SELECT * FROM khach_hang WHERE dienThoai = '" . $dienThoai . "'";
                            $result = select_database($sql);
                            if ($result->num_rows > 0) {
                                echo " <span hidden style=\"color: red;\">Số điện thoại đã có người sử dụng</span>";
                            }
                            // Nếu không có lỗi, thực hiện lưu dữ liệu vào cơ sở dữ liệu
                            if (empty($error)) {
                                // Thực hiện câu lệnh SQL để lưu dữ liệu vào bảng khach_hang
                                $sql = "INSERT INTO `khach_hang`(`tenKH`, `taiKhoan`, `matKhau`, `diaChi`, `dienThoai`, `email`, `ngaySinh`, `gioiTinh`) 
                                        VALUES ('$tenKH','$taiKhoan',md5('$matKhau'),'$diaChi','$dienThoai','$email','$ngaySinh',$gioiTinh)";
                                $result = insert_or_update($sql);
                                if ($result) {
                                    echo "<script>alert('Đăng kí thành công')</script>";
                                    echo "<button class=\" btn btn-outline-success btn-lg my-2 my-sm-0\"><a href=\"login.php\" style=\"color: black; text-decoration: none;\">Quay lại đăng nhập</a></button>";
                                }
                            } else {
                                echo $error;
                            }
                        }
                        ?>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>

</html>