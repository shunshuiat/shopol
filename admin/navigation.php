<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <?php require_once 'link.php'; ?>
</head>

<body>


    <ul class="list-group">
        <li class="list-group-item"><a href="trang-chu.php" class="nav-link active">Trang chủ</a></li>
        <li class="list-group-item"><a href="nhan-hieu.php" class="nav-link active">Nhãn hiệu</a></li>
        <li class="list-group-item"><a href="loai-san-pham.php" class="nav-link active">Loại sản phẩm</a></li>
        <li class="list-group-item"><a href="san-pham.php" class="nav-link active">Sản phẩm</a></li>

        <li class="list-group-item">
            <a href="quan-ly-hoa-don.php" class="nav-link active">Quản lý hóa đơn</a>
        </li>
        <li class="list-group-item">
            <a href="ct-hoa-don.php" class="nav-link active">Chi tiết hóa đơn</a>
        </li>
        <?php
        if (isset($_SESSION['trangThai']) == 1) {
            echo "<li class=\"list-group-item\"><a href=\"ql-khach-hang.php\" class=\"nav-link active\">Quản lý khách hàng</a></li>";
        }
        ?>
        <?php
        if (isset($_SESSION['trangThai']) == 1) {
            echo "<li class=\"list-group-item\"><a href=\"ql-nhan-vien.php\" class=\"nav-link active\">Quản lý nhân viên</a></li>";
        }
        ?>
        <li class="list-group-item"><a href="logout.php" class="nav-link active"><i class="fa fa-sign-out" aria-hidden="true"></i></a></li>

    </ul>
    <style>
        ul.list-group>li.list-group-item>a:hover {
            color: red;
        }

        a:active {
            font-weight: bolder;
        }
    </style>

</body>

</html>