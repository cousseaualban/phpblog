<?php 
    require_once 'db.php';

    // Validation d'un article
    function validatePost($post){
        $errors = array();
        if(empty($post['author'])){
            array_push($errors, 'Veuillez écrire votre nom');
        }
        if(empty($post['title'])){
            array_push($errors, 'Veuillez saisir un titre d\'article');
        }
        if(empty($post['content'])){
            array_push($errors, 'Veuillez rédiger le contenu de l\'article');
        }
        return $errors;
    }

    // Récupération de tous les articles
    function selectAll(){
        global $pdo;

        $results = $pdo->query('SELECT * FROM posts ORDER BY created_at DESC LIMIT 0,3');
        $posts = $results->fetchAll();
        return $posts;    
    }

    // Récupération d'un article en fonction de l'ID
    function selectOne($id){
        global $pdo;

        $query = $pdo->prepare('SELECT * FROM posts WHERE id = :post_id');
        $query->execute(array('post_id' => $id));
        $post = $query->fetch();
        return $post;
    }

    // Enregistrement d'un article
    function create($author, $title, $content, $image){
        global $pdo;

        $query = $pdo->prepare('INSERT INTO posts(author, title, content, image, created_at) VALUES(:auteur, :titre, :contenu, :image, NOW())');
        $query -> execute([
            'auteur' => $author,
            'titre' => $title,
            'contenu' => $content,
            'image' => $image
        ]);

    }

    // Modification d'un article
    function updatePost($id, $author, $title, $content, $image){
        global $pdo;

        $query = $pdo->prepare('UPDATE posts SET author = :auteur, title = :titre, content = :contenu, image = :image WHERE id = :id');
        $query -> execute([
            'auteur' => $author,
            'titre' => $title,
            'contenu' => $content,
            'image' => $image,
            'id' => $id
        ]);
    }
?>