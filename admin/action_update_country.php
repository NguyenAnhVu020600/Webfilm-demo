<?php
    session_start();
    require 'config.php';

    if(isset($_POST['fix'])){
        $id_country = $_POST['id_country'];
        $name = $_POST['name'];
        
        $queryupdate = "UPDATE country SET name ='$name' WHERE id_country = $id_country ";
        $result = $conn->query($queryupdate);
        if ($result === True) {
            $_SESSION['thongbao'] = "* Cập nhật thành công";
            header("location:admin_home.php?loadpage=detail_country.php");
        }
        else echo "Truy vấn bị sai";
        
    }
?>