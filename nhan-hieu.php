<?php
require_once 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KINGOFSHOES</title>
    <link rel="shortcut icon" href="./image/icon.png" type="image/x-icon">

</head>

<body>
    <div>
        <ul class="nav">
            <?php
            $sql = "SELECT * FROM `nhan_hieu`";
            $result = select_database($sql);
            foreach ($result as $row) {
                echo "<li class=\" dropdown\">
                        <a class=\"dropdown-toggle col-sm-2  dropbtn\" style=\"font-size: 20px\" href=\"index.php?maNH=" . $row["maNH"] . "\">" . $row["tenNH"] . "</a>";
            ?>
                <ul class="dropdown-menu">
                    <li>
                        <?php
                        $sql = "SELECT lsp.maLSP, lsp.tenLSP FROM loai_san_pham lsp 
                                inner join `san_pham` sp on sp.maLSP = lsp.maLSP
                                inner join `nhan_hieu` nh on nh.maNH = sp.maNH 
                                WHERE nh.maNH = " . $row['maNH'] . "
                                GROUP BY lsp.maLSP, lsp.tenLSP
                                ";
                        $result = mysqli_query($conn, $sql);
                        foreach ($result as $row) {
                            echo "<a  class=\"dropdown-item\" href=\"index.php?maLSP=" . $row["maLSP"] . "\">" . $row["tenLSP"] . "</a>";
                        }
                        ?>
                    </li>
                </ul>
            <?php
                echo "</li>";
            }
            ?>
        </ul>
    </div>

    <style>
        .navbar-nav .nav-link {
            color: #fff;
        }
        .dropend .dropdown-toggle {
            color: salmon;
        }
        .dropdown-item:hover {
            background-color: lightsalmon;
            color: #fff;
        }
        .dropdown .dropdown-menu {
            display: none;
        }

        .dropdown:hover>.dropdown-menu,
        .dropend:hover>.dropdown-menu {
            display: block;
        }

        @media screen and (min-width: 769px) {
            .dropend:hover>.dropdown-menu {
                position: absolute;
            }
        }
    </style>
</body>

</html>