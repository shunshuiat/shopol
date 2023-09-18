<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KINGOFSHOES</title>
    <link rel="shortcut icon" href="./image/icon.png" type="image/x-icon">
    
    
</head>

<body>
    <?php require_once 'header.php' ?>
    <nav class="navbar navbar-expand-sm navbar-dark " style="list-style: none;">
        <div class="container-fluid" style="margin: 10px; padding: 10px">
            <a class="navbar-brand" href="javascript:void(0)"><a class="navbar-brand" href="index.php"><img style="width: 50px;" src="./image/icon.png" alt="" srcset=""></a></a>

            <div class="collapse navbar-collapse" id="mynavbar">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link font-up text-uppercase" href="index.php" style="color: black; padding: 20px; font-weight: bolder; font-size: 20px">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <form>
                            <input class="form-control" type="text" placeholder="Tìm kiếm sản phẩm trên shop" name="txtSearch" style="width: 400px;">
                            <button class="btn btn-primary" type="submit" style="width: 100px; height: 40px;">
                                <span class="nav-link">Tìm kiếm</span>
                            </button>
                        </form>
                    </li>
                    <div style="display: flex; margin-left: 300px; padding: 10px;">
                        <li class="nav-item">
                            <a class="nav-link font-up text-uppercase" href="shopping_cart.php" style="color: red"><i class="fa fa-shopping-basket icon" aria-hidden="true" style="color: red"></i>Giỏ hàng</a>
                        </li>
                        <li class="nav-item">

                            <a class="nav-link font-up text-uppercase" href="profile.php" style="color: red"><i class="fa fa-users icon" aria-hidden="true" style="color: red"></i>Tài khoản</a>
                        </li>
                        <li class="nav-item">
                            <?php
                            if (isset($_SESSION['tenKH'])) {
                                echo "<p class=\"nav-link font-up text-uppercase\" style=\"color: red\"> Xin chào  " . $_SESSION['tenKH'] . "</p>";
                                echo "<a class=\"nav-link font-up text-uppercase\" href=\"logout.php\"><span style=\"color: red\">Đăng xuất</span></a>";
                            } else {
                                echo "<a class=\"nav-link font-up text-uppercase\" href=\"login.php\"><span style=\"color: red\">Đăng nhập</span></a>";
                            }
                            ?>
                        </li>
                </ul>

            </div>
        </div>
        </div>
    </nav>

</body>

</html>