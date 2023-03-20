<?php
// Traitement de single.php 
        $id ='';
        if(isset($_GET['id']) && is_numeric($_GET['id'])) {
            $id = $_GET['id'];
        }
        if (empty($_GET['id'])) {
            die ("L'article demandé n'existe pas ! ");
        }

?>