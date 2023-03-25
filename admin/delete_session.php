<?php
session_start();
require 'config.php';
if(isset($_GET['id_movie']) && isset($_GET['id_session']))
{
    $id_session = $_GET['id_session'];
    $id_movie = $_GET['id_movie'];
    $q = "DELETE FROM episode WHERE id_session = $id_session";
    $r = $conn->query($q);
    if(!$r) echo 'Cau truy van bi sai';

    $q_ss = "DELETE FROM session WHERE id_movie = $id_movie";
    $r_ss = $conn->query($q_ss);
    if(!$r_ss) echo 'Cau truy van bi sai';
    else
    {
        $_SESSION['thongbao'] = "* Xóa Thành Công!";
        header ("location:admin_home.php?loadpage=ql_session.php");
    }
}
?>