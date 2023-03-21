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
    function selectAll($noPage, $perPage){
        global $pdo;
    // 3 *($noPage = 1)
        $results = $pdo->query('SELECT * FROM posts ORDER BY created_at DESC LIMIT '. ($perPage*($noPage-1)).','.$perPage);
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

    // Sélection de tous les articles
    function pagination(){
        global $pdo;
        $query = $pdo->prepare('SELECT COUNT(*) as nbr_articles FROM posts');
        $query->execute([]);
        $nombre = $query->fetch();

        return $nombre['nbr_articles'];
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

    // Supprimer un article
    function deletePost($id){
        global $pdo;

        $query = $pdo->prepare('DELETE FROM posts WHERE id = :id');
        $query->execute(['id'=>$id]);
    }

    // Sauvegarder un commentaire
    function saveComment($author, $id_post, $comment){
        global $pdo;

        $query = $pdo->prepare('INSERT INTO comments(id_post, author, comment, created_at) VALUES(:id_post, :author, :comment, NOW())');
        $query -> execute([
            'id_post' => $id_post,
            'author' => $author,
            'comment' => $comment
        ]);
    }

        // Supprimer un commentaire
        function deleteComment($id){
            global $pdo;
    
            $query = $pdo->prepare('DELETE FROM comments WHERE id = :id');
            $query->execute(['id'=>$id]);
        }

    // Récupérer les commentaires dans la BDD
    function findAllComments($id_post){
        global $pdo;

        $query = $pdo->prepare('SELECT * FROM comments WHERE id_post = :post_id ORDER BY created_at DESC');
        $query->execute([
            'post_id' => $id_post
        ]);
        $comments = $query->fetchAll();
        return $comments;
    }
?>