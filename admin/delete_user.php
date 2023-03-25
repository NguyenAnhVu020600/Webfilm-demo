<?php
session_start();
require 'config.php';
if(isset($_GET['id_user']))
{
    $id_user = $_GET['id_user'];
    $q = "DELETE FROM user WHERE id_user = '$id_user'";
    $r = $conn->query($q);
    if(!$r) echo 'Cau truy van bi sai';
    else
    {
        $_SESSION['thongbao'] = "Xóa Thành Công!";
        header ("location:admin_home.php?loadpage=ql_user.php");
    }
}
?>