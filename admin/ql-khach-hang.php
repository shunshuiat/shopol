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
            <th>Mã khách hàng</th>
            <th>Tên khách hàng</th>
            <th>Tài khoản</th>
            <th>Địa chỉ</th>
            <th>Số điện thoại</th>
            <th>Email</th>
            <th>Ngày sinh</th>
            <th>Giới tính</th>
            <th>Tích điểm</th>
            
            <?php
                $sql = "SELECT * FROM khach_hang";
                $result = select_database($sql);
                foreach($result as $row) {
                    echo "
                        <tr style=\"text-align: center;\">";
                        echo "
                            <td>". $row['maKH'] ."</td>
                            <td>". $row['tenKH'] ."</td>
                            <td>". $row['taiKhoan'] ."</td>
                            <td>". $row['diaChi'] ."</td>
                            <td>". $row['dienThoai'] ."</td>
                            <td>". $row['email'] ."</td>
                            <td>". $row['ngaySinh'] ."</td>";
                        if($row['gioiTinh'] == 0) {
                            echo "<td>Nam</td>";
                        } else {
                            echo "<td>Nữ</td>";
                        }
                        echo "<td>". $row['tichDiem'] ."</td>";
                        echo "</tr>";
                       
                }
            ?>
        </table>
    </div>
</body>
</html>