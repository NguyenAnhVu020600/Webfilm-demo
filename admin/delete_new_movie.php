<?php
session_start();
require 'config.php';
if(isset($_GET['id_movie']))
{
    $id_movie = $_GET['id_movie'];
    $q = "DELETE FROM new WHERE id_movie= $id_movie";
    $r = $conn->query($q);
    if(!$r) echo 'Cau truy van bi sai';
    else
    {
        $_SESSION['thongbao'] = "* Xóa Thành Công!";
        header ("location:admin_home.php?loadpage=ql_new_movie.php");
    }
}
?>