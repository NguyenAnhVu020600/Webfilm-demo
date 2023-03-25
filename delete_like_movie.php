<?php
    session_start();
    require "config.php";
    $id_user = $_SESSION['id_user'];
    
    if( isset($_GET['id_movie'])){
        $id_movie = $_GET['id_movie'];
    }
    $query = "DELETE FROM list_like WHERE id_user = $id_user AND id_movie = $id_movie";
    $result = $conn->query($query);
    if(!$result) echo "câu truy vấn bị sai";
    else
    {
        $_SESSION['thongbao'] = "* Xóa Thành Công!";
        header ("location:movie_like.php");
    }
?>