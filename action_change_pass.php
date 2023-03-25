<?php
session_start();

if (isset($_POST['change'])) {
    require 'config.php';
    $id_user = $_SESSION['id_user'];
    $current_password = $_POST['current_password'];
    $new_password = ($_POST['new_password']);
    $password_confirmation = ($_POST['password_confirmation']);

    $query = "SELECT * FROM user WHERE  password = '$current_password' AND id_user = $id_user";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    if ($result->num_rows == 1) {
        if($new_password == $password_confirmation)
        {
            $q = "UPDATE user SET password = '$new_password' WHERE id_user = '$id_user'";
            $result = $conn->query($q);
            if(!$result) echo "truy vấn sai";
            if($result === TRUE)
            {
                $_SESSION['thongbao'] = "Đổi mật khẩu thành công";
                header ("location:change_password.php");
            }
        }
        else
        {
            $_SESSION['thongbao'] = "Mật khẩu không trùng khớp";
            header ("location:change_password.php");
        }
    }
    else 
    {
        $_SESSION['thongbao'] = "Mật khẩu hiện tại không đúng";
        header ("location:change_password.php");
    }
    
}
?>