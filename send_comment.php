<?php

    require "config.php";
    $id_movie = $_POST['id_movie'];
    $id_user = $_POST['id_user'];
    $content = $_POST['content'];
    $today = date("d/m/Y");
    
    $queryadd = "INSERT INTO comments (id_user,id_movie,content,create_date)
    VALUES ('$id_user','$id_movie','$content','$today');";
    $result = $conn->query($queryadd);

?>
