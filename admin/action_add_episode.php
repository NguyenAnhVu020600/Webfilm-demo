<?php
session_start();
require 'config.php';
if(isset($_POST['add_episode']))
{
    $id_session = $_POST['id_session'];
    $name_ep = $_POST['name_ep'];
    $link = $_POST['link'];
    $status = $_POST['status'];

    if (isset($_FILES['thumbnail_ep']['name'])) {
        $thumbnail_ep = $_FILES['thumbnail_ep']['name'];
        // upload
        $path = "../Data/thumbnail_ep/";
        $file = $path . basename($_FILES["thumbnail_ep"]["name"]);
        if (move_uploaded_file($_FILES["thumbnail_ep"]["tmp_name"], $file)) {
        } 
        else {
            echo "<a class='btn-large red waves-effects light-effects'>
                Sorry, there was an error uploading your picture
            </a>";
        }
        $queryadd = "INSERT INTO episode (name_ep,thumbnail_ep,view_ep,movie_link,status,id_session)
        VALUES ('$name_ep','$thumbnail_ep',0,'$link','$status','$id_session');";
        $result = $conn->query($queryadd);
        if ($result === True) {
            $_SESSION['thongbao'] = "* Thêm thành công";
            header("location:admin_home.php?loadpage=ql_episode.php");
        }
        else echo "Truy vấn bị sai 1";
    }
    else{
        $queryadd = "INSERT INTO episode (name_ep,view_ep,movie_link,status,id_session)
        VALUES ('$name_ep',0,'$link','$status','$id_session');";
        $result = $conn->query($queryadd);
        if ($result === True) {
            $_SESSION['thongbao'] = "* Thêm thành công";
            header("location:admin_home.php?loadpage=ql_episode.php");
        }
        else echo "Truy vấn bị sai 2";
    }

}
?>