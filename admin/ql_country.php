<div class="container">
<form method="POST">
    <div class="form-group">
        <table>
            <tr>
                <td colspan =3>
                    <input size=200px type="text" name="country" class="form-control" placeholder="Tìm kiếm...">
                </td>
                <td>
                    <input  type="submit" name="search" class="btn btn-primary btn-block" value="Tìm kiếm">
                </td>
            </tr>
        </table>
                
    </div>
    <h3 class="text-center text-info">Danh sách quốc gia</h3>
    <?php
        if (session_id() === '') session_start();
        require 'config.php';
        if (isset($_GET['id']) == '1') {
            if ($_SESSION['role'] == 'admin') {
                $_SESSION['tieude'] = "Quốc gia";
                header("location:admin_home.php?loadpage=ql_country.php");
            } else header("location:admin_home.php?loadpage=-1");
        }

        // if(isset($_SESSION['thongbaoQLND']))
        // {
        //     echo '<div class="form-group">
        //     <span style="color:red">'.$_SESSION['thongbaoQLND'].'</span>
        //     </div>';
        //     unset($_SESSION['thongbaoQLND']);
        // }


        if(isset($_POST['search']))
        {
            $key = $_POST['country'];
            $query = "SELECT * FROM country WHERE id_country like '%$key%' or name like '%$key%' ";
            $result = $conn->query($query);
        }
        else
        {
            $query = "SELECT * FROM country";
            $result = $conn->query($query);
            if(!$result) echo 'Cau truy van bi sai';
        }

        
        
    ?>
        <div class="form-group">
            <a href='add_country.php?id=1' class="btn btn-primary btn-block" >Thêm quốc gia</a>
        </div>
    <table class="table table-hover" id="data-table">
        <thead>
        <tr bgcolor="#95f461">
            <th>Mã quốc gia</th>
            <th>Tên tên quốc gia</th>
            <th style="text-align: center">Tuỳ chọn</th>
        </tr>
        </thead>          
        <tbody>
        <?php
        $d=0;
            while ($row = $result->fetch_assoc()) {
                $d++;
                if($d%2==1) $bg="#b0e5e5"; else $bg= "white";
            ?>
            <tr bgcolor="<?php echo $bg; ?>">
                <td><?= $row['id_country']; ?></td>
                <td><?= $row['name'];?></td>
                <?php
                
                    $id_country = $row['id_country'];
                    ?>
                        <td style="text-align: center">
                            <a href='detail_country.php?id_country=<?=$id_country?>' class='badge badge-primary p-2'>Chi tiết</a> 
                            <a style='background-color: #fc3232;' href='delete_country.php?id_country=<?=$id_country?>' class='badge badge-primary p-2'>Xóa</a>
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

<div class="thongbao">
    <?php
        if(isset($_SESSION['thongbao']))
        {
            echo $_SESSION['thongbao'];
            unset($_SESSION['thongbao']);
        }
    ?>
</div>
</div>

