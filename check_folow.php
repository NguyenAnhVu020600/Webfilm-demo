<?php

    require "config.php";
    
    $id_movie = $_POST['id_movie'];
    $id_user = $_POST['id_user'];

    $query ="SELECT * FROM list_folow, movie, user 
    WHERE movie.id_movie = list_folow.id_movie 
    AND user.id_user = list_folow.id_user 
    AND list_folow.id_movie = $id_movie AND list_folow.id_user = $id_user";
    $result= $conn->query($query);
    if(!$result) echo "truy van sai";
    if ($result->num_rows > 0){
        $query_delete = "DELETE FROM list_folow WHERE id_user = '$id_user' AND id_movie = $id_movie";
        $result_delete= $conn->query($query_delete);
        echo "remove";
        
    } 
    else
    {
        $query_add = "INSERT INTO list_folow (id_movie,id_user) VALUES ('$id_movie','$id_user')";
        $result_add= $conn->query($query_add);
        if(!$result_add) echo "truy van sai";
        echo "add";
    }

?>