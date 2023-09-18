<?php
require_once 'link.php';
require_once 'connection.php';
// Kiểm tra nếu người dùng không có quyền truy cập thì chuyển về trang chủ
if ($_SESSION['trangThai'] == '1') {
} else {
    echo "<script>alert('Bạn không có quyền truy cập vào đây')</script>";
    echo "<script>window.location.replace('trang-chu.php')</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm</title>
    <script>
        var myModal = document.getElementById('myModal')
        var myInput = document.getElementById('myInput')

        myModal.addEventListener('shown.bs.modal', function() {
            myInput.focus()
        })
    </script>
</head>

<body>

    <div style="display: flex; flex-direction: row;">
        <?php
        require_once 'navigation.php';
        ?>
        <div>

            <!-- Menu danh mục -->
            <ul class="nav flex-column">
                <li class="nav-item"><a class="nav-link" href="san-pham.php">Danh sách sản phẩm</a></li>
                <li class="nav-item"><a class="nav-link" href="update-insert-SP.php">Update Insert sản phẩm</a></li>
            </ul>

        </div>

        <div>

            <!-- Form tìm kiếm sản phẩm -->
            <form action="" method="get">
                <input class="form-control mr-sm-2" type="text" placeholder="Tìm kiếm sản phẩm trên shop" name="txtSearch">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Tìm kiếm</button>
            </form>

            <?php
            // Thực hiện tìm kiếm sản phẩm
            if (isset($_GET["txtSearch"])) {
                $search = $_GET["txtSearch"];
                $sql = "SELECT * FROM `san_pham` sp 
                inner join `nhan_hieu` nh on nh.maNH = sp.maNH
                        inner join `loai_san_pham` lsp on lsp.maLSP = sp.maLSP
                        WHERE sp.`tenSP` LIKE '%$search%'
                ";

                $result = select_database($sql);
            ?>

                <form action="" method="post" enctype="multipart/form-data">
                    <h1>Danh sách Sản phẩm</h1>
                    <table border="1" cellspacing="0" class="table table-bordered" style="text-align: center;">
                        <tr>
                            <th>Mã sản phẩm</th>
                            <th>Tên sản phẩm</th>
                            <th>Ảnh sản phẩm</th>
                            <th hidden>Mô tả</th>
                            <th hidden>Thông tin</th>
                            <th hidden>Giá nhập</th>
                            <th>Giá mới</th>
                            <th>Lượt xem</th>
                            <th>Ngày cập nhật</th>
                            <th>Loại sản phẩm</th>
                            <th>Nhãn hiệu</th>
                            <th>Update</th>
                            <th>Delete</th>
                        </tr>
                        <?php
                        $result = select_database($sql);
                        foreach ($result as $row) {
                            echo "
                            <tr>
                                <td>" . $row["maSP"] . "</td>
                                <td>" . $row["tenSP"] . "</td>";
                        ?>
                            <td style="display: flex; flex-direction: column; align-items: center;">
                                <img src="../uploads/<?php echo $row['anhSP'] ?>" width="100px" alt="">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $row['maSP'] ?>">
                                    Ảnh mô tả
                                </button>
                            </td>
                        <?php
                            echo "
                                <td hidden>" . $row["moTa"] . "</td>
                                <td hidden>" . $row["giaNhap"] . "</td>     
                                <td>" . $row["giaMoi"] . "</td>
                                <td>" . $row["luotXem"] . "</td>
                                <td>" . $row["ngayCapNhat"] . "</td>
                                <td>" . $row["tenLSP"] . "</td>
                                <td>" . $row["tenNH"] . "</td>
                                <td><a type=\"submit\"><a href=\"update-insert-SP.php?idupdateSP=" . $row["maSP"] . "\" ><img src=\"../image/update.png\" width=\"30px\"></td>
                                <td><a type=\"submit\" onclick=\"checkDelete(" . $row["maSP"] . ",'" . $row["tenSP"] . "')\"><img src=\"../image/delete.png\" width=\"30px\"></td>
                            </tr>
                            ";
                        }
                        ?>
                    </table>
                </form>
            <?php } ?>
            <?php

            // Hiển thị danh sách sản phẩm
            $page = 0;
            if (isset($_GET["page"])) {
                $page = $_GET["page"] - 1;
            }

            // Tính tổng số trang
            $sql = "SELECT CEIL((SELECT COUNT(*) FROM `san_pham`) / 6) AS 'totalpage'";
            $result = select_database($sql);
            $totalpage = 0;
            if ($result->num_rows  > 0) {
                while ($row = $result->fetch_assoc()) {
                    $totalpage = $row["totalpage"];
                }
            }

            $sql = "SELECT " . $page . " * (SELECT (SELECT COUNT(*) FROM `san_pham`) / (SELECT CEIL((SELECT COUNT(*) FROM `san_pham`) / 6))) AS 'offset'";
            $result = select_database($sql);
            $offset = 0;
            while ($row = $result->fetch_assoc()) {
                $offset = (int) $row["offset"];
            }

            $result = select_database($sql);
            $sql = "SELECT * FROM `san_pham` sp
                        inner join `nhan_hieu` nh on nh.maNH = sp.maNH
                        inner join `loai_san_pham` lsp on lsp.maLSP = sp.maLSP
                        ORDER BY sp.maSP 
                        LIMIT " . $offset . ", 6";

            if ($result->num_rows > 0) {
            ?>

                <!-- Danh sách sản phẩm -->
                <ul class="pagination nav justify-content-center">
                    <?php
                    for ($i = 1; $i <= $totalpage; $i++) {
                        echo "<li class=\"page-item\"><a class=\"page-link\" href='?page=$i'>" . $i . "</a></li>";
                    }
                    ?>
                </ul>
                <form action="" method="post" enctype="multipart/form-data">
                    <h1>Danh sách Sản phẩm</h1>
                    <table border="1" cellspacing="0" class="table table-bordered" style="text-align: center;">
                        <tr>
                            <th>Mã sản phẩm</th>
                            <th>Tên sản phẩm</th>
                            <th>Ảnh sản phẩm</th>
                            <th hidden>Mô tả</th>
                            <th hidden>Thông tin</th>
                            <th hidden>Giá nhập</th>
                            <th>Giá mới</th>
                            <th>Lượt xem</th>
                            <th>Ngày cập nhật</th>
                            <th>Loại sản phẩm</th>
                            <th>Nhãn hiệu</th>
                            <th>Update</th>
                            <th>Delete</th>
                        </tr>
                        <?php
                        $result = select_database($sql);
                        foreach ($result as $row) {
                            echo "
                            <tr>
                                <td>" . $row["maSP"] . "</td>
                                <td>" . $row["tenSP"] . "</td>";
                        ?>
                            <td style="display: flex; flex-direction: column; align-items: center;">
                                <img src="../uploads/<?php echo $row['tenSP'] ?>.png" width="100px" alt="">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $row['maSP'] ?>">
                                    Ảnh mô tả
                                </button>
                            </td>
                        <?php
                            echo "
                                <td hidden>" . $row["moTa"] . "</td>
                                <td hidden>" . $row["giaNhap"] . "</td>     
                                <td>" . $row["giaMoi"] . "</td>
                                <td>" . $row["luotXem"] . "</td>
                                <td>" . $row["ngayCapNhat"] . "</td>
                                <td>" . $row["tenLSP"] . "</td>
                                <td>" . $row["tenNH"] . "</td>
                                <td><a type=\"submit\"><a href=\"update-insert-SP.php?idupdateSP=" . $row["maSP"] . "\" ><img src=\"../image/update.png\" width=\"30px\"></td>
                                <td><a type=\"submit\" onclick=\"checkDelete(" . $row["maSP"] . ",'" . $row["tenSP"] . "')\"><img src=\"../image/delete.png\" width=\"30px\"></td>
                            </tr>
                            ";
                        }
                        ?>
                    </table>
                </form>
            <?php } ?>
        </div>

    </div>

    <?php
    // Hiển thị danh sách ảnh sản phẩm trong modal
    $sql = "SELECT sp.maSP,sp.tenSP, ha.tenHA FROM hinh_anh ha
            inner join san_pham sp on sp.maSP = ha.maSP 
        ";

    $result = select_database($sql);
    foreach ($result as $row) {
    ?>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal<?php echo $row['maSP'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><?php echo $row['tenSP'] ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?php
                        $maSP = $row['maSP'];
                        $sql = "SELECT * FROM hinh_anh WHERE maSP = $maSP";
                        $result = select_database($sql);
                        foreach ($result as $row) {
                            echo "<img src=\"../uploads/" . $row['tenHA'] . "\" width=\"100px\" height=\"100px\" style=\"display: flex; flex-direction: column;\">";
                        }
                        ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</body>

</html>