<?php
require_once 'connection.php';
if(isset($_GET['maNH'])) {
$maNH = $_GET["maNH"];
$sql = "DELETE FROM `nhan_hieu` WHERE `nhan_hieu`.`maNH` = $maNH";
$isOk = insert_or_update($sql);
if ($isOk) {
    header("Location: nhan-hieu.php");
} else {
    echo "Không thể xóa được mời bạn thử lại sau";
}
}
?>
<?php
if(isset($_GET["maLSP"])) {
$maLSP = $_GET["maLSP"];
$sql = "DELETE FROM `loai_san_pham` WHERE `loai_san_pham`.`maLSP` = $maLSP";
$isOk = insert_or_update($sql);
if ($isOk) {
    header("Location: loai-san-pham.php");
} else {
    echo "Không thể xóa được mời bạn thử lại sau";
}
}
?>
<?php
    if(isset($_GET["maSP"])) {
    $maSP = $_GET["maSP"];
    $sql = "DELETE FROM `san_pham` WHERE `maSP` = $maSP";
    $isOk = insert_or_update($sql);
    if ($isOk) {
        header("Location: san-pham.php");
    } else {
        echo "Không thể xóa được mời bạn thử lại sau";
    }
}
    
    
?>