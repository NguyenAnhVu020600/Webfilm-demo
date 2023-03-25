<?php
require 'config.php';
if (session_id() === '') session_start();
if (isset($_GET['id_movie'])) {
    $id_movie = $_GET['id_movie'];

    $query_test = "SELECT count(session.id_session) as 'count_ss' from movie,session 
    WHERE movie.id_movie = session.id_movie AND movie.id_movie =$id_movie";
    $result_test = $conn->query($query_test);
    if ($result_test->num_rows != 0) {
        while ($row = $result_test->fetch_assoc()) {
            $count = $row['count_ss'];
        }
        if($count == 0) 
        {
            $query_odd= "SELECT * from odd_movie WHERE id_movie = $id_movie";
            $result_odd = $conn->query($query_odd);
            if($result_odd === TRUE)
            {
                $_SESSION['thongbao'] = "* Phim này đã có trong danh sách phim bộ";
                header("location:admin_home.php?loadpage=ql_movie.php");
            }
            else
            {
                $queryadd = "INSERT INTO odd_movie (id_movie)
                VALUES ('$id_movie');";
                    $result = $conn->query($queryadd);
                    if ($result === True) {
                        $_SESSION['thongbao'] = "* Thêm thành công";
                        header("location:admin_home.php?loadpage=ql_movie.php");
                    }
                else echo "Truy vấn bị sai";
            }
        }
        else
        {
            $_SESSION['thongbao'] = "* không thể thêm phim này vào danh sách phim bộ";
            header("location:admin_home.php?loadpage=ql_movie.php");
            
        }
    }
    
    

    
}
?>