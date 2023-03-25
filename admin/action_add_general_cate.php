<?php
    session_start();
    require 'config.php';

    if(isset($_POST['add'])){
        $name = $_POST['name'];
        
        $queryadd = "INSERT INTO general_cate (name)
        VALUES ('$name');";
        $result = $conn->query($queryadd);
        if ($result === True) {
            $_SESSION['thongbao'] = "* Thêm thành công";
            header("location:admin_home.php?loadpage=ql_general_cate.php");
        }
        else echo "Truy vấn bị sai";
        
    }
?>