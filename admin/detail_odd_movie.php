<div class="container">
    <div class="row">
        <div class="thongbao">
            <?php
                if(isset($_SESSION['thongbao']))
                {
                    echo $_SESSION['thongbao'];
                    unset($_SESSION['thongbao']);
                }
            ?>
        </div>
        <?php
            require 'config.php';
            if (session_id() === '') session_start();
            if (isset($_GET['id_movie'])) {
                $_SESSION['id_movie'] = $_GET['id_movie'];
                header("location:admin_home.php?loadpage=detail_odd_movie.php");
            }

            $id_movie = $_SESSION['id_movie'];
            $query = "SELECT *
            FROM odd_movie
            WHERE id_movie = '$id_movie'";
            $result = $conn->query($query);
            if (!$result) echo 'Cau truy van bi sai';
            $row = $result->fetch_assoc();
        ?>
        
        
        
        <div class="col-sm-2">
        </div>
        <div class="col-sm-8">
        <form method="post" action="action_update_odd_movie.php" >
        
            <div class="form-group">
                <span>Link phim</span>
                <input type="text" name="id_movie" readonly class="form-control" value="<?= $row['id_movie'] ?>">
            </div>
            <div class="form-group">
                <span>Link phim</span>
                <input type="text" name="link" class="form-control" value="<?= $row['link'] ?>">
            </div>
            
            <div class="form-group">
                <a href='admin_home.php?loadpage=ql_odd_movie.php' class='badge badge-primary p-2'>Quay về</a>
                <input type="submit" name="fix" style='background-color: #6be56d;' value="Lưu thay đổi" class="input_submit">
            </div>

            
        </form>
        </div>
    </div>

    
</div>