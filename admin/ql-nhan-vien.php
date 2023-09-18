<?php require_once'connection.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php require_once 'header.php'; ?>
    <div style="display: flex; flex-direction: row;" >
        <?php require_once 'navigation.php' ?>
        <table class="table" style="text-align: center;">
            <th>Mã nhân viên</th>
            <th>Tên nhân viên</th>
            <th>Tài khoản</th>
            <th>Email</th>
            <th>Số điện thoại</th>
            <th>Trạng thái</th>
            <?php
                $sql = "SELECT * FROM `admin` WHERE trangThai = 0";
                $result = select_database($sql);
                foreach($result as $row) {
                    echo "
                        <tr style=\"text-align: center;\">";
                        echo "
                            <td>". $row['id'] ."</td>
                            <td>". $row['username'] ."</td>
                            <td>". $row['taiKhoan'] ."</td>
                            <td>". $row['email'] ."</td>
                            <td>". $row['dienThoai'] ."</td>
                            <td>". $row['trangThai'] ."</td>";
                        echo "</tr>";
                }
            ?>
        </table>
    </div>
</body>
</html>