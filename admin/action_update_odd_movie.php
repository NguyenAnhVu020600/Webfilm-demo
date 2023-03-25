<?php
    session_start();
    require 'config.php';

    if(isset($_POST['fix'])){
        $id_movie = $_POST['id_movie'];
        $link= $_POST['link'];

        
        $queryupdate = "UPDATE odd_movie SET link ='$link'
        WHERE id_movie = $id_movie ";
        $result = $conn->query($queryupdate);
        if ($result === True) {
            $_SESSION['thongbao'] = "* Cập nhật thành công";
            header("location:admin_home.php?loadpage=ql_odd_movie.php");
        }
        else echo "Truy vấn bị sai";
        
    }
?>