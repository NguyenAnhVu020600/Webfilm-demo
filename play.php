<?php
session_start();
require "header.php";
require "layout.php";
require "config.php";

if (isset($_GET['id_movie']) && isset($_GET['id_episode'])) {
    $id_movie = $_GET['id_movie'];
    $id_episode = $_GET['id_episode'];
    $query = "SELECT
    movie.id_movie as 'id_movie',
    movie.name as 'name',
    movie.thumbnail as 'thumbnail',
    movie.view as 'view',
    session.id_movie, 
    session.name_ss,
    session.thumbnail_ss,
    SUBSTRING(episode.name_ep,5,2) as 'current_ep',
    MAX(episode.id_episode) as 'max_ep',
    episode.thumbnail_ep,
    episode.movie_link

    FROM movie, session,episode
    WHERE movie.id_movie = session.id_movie AND episode.id_session = session.id_session 
    AND movie.id_movie=$id_movie AND episode.id_episode = $id_episode
    GROUP BY movie.id_movie";
    $result = $conn->query($query);
    if (!$result) echo "cau truy van bi sai";
    if ($result->num_rows != 0) {
        while ($row = $result->fetch_assoc()) {
            $id_movie = $row['id_movie'];
            $name = $row['name'];
            $thumbnail = $row['thumbnail'];
            $view = $row['view'];
            $name_ss = $row['name_ss'];
            $thumbnail_ss = $row['thumbnail_ss'];
            $max_ep = $row['max_ep'];
            $current_ep = $row['current_ep'];
            $thumbnail_ep = $row['thumbnail_ep'];
            $movie_link = $row['movie_link'];
        }
    }

    $q_max = "SELECT MAX(episode.id_episode) as 'max_ep' ,
    Count(episode.id_episode)as 'sum_ep' 
    FROM episode,session,movie
    WHERE session.id_session = episode.id_session AND movie.id_movie = session.id_movie AND movie.id_movie =$id_movie;";
    $r_ep = $conn->query($q_max);
    if (!$r_ep) echo "cau truy van bi sai";
    if ($r_ep->num_rows != 0) {
        while ($row = $r_ep->fetch_assoc()) {
            $max_ep = $row['max_ep']; // tập lớn nhất
            $sum_ep = $row['sum_ep']; // tổng số tập
        }
    }
} else {
    $id_movie = $_GET['id_movie'];
    $q_max = "SELECT MAX(episode.id_episode) as 'max_ep' ,
    Count(episode.id_episode)as 'sum_ep' 
    FROM episode,session,movie
    WHERE session.id_session = episode.id_session AND movie.id_movie = session.id_movie AND movie.id_movie =$id_movie;";
    $r_ep = $conn->query($q_max);
    if (!$r_ep) echo "cau truy van bi sai";
    if ($r_ep->num_rows != 0) {
        while ($row = $r_ep->fetch_assoc()) {
            $max_ep = $row['max_ep']; // tập lớn nhất
            $sum_ep = $row['sum_ep']; // tổng số tập
        }
    }

    $query = "SELECT
    movie.id_movie as 'id_movie',
    movie.name as 'name',
    movie.thumbnail as 'thumbnail',
    movie.view as 'view',
    session.id_movie, 
    session.name_ss,
    session.thumbnail_ss,
    SUBSTRING(episode.name_ep,5,2) as 'current_ep',
    MAX(episode.id_episode) as 'max_ep',
    episode.thumbnail_ep,
    episode.movie_link

    FROM movie, session,episode
    WHERE movie.id_movie = session.id_movie AND episode.id_session = session.id_session 
    AND movie.id_movie=$id_movie AND episode.id_episode = $max_ep
    GROUP BY movie.id_movie";
    $result = $conn->query($query);
    if (!$result) echo "cau truy van bi sai";
    if ($result->num_rows != 0) {
        while ($row = $result->fetch_assoc()) {
            $id_movie = $row['id_movie'];
            $name = $row['name'];
            $thumbnail = $row['thumbnail'];
            $view = $row['view'];
            $name_ss = $row['name_ss'];
            $thumbnail_ss = $row['thumbnail_ss'];
            $max_ep = $row['max_ep'];
            $current_ep = $row['current_ep'];
            $thumbnail_ep = $row['thumbnail_ep'];
            $movie_link = $row['movie_link'];
        }
    }
}

?>
<div class="player-container">
    <div class="player-wrapper">
        <div class="player-main">
            <div id="player" class="player player-paused user-inactive" tabindex="0">
                <iframe src="<?=$movie_link?>" frameborder="0" allowFullScreen="true" width="960" height="540">
                    <video class="player-video" id="main-video" autoplay="" preload="auto" playsinline="" webkit-playsinline="" src="<?= $movie_link ?>" tabindex="1"></video>
                </iframe>
                <!-- <div class="player-control-bar">

                    <div class="player-control player-prev-control">
                        <div class="player-control-tip" id="hover_prev">
                            <span>Tập trước</span>
                        </div>
                        <i class="material-icons hover_icon3">skip_previous</i>
                    </div>
                    <div class="player-control player-replay-control">
                        <div class="player-control-tip" id="hover_replay">
                            <span>Lùi 10s</span>
                        </div>
                        <i class="material-icons hover_icon4">replay_10</i>
                    </div>
                    <div class="player-control ">
                        <div id="hover_play" class="player-control-tip">
                            <span>Phát</span>
                        </div>
                        <i class="material-icons player-play-control hover_icon1">play_arrow</i>
                    </div>
                    <div class="player-control player-forward-control">
                        <i class="material-icons hover_icon5">forward_10</i>
                        <div class="player-control-tip" id="hover_forward">
                            <span>Tới 10s</span>
                        </div>
                    </div>
                    <div class="player-control player-next-control disabled">
                        <i class="material-icons hover_icon2">skip_next</i>
                        <div class="player-control-tip" id="hover_next">
                            <span>Tập sau</span>
                        </div>
                    </div>
                    <div class="player-control player-volume-control">
                        <div class=" player-volume-toggle">
                            <i class="material-icons player-volume-control">volume_up</i>

                        </div>

                        <div class="player-volume-level">
                            <div class="volume-holder">
                                <div class="volume-slider"></div>
                                <div class="volume-current" style="height: 100%;"></div>
                                <div class="volume-handle" style="bottom: 99.5%;"></div>
                            </div>
                        </div>
                    </div>
                    <div class="player-control player-current player-time"><span>--:--</span></div>
                    <div class="player-progress-control">
                        <div class="player-progress-holder">
                            <div class="player-progress-background"></div>
                            <div class="player-load-progress" style="width: 00.00%;"></div>
                            <div class="player-play-progress" style="width: 00.00%;"></div>
                            <div class="player-seek-handle" style="left: 00.00%;"></div>
                        </div>
                    </div>
                    <div class="player-control player-duration player-time"><span>00:00</span></div>

                    <div class="player-control player-light-control">
                        <i class="material-icons hover_icon6">sunny</i>
                        <div class="player-control-tip" id="hover_sunny">
                            <span>Tắt đèn</span>
                        </div>
                    </div>
                    <div class="player-control picture-in-picture-control">
                        <i class="material-icons hover_icon7">picture_in_picture_alt</i>
                        <div class="player-control-tip" id="hover_picture">
                            <span>Trình phát thu nhỏ</span>
                        </div>
                    </div>
                    <div class="player-control player-setting-control">
                        <i class="material-icons">settings</i>
                        <div class="player-control-tip">
                            <span>Tuỳ chỉnh</span>
                        </div>
                    </div>
                    <div class="player-control ">
                        <i class="material-icons player-fullscreen-control hover_icon9">fullscreen</i>
                        <div class="player-control-tip" id="hover_full">
                            <span>Toàn màn hình</span>
                        </div>
                    </div>
                </div>
                 -->

                

                <!-- <div class="player-board">
                    <div class="player-board-close"><i class="material-icons">close</i></div>
                    <div class="player-board-item setting-selector">
                        <div class="label">Chọn tập</div><input class="selector-input" type="number" min="1" max="999"><span class="selector-button"><i class="icon-play"></i></span><span class="selector-tip"></span>
                    </div>
                    <div class="player-board-item setting-server">
                        <div class="label">Máy chủ</div><span class="setting-server-item server-1 active">SG</span>
                    </div>
                    <div class="player-board-item setting-quality">
                        <div class="label">Chất lượng</div><span class="setting-quality-item quality-auto">auto</span><span class="setting-quality-item quality-480p active">480p</span><span class="setting-quality-item quality-720p">720p<sup class="">HD</sup></span><span class="setting-quality-item quality-1080p">1080p<sup class="">HD</sup></span>
                    </div>
                    <div class="player-board-item setting-speed">
                        <div class="label">Tốc độ</div><span class="setting-speed-item speed-0.25">0.25</span><span class="setting-speed-item speed-0.5">0.5</span><span class="setting-speed-item speed-1 active">1</span><span class="setting-speed-item speed-1.5">1.5</span><span class="setting-speed-item speed-2">2</span>
                    </div>
                </div> -->
                <div class="player-error-display"><i class="icon-alert"></i><span class="player-error-message"></span></div>
                <div class="player-loading"></div>
                <div class="player-loading-text"></div><video class="player-vast-video hidden" autoplay="" preload="auto" playsinline="" webkit-playsinline=""></video>
            </div>
            <div class="player-meta">
                <h1 class="film-info-title" id="name_ep"><?= $name ?> Tập <?= $current_ep ?> </h1>
                <div class="film-info-views">
                    <span><?= number_format($view) ?> lượt xem</span>
                </div>

                <div class="film-info-action">
                    <a href="https://www.facebook.com/sharer/sharer.php?u=https://vuighe.net/summertime-render/tap-8-memento" target="_blank">
                        <div class="film-info-share">
                            <i class="fa fa-share-alt" aria-hidden="true"></i>
                            <span>Share</span>
                        </div>
                    </a>
                    
                    <div class="film-info-like" data-movie="<?=$id_movie?>" id="id_mv_like">
                        <?php
                            if(isset($_SESSION['id_user'])){
                                $id_user =$_SESSION['id_user'];

                                $query ="SELECT * FROM list_like, movie, user 
                                WHERE movie.id_movie = list_like.id_movie 
                                AND user.id_user = list_like.id_user 
                                AND list_like.id_movie = $id_movie AND list_like.id_user = $id_user";
                                $result= $conn->query($query);
                                if(!$result) echo "truy van sai";
                                if ($result->num_rows > 0){
                                    echo "<i class='fa fa-heart change_color' aria-hidden='true' style='color:#e50d1e'></i>";
                                }
                                else  echo "<i class='fa fa-heart change_color' aria-hidden='true'></i>";

                            }
                            else{
                                echo "<i class='fa fa-heart change_color' aria-hidden='true'></i>";
                            }
                           
                            
                            $q ="SELECT count(id_movie) as 'count_like' FROM list_like
                            WHERE id_movie = $id_movie";
                            $r= $conn->query($q);
                            if(!$r) echo "truy van sai";
                            if ($r->num_rows != 0) {
                                while ($row = $r->fetch_assoc()) {
                                    $count_like = $row['count_like'];
                                }
                            }
                        ?>
                        
                        <span class="film-like-label">thích</span>
                        <span class="count-box"><?=$count_like?></span>
                    </div>

                    <input type = "hidden" class ="id_ur" value="<?=$id_user?>"/>

                    <div class="film-info-follow" id="id_mv_folow">
                        <?php
                            if(isset($_SESSION['id_user'])){
                                $id_user =$_SESSION['id_user'];
                                $query ="SELECT * FROM list_folow, movie, user 
                                WHERE movie.id_movie = list_folow.id_movie 
                                AND user.id_user = list_folow.id_user 
                                AND list_folow.id_movie = $id_movie AND list_folow.id_user = $id_user";
                                $result= $conn->query($query);
                                if(!$result) echo "truy van sai";
                                if ($result->num_rows > 0){
                                    echo "<i class='fa fa-bell change_color_fl' aria-hidden='true' style='color:#00ffe7'></i>";
                                }
                                else  echo "<i class='fa fa-bell change_color_fl' aria-hidden='true'></i>";
                                
                            }
                            else{
                                echo "<i class='fa fa-bell change_color_fl' aria-hidden='true'></i>";
                            }
                            
                            $q ="SELECT count(id_movie) as 'count_folow' FROM list_folow
                            WHERE id_movie = $id_movie";
                            $r= $conn->query($q);
                            if(!$r) echo "truy van sai";
                            if ($r->num_rows != 0) {
                                while ($row = $r->fetch_assoc()) {
                                    $count_folow = $row['count_folow'];
                                }
                            }
                        ?>
                        <span class="film-follow-label">theo dõi</span>
                        <span class="count-box-fl"><?=$count_folow?></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="player-sidebar">
            <div class="player-sidebar-header">
                <div class="tab-item tab-episode-comment activated" data-id="3">Danh sách tập</div>
                <div class="tab-item tab-ova" data-id="4">OVA</div>
                <div class="tab-item tab-video" data-id="5">Video</div>
                <div class="tab-item tab-information" data-id="6"><span>Thông tin</span><i class="icon icon-information"></i></div>
                <div class="tab-item tab-episode-comment " data-id="cmt">Bình luận</div>
            </div>
            <div class="player-sidebar-body body-episode " data-id="3">
                <div class="episode-list-tool">
                    <?php

                    $query_count_ss = "SELECT movie.id_movie,
                    Count(session.id_session) as 'count_ss'
                    FROM movie,session
                    Where movie.id_movie = session.id_movie AND movie.id_movie=$id_movie";
                    $result_count_ss = $conn->query($query_count_ss);
                    if (!$result_count_ss) echo "cau truy van bi sai";
                    if ($result_count_ss->num_rows != 0) {
                        while ($row = $result_count_ss->fetch_assoc()) {
                            $count_ss = $row['count_ss'];
                        }
                    }
                    if ($count_ss == 1) {
                    ?>
                        <div class="episode-total">Tổng số: <?= $sum_ep ?> video</div>
                        <div class="episode-select">
                            Tập <input type="number" min="1" max="<?= $sum_ep ?>" value="<?= intval($current_ep)?>" name="current-episode">
                            <div class="play-button">
                                <i class="fa fa-play" aria-hidden="true"></i>
                            </div>
                        </div>
                        <?php
                    } else {
                        $query_ss = "SELECT movie.id_movie,
                        Count(session.id_session) as 'count_ss',
                        new.id_movie as 'id_movie_new'
                        FROM movie,session,new
                        Where movie.id_movie = session.id_movie AND movie.id_movie = new.id_movie AND movie.id_movie=$id_movie";
                        $result_ss = $conn->query($query_ss);
                        if (!$result_ss) echo "cau truy van bi sai";
                        if ($result_ss->num_rows != 0) {
                            while ($row = $result_ss->fetch_assoc()) {
                                $id_movie_new = $row['id_movie_new'];
                            }
                        }
                        $query_ss1 = "SELECT movie.id_movie,
                            session.id_session,
                            session.id_movie,
                            session.name_ss,
                            session.number_episode,
                            LEFT(session.name_ss,10) as 'session'
                            FROM movie,session
                            Where movie.id_movie = session.id_movie AND movie.id_movie=$id_movie";
                        $result_ss1 = $conn->query($query_ss1);
                        if (!$result_ss1) echo "cau truy van bi sai";
                        if ($result_ss1->num_rows != 0) {
                            $count = 1;
                            while ($row = $result_ss1->fetch_assoc()) {
                                $id_movie_ss1 = $row['id_movie'];
                                $id_session_ss1 = $row['id_session'];
                                $name_ss1 = $row['name_ss'];
                                $session = $row['session'];
                                $number_episode = $row['number_episode'];
                                if ($count == 1) {
                                    if ($id_movie_new != null) {
                                        if (isset($_GET['id_episode'])) {
                        ?>
                                            <div class="season-active activated" id="activated_ss" data-id="<?= $count ?>">
                                                <div class="season-name"><?= $session ?></div>
                                                <div class="season-range"><?= $number_episode ?></div>
                                            </div>
                                        <?php
                                        } else {
                                        ?>
                                            <div class="season-active hidden" id="activated_ss" data-id="<?= $count ?>">
                                                <div class="season-name"><?= $session ?></div>
                                                <div class="season-range"><?= $number_episode ?></div>
                                            </div>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <div class="season-active activated" id="activated_ss" data-id="<?= $count ?>">
                                            <div class="season-name"><?= $session ?></div>
                                            <div class="season-range"><?= $number_episode ?></div>
                                        </div>
                                        <?php
                                    }
                                } else {
                                    if ($id_movie_new != null) {
                                        if (isset($_GET['id_episode'])) {
                                        ?>
                                            <div class="season-active hidden" id="activated_ss" data-id="<?= $count ?>">
                                                <div class="season-name"><?= $session ?></div>
                                                <div class="season-range"><?= $number_episode ?></div>
                                            </div>
                                        <?php
                                        } else {
                                        ?>
                                            <div class="season-active activated" id="activated_ss" data-id="<?= $count ?>">
                                                <div class="season-name"><?= $session ?></div>
                                                <div class="season-range"><?= $number_episode ?></div>
                                            </div>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <div class="season-active hidden" id="activated_ss" data-id="<?= $count ?>">
                                            <div class="season-name"><?= $session ?></div>
                                            <div class="season-range"><?= $number_episode ?></div>
                                        </div>
                            <?php
                                    }
                                }
                                $count++;
                            }
                            ?>
                            <div class="episode-select">
                                Tập <input type="number" min="1" max="<?= $sum_ep ?>" value="<?= $current_ep + 0;?>" name="current-episode">
                                <div class="play-button">
                                    <i class="fa fa-play" aria-hidden="true"></i>
                                </div>
                            </div>
                    <?php
                        }
                    }
                    ?>
                    <input id="id_movie" value="<?= $id_movie ?>" type="hidden" />
                    <!-- số lượng session -->
                    <div class="season-list ps-container ps-theme-default " id="activated_list_ss">
                        <?php
                        $query_ss_dr = "SELECT 
                        session.id_session,
                        session.name_ss,
                        session.number_episode
                        FROM movie,session
                        Where movie.id_movie = session.id_movie AND movie.id_movie=$id_movie";
                        $result_ss_dr = $conn->query($query_ss_dr);
                        if (!$result_ss_dr) echo "cau truy van bi sai";
                        if ($result_ss_dr->num_rows != 0) {
                            $count = 1;

                            while ($row = $result_ss_dr->fetch_assoc()) {
                                $id_session_dr = $row['id_session'];
                                $name_ss_dr = $row['name_ss'];
                                $number_episode_dr = $row['number_episode'];
                                if ($count == 1) {
                        ?>
                                    <div class="season-item activated" onclick="session_click(this)" data-id="<?= $id_session_dr ?>">
                                        <span class="season-item-name"><?= $name_ss_dr ?></span>
                                        <span class="season-item-range"><?= $number_episode_dr ?></span>
                                    </div>
                                <?php
                                } else {
                                ?>
                                    <div class="season-item " onclick="session_click(this)" data-id="<?= $id_session_dr ?>">
                                        <span class="season-item-name"><?= $name_ss_dr ?></span>
                                        <span class="season-item-range"><?= $number_episode_dr ?></span>
                                    </div>
                        <?php
                                }
                                $count++;
                            }
                        }
                        ?>
                    </div>
                </div>
                <!-- danh sách các tập -->
                <div class="episode-list ps-container ps-theme-default ps-active-y" id="list_movie_ss">
                    <?php
                    if (isset($_GET['id_movie']) && isset($_GET['id_episode'])) {
                        $query_session = "SELECT MIN(session.id_session) as'id_session',
                        movie.id_movie
                        FROM movie,session
                        WHERE movie.id_movie = session.id_movie AND movie.id_movie = $id_movie";
                        $result_session = $conn->query($query_session);
                        if (!$result_session) echo "cau truy van bi sai";
                        if ($result_session->num_rows != 0) {
                            while ($row = $result_session->fetch_assoc()) {
                                $id_movie_ss = $row['id_movie'];
                                $id_session_ss = $row['id_session'];
                            }
                        }
                    } else {
                        $query_session = "SELECT session.id_session,
                        movie.id_movie
                        FROM movie,session
                        WHERE movie.id_movie = session.id_movie AND movie.id_movie = $id_movie";
                        $result_session = $conn->query($query_session);
                        if (!$result_session) echo "cau truy van bi sai";
                        if ($result_session->num_rows != 0) {
                            while ($row = $result_session->fetch_assoc()) {
                                $id_movie_ss = $row['id_movie'];
                                $id_session_ss = $row['id_session'];
                            }
                        }
                    }
                    $query = "SELECT
                        movie.id_movie ,
                        movie.name ,
                        session.id_movie, 
                        session.name_ss,
                        session.thumbnail_ss,
                        episode.id_episode,
                        episode.name_ep,
                        episode.thumbnail_ep,
                        episode.view_ep
                        FROM movie, session,episode
                        WHERE movie.id_movie = session.id_movie 
                        AND episode.id_session = session.id_session AND movie.id_movie =$id_movie 
                        AND session.id_session = $id_session_ss";
                    $result = $conn->query($query);
                    if (!$result) echo "cau truy van bi sai";
                    if ($result->num_rows != 0) {
                        while ($row = $result->fetch_assoc()) {
                            $id_movie = $row['id_movie'];
                            $id_episode = $row['id_episode'];
                            $name = $row['name'];
                            $name_ep = $row['name_ep'];
                            $thumbnail_ep = $row['thumbnail_ep'];
                            $view_ep = $row['view_ep'];

                    ?>
                            <div class="episode-item" id="img_ep">
                                <a href="play.php?id_movie=<?= $id_movie ?>&id_episode=<?= $id_episode ?>">
                                    <div class="episode-item-thumbnail">
                                        <img src="Data/thumbnail_ep/<?= $thumbnail_ep ?>">
                                    </div>
                                    <div class="episode-item-meta">
                                        <div class="episode-item-title"><?= $name_ep ?></div>
                                        <div class="episode-item-views"><?= number_format($view_ep) ?> lượt xem</div>
                                    </div>
                                </a>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
                <!-- ô nhập comment -->
                
            </div>
            <div class="player-sidebar-body body-comment hidden" data-id="cmt">
                <div class="comment-input">
                    
                    <input type="text" name="comment-input" value="" id="comment-content" autocomplete="off" placeholder="Bình luận...">
                    <i class="material-icons comment-send">send</i>
                    
                    <!-- <span id="comment-emoticon" class="comment-emoticon icon-smile emoji-toggle"><i class='far fa-grin-beam'></i></span>
                    <div id="emoji-picker" class="emoji-picker hidden">
                        <div class="emoji-picker-header">
                            <div class="emoji-close"><i class="icon-close"></i></div>
                        </div>
                        <div class="emoji-picker-body">
                            <ul class="emoji-list emoji-panda" data-tab="panda"></ul>
                            <ul class="emoji-list emoji-onion hidden" data-tab="onion"></ul>
                        </div>
                    </div> -->
                </div>
                <!-- nội dung comment -->
                <div class="comment-list ps-container ps-theme-default ps-active-y" data-ps-id="02511de2-2565-e90d-c92d-0c9c2455e129">
                    <!-- <div class="input_group" >
                        <input type="text" name="reply-input" id="reply-input" class="reply-input hidden" autocomplete="off">
                        <i class="material-icons">send</i>
                    </div> -->
                    <div class="comment-item">
                        <?php
                        $query_comment = "SELECT
                        comments.id_movie,
                        comments.id_user,
                        comments.content,
                        comments.create_date,
                        user.avatar,
                        user.username
                        FROM comments, user
                        WHERE comments.id_user = user.id_user AND comments.id_movie = $id_movie ";
                        $result_comment = $conn->query($query_comment);
                        if (!$result_comment) echo "cau truy van bi sai";
                        if ($result_comment->num_rows != 0) {
                            while ($row = $result_comment->fetch_assoc()) {
                                $id_user_cmt = $row['id_user'];
                                $content_cmt = $row['content'];
                                $avatar_cmt = $row['avatar'];
                                $create_date = $row['create_date'];
                                $username_cmt = $row['username'];
                            ?>
                                <div class="author-avatar">
                                    <img class="avatar_comment" src="Data/img_user/<?= $avatar_cmt ?>">
                                </div>
                                <div class="comment-item-body">
                                    <div class="author-name"><?= $username_cmt ?></div>
                                    <div class="comment-content"><?= $content_cmt ?></div>
                                    <div class="comment-action">
                                        <!-- <span class="comment-reply"><i class="fa fa-comment" aria-hidden="true"></i> trả lời</span> -->
                                        <span class="comment-time"><i class="fa fa-clock-o" aria-hidden="true"></i><?= $create_date ?></span>
                                    </div>
                                    <!-- <div class="reply-count"><i class="fa fa-caret-down" aria-hidden="true"></i> 1 trả lời</div> -->
                                    <!-- <div class="reply-list">
                                            <div data-id="1163250" data-parent-id="1163201" class="reply-item reply-item-1163250">
                                                <div class="author-avatar"><img class="avatar_comment" src="https://s199.imacdn.com/vg/2021/08/04/bbee3a1342de808b_3849d249f984b63e_1150616280921732670449.jpg"></div>
                                                <div class="reply-item-body">
                                                    <div class="author-name">H.N nguyễn</div>
                                                    <div class="reply-content">Chung waifu này</div>
                                                    <div class="comment-action"><span class="comment-reply"><i class="icon icon-comment"></i> trả lời</span><span class="comment-time"><i class="icon icon-time"></i> 4 ngày trước</span></div>
                                                </div>
                                            </div>
                                        </div> -->
                                </div>
                            <?php
                            }
                        }
                        ?>
                    </div>
                    <!-- <input type="button" class="comment-more" value="Xem thêm"> -->
                </div>
            </div>
        </div>
        <div class="container play">
            <div class="film-content">
                <div class="film-info">
                    <div class="film-info-genre">
                        Thể loại:
                        <?php
                        $q_cate = "SELECT movie.description,
                        COUNT(category.name_category) as 'count_cate'
                        FROM movie,category_detail,category
                        WHERE category_detail.id_category = category.id_category 
                        AND movie.id_movie = category_detail.id_movie AND movie.id_movie =$id_movie;";
                        $r_cate = $conn->query($q_cate);
                        if (!$r_cate) echo "cau truy van bi sai";
                        if ($r_cate->num_rows != 0) {
                            while ($row = $r_cate->fetch_assoc()) {
                                $description = $row['description'];
                                $count_cate = $row['count_cate'];
                            }
                        }
                        $q_info = "SELECT
                        category.name_category
                        FROM movie,category_detail,category
                        WHERE category_detail.id_category = category.id_category 
                        AND movie.id_movie = category_detail.id_movie AND movie.id_movie =$id_movie;";
                        $r_info = $conn->query($q_info);
                        if (!$r_info) echo "cau truy van bi sai";
                        if ($r_info->num_rows != 0) {
                            $count = 1;
                            while ($row = $r_info->fetch_assoc()) {
                                $name_category = $row['name_category'];
                                if ($count != $count_cate) {
                        ?>
                                    <a href="#" style="color: #1ab394;"><?= $name_category ?> </a>,
                                <?php
                                } else {
                                ?>
                                    <a href="#" style="color: #1ab394;"><?= $name_category ?> </a>
                        <?php
                                }
                                $count++;
                            }
                        }
                        ?>
                    </div>
                    <div class="film-info-subteam">
                        Nhóm sub:
                        <a href="index.php" rel="nofollow" style="color: #1ab394;">MePhim Sub</a>
                    </div>
                    <div class="film-info-genre">Tổng số tập: 999 tập</div>
                    <div class="film-info-description">
                        <p><?= $description ?></p>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="js/app.js"></script>
    <script src="js/OpenSearch.js"></script>
    <script src="js/close_nav.js"></script>
    <script src="js/change_tab.js"></script>
    <script src="js/play.js"></script>
