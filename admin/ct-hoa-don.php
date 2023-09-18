<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php require_once 'link.php' ?>
</head>

<body>
    <div style="display: flex; flex-direction: row;">
        <?php
        require_once 'connection.php';
        require_once 'navigation.php';
        ?>
        <div style="display: flex; flex-direction: column;">
            <h1>Chi tiết hóa đơn</h1>
            <table class="table table-bordered" style="text-align: center;">


                <tr>
                    <th>Mã hóa đơn</th>
                    <th>Tên khách hàng</th>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng sản phẩm</th>
                    <th>Đơn giá</th>
                </tr>

                <?php
                $sql = "SELECT hd.maHD,hd.hoTenNguoiNhan, sp.tenSP, ct.so_luong, (SELECT ct.so_luong * cthd.giaBan) as giaBan FROM ct_hoa_don cthd
                    inner join san_pham_ct ct on ct.maSPCT = cthd.maSPCT
                    inner join san_pham sp on sp.maSP = ct.maSP
                    inner join hoa_don hd on hd.maHD = cthd.maHD
                    order by hd.maHD 
                ";
                $result = insert_or_update($sql);
                foreach ($result as $row) {
                    echo "<tr>
                <td>" . $row["maHD"] . "</td>
                <td>" . $row["hoTenNguoiNhan"] . "</td>
                <td>" . $row["tenSP"] . "</td>
                <td>" . $row["so_luong"] . "</td>
                <td>" . $row["giaBan"] . "</td>

            </tr>
            
            ";
                }
                ?>
            </table>
        </div>
    </div>
</body>

</html>