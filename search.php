<?php
session_start();
require 'header.php';
require 'layout.php';
require 'config.php';

?>

<div class="container">
    <div class="content-container">
        <div class="height-60" style="height: 20px;"></div>
        <?php
        if (isset($_POST['word'])) {
            $word = $_POST['word'];
            
            $query_movie = "SELECT
                movie.id_movie ,
                movie.name ,
                movie.thumbnail,
                session.id_movie, 
                session.name_ss,
                session.thumbnail_ss,
                episode.id_episode,
                episode.name_ep,
                episode.thumbnail_ep,
                SUM(episode.view_ep) as 'sumview'
                FROM movie, session,episode
                WHERE movie.id_movie = session.id_movie 
                AND episode.id_session = session.id_session AND movie.name LIKE '%$word%'
                GROUP BY movie.id_movie";
            $result_movie = $conn->query($query_movie);
            $count = $result_movie->num_rows;
            ?>
                <div class="tray-title">
                    <h3>Có <?= $count ?> kết quả tìm kiếm cho : <?= $word ?></h3>
                </div>
                <div class="height-60" style="height: 20px;"></div>
            <?php
            if (!$result_movie) echo "cau truy van bi sai";
            if ($result_movie->num_rows != 0) {
                while ($row = $result_movie->fetch_assoc()) {
                    $id_movie = $row['id_movie'];
                    $id_episode = $row['id_episode'];
                    $name = $row['name'];
                    $name_ep = $row['name_ep'];
                    $thumbnail = $row['thumbnail'];
                    $sumview = $row['sumview'];
                ?>
                    <div class="tray-item">
                        <a href="play.php?id_movie=<?= $id_movie ?>">
                            <img class="tray-item-thumbnail" src="Data/thumbnail/<?= $thumbnail ?>">
                            <div class="tray-item-description">
                                <div class="tray-item-title"><?= $name ?></div>
                                <div class="tray-item-meta-info">
                                    <div class="tray-film-views"><?=number_format($sumview)?> lượt xem</div>
                                </div>
                            </div>
                            <div class="tray-film-genres">
                            </div>
                            <div class="tray-film-update">23 / 24 tập</div>
                            <div class="tray-item-play-button">
                                <i class="fa fa-play" aria-hidden="true"></i>
                            </div>
                        </a>
                    </div>
                <?php
                }
            }
        }
        ?>
    </div>
</div>

<script src="js/app.js"></script>
<script src="js/OpenSearch.js"></script>
<script src="js/close_nav.js"></script>
<script src="js/change_tab.js"></script>
<script src="js/play.js"></script>