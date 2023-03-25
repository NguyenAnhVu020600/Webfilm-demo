<?php
require 'config.php';
$id_session = $_POST['id_session'];
$id_movie = $_POST['id_movie'];

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
    AND session.id_session = $id_session";
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
            <div class="episode-item active" id="img_ep">
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