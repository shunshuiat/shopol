<?php
require_once 'connection.php';
?>
<?php
if (isset($_POST["username"])) {
    $cnn = get_connection();
    $uname = mysqli_real_escape_string($cnn, $_POST["username"]);
    $upass = md5(mysqli_real_escape_string($cnn, $_POST["password"]));

    $sql = "SELECT * FROM `admin` WHERE `taiKhoan`='$uname' AND `matKhau`='$upass'";
    $result = select_database($sql);

    if (mysqli_num_rows($result) > 0) {
        // Đăng nhập thành công
        // session_start();
        // Lưu thông tin người dùng vào session
        while ($row = mysqli_fetch_assoc($result)) {
            session_start();
            $_SESSION["maKH"] = $row['maKH'];
            $_SESSION["taiKhoan"] = $row["taiKhoan"];
            $_SESSION["username"] = $row["username"];
            $_SESSION["email"] = $row["email"];
            $_SESSION["trangThai"] = $row["trangThai"];
        }
 
        header("Location: trang-chu.php");
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
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="login-page bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <h3 class="mb-3">Login Now</h3>
                    <div class="bg-white shadow rounded">
                        <div class="row">
                            <div class="col-md-7 pe-0">
                                <div class="form-left h-100 py-5 px-5">
                                    <form method="post" action="" class="row g-4">
                                        <div class="col-12">
                                            <label>Username<span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="bi bi-person-fill"></i></div>
                                                <input type="text" name="username" class="form-control" placeholder="Nhập tên tài khoản">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label>Password<span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="bi bi-lock-fill"></i></div>
                                                <input type="password" name="password" class="form-control" placeholder="Nhập mật khẩu">
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="inlineFormCheck">
                                                <label class="form-check-label" for="inlineFormCheck">Ghi nhớ</label>
                                            </div>
                                        </div>


                                        <div class="col-12" style="display: flex; flex-direction: row; justify-content: space-between;">
                                            <button type="submit" class="btn btn-primary px-4 float-end mt-4">Đăng nhập</button>
                                            <button type="submit" class="btn btn-primary px-4 float-end mt-4"><a class="nav-link" href="register.php">Đăng ký</a></button>
                                        </div>
                                        
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


</body>

</html>