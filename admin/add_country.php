<div class="container">
    <div class="row">
        <?php
            require 'config.php';
            if (session_id() === '') session_start();
            require 'config.php';
            if (isset($_GET['id']) == '1') {
                if ($_SESSION['role'] == 'admin') {
                    $_SESSION['tieude'] = "Thêm quốc gia";
                    header("location:admin_home.php?loadpage=add_country.php");
                } else header("location:admin_home.php?loadpage=-1");
            }
        ?>
        
        <div class="col-sm-2">
        </div>
        <div class="col-sm-8    ">
        <form method="post" action="action_add_country.php" >
    
            <div class="form-group">
                <span>Tên quốc gia</span>
                <input type="text" name="name" class="form-control">
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
                <input type="submit" name="add" style='background-color: #6be56d;' value="Thêm" class="input_submit">
            </div>
        </form>
        </div>
    </div>

    
</div>