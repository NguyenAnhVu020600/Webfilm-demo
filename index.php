<?php
session_start();
require 'header.php';
require 'layout.php';
require 'config.php';
?>
<body>
<div class="container">
    <div class="content-container">
        <div class="slider-wrapper">
            <div class="slider-container">
                <?php
                $query = "SELECT
                    movie.id_movie as 'id_movie',
                    movie.name as 'name',
                    new.thumbnail  as 'thumbnail',
                    movie.view as 'view',
                    new.id_movie 

                    FROM movie, new
                    WHERE movie.id_movie = new.id_movie
                    GROUP BY movie.id_movie 
                    ORDER BY RAND() Limit 1";
                $result = $conn->query($query);
                if (!$result) echo "cau truy van bi sai";
                if ($result->num_rows != 0) {
                    while ($row = $result->fetch_assoc()) {
                        $id_movie = $row['id_movie'];
                        $name = $row['name'];
                        $thumbnail = $row['thumbnail'];
                        $view = $row['view'];
                ?>
                        <div class="slider-cover">

                            <div class="slider-play-button">
                                <i class="fa fa-play" aria-hidden="true"></i>
                            </div>
                            <div class="slider-meta">
                                <span class="slider-views"><?= number_format($view) ?> lượt xem</span>
                                <div class="slider-title"><?= $name ?> </div>
                            </div>
                            <a class="slider-link" href="play.php?id_movie=<?= $id_movie ?>">
                                <img class="activated" src="Data/thumbnail/<?= $thumbnail ?>" />
                            </a>
                        </div>
                <?php
                    }
                }
                ?>
                <?php
                $query_item = "SELECT
                    movie.id_movie as 'id_movie_item',
                    movie.name as 'name_item',
                    new.thumbnail  as 'thumbnail_item',
                    movie.view as 'view_item',
                    new.id_movie
                    

                    FROM movie, new
                    WHERE movie.id_movie = new.id_movie AND movie.id_movie != $id_movie
                    GROUP BY movie.id_movie 
                    ORDER BY RAND() Limit 7 ";
                $result_item = $conn->query($query_item);
                if (!$result_item) echo "cau truy van bi sai";
                if ($result_item->num_rows != 0) {
                    while ($row = $result_item->fetch_assoc()) {
                        $id_movie_item = $row['id_movie_item'];

                        $name = $row['name_item'];
                        $thumbnail_item = $row['thumbnail_item'];
                        $view = $row['view_item'];
                ?>
                        <div class="slider-item">
                            <a href="play.php?id_movie=<?= $id_movie_item ?>">
                                <img class="slider-item-img" src="Data/thumbnail/<?= $thumbnail_item ?>">
                            </a>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>

        <div class="movie-list-container">
            <h2 class="movie-list-title">TẬP MỚI NHẤT</h2>
            <div class="movie-list-wrapper">
                <div class="tray-content index">
                    <?php
                    $query_new_ep = "SELECT movie.id_movie as 'id_movie',
                    movie.name as 'name',
                    episode.thumbnail_ep,
                    episode.view_ep ,
                    new.id_movie as 'id_movie_new',
                    
                    episode.name_ep,
                    episode.status

                    FROM movie, new , episode,session
                    WHERE movie.id_movie = new.id_movie AND movie.id_movie = session.id_movie 
                    AND session.id_session = episode.id_session AND episode.status='new' 
                    ORDER BY RAND() LIMIT 8 ";
                    $result_new_ep = $conn->query($query_new_ep);
                    if (!$result_new_ep) echo "cau truy van bi sai";
                    if ($result_new_ep->num_rows != 0) {
                        while ($row = $result_new_ep->fetch_assoc()) {
                            $id_movie = $row['id_movie'];
                            $id_movie_new = $row['id_movie_new'];
                            $name = $row['name'];
                            $name_ep = $row['name_ep'];
                            $thumbnail_ep = $row['thumbnail_ep'];
                            $view_ep = $row['view_ep'];
                    ?>
                            <div class="tray-item">
                            <a href="play.php?id_movie=<?= $id_movie ?>">
                                <img id="main_img" class="tray-item-thumbnail" src="Data/thumbnail_ep/<?=$thumbnail_ep?>">
                                <div class="tray-item-description">
                                    <div class="tray-item-title"><?=$name?></div>
                                    <div class="tray-item-meta-info">
                                        <span class="tray-episode-name"><?=$name_ep?></span>
                                        <span class="tray-episode-views"><?=number_format($view_ep)?> lượt xem</span>
                                    </div>
                                </div>
                                <div class="tray-item-play-button">
                                    <i class="fa fa-play" aria-hidden="true"></i>
                                </div>
                            </a>
                        </div>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="movie-list-container">
            <h2 class="movie-list-title">PHIM LẺ</h2>
            <div class="tray-content index">
                <?php
                $query_all = "SELECT * FROM movie, odd_movie WHERE movie.id_movie = odd_movie.id_movie";
                $result_all = $conn->query($query_all);
                if (!$result_all) echo "cau truy van bi sai";
                if ($result_all->num_rows != 0) {
                    while ($row = $result_all->fetch_assoc()) {
                        $id_odd_movie = $row['id_movie'];
                        $name_odd_movie = $row['name'];
                        $thumbnail_odd_movie = $row['thumbnail'];
                        $view_odd_movie = $row['view'];
                ?>
                        
                            <div class="tray-item">
                                <a href="play.php?id_movie=<?= $id_odd_movie ?>">
                                    <img id="main_img" class="tray-item-thumbnail" src="Data/thumbnail/<?=$thumbnail_odd_movie?>">
                                    <div class="tray-item-description">
                                        <div class="tray-item-title"><?=$name_odd_movie?></div>
                                        <div class="tray-item-meta-info">
                                            <!-- <span class="tray-episode-name">Tập 10 - Giờ ăn nhẹ</span> -->
                                            <span class="tray-episode-views"><?=number_format($view_odd_movie)?></span>
                                        </div>
                                    </div>
                                    <div class="tray-item-play-button">
                                    <i class="fa fa-play" aria-hidden="true"></i>
                                    </div>
                                </a>
                            </div>
                <?php
                    }
                }
                ?>

            </div>
        </div>
        <!-- <div class="featured-content" style="background: linear-gradient(to bottom, rgba(0,0,0,0), #151515), url('Data/thumbnail/f-2.jpg');">
            <img class="featured-title" src="Data/thumbnail/f-t-2.png" alt="">
            <p class="featured-desc">
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Iusto illo dolor
                deserunt nam assumenda ipsa eligendi dolore, ipsum id fugiat quo enim impedit, laboriosam omnis
                minima voluptatibus incidunt. Accusamus, provident.
            </p>
            <button class="featured-button">WATCH</button>
        </div> -->
        <div class="movie-list-container">
            <h2 class="movie-list-title">TẤT CẢ PHIM</h2>
            <div class="tray-content index">
                <?php
                $query_all = "SELECT * FROM movie";
                $result_all = $conn->query($query_all);
                if (!$result_all) echo "cau truy van bi sai";
                if ($result_all->num_rows != 0) {
                    while ($row = $result_all->fetch_assoc()) {
                        $id_movie_all = $row['id_movie'];
                        $name_all = $row['name'];
                        $thumbnail_all = $row['thumbnail'];
                        $view_all = $row['view'];
                ?>
                        
                            <div class="tray-item">
                                <?php
                                $query_id_ep = "SELECT MIN(episode.id_episode) as 'id_ep_first'
                                FROM movie,session,episode
                                WHERE movie.id_movie = session.id_movie AND session.id_session = episode.id_session  
                                AND movie.id_movie = $id_movie_all";
                                $result_id_ep = $conn->query($query_id_ep);
                                if (!$result_id_ep) echo "cau truy van bi sai";
                                if ($result_id_ep->num_rows != 0) {
                                    while ($row = $result_id_ep->fetch_assoc()) {
                                        $id_ep = $row['id_ep_first'];
                                    }
                                }
                                ?>
                                <a href="play.php?id_movie=<?= $id_movie_all?>&id_episode=<?=$id_ep?>">
                                    <img id="main_img" class="tray-item-thumbnail" src="Data/thumbnail/<?=$thumbnail_all?>">
                                    <div class="tray-item-description">
                                        <div class="tray-item-title"><?=$name_all?></div>
                                        <div class="tray-item-meta-info">
                                            <span class="tray-film-views"><?=number_format($view_all);?> lượt xem</span>
                                        </div>
                                    </div>
                                    <div class="tray-item-play-button">
                                    <i class="fa fa-play" aria-hidden="true"></i>
                                    </div>
                                </a>
                            </div>
                <?php
                    }
                }
                ?>

            </div>
        </div>
    </div>
    <script src="js/app.js"></script>
    <script src="js/OpenSearch.js"></script>
    <script src="js/close_nav.js"></script>
    <script src="js/change_tab.js"></script>
</body>