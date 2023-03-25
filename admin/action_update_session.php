<?php
    session_start();
    require 'config.php';

    if(isset($_POST['fix'])){
        $id_movie = $_POST['id_movie'];
        $id_session = $_POST['id_session'];
        $name = $_POST['name'];
        $number_ep = $_POST['number_ep'];
        
        $queryupdate = "UPDATE session SET name_ss ='$name',
        number_episode = '$number_ep'
        WHERE id_movie = $id_movie AND id_session = $id_session" ;
        $result = $conn->query($queryupdate);
        if ($result === True) {
            $_SESSION['thongbao'] = "* Cập nhật thành công";
            header("location:admin_home.php?loadpage=ql_session.php");
        }
        else echo "Truy vấn bị sai";
       
    }
?>