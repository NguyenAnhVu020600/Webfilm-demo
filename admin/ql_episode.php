<div class="container">
    <form method="POST">
        <div class="form-group">
            <table>
                <tr>
                    <td colspan=3><input size=200px type="text" name="name" class="form-control" placeholder="Tìm kiếm..."></td>
                    <td><input type="submit" name="search" class="btn btn-primary btn-block" value="Tìm kiếm"></td>
                </tr>
            </table>

        </div>
        <?php
        if (session_id() === '') session_start();
        require 'config.php';
        if (isset($_GET['id']) == '1') {
            if ($_SESSION['role'] == 'admin') {
                unset($_SESSION['tieude']);
                $_SESSION['tieude'] = "Danh sách các tập phim";
                if(isset($_GET['id_movie'])&&isset($_GET['id_session']))
                {
                    $_SESSION['id_movie']=$_GET['id_movie'];
                    $_SESSION['id_session']=$_GET['id_session'];
                }
                header("location:admin_home.php?loadpage=ql_episode.php");
            } else header("location:admin_home.php?loadpage=-1");
        }
        $id_movie = $_SESSION['id_movie'];
        $id_session= $_SESSION['id_session'];
        if(isset($_POST['search']))
        {
            $key = $_POST['name'];
            $query = "SELECT episode.id_episode,episode.name_ep,
            episode.thumbnail_ep,episode.view_ep,episode.movie_link,episode.status 
            FROM episode,movie,session WHERE movie.id_movie = session.id_movie
            AND session.id_session = episode.id_session AND movie.id_movie = $id_movie
            AND session.id_session = $id_session AND (episode.id_episode LIKE '%$key%' 
            OR episode.name_ep LIKE '%$key%')
            GROUP BY movie.id_movie";
            $result = $conn->query($query);
            if (!$result) echo 'Cau truy van bi sai';
        }
        else
        {
            $query = "SELECT episode.id_episode,episode.name_ep,
            episode.thumbnail_ep,episode.view_ep,episode.movie_link,episode.status 
            FROM episode,movie,session WHERE movie.id_movie = session.id_movie
            AND session.id_session = episode.id_session AND movie.id_movie = $id_movie 
            AND session.id_session = $id_session ";
            $result = $conn->query($query);
            if (!$result) echo 'Cau truy van bi sai';
        } 

        ?>
    
        <h3 class="text-center text-info">Danh sách phim</h3>
        <div class="form-group">
            <a href='add_episode.php?id=1&id_session=<?=$id_session?>' class="btn btn-primary btn-block">Thêm tập phim mới</a>
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
        <table class="table table-hover" id="data-table">
            <thead>
                <tr bgcolor="#95f461">
                    <th>Thumbnail</th>
                    <th style="width:80px;">Mã tập </th>
                    <th>Tên tập phim</th>
                    <th style="width:105px;">Lượt xem</th>
                    <th>Link phim</th>
                    <th>status</th>
                    <th>Tuỳ chọn</th>
                </tr>
            </thead>
            <tbody>
                <?php

                $d = 0;
                while ($row = $result->fetch_assoc()) {
                    $movie_link=$row['movie_link'];
                    
                    $d++;
                    if ($row['id_episode'] == 0) $bg = "#f27171";
                    else {
                        if ($d % 2 == 1) $bg = "#b0e5e5";
                        else $bg = "white";
                    }
                ?>
                    <tr bgcolor="<?php echo $bg; ?>">
                        <td ><img class="img_movie" src="../Data/thumbnail_ep/<?= $row['thumbnail_ep']; ?>"></td>
                        <td ><?= $row['id_episode']; ?></td>
                        <td ><?= $row['name_ep']; ?></td>
                        <td><?= $row['view_ep']; ?></td>
                        <td ><?= $row['movie_link']; ?></td>
                        <td ><?= $row['status']; ?></td>
                        <?php
                            $id_ep = $row['id_episode'];
                            ?>
                                <td style="width:130px;">
                                    <a href='detail_episode.php?id_ep=<?=$id_ep?>' class='badge badge-primary p-2'>Chi tiết</a>
                                    <a style='background-color: #fc3232;' href='delete_episode.php?id_episode=<?=$id_ep?>' class='badge badge-primary p-2'>Xóa</a>
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
</div>