<?php
require_once 'navigation.php';
require_once 'connection.php';
$tenSP = "";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KINGOFSHOES</title>
    <link rel="shortcut icon" href="./image/icon.png" type="image/x-icon">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="./css/detail.css">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <script src="./js/detail.js"></script>

</head>

<body>
    <?php
    require_once 'nhan-hieu.php';
    ?>

    <div class="pd-wrap">
        <div class="container">

            <div class="row">
                <div class="col-md-6">
                    <div id="slider" class="owl-carousel product-slider">
                        <?php
                        $sql = "SELECT * FROM san_pham";
                        if (isset($_POST['maSP'])) {
                            $maSP = $_GET["maSP"];
                            $sql .= " WHERE `maSP` = '$maSP'";
                            $result = mysqli_query($conn, $sql);
                            foreach ($result as $row) {
                                $anhSP = $row["anhSP"];
                            }
                            echo "
                                    <div class=\"item\">
                                        <img src=\"./uploads/$anhSP\" alt=\"Ảnh minh họa\"/>
                                    </div>";
                        }
                        ?>
                        <?php
                        $sqlm = "SELECT * FROM `hinh_anh`";
                        if (isset($_GET["maSP"])) {
                            $maSP = $_GET["maSP"];
                            $sqlm .= " WHERE `maSP` = '$maSP'";
                            $result = mysqli_query($conn, $sqlm);
                            foreach ($result as $row) {
                                $anhMoTa = $row["tenHA"];
                                echo "
                                    <div class=\"item\">
                                        <img src=\"./uploads/$anhMoTa\" alt=\"Ảnh minh họa\"/>
                                    </div>";
                            }
                        }
                        ?>
                    </div>
                    <div id="thumb" class="owl-carousel product-thumb">
                        <?php
                        $sql = "SELECT * FROM san_pham";
                        if (isset($_GET['maSP'])) {
                            $maSP = $_GET["maSP"];
                            $sql .= " WHERE `maSP` = '$maSP'";
                            $result = mysqli_query($conn, $sql);
                            foreach ($result as $row) {
                                $anhSP = $row["anhSP"];
                            }
                            echo "
                                    <div class=\"item\">
                                        <img src=\"./uploads/$anhSP\" alt=\"Ảnh minh họa\"/>
                                    </div>";
                        }
                        ?>
                        <?php
                        $sqlm = "SELECT * FROM `hinh_anh`";
                        if (isset($_GET["maSP"])) {
                            $maSP = $_GET["maSP"];
                            $sqlm .= " WHERE `maSP` = '$maSP'";
                            $result = mysqli_query($conn, $sqlm);
                            foreach ($result as $row) {
                                $anhMoTa = $row["tenHA"];
                                echo "
                                    <div class=\"item item-img\">
                                        <img src=\"./uploads/$anhMoTa\" alt=\"Ảnh minh họa\"/>
                                    </div>";
                            }
                        }
                        ?>

                    </div>
                </div>

                <div class="col-md-6">
                    <div class="product-dtl">
                        <div class="product-info">

                            <div class="product-name">
                                <?php
                                $sql = "SELECT * FROM san_pham";

                                $maSP = $_GET["maSP"];
                                $sql .= " WHERE `maSP` = '$maSP'";
                                $result = mysqli_query($conn, $sql);
                                foreach ($result as $row) {
                                    $tenSP .= $row["tenSP"];
                                    echo "$tenSP";
                                }
                                ?>
                            </div>
                            <div class="product-price-discount">
                                <span>
                                    <?php
                                    $sql = "SELECT * FROM san_pham";

                                    $maSP = $_GET["maSP"];
                                    $sql .= " WHERE `maSP` = '$maSP'";
                                    $result = mysqli_query($conn, $sql);
                                    foreach ($result as $row) {
                                        $price = $row["giaMoi"];
                                        echo currency_format($price);
                                    }
                                    ?>
                                </span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label for="size">Size</label>
                                <form>
                                    <?php
                                    $maSP = $_GET["maSP"];
                                    $sql = "SELECT * FROM size WHERE maSP = '$maSP'";
                                    $result = select_database($sql);
                                    foreach ($result as $row) {
                                        $maSize = $row["maSize"];
                                        $tenSize = $row["tenSize"];
                                        echo "<button type=\"button\" class=\"btn btn-outline-info size-btn\" data-ma-size=\"$maSize\" data-ten-size=\"$tenSize\">$tenSize</button>";
                                    }
                                    ?>
                                </form>
                                <!-- 
                                <script>
                                    $(document).ready(function() {
                                        var maSP = "<?php echo $_GET['maSP'] ?>"; // Lấy mã sản phẩm từ URL

                                        $('.size-btn').click(function() { // Khi người dùng click vào nút size
                                            var maSize = $(this).data('ma-size'); // Lấy giá trị maSize từ data attribute
                                            var tenSize = $(this).data('ten-size'); // Lấy giá trị tenSize từ data attribute
                                            $(this).addClass('active').siblings().removeClass('active'); // Thêm class active cho nút hiện tại và xoá class active của các nút còn lại
                                            // Lưu maSize và tenSize vào biến trong JavaScript
                                            sessionStorage.setItem("maSize_" + maSP, maSize);
                                            sessionStorage.setItem("tenSize_" + maSP, tenSize);
                                        });

                                        $('form').submit(function(e) { // Khi người dùng submit form
                                            e.preventDefault(); // Ngăn chặn việc submit form
                                            var maSize = sessionStorage.getItem("maSize_" + maSP); // Lấy maSize từ biến trong JavaScript
                                            var tenSize = sessionStorage.getItem("tenSize_" + maSP); // Lấy tenSize từ biến trong JavaScript
                                            if (!maSize || !tenSize) { // Nếu không có giá trị maSize hoặc tenSize
                                                alert("Vui lòng chọn size trước khi thêm vào giỏ hàng."); // Hiển thị thông báo lỗi
                                                return; // Dừng chương trình
                                            }
                                            $.ajax({
                                                url: 'shopping_update.php',
                                                method: 'POST',
                                                data: {
                                                    maSP: maSP,
                                                    maSize: maSize,
                                                    tenSize: tenSize
                                                }, // Gửi thông tin sản phẩm, maSize và tenSize
                                                success: function(response) {
                                                    // Xử lý kết quả trả về từ shopping_update.php nếu cần
                                                },
                                                error: function() {
                                                    alert('Đã có lỗi xảy ra. Vui lòng thử lại sau.');
                                                }
                                            })
                                        });
                                    });
                                </script> -->
                            </div>
                        </div>

                        <div class="product-count">
                            <?php
                            $maSP = $_GET["maSP"];
                            echo "<a class=\"nav-link\" href=\"shopping_add.php?maSP=" . $maSP . "\"><input class=\"btn btn-primary\" type=\"submit\" value=\"Thêm giỏ hàng\"></a>";
                            ?>

                        </div>

                    </div>
                </div>
            </div>
            <div class="product-info-tabs">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="description-tab" data-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true">Description</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review" aria-selected="false">Reviews (0)</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                        <?php

                        $maSP = $_GET["maSP"];

                        $sql = "SELECT moTa FROM san_pham WHERE `maSP` = '$maSP'";

                        $result = mysqli_query($conn, $sql);
                        foreach ($result as $row) {
                            $des = $row['moTa'];
                        }
                        echo $des;
                        ?>
                    </div>

                    <div class="tab-pane " id="review" role="tabpanel" aria-labelledby="review-tab">
                        <div class="review-heading">REVIEWS</div>
                        <p class="mb-20">There are no reviews yet.</p>
                        <form class="review-form">
                            <div class="form-group">
                                <label>Your message</label>
                                <textarea class="form-control" rows="10"></textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="" class="form-control" placeholder="Name*">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" name="" class="form-control" placeholder="Email Id*">
                                    </div>
                                </div>
                            </div>
                            <button class="round-black-btn">Submit Review</button>
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="	sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <style>
        div.item-img>img {
            width: 110px !important;
            margin-left: 10px;
        }

        #img-pro {
            width: 300px !important;
            height: 300px !important;
        }

        select.form-control:not([size]):not([multiple]) {
            height: 40px;
        }
    </style>
    <h1>Sản phẩm liên quan</h1>
    <div style="display: flex; flex-direction: row;">

        <?php

        $sqls = "SELECT sp.maSP, sp.giaMoi, sp.anhSP, sp.tenSP, nh.tenNH 
                FROM san_pham sp 
                INNER JOIN nhan_hieu nh ON nh.maNH = sp.maNH 
                WHERE sp.maSP != $maSP AND sp.maNH = (SELECT maNH FROM san_pham WHERE maSP = $maSP) 
                ORDER BY RAND()
                LIMIT 4";

        $result = mysqli_query($conn, $sqls);
        foreach ($result as $row) {
            echo "<div class=\"col-xs-3 col-sm-3 col-md-3 col-lg-3\">
              <div class=\"thumbnail\" style=\"width: 300px; height:600px\">
                  <a href=\"detail.php?maSP=" . $row['maSP'] . "\" onclick=\"increaseView(" . $row['maSP'] . ")\">
                      <img id=\"img-pro\" src=\"./uploads/" . $row["anhSP"] . "\">
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
                  <div class=\"caption text-center\">
                      <h3>" . $row["tenSP"] . "</h3>
                      <p><b>" . currency_format($row["giaMoi"]) . "</b></p>
                  </div>
              </div>
          </div>";
        }
        echo "</div>";
        ?>

        <footer style="background-color: whitesmoke;">
            <?php
            require_once 'footer.php';
            ?>
        </footer>
</body>

</html>