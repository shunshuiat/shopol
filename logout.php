<?php
    session_start();    
    session_destroy();
    header("Location: login.php");
    echo "<script>alert('Đăng xuất thành công')</script>";