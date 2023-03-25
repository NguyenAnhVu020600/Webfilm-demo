<?php
session_start();
require 'header.php';
require 'layout.php';
require 'config.php';
?>

<div class="container">
    <div class="content-container-new">
        <!-- <div class="height-60" style="height: 20px;"></div> -->
            <div class="tray-title">
                <h3>Tin Mới Nhất</h3>
            </div>
            <div class="new-content">
            <?php
            $q_news = "SELECT * 
            FROM news";
            $r_news = $conn->query($q_news);
            if (!$r_news) echo "cau truy van bi sai";
            if ($r_news->num_rows != 0) {
                while ($row = $r_news->fetch_assoc()) {
                    $name_news = $row['name'];
                    $thumbnail_news = $row['thumbnail_news'];
                    $link_news = $row['link'];
                    ?>
                        <div class="news-item">
                            <a href="<?=$link_news?>" target="_blank">
                                <img class="news-item-thumbnail" src="Data/thumbnail_news/<?=$thumbnail_news?>">
                            </a>
                            <div class="news-item-meta">
                                <div class="news-item-title"><a href="<?=$link_news?>" target="_blank"><?=$name_news?></a></div>
                                <div class="news-item-site">Tin tức</div>
                                <div class="news-item-description"></div>
                            </div>
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
<script src="js/play.js"></script>