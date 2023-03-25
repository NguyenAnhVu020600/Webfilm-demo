<div class="container">
    <form method="POST">
            <div class="form-group">
                <table>
                    <tr>
                        <td colspan=3>
                            <input size=200px type="text" name="cate" class="form-control" placeholder="Tìm kiếm...">
                        </td>
                        <td>
                            <input type="submit" name="search" class="btn btn-primary btn-block" value="Tìm kiếm">
                        </td>
                    </tr>
                </table>

            </div>
    </form>
    <form method="POST" action="add_category.php">
        <?php
        if (session_id() === '') session_start();
        require 'config.php';
        if (isset($_GET['id']) == '1') {
            if ($_SESSION['role'] == 'admin') {
                unset($_SESSION['tieude']);
                $_SESSION['tieude'] = "Quản lý thể loại";
                header("location:admin_home.php?loadpage=ql_category.php");
            } else header("location:admin_home.php?loadpage=-1");
        }
        if(isset($_POST['search']))
        {
            $key = $_POST['cate'];
            $query = "SELECT *
            FROM category 
            WHERE category.id_category LIKE '%$key%' or category.name_category LIKE '%$key%'";
            $result = $conn->query($query);
        }
        else
        {
            $query = "SELECT * FROM category";
            $result = $conn->query($query);
        }

        if (!$result) echo 'Cau truy van bi sai';
        ?>
        <h3 class="text-center text-info">Danh sách thể loại</h3>
        
        <div class="form-group">
            <a href='add_category.php?id=1' class="btn btn-primary btn-block">Thêm thể loại mới</a>
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
                    <th>Mã thể loại</th>
                    <th>Tên thể loại</th>
                    <th>Tuỳ chọn</th>
                </tr>
            </thead>
            <tbody>
                <?php $d = 0;
                while ($row = $result->fetch_assoc()) {
                    $d++;
                    if ($d % 2 == 1) $bg = "#b0e5e5";
                    else $bg = "white";
                ?>
                    <tr bgcolor="<?php echo $bg; ?>">
                        <td><?= $row['id_category']; ?></td>
                        <td><?= $row['name_category']; ?></td>
                        <?php
                        
                            $id_category = $row['id_category'];
                            ?>
                                <td>
                                    <a style='background-color: #ff7070;' class='btn btn-primary' href='delete_category.php?id_category=<?=$id_category?>'>Xóa</a>
                                </td>
                            <?php
                        ?>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </form>
</div>