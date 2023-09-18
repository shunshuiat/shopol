    <?php
    require_once 'connection.php';
    require_once 'upload-file.php';
    require_once 'link.php';
    ?>
    <?php
    $isUpdateOkSP = $isInsertOkSP = null;

    $maSP = null;
    $tenSP = null;
    $anhSP = null;
    $motaSP = null;

    $gianhapSP = null;

    $giamoiSP = null;
    $luotxemSP = null;
    $ngaycapnhatSP = null;
    $trangthaiSP = null;
    $maLSP = null;
    $maNH = null;
    $size = null;
    if (isset($_GET["idupdateSP"])) {
        $idupdateSP = $_GET["idupdateSP"];

        $sql = "SELECT * FROM `san_pham` sp
        inner join `nhan_hieu` nh on nh.maNH = sp.maNH
        inner join `loai_san_pham` lsp on lsp.maLSP = sp.maLSP
        WHERE sp.maSP = $idupdateSP";
        $result = select_database($sql);
        if ($result->num_rows > 0)
            while ($row = $result->fetch_assoc()) {
                $maSP = $row["maSP"];
                $tenSP = $row["tenSP"];
                $anhSP = $row["anhSP"];
                $motaSP = $row["moTa"];
                $gianhapSP = $row["giaNhap"];
                $giamoiSP = $row["giaMoi"];
                $luotxemSP = $row["luotXem"];
                $ngaycapnhatSP = $row["ngayCapNhat"];
                $trangthaiSP = $row["trangThai"];
                $maLSP = $row["maLSP"];
                $maNH = $row["maNH"];

                break;
            }
        $sqls = "SELECT * FROM size 
            where maSP = $idupdateSP;
        ";
        $result = select_database($sqls);
        foreach ($result as $row) {
            $size = $row["tenSize"];
        }
    }
    if (isset($_POST["txtMaSP"]) && $_POST["txtMaSP"] != "") {
        $ma_SP = $_POST["txtMaSP"];
        $ten_SP = $_POST["txtTenSP"];
        $mota_SP = $_POST["txtMoTaSP"];

        $gianhap_SP = $_POST["txtGiaNhapSP"];

        $giamoi_SP = $_POST["txtGiaMoiSP"];
        $ngaycapnhat_SP = $_POST["txtNgayCapNhatSP"];
        $trangthai_SP = $_POST["txtTrangThaiSP"];
        $ma_LSP = $_POST["txtMaLSP"];
        $ma_NH = $_POST["txtMaNH"];
        $size_s = $_POST["txtSize"];
        //update anh
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $anh_SP = $_FILES['txtAnhSP']['name'];

            $image_temp = $_FILES['txtAnhSP']['tmp_name'];

            move_uploaded_file($image_temp, "../uploads/$anh_SP");

            $sql = "UPDATE `san_pham` 
            SET tenSP='$ten_SP', anhSP = '$anh_SP' , moTa='$mota_SP', giaNhap='$gianhap_SP', giaMoi='$giamoi_SP', ngayCapNhat='$ngaycapnhat_SP', trangThai='$trangthai_SP', maLSP='$ma_LSP',maNH='$ma_NH' WHERE maSP = $ma_SP";
            $isUpdateOkSP = insert_or_update($sql);
            if ($isUpdateOkSP) {
                header("Location: san-pham.php");
            }

            $arrayS = explode(",", $size_s);

            foreach ($arrayS as  $key => $value) {
                $sqls = "UPDATE `size` SET  `tenSize` = '$value' WHERE maSP =  '$ma_SP')";
                $result = insert_or_update($sqls);
            }
        }
        // cap nhat nhieu anh
        //


    } else if (isset($_POST["txtTenSP"])) {
        $ten_SP = $_POST["txtTenSP"];
        $mota_SP = $_POST["txtMoTaSP"];
        $gianhap_SP = $_POST["txtGiaNhapSP"];
        $giamoi_SP = $_POST["txtGiaMoiSP"];
        $ngaycapnhat_SP = $_POST["txtNgayCapNhatSP"];
        $trangthai_SP = $_POST["txtTrangThaiSP"];
        $ma_NH = $_POST["txtMaNH"];
        $ma_LSP = $_POST["txtMaLSP"];
        $size_s = $_POST["txtSize"];
        $isUploadOk = uploadFile($_FILES["txtAnhSP"], $ten_SP);
        if ($isUploadOk) {
            $anh_SP = str_replace(" ", "_", $ten_SP) . "." . "png";
        } else {
            echo "Insert file thất bại";
        }
        move_uploaded_file($anh_SP, "../uploads/$anh_SP");
        $sql = "INSERT INTO `san_pham`(`tenSP`, `anhSP`, `moTa`,  `giaNhap`,  `giaMoi`, `ngayCapNhat`, `trangThai`, `maLSP`, `maNH`) 
        VALUES ('$ten_SP','$anh_SP','$mota_SP', '$gianhap_SP', '$giamoi_SP','$ngaycapnhat_SP','$trangthai_SP', '$ma_LSP', '$ma_NH')";

        $query = mysqli_query($conn, $sql);

        $ma_SP = mysqli_insert_id($conn);

        //them anh mo ta san pham
        if (isset($_FILES['anhMoTaSP'])) {
            $files = $_FILES["anhMoTaSP"];
            $file_names = $files['name'];

            foreach ($file_names as $key => $value) {

                move_uploaded_file($files['tmp_name'][$key], '../uploads/' . $value);
            }
        }
        foreach ($file_names as $key => $value) {
            $sql = "INSERT INTO `hinh_anh`(`tenHA`, `maSP`) VALUES ('$value', '$ma_SP')";
            $result = insert_or_update($sql);
        }
        if ($query && $_FILES['anhMoTaSP']) {
            $isInsertOkSP = true;
        } else {
            $isInsertOkSP = false;
        }
    }
    if (isset($_POST['txtSize'])) {

        $arrayS = explode(",", $size_s);

        foreach ($arrayS as  $key => $value) {
            $sqls = "INSERT INTO `size`(tenSize, maSP) VALUES ('$value', '$ma_SP')";
            $result = insert_or_update($sqls);
        }
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo isset($_GET["idupdateSP"]) ? "Cập nhật sản phẩm" : "Thêm mới sản phẩm" ?></title>
        <?php require_once 'link.php' ?>
        <style>
            .form-group {
                margin-bottom: 20px;
            }

            label {
                font-weight: 700;
                margin-right: 10px;
            }

            input[type="text"],
            input[type="date"] {
                padding: 5px;
                border: 1px solid #ccc;
                border-radius: 5px;
                width: 100%;
            }

            textarea {
                padding: 5px;
                border: 1px solid #ccc;
                border-radius: 5px;
                width: 100%;
            }

            select {
                padding: 5px;
                border: 1px solid #ccc;
                border-radius: 5px;
                width: 100%;
            }

            .btn-primary,
            .btn-secondary {
                margin-top: 20px;
                margin-right: 10px;
            }

            .row {
                justify-content: center;
            }
        </style>
    </head>

    <body>

        <div style="display: flex; flex-direction: row;">
            <?php
            require_once 'navigation.php';
            ?>
            <ul class="nav flex-column">
                <li class="nav-item"><a class="nav-link" href="san-pham.php">Danh sách sản phẩm</a></li>
                <li class="nav-item"><a class="nav-link" href="update-insert-SP.php"><?php echo isset($_GET["idupdateSP"]) ? "Cập nhật sản phẩm" : "Thêm mới sản phẩm" ?></a></li>
            </ul>

            <div class="row">
                <div class="col-sm-6 text-black">

                    <form class="form-group" action="" method="post" enctype="multipart/form-data">
                        <h1><?php echo isset($_GET["idupdateSP"]) ? "Cập nhật sản phẩm" : "Thêm mới sản phẩm" ?></h1>
                        <?php
                        if (isset($isInsertOkSP)) {
                            if ($isInsertOkSP) {
                                echo "<p style=\"color: green;\">Thêm mới thành công</p>";
                            } else {
                                echo "<p style=\"color: red\">Thêm mới thất bại</p>";
                            }
                        }
                        if (isset($isUpdateOkSP)) {
                            if ($isUpdateOkSP) {
                                echo "<p style=\"color: green;\">Cập nhật thành công</p>";
                            } else {
                                echo "<p style=\"color: red\">Cập nhật thất bại</p>";
                            }
                        }
                        ?>
                        <input type="text" name="txtMaSP" value="<?php echo $maSP ?>" readonly hidden>
                        <div class="form-group">
                            <label for="txtTenSP">Tên sản phẩm:</label>
                            <input type="text" name="txtTenSP" id="txtTenSP" value="<?php echo $tenSP ?>">
                        </div>
                        <div class="form-group">
                            <label for="txtAnhSP">Ảnh đại diện sản phẩm:</label>
                            <input type="file" name="txtAnhSP" id="txtAnhSP">
                            <?php if (!empty($anhSP)) { ?>
                                <img width="200" height="200" src='<?php echo "../uploads/" . $anhSP ?>' alt="">
                            <?php } ?>
                        </div>
                        <div class="form-group">
                            <label for="anhMoTaSP[]">Ảnh mô tả sản phẩm:</label>
                            <input type="file" multiple name="anhMoTaSP[]">
                        </div>
                        <div class="form-group">
                            <label for="txtMoTaSP">Mô tả:</label>
                            <textarea name="txtMoTaSP" id="editor1" cols="30" rows="10"><?php echo $motaSP ?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="txtSize">Size:</label>
                            <input type="text" name="txtSize" id="txtSize" value="<?php echo $size ?>">
                        </div>
                        <div class="form-group">
                            <label for="txtGiaNhapSP">Giá nhập:</label>
                            <input type="text" name="txtGiaNhapSP" id="txtGiaNhapSP" value="<?php echo $gianhapSP ?>">
                        </div>
                        <div class="form-group">
                            <label for="txtGiaMoiSP">Giá mới:</label>
                            <input type="text" name="txtGiaMoiSP" id="txtGiaMoiSP" value="<?php echo $giamoiSP ?>">
                        </div>
                        <div class="form-group">
                            <label for="txtNgayCapNhatSP">Ngày cập nhật:</label>
                            <input type="date" name="txtNgayCapNhatSP" id="txtNgayCapNhatSP" value="<?php echo $ngaycapnhatSP ?>">
                        </div>
                        <div class="form-group">
                            <label for="txtTrangThaiSP">Trạng thái:</label>
                            <input type="text" name="txtTrangThaiSP" id="txtTrangThaiSP" value="<?php echo $trangthaiSP ?>">
                        </div>
                        <div class="form-group">
                            <label for="txtMaLSP">Loại sản phẩm:</label>
                            <?php
                            echo "<select name=\"txtMaLSP\" id=\"txtMaLSP\">";
                            $sql = "SELECT * FROM `loai_san_pham`";
                            $result = select_database($sql);
                            foreach ($result as $row) {
                                $selected = ($maLSP === $row["maLSP"]) ? "selected" : "";
                                echo "<option value=\"$row[maLSP]\" $selected> $row[tenLSP] </option>";
                            };
                            echo "</select>";
                            ?>
                        </div>
                        <div class="form-group">
                            <label for="txtMaNH">Nhãn hiệu:</label>
                            <?php
                            echo "<select name=\"txtMaNH\" id=\"txtMaNH\">";
                            $sql = "SELECT * FROM `nhan_hieu`";
                            $result = select_database($sql);
                            foreach ($result as $row) {
                                $selected = ($maNH === $row["maNH"]) ? "selected" : "";
                                echo "<option value=\"$row[maNH]\" $selected> $row[tenNH] </option>";
                            };
                            echo "</select>";
                            ?>
                        </div>
                        <input type="submit" class="btn btn-primary" value="<?php echo isset($_GET["idupdateSP"]) ? "Cập nhật" : "Thêm mới" ?>" id="btnUI">
                        <input type="reset" class="btn btn-secondary" value="Làm lại">
                    </form>
                </div>
            </div>
            <script>
                CKEDITOR.replace('editor1', {
                    filebrowserBrowseUrl: 'ckfinder/ckfinder.html',
                    filebrowserUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'
                });
            </script>
        </div>
    </body>

    </html>