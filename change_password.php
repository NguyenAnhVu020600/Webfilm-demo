<?php
session_start();
require 'header.php';
require 'layout.php';
require 'config.php';

?>

<div class="container">
    <div class="profile">
    <?php
        if (isset($_SESSION['id_user']) ){
            $id_user=$_SESSION['id_user'];
        }
            $q_user = "SELECT * 
            FROM user WHERE user.id_user = $id_user";
            $r_user = $conn->query($q_user);
            if (!$r_user) echo "cau truy van bi sai";
            if ($r_user->num_rows != 0) {
                while ($row = $r_user->fetch_assoc()) {
                    $username = $row['username'];
                    $email = $row['email'];
                }
        }
    ?>
        <div class="profile-about">
            <ul>
                <li><label>Username :</label><span><?=$username?></span></li>
                <li><label>Email &ensp; :</label><span><?=$email?></span></li>
            </ul>
        </div>
        

        <div class="profile-home">
            <h3 class="title">ĐỔI MẬT KHẨU</h3>
            <form method="POST" action="action_change_pass.php">
                <input type="hidden" name="_token" >
                <div class="form-group">
                    <label for="old_password">Mật khẩu hiện tại:</label>
                    <input type="password" name="current_password" required="">
                </div>
                
                <div class="form-group">
                    <label for="password">Mật khẩu mới</label>
                    <input type="password" required="" minlength="7" name="new_password">
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Nhập lại mật khẩu</label>
                    <input type="password" required="" minlength="7" name="password_confirmation">
                </div>

                <div class="error_change">
                <?php
                    if(isset($_SESSION['thongbao'])){
                        echo $_SESSION['thongbao'];
                        unset($_SESSION['thongbao']);
                    }
                ?>
                </div>
                
                <div class="form-group">
                    <button type="submit" name="change" >Đổi mật khẩu</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="js/app.js"></script>
<script src="js/OpenSearch.js"></script>
<script src="js/close_nav.js"></script>
<script src="js/change_tab.js"></script>
<script src="js/play.js"></script>