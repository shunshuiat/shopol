<?php
require_once 'connection.php';
$mahd = "";
$sql = "SELECT * FROM hoa_don";
$result = select_database($sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php require_once 'link.php'; ?>
</head>

<body>


    <div style="display: flex;flex-direction: row;">
        <?php

        require_once 'navigation.php';
        ?>
        <div style="display: flex;flex-direction: column;">
            <h1>Quản lý hóa đơn</h1>
            <table border="1" cellspacing="0" cellpadding="0" style="text-align: center;" class="table table-bordered">
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
                <?php
                $sql = "SELECT * FROM hoa_don";
                $result = select_database($sql);
                foreach ($result as $row) {
                    echo "
        <tr>
            <td>" . $row["maHD"] . "</td>
            <td>" . $row["hoTenNguoiNhan"] . "</td>
            <td>" . $row["diaChiNguoiNhan"] . "</td>
            <td>" . $row["dienThoaiNguoiNhan"] . "</td>
            <td>" . $row["diaChiEmail"] . "</td>
            <td>" . $row["ngayHoaDon"] . "</td>
            <td>" . $row["tongTien"] . "</td>
            <td>" . $row["ngayHoaDon"] . "</td>
            <td>
                <a href=\"#\" class=\"btn btn-light\" data-bs-toggle=\"modal\" data-bs-target=\"#myModal-" . $row["maHD"] . "\">Chi tiết</a>
                <!-- Modal -->
                <div class=\"modal fade\" id=\"myModal-" . $row["maHD"] . "\" tabindex=\"-1\" aria-labelledby=\"myModalLabel\" aria-hidden=\"true\">
                    <div class=\"modal-dialog\">
                        <div class=\"modal-content\">
                            <div class=\"modal-header\">
                                <h4 class=\"modal-title\">Chi tiết hóa đơn " . $row["maHD"] . "</h4>
                                <button type=\"button\" class=\"close\" data-bs-dismiss=\"modal\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
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
                    $sql_cthd = "SELECT ct.so_luong, sp.tenSP, cthd.giaBan FROM ct_hoa_don cthd
                        JOIN san_pham_ct ct ON ct.maSPCT = cthd.maSPCT
                        JOIN san_pham sp ON sp.maSP = ct.maSP
                        WHERE cthd.maHD = " . $row["maHD"];
                    $result_cthd = select_database($sql_cthd);

                    // Hiển thị chi tiết đơn hàng
                    $total_amount = 0;
                    foreach ($result_cthd as $cthd) {
                        $total_amount += $cthd["so_luong"] * $cthd["giaBan"];
                        echo "<tr>
                                            <td>" . $cthd["tenSP"] . "</td>
                                            <td>" . $cthd["so_luong"] . "</td>
                                            <td>" . $cthd["giaBan"] . "</td>
                                            <td>" . ($cthd["so_luong"] * $cthd["giaBan"]) . "</td>
                                        </tr>";
                    }

                    echo "</tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan=\"3\">Tổng tiền:</th>
                                            <td>" . $total_amount . "</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Modal -->
            </td>
            <td>";
                    if ($row["trangThai"] == 1) {
                        echo "<a href='status-hoadon.php?invoiceId=" . $row["maHD"] . "'>Giao hàng</a>";
                    } else {
                        echo "Hoàn thành";
                    }
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
    </div>
</body>

</html>