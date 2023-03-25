<?php
    session_start();
    require 'config.php';

    if(isset($_POST['fix'])){
        $id_episode = $_POST['id_episode'];
        $name_ep = $_POST['name_ep'];
        $view_ep= $_POST['view_ep'];
        $link = $_POST['link'];
        $status = $_POST['status'];
        if (isset($_FILES['thumbnail']['name'])) {
            $thumbnail = $_FILES['thumbnail']['name'];
            // upload
            $path = "../Data/thumbnail_ep/";
            $file = $path . basename($_FILES["thumbnail"]["name"]);
            if (move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $file)) {
            } else {
                echo "<a class='btn-large red waves-effects light-effects'>
                    Sorry, there was an error uploading your picture
                </a>";
            }
            $queryupdate = "UPDATE episode SET name_ep ='$name_ep',
            view_ep = '$view_ep',thumbnail_ep='$thumbnail',
            movie_link = '$link', status = '$status'
            WHERE id_episode = $id_episode";
            $result = $conn->query($queryupdate);
            if ($result === True) {
                $_SESSION['thongbao'] = "* Cập nhật thành công";
                header("location:admin_home.php?loadpage=ql_episode.php");
            }
            else echo "Truy vấn bị sai";
        }
        else {
            $queryupdate = "UPDATE episode SET name_ep ='$name_ep',
            view_ep = '$view_ep', movie_link = '$link', status = '$status'
            WHERE id_episode = $id_episode";
            $result = $conn->query($queryupdate);
            if ($result === True) {
                $_SESSION['thongbao'] = "* Cập nhật thành công";
                header("location:admin_home.php?loadpage=ql_episode.php");
            }
            else echo "Truy vấn bị sai";
        }
    }
?>