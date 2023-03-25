<div class="container">
<form method="POST">
    <div class="form-group">
        <table>
            <tr>
                <td colspan =3>
                    <input size=200px type="text" name="username" class="form-control" placeholder="Tìm kiếm...">
                </td>
                <td>
                    <input  type="submit" name="search" class="btn btn-primary btn-block" value="Tìm kiếm">
                </td>
            </tr>
        </table>
                
    </div>
    <h3 class="text-center text-info">Danh sách người dùng</h3>
    <?php
        if (session_id() === '') session_start();
        require 'config.php';
        if (isset($_GET['id']) == '1') {
            if ($_SESSION['role'] == 'admin') {
                $_SESSION['tieude'] = "Quản lý người dùng";
                header("location:admin_home.php?loadpage=ql_user.php");
            } else header("location:admin_home.php?loadpage=-1");
        }

        // if(isset($_SESSION['thongbaoQLND']))
        // {
        //     echo '<div class="form-group">
        //     <span style="color:red">'.$_SESSION['thongbaoQLND'].'</span>
        //     </div>';
        //     unset($_SESSION['thongbaoQLND']);
        // }


        if(isset($_POST['search']))
        {
            $key = $_POST['username'];
            $query = "SELECT * FROM user WHERE id_user like '%$key%' or username like '%$key%' 
            or email like '%$key%'";
            $result = $conn->query($query);
        }
        else
        {
            $query = "SELECT * FROM user";
            $result = $conn->query($query);
            if(!$result) echo 'Cau truy van bi sai';
        }

        
        
    ?>
    <table class="table table-hover" id="data-table">
        <thead>
        <tr bgcolor="#95f461">
            <th>Mã ND</th>
            <th>Avatar</th>
            <th>Tên tài khoảng</th>
            <th>Email</th>
            <th>Mật Khẩu</th>
            <th style="text-align: center">Tuỳ chọn</th>
        </tr>
        </thead>          
        <tbody>
        <?php
        $d=0;
            while ($row = $result->fetch_assoc()) {
                $d++;
                if($d%2==1) $bg="#b0e5e5"; else $bg= "white";
            ?>
            <tr bgcolor="<?php echo $bg; ?>">
                <td><?= $row['id_user']; ?></td>
                <td><img class="avatar_ad" src="../Data/img_user/<?= $row['avatar']; ?>" /></td>
                <td><?= $row['username'];?></td>
                <td><?= $row['email']; ?></td>
                <td><?= md5($row['password']); ?></td>
                <?php
                
                    $id_user = $row['id_user'];
                    ?>
                        <td>
                            <a href='detail_user.php?id_user=<?=$id_user?>' class='badge badge-primary p-2'>Chi tiết</a> 
                            <a style='background-color: #fc3232;' href='delete_user.php?id_user=<?=$id_user?>' class='badge badge-primary p-2'>Xóa</a>
                        </td>
                    <?php
                    
                ?>  
            </tr>
            
            <?php 
            } 
        ?>
        </tbody>
    </table>
    
</form>

<div class="thongbao">
    <?php
        if(isset($_SESSION['thongbao']))
        {
            echo $_SESSION['thongbao'];
            unset($_SESSION['thongbao']);
        }
    ?>
</div>
</div>

