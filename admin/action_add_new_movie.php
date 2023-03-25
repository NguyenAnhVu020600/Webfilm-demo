<?php
require 'config.php';
if (session_id() === '') session_start();
if (isset($_GET['id_movie'])) {
    $id_movie = $_GET['id_movie'];
    $query_new= "SELECT * from new WHERE id_movie = $id_movie";
    $result_new = $conn->query($query_new);
    if($result_new === TRUE)
    {
        $_SESSION['thongbao'] = "* Phim này đã có trong danh sách phim mới";
        header("location:admin_home.php?loadpage=ql_movie.php");
    }
    else
    {
        $queryadd = "INSERT INTO new (id_movie)
        VALUES ('$id_movie');";
            $result = $conn->query($queryadd);
            if ($result === True) {
                $_SESSION['thongbao'] = "* Thêm thành công";
                header("location:admin_home.php?loadpage=ql_movie.php");
            }
        else echo "Truy vấn bị sai";
    }
    
}
?>