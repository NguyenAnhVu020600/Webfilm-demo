<div class="container">
    <div class="row">
        <div class="col-sm-2">
            <h3 class="text-justify-center text-info">Session</h3>
        </div>
        <div class="col-sm-12">
        </div>
        <?php
            require 'config.php';
            if (session_id() === '') session_start();
            if (isset($_GET['id_movie']) ) {
                $_SESSION['id_movie'] = $_GET['id_movie'];
                header("location:admin_home.php?loadpage=detail_session.php");
            }
            $id_movie = $_SESSION['id_movie'];
            $query = "SELECT movie.id_movie, session.id_session,session.name_ss,session.number_episode 
            FROM movie,session
            WHERE movie.id_movie = session.id_movie and movie.id_movie = $id_movie";
            $result = $conn->query($query);
            if (!$result) echo 'Cau truy van bi sai';
            while($row = $result->fetch_assoc()){
                ?>
                    <div class="col-sm-2">
                        </div>
                    <div class="col-sm-8">
                        <form method="post" action="action_update_session.php" >
                        
                            <div class="form-group">
                                <span>Mã phim</span>
                                <input type="text" name="id_movie" readonly class="form-control" value="<?= $row['id_movie'] ?>">
                            </div>
                            <div class="form-group">
                                <span>Mã session</span>
                                <input type="text" name="id_session" readonly class="form-control" value="<?= $row['id_session'] ?>">
                            </div>
                            <div class="form-group">
                                <span>Tên session</span>
                                <input type="text" name="name" class="form-control" value="<?= $row['name_ss'] ?>">
                            </div>
                            <div class="form-group">
                            <span>Số tập</span>
                                <input type="text" name="number_ep" class="form-control" value="<?= $row['number_episode'] ?>">
                            </div>
                            <div class="form-group">
                                <a href='admin_home.php?loadpage=ql_session.php' class='badge badge-primary p-2'>Quay về</a>
                                <input type="submit" name="fix" style='background-color: #6be56d;' value="Lưu thay đổi" class="input_submit">
                                <a href='ql_episode.php?id=1&id_movie=<?=$id_movie?>&id_session=<?=$row['id_session']?>' class='badge badge-primary p-2' style='margin-right:20px;'>Danh sách tập</a>
                                <a style='background-color: #fc3232;' href='delete_session.php?id_movie=<?= $id_movie; ?>&id_session=<?= $row['id_session'] ?>' class='badge badge-primary p-2'>Xóa</a>
                            </div>

                            
                        </form>
                        </div>
                        <div class="col-sm-2">
                        </div>
                <?php
            }
        ?>
        

        
    </div>

    
</div>