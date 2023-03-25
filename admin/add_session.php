<div class="container">
    <div class="row">
        <?php
            require 'config.php';
            if (session_id() === '') session_start();
            if (isset($_GET['id_movie'])) {
                $_SESSION['id_movie'] = $_GET['id_movie'];
                header("location:admin_home.php?loadpage=add_session.php");
            }
            $id_movie = $_SESSION['id_movie'];
        ?>
        
        <div class="col-sm-3">
            <h3 class="text-justify-center text-info">Thêm session</h3>
        </div>

        <div class="col-sm-8">
        <form method="post"  action="action_add_session.php" >
            <div class="form-group">
                <span>Mã phim</span>
                <input type="text" name="id_movie" readonly  value ="<?=$id_movie?>" class="form-control">
            </div>
            <div class="form-group">
                <span>Tên session</span>
                <input type="text" name="name_ss" class="form-control">
            </div>
            <div class="form-group">
                <span>Số tập</span>
                <input type="text" name="number_ep" class="form-control">
            </div>    
            <div class="form-group">
                <input type="submit" name="add_session" style='background-color: #6be56d;' value="Thêm" class="input_submit">
                <a href='admin_home.php?loadpage=ql_session.php' class='badge badge-primary p-2'>Quay về</a>
                
            </div>
        </form>
        </div>
    </div>

    
</div>