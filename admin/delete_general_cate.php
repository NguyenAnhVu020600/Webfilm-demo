<?php
session_start();
require 'config.php';
if(isset($_GET['id_general_cate']))
{
    $id_general_cate = $_GET['id_general_cate'];
    $q = "DELETE FROM general_cate WHERE id_general_cate = '$id_general_cate'";
    $r = $conn->query($q);
    if(!$r) echo 'Cau truy van bi sai';
    else
    {
        $_SESSION['thongbao'] = "* Xóa Thành Công!";
        header ("location:admin_home.php?loadpage=ql_general_cate.php");
    }
}
?>