<?php
session_start();
require 'config.php';
if(isset($_GET['id_country']))
{
    $id_country = $_GET['id_country'];
    $q = "DELETE FROM country WHERE id_country = '$id_country'";
    $r = $conn->query($q);
    if(!$r) echo 'Cau truy van bi sai';
    else
    {
        $_SESSION['thongbao'] = "* Xóa Thành Công!";
        header ("location:admin_home.php?loadpage=ql_country.php");
    }
}
?>