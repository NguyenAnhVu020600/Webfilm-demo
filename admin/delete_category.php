<?php
session_start();
require 'config.php';
if(isset($_GET['id_category']))
{
    $id_category = $_GET['id_category'];
    $q = "DELETE FROM category WHERE id_category = '$id_category'";
    $r = $conn->query($q);
    if(!$r) echo 'Cau truy van bi sai';
    else
    {
        $_SESSION['thongbao'] = "* Xóa Thành Công!";
        header ("location:admin_home.php?loadpage=ql_category.php");
    }
}
?>