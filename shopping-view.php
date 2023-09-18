<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    
<?php
require_once 'connection.php';

if (isset($_GET['maSP'])) {
    $maSP = $_GET['maSP'];

    // Lấy số lượng lượt xem hiện tại của sản phẩm
    $sql = "SELECT luotXem FROM san_pham WHERE maSP=$maSP";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $views = $row['luotXem'];

    // Tăng số lượng lượt xem lên 1
    $views++;

    // Cập nhật số lượng lượt xem mới
    $sql = "UPDATE san_pham SET luotXem=$views WHERE maSP=$maSP";
    $conn->query($sql);

    // Trả về số lượng lượt xem mới cho trình duyệt
    echo "Lượt xem".$views;
}
?>
</body>

</html>