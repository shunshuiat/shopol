<?php
require_once 'connection.php';
?>
<?php
if (isset($_POST["username"])) {
    $uname = $_POST["username"];
    $upass = md5($_POST["password"]);

    $sql = "SELECT * FROM `khach_hang` WHERE `taiKhoan` = ? AND `matKhau` = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $uname, $upass);
    mysqli_stmt_execute($stmt); // Kích hoạt lệnh prepare
    $result = mysqli_stmt_get_result($stmt); // Lấy dữ liệu trả về

    if (mysqli_num_rows($result) > 0) {
        // Đăng nhập thành công
        // session_start();
        // Lưu thông tin người dùng vào session
        while ($row = mysqli_fetch_assoc($result)) {
            session_start();
            $_SESSION["maKH"] = $row['maKH'];
            $_SESSION["taiKhoan"] = $row["taiKhoan"];
            $_SESSION["tenKH"] = $row["tenKH"];
            $_SESSION["diaChi"] = $row["diaChi"];
            $_SESSION["dienThoai"] = $row["dienThoai"];
            $_SESSION["email"] = $row["email"];
            $_SESSION["ngaySinh"] = $row["ngaySinh"];
            $_SESSION['gioiTinh'] = $row["gioiTinh"];
        }

        header("Location: index.php");
    } else {
        echo "<script>alert('Tài khoản hoặc mật khẩu không chính xác')</script>";
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
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
    <section class="vh-100">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-2">
                    <img src="./image/icon.png" class="img-fluid" alt="Sample image">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <form method="post">
                        <div class="form-outline mb-4">
                            <input type="text" id="form3Example3" name="username" class="form-control form-control-lg" placeholder="Nhập tài khoản" />
                            <label class="form-label" for="form3Example3"></label>
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-3">
                            <input type="password" id="form3Example4" name="password" class="form-control form-control-lg" placeholder="Nhập mật khẩu" />
                            <label class="form-label" for="form3Example4"></label>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <!-- Checkbox -->
                            <div class="form-check mb-0">
                                <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
                                <label class="form-check-label" for="form2Example3">
                                    Ghi nhớ
                                </label>
                            </div>
                            <a href="miss-pass.php" class="text-body">Quên mật khẩu?</a>
                        </div>

                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="submit" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">Đăng nhập</button>
                            <p class="small fw-bold mt-2 pt-1 mb-0">Chưa có tài khoản? <a href="register.php" class="link-danger">Đăng ký</a></p>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
</body>

</html>