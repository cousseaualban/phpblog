<?php
// Connexion à la BDD en PDO
require_once 'refactoring.php';

        // Récupération de tous les articles de ma base
    // SELECT * FROM posts ORDER BY created_at DESC LIMIT 0,3
    $posts = selectAll();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Mini-Blog</title>
</head>

<body>
    <!-- Page Header -->
    <?php include('inc/header.php'); ?>

    <!-- Page Wrapper -->
    <div class="page-container">

        <!-- Post Slider -->
        <div class="posts">
            <h1 class="posts-title">Articles</h1>
            <div class="post-container">

                <?php foreach($posts as $post): ?>
                <div class="post">
                    <img src="<?php echo 'images/' .$post['image']; ?>" alt="Image de l'article 1" class="slider-image">
                    <div class="post-info">
                        <h4><a href="single.php?id=<?= $post['id'] ?>"><?php echo $post['title']; ?></a></h4>
                        <i> <?php echo $post['author']; ?></i>
                        &nbsp;
                        <i> <?php echo date('d F, Y', strtotime($post['created_at'])) ?></i>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- footer -->
        <?php include('inc/footer.php'); ?>
        <!-- // footer -->

        <body>

</html>