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
                header("location:admin_home.php?loadpage=detail_new_movie.php");
            }

            $id_movie = $_SESSION['id_movie'];
            $query = "SELECT movie.id_movie, movie.name,new.thumbnail,movie.description,
            general_cate.id_general_cate as 'id_general_cate',
            general_cate.name as 'general_cate',
            country.id_country as 'id_country',
            country.name as 'country'
            FROM movie,general_cate,country,new
            WHERE general_cate.id_general_cate = movie.id_general_cate 
            AND country.id_country = movie.id_country AND movie.id_movie = new.id_movie AND movie.id_movie = '$id_movie'";
            $result = $conn->query($query);
            if (!$result) echo 'Cau truy van bi sai';
            $row = $result->fetch_assoc();
        ?>
        
        <div class="col-sm-12">
            <h3 class="text-justify-center text-info">Thông tin phim</h3>
            <img class="thumbnail_movie_new" src="../Data/thumbnail/<?=$row['thumbnail']?>"/>
            <div class="thumbnail_new_show">
                <span>Thumbnail</span>
            </div>
        </div>
        
        <div class="col-sm-2">
        </div>
        <div class="col-sm-8">
        <form method="post" enctype="multipart/form-data" action="action_update_new_movie.php" >
        
            <div class="form-group" style="padding-top: 50px;">
                <span>Mã phim</span>
                <input type="text" name="id_movie" readonly class="form-control" value="<?=$id_movie?> ">
            </div>
            <div class="form-group">
                <span>Tên phim</span>
                <input type="text" name="name" class="form-control" value="<?= $row['name'] ?>">
            </div>
            <div class="form-group">
                <span>Quốc gia</span>
                <div class="select_show">
                <select name="id_country" require>
                    <option selected value=<?= $row['id_country'] ?>> <?= $row['country'] ?></option>
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
                    <option selected value="<?= $row['id_general_cate'] ?>"> <?= $row['general_cate'] ?></option>
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
                <textarea type="text" name="des" class="form-control" style="height:100px;"><?= $row['description']?></textarea>
            </div>
            <div class="form-group">
                <span>Thumbnail</span>
                <div style="padding-top:10px;padding-bottom:20px;">
                    <input type="file" name="thumbnail">
                </div>
                
            <div class="form-group">
                <a href='admin_home.php?loadpage=ql_new_movie.php' class='badge badge-primary p-2'>Quay về</a>
                <input type="submit" name="fix" style='background-color: #6be56d;' value="Lưu thay đổi" class="input_submit">
                <a style='background-color: #fc3232;' href='delete_movie.php?id_movie=<?= $id_movie; ?>' class='badge badge-primary p-2'>Xóa</a>
            </div>

            
        </form>
        </div>
    </div>

    
</div>