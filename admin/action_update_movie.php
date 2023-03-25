<?php
    session_start();
    require 'config.php';

    if(isset($_POST['fix'])){
        $id_movie = $_POST['id_movie'];
        $name = $_POST['name'];
        $id_country = $_POST['id_country'];
        $id_general_cate = $_POST['id_general_cate'];
        $description = $_POST['des'];
        if (isset($_FILES['thumbnail']['name'])) {
            $thumbnail = $_FILES['thumbnail']['name'];
            // upload
            $path = "../Data/thumbnail/";
            $file = $path . basename($_FILES["thumbnail"]["name"]);
            if (move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $file)) {
            } else {
                echo "<a class='btn-large red waves-effects light-effects'>
                    Sorry, there was an error uploading your picture
                </a>";
            }
            $queryupdate = "UPDATE movie SET name ='$name',
            description = '$description',thumbnail='$thumbnail',
            id_general_cate = '$id_general_cate', id_country = '$id_country'
            WHERE id_movie = $id_movie ";
            $result = $conn->query($queryupdate);
            if ($result === True) {
                $_SESSION['thongbao'] = "* Cập nhật thành công";
                header("location:admin_home.php?loadpage=ql_movie.php");
            }
            else echo "Truy vấn bị sai";
        }
        else {
            $queryupdate = "UPDATE movie SET name ='$name',
            description = '$description',
            id_general_cate = '$id_general_cate', id_country = '$id_country'
            WHERE id_movie = $id_movie ";
            $result = $conn->query($queryupdate);
            if ($result === True) {
                $_SESSION['thongbao'] = "* Cập nhật thành công";
                header("location:admin_home.php?loadpage=ql_movie.php");
            }
            else echo "Truy vấn bị sai";
        }
    }
?>