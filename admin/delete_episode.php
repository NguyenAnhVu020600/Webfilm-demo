<?php
session_start();
require 'config.php';
if(isset($_GET['id_episode']))
{
    $id_episode = $_GET['id_episode'];
    $q = "DELETE FROM episode WHERE id_episode = $id_episode";
    $r = $conn->query($q);
    if(!$r) echo 'Cau truy van bi sai';
    else
    {
        $_SESSION['thongbao'] = "* Xóa Thành Công!";
        header ("location:admin_home.php?loadpage=ql_episode.php");
    }
}
?>