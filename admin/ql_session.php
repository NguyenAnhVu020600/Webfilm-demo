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
                $_SESSION['tieude'] = "Quản lý session";
                header("location:admin_home.php?loadpage=ql_session.php");
            } else header("location:admin_home.php?loadpage=-1");
        }
        if(isset($_POST['search']))
        {
            $key = $_POST['name'];
            $query = "SELECT * FROM session,movie WHERE id_session LIKE '%$key%' OR name LIKE '%$key%'";
            $result = $conn->query($query);
            if (!$result) echo 'Cau truy van bi sai';
        }
        else
        {
            $query = "SELECT * FROM movie ";
            $result = $conn->query($query);
            if (!$result) echo 'Cau truy van bi sai';

        } 
        ?>
    
        <h3 class="text-center text-info">Danh sách phim</h3>
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
                    <th>Số lượng session</th>
                    <th>Tuỳ chọn</th>
                </tr>
            </thead>
            <tbody>
                <?php

                $d = 0;
                while ($row = $result->fetch_assoc()) {
                    $id_movie = $row['id_movie'];
                    $d++;
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
                        <td >
                            <?php 
                            
                            $query_ss = "SELECT COUNT(session.id_session) as 'count_session' 
                            FROM movie,session
                            WHERE movie.id_movie = session.id_movie AND movie.id_movie= $id_movie";
                            $result_ss = $conn->query($query_ss);
                            if (!$result_ss) echo 'Cau truy van bi sai';
                            while ($row2 = $result_ss->fetch_assoc()) {
                                $count_ss= $row2['count_session'];
                            }
                            if($count_ss == 0)
                            {
                                echo "Chưa có session";
                            }
                            else
                            {
                                echo $count_ss;
                            }
                            ?>
                            
                        </td>
                        <?php
                            $id_movie = $row['id_movie'];
                            ?>
                            <td style="width:130px;">
                                <?php 
                                    if($count_ss == 0){
                                        echo "<a href='add_session.php?id_movie=$id_movie' class='badge badge-primary p-2' style='width:58px;'>Thêm</a>";
                                    }
                                    else
                                    {
                                        echo "<a href='detail_session.php?id_movie=$id_movie' class='badge badge-primary p-2'>Chi tiết</a>";
                                    }
                                ?>
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