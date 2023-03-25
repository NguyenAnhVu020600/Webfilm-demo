<?php
    session_start();
    require 'config.php';

    if(isset($_POST['fix'])){
        $id_user = $_POST['id_user'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        if (isset($_FILES['avatar']['name'])) {
            $avatar = $_FILES['avatar']['name'];
            // upload
            $path = "../Data/img_user/";
            $file = $path . basename($_FILES["avatar"]["name"]);
            if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $file)) {
            } else {
                echo "<a class='btn-large red waves-effects light-effects'>
                    Sorry, there was an error uploading your picture
                </a>";
            }
            $queryupdate = "UPDATE user SET username ='$username',
            password = '$password',avatar='$avatar' WHERE id_user = $id_user ";
            $result = $conn->query($queryupdate);
            if ($result === True) {
                $_SESSION['thongbao'] = "* Cập nhật thành công";
                header("location:admin_home.php?loadpage=detail_user.php");
            }
            else echo "Truy vấn bị sai";
        }
        else {
            $queryupdate = "UPDATE user SET username ='$username', password = '$password' WHERE id_user = $id_user ";
            $result = $conn->query($queryupdate);
            if ($result === True) {
                $_SESSION['thongbao'] = "Cập nhật thành công";
                header("location:admin_home.php?loadpage=detail_user.php");
            }
            else echo "Truy vấn bị sai";
        }
    }
?>