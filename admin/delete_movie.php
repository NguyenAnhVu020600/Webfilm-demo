<?php
session_start();
require 'config.php';
if(isset($_GET['id_movie']))
{
    $id_movie = $_GET['id_movie'];

    $q_new = "SELECT * FROM new
    WHERE id_movie = $id_movie";
    $r_new = $conn->query($q_new);
    if(!$r_new) echo 'Cau truy van bi sai';
    else{
        $q_delete_new = "DELETE FROM new WHERE id_movie = '$id_movie'";
        $r_delete_new = $conn->query($q_delete_new);
        if(!$r_delete_new) echo 'Cau truy van bi sai 4';
    }

    $q_odd = "SELECT * FROM odd_movie
    WHERE id_movie = $id_movie";
    $r_odd = $conn->query($q_odd);
    if(!$r_odd) echo 'Cau truy van bi sai';
    else{
        $q_delete_odd = "DELETE FROM odd_movie WHERE id_movie = '$id_movie'";
        $r_delete_odd = $conn->query($q_delete_odd);
        if(!$r_delete_odd) echo 'Cau truy van bi sai 5';
    }

    $q = "SELECT movie.id_movie,session.id_session FROM movie,session
    WHERE movie.id_movie = session.id_movie AND movie.id_movie = $id_movie";
    $r = $conn->query($q);
    if(!$r) echo 'Cau truy van bi sai';
    if ($r->num_rows != 0) {
        while ($row = $r->fetch_assoc()) {
            $id_session = $row['id_session'];

            $q_delete_ep = "DELETE FROM episode WHERE id_session = '$id_session'";
            $r_delete_ep = $conn->query($q_delete_ep);
            if(!$r_delete_ep) echo 'Cau truy van bi sai 1';
        }
    }
    $q_delete_ss = "DELETE FROM session WHERE id_movie = '$id_movie'";
    $r_delete_ss = $conn->query($q_delete_ss);
    if(!$r_delete_ss) echo 'Cau truy van bi sai 2';

    $q_delete_mv = "DELETE FROM movie WHERE id_movie = '$id_movie'";
    $r_delete_mv = $conn->query($q_delete_mv);
    if(!$r_delete_mv) echo 'Cau truy van bi sai 3';
    else
    {
        $_SESSION['thongbao'] = "* Xóa Thành Công!";
        header ("location:admin_home.php?loadpage=ql_movie.php");
    }
    

   
}
?>