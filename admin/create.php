<?php 
    require_once('../refactoring.php');
?>

<?php
$errors = array();
$title = '';
$author = ''; 
$content = ''; 

    if (isset($_POST['add-post'])){
        // La gestion des erreurs sur les valeurs des champs du formulaire
        $errors = validatePost($_POST);
        // Traitement de l'image

         if(!empty($_FILES['image']['name'])){
            $image_name = time().'_'.$_FILES['image']['name'];
            $destination = "../images/$image_name";

           $result = move_uploaded_file($_FILES['image']['tmp_name'], $destination);
           if ($result){
                $_POST['image'] = $image_name;
           } else{
                array_push($errors, 'L\'enregistrement de l\'article n\'a pas fonctionné');
           }
        } else{
            array_push($errors, 'Vous devez sélectionner une image');
        }
        if (count($errors) == 0){
            $_POST['content'] = nl2br(htmlentities($_POST['content']));

            // Enregistrement de l'article dans la BDD
            create($_POST['author'],$_POST['title'],$_POST['content'],$_POST['image']);
            header('Location: index.php');
            exit();
        } else{
            $title = $_POST['title'];
            $author = $_POST['author'];
            $content = $_POST['content'];
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Custom Styling -->
    <link rel="stylesheet" href="../css/style.css">

    <!-- Admin Styling -->
    <link rel="stylesheet" href="../css/admin.css">

    <title>Admin Section - Add Post</title>
</head>

<body>
    <!-- Header -->
    <?php include('../inc/header.php'); ?>

    <!-- Admin Page Wrapper -->
    <div class="admin-container">


        <!-- // Left Sidebar -->


        <!-- Admin Content -->
        <div class="admin-content">
            <div class="button-group">
                <a href="create.html" class="btn btn-big">Ajout un article</a>
                <a href="index.html" class="btn btn-big">Gérer des articles</a>
            </div>


            <div class="container">
                <h2 class="page-title">Gestion des articles</h2>
                <?php include('formErrors.php'); ?>
                <form action="create.php" enctype="multipart/form-data" method="post">
                    <div>
                        <label>Author</label>
                        <input type="text" name="author" value="<?= $author ?>" class="text-input">
                    </div>
                    <div>
                        <label>Title</label>
                        <input type="text" name="title" value="<?= $title ?>" class="text-input">
                    </div>
                    <div>
                        <label>Contenu</label>
                        <textarea cols="130" , rows="10" name="content" value="<?= $content ?>" id="body"></textarea>
                    </div>
                    <div>
                        <label>Image</label>
                        <input type="file" name="image" class="text-input">
                    </div>

                    <div>
                        <button type="submit" name="add-post" class="btn btn-big">Add Post</button>
                    </div>
                </form>

            </div>

        </div>
        <!-- // Admin Content -->

    </div>
    <!-- // Page Wrapper -->

    <!-- Footer -->
    <?php include('../inc/footer.php'); ?>
</body>

</html>