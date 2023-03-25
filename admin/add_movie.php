<div class="container">
    <div class="row">
        <?php
            require 'config.php';
            if (session_id() === '') session_start();
            require 'config.php';
            if (isset($_GET['id']) == '1') {
                if ($_SESSION['role'] == 'admin') {
                    $_SESSION['tieude'] = "Thêm phim mới";
                    header("location:admin_home.php?loadpage=add_movie.php");
                } else header("location:admin_home.php?loadpage=-1");
            }
        ?>
        
        <div class="col-sm-2">
        </div>
        <div class="col-sm-8    ">
        <form method="post" enctype="multipart/form-data" action="action_add_movie.php" >
            <div class="form-group">
                <span>Tên phim</span>
                <input type="text" name="name" class="form-control">
            </div>
            <div class="form-group">
                <span>Quốc gia</span>
                <div class="select_show">
                <select name="id_country" require>
                    <?php 
                    $query_country = "SELECT * FROM country";
                    $result_country = $conn->query($query_country);
                    if (!$result_country) echo 'Cau truy van bi sai';
                    while ($row3 = $result_country->fetch_assoc()) {
                        $id_country = $row3['id_country'];
                        $name_country = $row3['name'];
                        ?>
                            <option value="<?=$id_country?>"><?=$name_country?></option>
                        <?php
                    }
                    ?>
                    
                </select>
                </div>
            </div>
            <div class="form-group">
                <span>Thể loại chung</span>
                <div class="select_show">
                <select name="id_general_cate" require>
                    <?php 
                    $query_cate = "SELECT * FROM general_cate";
                    $result_cate = $conn->query($query_cate);
                    if (!$result_cate) echo 'Cau truy van bi sai';
                    while ($row2 = $result_cate->fetch_assoc()) {
                        $id_general_cate = $row2['id_general_cate'];
                        $name_cate = $row2['name'];
                        ?>
                            <option value="<?=$id_general_cate?>"><?=$name_cate?></option>
                        <?php
                    }
                    ?>
                </select>
                </div>
            </div>
            <div class="form-group">
                <span>Description</span>
                <textarea type="text" name="des" class="form-control" style="height:100px;"></textarea>
            </div>
            <div class="form-group">
                <span>Thumbnail</span>
                <div style="padding-top:10px;padding-bottom:20px;">
                    <input type="file" name="thumbnail_movie">
                </div>
            <div>    
            <div class="form-group">
                <input type="submit" name="add_movie" style='background-color: #6be56d;' value="Thêm" class="input_submit">
                <a href='admin_home.php?loadpage=ql_movie.php' class='badge badge-primary p-2'>Quay về</a>
                
            </div>
        </form>
        </div>
    </div>

    
</div>