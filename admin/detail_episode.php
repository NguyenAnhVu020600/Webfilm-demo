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
            if (isset($_GET['id_ep'])) {
                $_SESSION['id_ep'] = $_GET['id_ep'];
                
                header("location:admin_home.php?loadpage=detail_episode.php");
            }

            $id_episode=$_SESSION['id_ep'];
            $query = "SELECT * FROM episode WHERE id_episode = $id_episode";
            $result = $conn->query($query);
            if (!$result) echo 'Cau truy van bi sai';
            $row = $result->fetch_assoc();
        ?>
        
        <div class="col-sm-4">
            <h3 class="text-justify-center text-info">Thông tin tập phim</h3>
            <img class="thumbnail_movie" src="../Data/thumbnail_ep/<?=$row['thumbnail_ep']?>"/>
            <div class="thumbnail_show">
                <span>Thumbnail</span>
            </div>
        </div>
        <div class="col-sm-8">
        <form method="post" enctype="multipart/form-data" action="action_update_episode.php" >
        
            <div class="form-group" style="padding-top: 50px;">
                <span>Mã tập phim</span>
                <input type="text" name="id_episode" readonly class="form-control" value="<?=$id_episode?> ">
            </div>
            <div class="form-group">
                <span>Tên tập phim</span>
                <input type="text" name="name_ep" class="form-control" value="<?= $row['name_ep'] ?>">
            </div>
            
        
            <div class="form-group">
                <span>Lượt xem</span>
                <input type="text" name="view_ep" class="form-control" value="<?= $row['view_ep']?>">
            </div>

            <div class="form-group">
                <span>Link movie</span>
                <input type="text" name="link" class="form-control" value="<?= $row['movie_link']?>">
            </div>
            <div class="form-group">
                <span>Status</span>
                <input type="text" name="status" class="form-control" value="<?= $row['status']?>">
            </div>
            <div class="form-group">
                <span>Thumbnail</span>
                <div style="padding-top:10px;padding-bottom:20px;">
                    <input type="file" name="thumbnail">
                </div>
                
            <div class="form-group">
                <a href='admin_home.php?loadpage=ql_episode.php' class='badge badge-primary p-2'>Quay về</a>
                <input type="submit" name="fix" style='background-color: #6be56d;' value="Lưu thay đổi" class="input_submit">
            </div>
        </form>
        </div>
    </div>

    
</div>