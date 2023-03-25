<div class="container">
    <div class="row">
        <?php
            require 'config.php';
            if (session_id() === '') session_start();
            if (isset($_GET['id_country'])) {
                $_SESSION['id_country'] = $_GET['id_country'];
                header("location:admin_home.php?loadpage=detail_country.php");
            }

            $id_country = $_SESSION['id_country'];
            $query = "SELECT * FROM country where id_country = '$id_country'";
            $result = $conn->query($query);
            if (!$result) echo 'Cau truy van bi sai';
            $row = $result->fetch_assoc();
        ?>
        
        <div class="col-sm-2">
            <h3 class="text-justify-center text-info">Quốc gia</h3>
        </div>
        <div class="col-sm-8">
        <form method="post" action="action_update_country.php" >
        
            <div class="form-group" style="padding-top: 50px;">
                <span>Mã quốc gia</span>
                <input type="text" name="id_country" readonly class="form-control" value="<?=$id_country?> ">
            </div>
            <div class="form-group">
                <span>Tên quốc gia</span>
                <input type="text" name="name" class="form-control" value="<?= $row['name'] ?>">
            </div>
            
            <div class="form-group">
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
                <a href='admin_home.php?loadpage=ql_country.php' class='badge badge-primary p-2'>Quay về</a>
                <input type="submit" name="fix" style='background-color: #6be56d;' value="Lưu thay đổi" class="input_submit">
                <a style='background-color: #fc3232;' href='delete_country.php?id_country=<?= $id_country; ?>' class='badge badge-primary p-2'>Xóa</a>
            </div>

            
        </form>
        </div>
    </div>

    
</div>