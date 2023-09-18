<?php

require_once 'connection.php';

if (isset($_POST["txtTaiKhoan"])) {
    $taiKhoan = $_POST["txtTaiKhoan"];
    $matKhau = $_POST["txtMatKhau"];
    $tenNV = $_POST["txtTenNV"];
    $email = $_POST["txtEmail"];
    $dienThoai = $_POST["txtDienThoai"];
    // Kiểm tra định dạng tên đăng nhập
    if (strlen($taiKhoan) < 5 || !preg_match('/^[a-zA-Z0-9_]+$/', $taiKhoan)) {
        $error = "Tên đăng nhập phải có ít nhất 5 ký tự, chỉ bao gồm chữ, số và dấu gạch dưới.";
    }

    // Kiểm tra định dạng mật khẩu
    if (strlen($matKhau) < 8) {
        $error = "Mật khẩu phải có ít nhất 8 ký tự";
    }
    if (strlen($dienThoai) == 11) {
        $error = "Số điện thoại không hợp lệ";
    }
    // Kiểm tra định dạng email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Địa chỉ email không hợp lệ.";
    }

    if (!isset($error)) {
        // Kiểm tra tài khoản đã tồn tại hay chưa
        $sql = "SELECT * FROM admin WHERE taiKhoan = '$taiKhoan'";
        $result = select_database($sql);
        if ($result->num_rows > 0) {
            $error = "Tài khoản đã có người sử dụng.";
        }
    }

    if (!isset($error)) {
        // Lưu dữ liệu vào cơ sở dữ liệu
        $sql = "INSERT INTO admin (taiKhoan, matKhau, username, email, dienThoai) VALUES ('$taiKhoan', MD5('$matKhau'), '$tenNV', '$email', '$dienThoai')";
        $result = insert_or_update($sql);
        if ($result) {
            echo "<script>alert('Đăng kí thành công')</script>";
            echo "<button class=\"btn btn-outline-success btn-lg my-2 my-sm-0\"><a href=\"index.php\" style=\"color: black; text-decoration: none;\">Quay lại đăng nhập</a></button>";
        } else {
            $error = "Có lỗi xảy ra khi thêm tài khoản.";
        }
    }

    if (isset($error)) {
        echo "<span style=\"color: red;\">$error</span>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KINGOFSHOES</title>
    <link rel="shortcut icon" href="../image/icon.png" type="image/x-icon">

    <style>
        .divider:after, .divider:before {
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
    <section class="vh-100">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <form method="post">
                        <div class="form-outline mb-4">
                            <label for="txtTenNV" class="right-form fa-2x"></label>
                            <input type="text" id="txtTenNV" name="txtTenNV" class="form-control form-control-lg" required placeholder="Nhập họ và tên">
                        </div>
                        <div class="form-outline mb-4">
                            <label for="txtTaiKhoan" class="right-form fa-2x"></label>
                            <input type="text" id="txtTaiKhoan" name="txtTaiKhoan" class="form-control form-control-lg" required placeholder="Nhập tài khoản">
                        </div>
                        <div class="form-outline mb-4">
                            <label for="txtMatKhau" class="right-form fa-2x"></label>
                            <input type="password" id="txtMatKhau" name="txtMatKhau" class="form-control form-control-lg" required placeholder="Nhập mật khẩu">
                        </div>
                        <div class="form-outline mb-4">
                            <label for="txtEmail" class="right-form fa-2x"></label>
                            <input type="text" id="txtEmail" name="txtEmail" class="form-control form-control-lg" required placeholder="Nhập địa chỉ email">
                        </div>
                        <div class="form-outline mb-4">
                            <label for="txtDienThoai" class="right-form fa-2x"></label>
                            <input type="text" id="txtDienThoai" name="txtDienThoai" class="form-control form-control-lg" required placeholder="Nhập số điện thoại">
                        </div>
                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="submit" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">Đăng ký</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
</html>