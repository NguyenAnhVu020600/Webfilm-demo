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
            $queryupdate = "UPDATE movie,new SET movie.name ='$name',
            movie.description = '$description',new.thumbnail='$thumbnail',
            movie.id_general_cate = '$id_general_cate', movie.id_country = '$id_country'
            WHERE movie.id_movie = new.id_movie AND movie.id_movie = $id_movie ";
            $result = $conn->query($queryupdate);
            if ($result === True) {
                $_SESSION['thongbao'] = "* Cập nhật thành công";
                header("location:admin_home.php?loadpage=ql_new_movie.php");
            }
            else echo "Truy vấn bị sai";
        }
        else {
            $queryupdate = "UPDATE movie,new SET movie.name ='$name',
            movie.description = '$description',
            movie.id_general_cate = '$id_general_cate', movie.id_country = '$id_country'
            WHERE movie.id_movie = new.id_movie AND movie.id_movie = $id_movie ";
            $result = $conn->query($queryupdate);
            if ($result === True) {
                $_SESSION['thongbao'] = "* Cập nhật thành công";
                header("location:admin_home.php?loadpage=ql_new_movie.php");
            }
            else echo "Truy vấn bị sai";
        }
    }
?>