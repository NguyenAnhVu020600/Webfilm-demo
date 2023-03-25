<?php
session_start();
require 'config.php';
if(isset($_POST['add_session']))
{
    $id_movie= $_POST['id_movie'];
    $name = $_POST['name_ss'];
    $number_ep= $_POST['number_ep'];

    $queryadd = "INSERT INTO session (name_ss,number_episode,id_movie)
    VALUES ('$name','$number_ep','$id_movie');";
    $result = $conn->query($queryadd);
    if ($result === True) {
        $_SESSION['thongbao'] = "* Thêm thành công";
        header("location:admin_home.php?loadpage=ql_session.php");
    }
    else echo "Truy vấn bị sai";
}
?>