<div class="container">
    <div class="row">
        <?php
            require 'config.php';
            if (session_id() === '') session_start();
            require 'config.php';
            if (isset($_GET['id']) == '1') {
                if ($_SESSION['role'] == 'admin') {
                    $_SESSION['tieude'] = "Thêm tập phim mới";
                    if(isset($_GET['id_session'])){
                        $_SESSION['id_session'] = $_GET['id_session']; 
                        
                    }
                    header("location:admin_home.php?loadpage=add_episode.php");
                } else header("location:admin_home.php?loadpage=-1");
            }
            $id_session=$_SESSION['id_session'];
        ?>
        
        <div class="col-sm-2">
        </div>
        <div class="col-sm-8    ">
        <form method="post" enctype="multipart/form-data" action="action_add_episode.php" >
            <div class="form-group">
                <span>Mã session</span>
                <input type="text" name="id_session" class="form-control" value=<?=$id_session?> readonly>
            </div>
            <div class="form-group">
                <span>Tên tập phim</span>
                <input type="text" name="name_ep" class="form-control">
            </div>
            <div class="form-group">
                <span>Link movie</span>
                <input type="text" name="link" class="form-control">
            </div>
            <div class="form-group">
                <span>Status</span>
                <input type="text" name="status" class="form-control" >
            </div>
            <div class="form-group">
                <span>Thumbnail</span>
                <div style="padding-top:10px;padding-bottom:20px;">
                    <input type="file" name="thumbnail_ep">
                </div>
            <div>    
            <div class="form-group">
                <input type="submit" name="add_episode" style='background-color: #6be56d;' value="Thêm" class="input_submit">
                <a href='admin_home.php?loadpage=ql_episode.php' class='badge badge-primary p-2'>Quay về</a>
                
            </div>
        </form>
        </div>
    </div>

    
</div>