<?php
session_start();
require 'header_log.php';
require 'layout.php';
require 'config.php';

?>

<body>
    
    <div class="container">
        <div class="profile">
            <?php
            if (isset($_SESSION['id_user'])) {
                $id_user = $_SESSION['id_user'];
            }
            $q_user = "SELECT * 
            FROM user WHERE user.id_user = $id_user";
            $r_user = $conn->query($q_user);
            if (!$r_user) echo "cau truy van bi sai";
            if ($r_user->num_rows != 0) {
                while ($row = $r_user->fetch_assoc()) {
                    $username = $row['username'];
                    $email = $row['email'];
                    $avatar = $row['avatar'];
                }
            }
            ?>
            <div class="row">
                <div class="col-md-3" style="margin-bottom:20px;">
                    <div class="profile-sidebar">
                        <div class="profile-userpic">
                            <img src="Data/img_user/<?=$avatar?>" class="img-responsive" alt="">
                        </div>
                        <div class="profile-usertitle">
                            <div class="profile-usertitle-name"><?=$username?></div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-md-9" style="margin-bottom:20px;">
                    <div class="col-xs-12 col-md-12 pdr0">
                        <div class="tab-login update-info" id="tab-login">
                            <div class="title"> THÔNG TIN TÀI KHOẢN</div>
                            <div class="bor-form">
                                <form method="post" enctype="multipart/form-data" action="update.php">
                                    <div class="form-group">
                                        <label class="control-label col-sm-3" for="email">Email</label>
                                        <div class="col-sm-9">
                                            <input name="email" type="email"  value="<?=$email?>"  placeholder="Email đăng nhập" disabled="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3" for="username">Tài khoản</label>
                                        <div class="col-sm-9">
                                            <input name="username" type="text" value="<?=$username?>"  placeholder="Tài khoản / Username">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-3" >Avatar</label>
                                        <div class="col-sm-9">
                                            <input  type="file" name="avatar">
                                        </div>
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
                                    <div class="form-group" style="padding-top: 6px;">
                                        <label class="control-label col-sm-3"></label>
                                        <div class="col-sm-9">
                                            <input type="submit" name="submit" value="Cập nhật">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="js/app.js"></script>
<script src="js/OpenSearch.js"></script>
<script src="js/close_nav.js"></script>
<script src="js/change_tab.js"></script>
<script src="js/play.js"></script>