<?php
// Traitement de single.php 
        $id ='';
        if(isset($_GET['id']) && is_numeric($_GET['id'])) {
            $id = $_GET['id'];
        }
        if (empty($_GET['id'])) {
            die ("L'article demandé n'existe pas ! ");
        }

// Sauvegarde d'un commentaire
if(isset($_POST['add-comment'])){
    if(!empty($_POST['author']) && !empty($_POST['comment'])){
        $author = $_POST['author'];
        $comment = $_POST['comment'];
        $id = $_POST['id'];

        saveComment($author, $id, $comment);
        header('Location: single.php?id='.$_POST['id']);
        exit();
    }
}

// Suppression d'un commentaire en fonction de son ID
if (isset($_GET['delete'])) {
    $comment_id = $_GET['delete'];
    deleteComment($comment_id);
}
?>