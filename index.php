</html>
<?php
require_once 'navigation.php';
require_once 'connection.php';
require_once 'header.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KINGOFSHOES</title>
    <link rel="shortcut icon" href="./image/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    
</head>

<body>
    <!-- <?php
            echo  $_SESSION["maKH"];
            echo $_SESSION["taiKhoan"];
            echo $_SESSION["tenKH"];
            echo $_SESSION["diaChi"];
            echo $_SESSION["dienThoai"];
            echo $_SESSION["email"];
            echo  $_SESSION["ngaySinh"];
            echo $_SESSION['gioiTinh'];
            ?> -->

    <?php
    require_once 'nhan-hieu.php';
    ?>
    <script>
        $('.carousel').carousel('cycle')({
            interval: 10
        })
    </script>
    <!-- Carousel -->
    <div id="demo" class="carousel slide" data-bs-ride="carousel">

        <!-- Indicators/dots -->
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
        </div>

        <!-- The slideshow/carousel -->
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="./image/ban1.png" width="1000px" height="400px" class="d-block w-100">
            </div>
            <div class="carousel-item">
                <img src="./image/ban2.png" width="1000px" height="400px" class="d-block w-100">
            </div>
            <div class="carousel-item">
                <img src="./image/ban3.png" width="1000px" height="400px" class="d-block w-100">
            </div>
        </div>

        <!-- Left and right controls/icons -->
        <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>

    <form action="" method="get" class="navbar navbar-expand-sm bg-light" style="justify-content: right;">
        <select class=" form-control mr-sm-2 navbar-nav" name="objOption" id="optPrice" onchange="sortByPrice()" style="width: 100px;">
            <option value="">Mặc định <strong>↓</strong></option>
            <option value="asc">Giá tăng dần</option>
            <option value="desc">Giá giảm dần</option>
        </select>
        <input class="form-control mr-sm-2" type="text" name="txtPriceMin" placeholder="Giá thấp nhất" style="width: 140px;">
        <input class="form-control mr-sm-2" type="text" name="txtPriceMax" placeholder="Giá cao nhất" style="width: 140px;">
        <input class="btn btn-outline-success my-2 my-sm-0" style="height: 32px;" type="submit" name="objOption" value="Lọc" style="width: 100px;">
    </form>



        

    <div style="display: flex; flex-direction: column;">
        <div>
            <?php
            $sql = "SELECT * FROM `san_pham`";

            if (isset($_GET["maNH"])) {
                $maNH = $_GET["maNH"];
                $sql .= "where `maNH` = $maNH";
            }
            if (isset($_GET["maLSP"])) {
                $maLSP = $_GET["maLSP"];
                $sql .= "WHERE `maLSP` = $maLSP";
            }
            if (isset($_GET["txtSearch"])) {
                $search = $_GET["txtSearch"];
                $sql .= " WHERE `tenSP` LIKE '%$search%'";
            }
            if (isset($_GET["sort"])) {
                $sort = $_GET["sort"];
                $sql .= " ORDER BY `san_pham`.`giaMoi` $sort";
            }
            // Lọc
            if (isset($_GET["txtPriceMin"]) && isset($_GET["txtPriceMax"])) {
                $min = $_GET["txtPriceMin"];
                $max = $_GET["txtPriceMax"];
                $sql .= "WHERE `giaMoi` >= $min AND `giaMoi` <= $max";
            }


            $result = select_database($sql);
            foreach ($result as $row) {
                echo "
                        <div class=\"col-xs-3 col-sm-3 col-md-3 col-lg-3\">
                            <div class=\"thumbnail\" style=\"width: 300px; height:600px\">";
            ?>

                <a href="detail.php?maSP=<?php echo $row['maSP']; ?>" onclick="increaseView(<?php echo $row['maSP']; ?>)">
                    <img id="img-pro" src="./uploads/<?php echo $row["anhSP"] ?>">
                </a>
                
                <script>
                    function increaseView(id) {
                        var xhr = new XMLHttpRequest();
                        xhr.open('GET', 'shopping-view.php?maSP=' + id);
                        xhr.onload = function() {
                            if (xhr.status === 200) {
                                var viewCount = document.getElementById('view_count_' + id);
                                viewCount.innerHTML = xhr.responseText;
                            } else {
                                console.error(xhr.statusText);
                            }
                        };
                        xhr.onerror = function() {
                            console.error(xhr.statusText);
                        };
                        xhr.send();
                    }
                </script>
            <?php
                echo "                          
                                <div class=\"caption text-center\">
                                    <h3>" . $row["tenSP"] . "</h3>
                                    <p>
                                        <b>" . currency_format($row["giaMoi"]) . "</b>
                                    </p>
                                    
                                </div>
                            </div>
                        </div>

                        ";
            }; ?>
        </div>
        <style>
            #img-pro {
                width: 300px !important;
                height: 300px !important;
            }

            div.thumbnail {
                height: 500px !important;
            }

            .carousel-inner>.item>a>img,
            .carousel-inner>.item>img,
            .img-responsive,
            .thumbnail a>img,
            .thumbnail>img {
                height: 400 px !important;
            }
        </style>
        <footer style="background-color: whitesmoke;">
            <?php
            require_once 'footer.php';
            ?> 
        </footer>
    </div>
</body>

</html>