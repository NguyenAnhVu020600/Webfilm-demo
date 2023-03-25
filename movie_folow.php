<?php
session_start();
require 'header.php';
require 'layout.php';
require 'config.php';
?>
  
<div class="container">
    <div class="content-container-new">
        <div class="tray-title">Phim Đã Theo Dõi</div>
        <div class="film-list">
            <div class="table-header">
                <div class="column column-1">Hình</div>
                <div class="column column-2">Tên anime</div>
                <div class="column column-3 hide-xs">Thời lượng</div>
                <div class="column column-4 hide-xs column-views">Lượt xem</div>
            </div>
            
            <?php
            $id_user = $_SESSION['id_user'];
            $query = "SELECT movie.id_movie,movie.thumbnail, movie.name,movie.view,session.number_episode
            FROM movie, list_folow ,session, episode
            WHERE movie.id_movie = list_folow.id_movie AND movie.id_movie = session.id_movie 
            AND session.id_session = episode.id_session AND list_folow.id_user = $id_user
            GROUP BY movie.id_movie";
            $result = $conn->query($query);
            if (!$result) echo "cau truy van bi sai";
            
            if ($result->num_rows != 0) {
                while ($row = $result->fetch_assoc()) {
                    $id_movie = $row['id_movie'];
                    $thumbnail = $row['thumbnail'];
                    $name = $row['name'];
                    $number_episode = $row['number_episode'];
                    $view = $row['view'];


                    
                    ?>
                    <div class="film-item" >
                        <div class="column column-1">
                            <a href="">
                                <img class="film-thumbnail" src="Data/thumbnail/<?=$thumbnail?>" >
                            </a>
                        </div>
                        <div class="column column-2"><a href="" class="name_movie"><?=$name?></a></div>
                        <div class="column column-3 hide-xs">
                        <?php
                                $query_ep = "SELECT count(id_episode)  as 'sotap', right('$number_episode','3') as 'tongtap'
                                FROM session, episode, movie
                                WHERE  movie.id_movie = session.id_movie 
                                AND session.id_session = episode.id_session AND movie.id_movie = $id_movie";
                                $result_ep = $conn->query($query_ep);
                                if (!$result_ep) echo "cau truy van bi sai";
                                if ($result_ep->num_rows != 0) {
                                    while ($row = $result_ep->fetch_assoc()) {
                                        $sotap = $row['sotap'];
                                        $tongtap = $row['tongtap'];
                                        ?>
                                        <?=$sotap?> / <?=$tongtap?> Tập
                                        <?php
                                    }
                                }
                            ?>
                            
                        </div>
                        <div class="column column-4 hide-xs column-views"><?=$view?></div>
                        <div class="column column-5 column-tools">
                            <a href="delete_folow_movie.php?id_movie=<?=$id_movie?>">
                                <div class="film-delete">
                                    <i class="fa fa-trash" aria-hidden="true"></i> 
                                    xóa</div>
                                </div>
                            </a>
                        </div>
                    <?php
                }
            }
            

            ?>
            
                
            
        </div>
        <!-- <input type="hidden" name="total-item" value="112">
        <input type="hidden" name="current-page" value="1">
        <div class="pagination">
            <div class="page-item activated"><a href="/phim-da-thich"><i class="icon-backward"></i></a></div>
            <div class="page-item activated"><a href="/phim-da-thich/trang-1">1</a></div>
            <div class="page-item"><a href="/phim-da-thich/trang-2">2</a></div>
            <div class="page-item"><a href="/phim-da-thich/trang-3">3</a></div>
            <div class="page-item"><a href="/phim-da-thich/trang-4">4</a></div>
            <div class="page-item"><a href="/phim-da-thich/trang-5">5</a></div>
            <div class="page-item"><a href="/phim-da-thich/trang-5"><i class="icon-forward"></i></a></div>
        </div> -->
    </div>
    <input type="hidden" name="self-type" id="self-type" value="liked">

</div>

<script src="js/app.js"></script>
    <script src="js/OpenSearch.js"></script>
    <script src="js/close_nav.js"></script>
    <script src="js/change_tab.js"></script>
    <script src="js/play.js"></script>
