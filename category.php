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
        if (isset($_GET['id_general_cate'])) {
            $id_general_cate = $_GET['id_general_cate'];

            $query_cate = "SELECT *
            FROM general_cate
            WHERE id_general_cate = $id_general_cate";
            $result_cate = $conn->query($query_cate);
            if ($result_cate->num_rows != 0) {
                while ($row = $result_cate->fetch_assoc()) {
                    $name = $row['name'];
                }
            }
            ?>
                <div class="tray-title">
                    <h3> Thẻ loại : <?= $name ?></h3>
                </div>
                <div class="height-60" style="height: 20px;"></div>
            <?php


            $query_movie = "SELECT movie.id_movie,
            movie.name,
            movie.thumbnail,
            movie.view,
            general_cate.name as 'name_cate'
            FROM movie,general_cate
            WHERE movie.id_general_cate = general_cate.id_general_cate
            AND movie.id_general_cate = $id_general_cate
            GROUP By movie.id_movie";
            $result_movie = $conn->query($query_movie);
            if (!$result_movie) echo "cau truy van bi sai";
            if ($result_movie->num_rows != 0) {
                while ($row = $result_movie->fetch_assoc()) {
                    $id_movie = $row['id_movie'];
                    $name = $row['name'];
                    $name_cate = $row['name_cate'];
                    $thumbnail = $row['thumbnail'];
                    $view = $row['view'];
            ?>
                    <div class="tray-item">
                        <a href="play.php?id_movie=<?= $id_movie ?>">
                            <img class="tray-item-thumbnail" src="Data/thumbnail/<?= $thumbnail ?>">
                            <div class="tray-item-description">
                                <div class="tray-item-title"><?= $name ?></div>
                                <div class="tray-item-meta-info">
                                    <div class="tray-film-views"><?= number_format($view) ?> lượt xem</div>
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