<?php
session_start();
require 'config.php';
if(isset($_POST['add_movie']))
{
    $name = $_POST['name'];
    $id_country = $_POST['id_country'];
    $id_general_cate = $_POST['id_general_cate'];
    $description = $_POST['des'];

    if (isset($_FILES['thumbnail_movie']['name'])) {
        $thumbnail_movie = $_FILES['thumbnail_movie']['name'];
        // upload
        $path = "../Data/thumbnail/";
        $file = $path . basename($_FILES["thumbnail_movie"]["name"]);
        if (move_uploaded_file($_FILES["thumbnail_movie"]["tmp_name"], $file)) {
        } 
        else {
            echo "<a class='btn-large red waves-effects light-effects'>
                Sorry, there was an error uploading your picture
            </a>";
        }
        $queryadd = "INSERT INTO movie (name,id_country,id_general_cate,thumbnail,view,folow,description)
        VALUES ('$name','$id_country','$id_general_cate','$thumbnail_movie',0,0,'$description');";
        $result = $conn->query($queryadd);
        if ($result === True) {
            $_SESSION['thongbao'] = "* Thêm thành công";
            header("location:admin_home.php?loadpage=ql_movie.php");
        }
        else echo "Truy vấn bị sai";
    }
    else {
        $queryadd = "INSERT INTO movie (name,id_country,id_general_cate,view,folow,description)
        VALUES ('$name','$id_country','$id_general_cate',0,0,'$description');";
        $result = $conn->query($queryadd);
        if ($result === True) {
            $_SESSION['thongbao'] = "* Thêm thành công";
            header("location:admin_home.php?loadpage=ql_movie.php");
        }
        else echo "Truy vấn bị sai";
    }
    
    
}
?>