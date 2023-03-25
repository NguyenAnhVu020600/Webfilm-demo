<?php
session_start();

if (isset($_POST['login'])) {
    require 'config.php';
    $email = $_POST['email'];
    $password = ($_POST['password']);

    $query = "SELECT * FROM user WHERE email = '$email' and password = '$password'";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    if ($result->num_rows == 1) {
        $_SESSION['email'] = $row['email'];
        $_SESSION['id_user'] = $row['id_user'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['avatar'] = $row['avatar'];
        $_SESSION['role'] = $row['role'];
        header('location:index.php');
        if($_SESSION['role'] == 'admin')
        {
            header('location:admin/admin_home.php');
        }
    }
    else
    {
        $_SESSION['thongbaologin'] = "Sai Email hoặc password ! Vui lòng đăng nhập lại !";
        header('location:login.php');
    }
    
}
?>
