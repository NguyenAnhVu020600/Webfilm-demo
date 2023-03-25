<div class="container">
    <div class="row">
        <?php
            require 'config.php';
            if (session_id() === '') session_start();
            if (isset($_GET['id_user'])) {
                $_SESSION['id_user'] = $_GET['id_user'];
                header("location:admin_home.php?loadpage=detail_user.php");
            }

            $id_user = $_SESSION['id_user'];
            $query = "SELECT * FROM user where id_user = '$id_user'";
            $result = $conn->query($query);
            if (!$result) echo 'Cau truy van bi sai';
            $row = $result->fetch_assoc();
        ?>
        
        <div class="col-sm-4">
            <h3 class="text-justify-center text-info">Thông tin của người dùng</h3>
            <img class="avatar_user" src="../Data/img_user/<?=$row['avatar']?>"/>
            <div class="username_detail">
                <span><?=$row['username']?></span>
            </div>
        </div>
        <div class="col-sm-8">
        <form method="post" enctype="multipart/form-data" action="action_update_user.php" >
        
            <div class="form-group" style="padding-top: 50px;">
                <span>Mã người dùng</span>
                <input type="text" name="id_user" readonly class="form-control" value="<?=$id_user?> ">
            </div>
            <div class="form-group">
                <span>Email</span>
                <input type="text" name="email" class="form-control" value="<?= $row['email'] ?>" disabled>
            </div>
            <div class="form-group">
                <span>Tên tài khoảng</span>
                <input type="text" name="username" class="form-control" value="<?= $row['username'] ?> ">
            </div>
            <div class="form-group">
                <span>Mật Khẩu</span>
                <input type="text" name="password" class="form-control" value="<?= $row['password']?>">
            </div>
            <div class="form-group">
                <span>Avatar</span>
                <div style="padding-top:10px;padding-bottom:20px;">
                    <input type="file" name="avatar">
                </div>
                <div class="thongbao">
                    <?php
                        if(isset($_SESSION['thongbao']))
                        {
                            echo $_SESSION['thongbao'];
                            unset($_SESSION['thongbao']);
                        }
                    ?>
                </div>
            <div class="form-group">
                <a href='admin_home.php?loadpage=ql_user.php' class='badge badge-primary p-2'>Quay về</a>
                <input type="submit" name="fix" style='background-color: #6be56d;' value="Lưu thay đổi" class="input_submit">
                <a style='background-color: #fc3232;' href='delete_cus.php?id_user=<?= $id_user; ?>' class='badge badge-primary p-2'>Xóa người dùng</a>
            </div>

            
        </form>
        </div>
    </div>

    
</div>