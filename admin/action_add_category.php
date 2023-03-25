<?php
    session_start();
    require 'config.php';

    if(isset($_POST['add'])){
        $name = $_POST['name'];
        
        $queryadd = "INSERT INTO category (name_category)
        VALUES ('$name');";
        $result = $conn->query($queryadd);
        if ($result === True) {
            $_SESSION['thongbao'] = "* Thêm thành công";
            header("location:admin_home.php?loadpage=ql_category.php");
        }
        else echo "Truy vấn bị sai";
        
    }
?>