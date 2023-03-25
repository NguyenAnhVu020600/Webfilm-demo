<div class="container">
    <form method="POST">
        <div class="form-group">
            <table>
                <tr>
                    <td colspan=3><input size=200px type="text" name="name_search" class="form-control" placeholder="Tìm kiếm..."></td>
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
                $_SESSION['tieude'] = "Quản lý phim mới";
                header("location:admin_home.php?loadpage=ql_new_movie.php");
            } else header("location:admin_home.php?loadpage=-1");
        }
        if(isset($_POST['search']))
        {
            $key = $_POST['name_search'];
            $query = "SELECT * FROM movie,new WHERE movie.id_movie = new.id_movie 
            AND (new.id_movie LIKE '%$key%' OR movie.name LIKE '%$key%')";
            $result = $conn->query($query);
            if (!$result) echo 'Cau truy van bi sai';
        }
        else
        {
            $query = "SELECT * FROM movie,new WHERE movie.id_movie = new.id_movie";
            $result = $conn->query($query);
            if (!$result) echo 'Cau truy van bi sai';
        } 

        ?>
    
        <h3 class="text-center text-info">Danh sách phim mới</h3>
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
                    <th >Thumbnail</th>
                    <th >Mã phim</th>
                    <th>Tên phim</th>
                    <th >Lượt xem</th>
                    <th>Theo dõi</th>
                    <th>Tuỳ chọn</th>
                </tr>
            </thead>
            <tbody>
                <?php

                $d = 0;
                while ($row = $result->fetch_assoc()) {
                    $d++;
                    $id_movie = $row['id_movie'];
                    if ($row['id_movie'] == 0) $bg = "#f27171";
                    else {
                        if ($d % 2 == 1) $bg = "#b0e5e5";
                        else $bg = "white";
                    }
                ?>
                    <tr bgcolor="<?php echo $bg; ?>">
                        <td ><img class="img_movie" src="../Data/thumbnail/<?= $row['thumbnail']; ?>"></td>
                        <td ><?= $row['id_movie']; ?></td>
                        <td ><?= $row['name']; ?></td>
                        <td><?= $row['view']; ?></td>
                        <td > 
                            <?php
                                $query_fl = "SELECT count(id_user) as 'folow' 
                                FROM list_folow WHERE id_movie = $id_movie";
                                $result_fl = $conn->query($query_fl);
                                if (!$result_fl) echo 'Cau truy van bi sai'; 
                                while ($row = $result_fl->fetch_assoc()) {
                                    $folow = $row['folow'];
                                }
                            ?>
                            <?=$folow?>
                        </td>
                        <?php
                            
                            ?>
                            <td style="width:130px;">
                                <a href='detail_new_movie.php?id_movie=<?=$id_movie?>' class='badge badge-primary p-2'>Chi tiết</a>
                                <a style='background-color: #fc3232;' href='delete_new_movie.php?id_movie=<?=$id_movie?>' class='badge badge-primary p-2'>Xóa</a>
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