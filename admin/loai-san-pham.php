<?php
require_once 'connection.php';
?>
<?php
// update insert nhãn hiệu
$isUpdateOkLSP = $isInsertOkLSP = null;

$maLSP = null;
$tenLSP = null;

if (isset($_GET["idupdateLSP"])) {
    $idupdateLSP = $_GET["idupdateLSP"];

    $sql = "SELECT `maLSP`, `tenLSP` FROM `loai_san_pham` WHERE `maLSP` = $idupdateLSP";
    $result = select_database($sql);
    if ($result->num_rows > 0)
        while ($row = $result->fetch_assoc()) {
            $maLSP = $row["maLSP"];
            $tenLSP = $row["tenLSP"];
            break;
        }
}
if (isset($_POST["txtMaLSP"]) && $_POST["txtMaLSP"] != "") {
    $maLSP_lsp = $_POST["txtMaLSP"];
    $tenLSP_lsp = $_POST["txtTenLSP"];

    $sql = "UPDATE `loai_san_pham` SET `tenLSP` = '$tenLSP_lsp' WHERE `maLSP` = $maLSP_lsp";
    $isUpdateOkLSP = insert_or_update($sql);

    if ($isUpdateOkLSP) {
        header("Location: loai-san-pham.php");
    }
} else if (isset($_POST["txtTenLSP"])) {
    $tenLSP_lsp = $_POST["txtTenLSP"];

    $sql = "INSERT INTO `loai_san_pham`(`tenLSP`) VALUES ('$tenLSP_lsp')";
    $isInsertOkLSP = insert_or_update($sql);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php require_once 'link.php' ?>
</head>

<body>

    <div style="display: flex; flex-direction: row;">
        <?php
        require_once 'navigation.php';
        ?>
        <div style="display: flex; flex-direction: column;">
            <div>
                <form action="" method="post" class="mb-3 mt-3">
                    <h1>Loại sản phẩm</h1>
                    <?php
                    if (isset($isInsertOkLSP)) {
                        if ($isInsertOkLSP) {
                            echo "Thêm mới thành công";
                        } else {
                            echo "Thêm mới thất bại";
                        }
                    }
                    ?>
                    <div>
                        <label for="txtMaLSP" class="form-label" hidden>Mã loại sản phẩm:</label>
                        <input type="text" class="form-control" name="txtMaLSP" id="txtMaLSP" readonly hidden value="<?php echo $maLSP ?>">
                    </div>
                    <div>
                        <label for="txtTenLSP" class="form-label">Tên loại sản phẩm</label>
                        <input type="text" name="txtTenLSP" id="txtTenLSP" value="<?php echo $tenLSP ?>">
                    </div>
                    <input class="btn btn-light" type="submit" value="<?php echo isset($_GET["idupdateLSP"]) ? "Cập nhật" : "Thêm mới" ?>" id="btnUI">
                </form>



            </div>
            <div class="tbl-1">
                <form action="" method="post">
                    <h1>Danh sách nhãn hiệu</h1>
                    <table border="1" cellspacing="0" class="table table-bordered" style="text-align: center;">
                        <tr>
                            <th>Mã loại sản phấm</th>
                            <th>Tên loại sản phấm</th>
                            <th>Update</th>
                            <th>Delete</th>
                        </tr>
                        <?php
                        $sql = "SELECT * FROM `loai_san_pham`";
                        $result = select_database($sql);
                        foreach ($result as $row) {
                            echo "
                            <tr>
                                <td>" . $row["maLSP"] . "</td>
                                <td>" . $row["tenLSP"] . "</td>
                                <td><a type=\"submit\"><a href=\"?idupdateLSP=" . $row["maLSP"] . "\" ><img src=\"../image/update.png\" width=\"30px\"></td>
                                <td><a type=\"submit\" onclick=\"checkDeleteLoaiSanPham(" . $row["maLSP"] . ",'" . $row["tenLSP"] . "')\"><img src=\"../image/delete.png\" width=\"30px\"></td>
                            </tr>
                            ";
                        }
                        ?>
                    </table>
                </form>
            </div>
        </div>
    </div>

</html>