<?php
require_once 'connection.php';
?>
<?php
// update insert nhãn hiệu
$isUpdateOkNH = $isInsertOkNH = null;

$maNH = null;
$tenNH = null;

if (isset($_GET["idupdateNH"])) {
    $idupdateNH = $_GET["idupdateNH"];

    $sql = "SELECT `maNH`, `tenNH` FROM `nhan_hieu` WHERE `maNH` = $idupdateNH";
    $result = select_database($sql);
    if ($result->num_rows > 0)
        while ($row = $result->fetch_assoc()) {
            $maNH = $row["maNH"];
            $tenNH = $row["tenNH"];
            break;
        }
}
if (isset($_POST["txtMaNH"]) && $_POST["txtMaNH"] != "") {
    $maNH_nh = $_POST["txtMaNH"];
    $tenNH_nh = $_POST["txtTenNH"];

    $sql = "UPDATE `nhan_hieu` SET `tenNH` = '$tenNH_nh' WHERE `maNH` = $maNH_nh";
    $isUpdateOkNH = insert_or_update($sql);

    if ($isUpdateOkNH) {
        header("Location: nhan-hieu.php");
    }
} else if (isset($_POST["txtTenNH"])) {
    $tenNH_nh = $_POST["txtTenNH"];

    $sql = "INSERT INTO `nhan_hieu`(`tenNH`) VALUES ('$tenNH_nh')";
    $isInsertOkNH = insert_or_update($sql);
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
<div style="display: flex; flex-direction: row;">
    <?php
    require_once 'navigation.php';
    ?>
    <div style="display: flex; flex-direction: column; ">
        <div >
            <form action="" method="post" class="mb-3 mt-3" style="align-items: center;">
                <h1>Nhãn hiệu</h1>
                <?php
                if (isset($isInsertOkNH)) {
                    if ($isInsertOkNH) {
                        echo "Thêm mới thành công";
                    } else {
                        echo "Thêm mới thất bại";
                    }
                }
                ?>
                <div>
                    <label for="txtMaNH" class="form-label" hidden>Mã nhãn hiệu:</label>
                    <input type="text" class="form-control" name="txtMaNH" id="txtMaNH" readonly hidden value="<?php echo $maNH ?>">
                </div>
                <div>
                    <label for="txtTenNH" class="form-label">Tên nhãn hiệu</label>
                    <input type="text" name="txtTenNH" id="txtTenTH" value="<?php echo $tenNH ?>">
                </div>
                <input class="btn btn-light" type="submit" value="<?php echo isset($_GET["idupdateNH"]) ? "Cập nhật" : "Thêm mới" ?>" id="btnUI">
            </form>
            <div class="tbl-1">
                <form action="" method="post">
                    <h1>Danh sách nhãn hiệu</h1>
                    <table border="1" cellspacing="0" class="table table-bordered" style="text-align: center;">
                        <tr>
                            <th>Mã nhãn hiệu</th>
                            <th>Tên nhãn hiệu</th>
                            <th>Update</th>
                            <th>Delete</th>
                        </tr>
                        <?php
                        $sql = "SELECT * FROM `nhan_hieu`";
                        $result = select_database($sql);
                        foreach ($result as $row) {
                            echo "
                            <tr>
                                <td>" . $row["maNH"] . "</td>
                                <td>" . $row["tenNH"] . "</td>
                                <td><a type=\"submit\"><a href=\"?idupdateNH=" . $row["maNH"] . "\" ><img src=\"../image/update.png\" width=\"30px\"></td>
                                <td><a type=\"submit\" onclick=\"checkDeleteNhanHieu(" . $row["maNH"] . ",'" . $row["tenNH"] . "')\"><img src=\"../image/delete.png\" width=\"30px\"></td>
                            </tr>
                            ";
                        }
                        ?>
                    </table>
                </form>

            </div>
        </div>


        </body>

</html>