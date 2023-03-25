<?php
session_start();
require 'config.php';
if(isset($_GET['id_movie']))
{
    $id_movie = $_GET['id_movie'];
    $q = "DELETE FROM odd_movie WHERE id_movie= $id_movie";
    $r = $conn->query($q);
    if(!$r) echo 'Cau truy van bi sai';
    else
    {
        $_SESSION['thongbao'] = "* Xóa Thành Công!";
        header ("location:admin_home.php?loadpage=ql_odd_movie.php");
    }
}
?>