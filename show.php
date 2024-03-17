<?php

/*******w******** 
    
    Name: Arbie Lhyn Lacanlale
    Date: January 22, 2024
    Description:

****************/

require('connect.php');
$currentPage = 'home';

if (isset($_GET['id'])) {
    $postId = $_GET['id'];
    $query = "SELECT * FROM blog WHERE id = :id";
    $statement = $db->prepare($query);
    $statement->bindParam(':id', $postId);
    $statement->execute();

    $row = $statement->fetch();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main-1.css">
    <title>My Blog Post!</title>
</head>
<body>
    <!-- Remember that alternative syntax is good and html inside php is bad -->
    <?php include('nav.php'); ?>

    <div class="container">
        <div class="post">
            <div class="title"><?= $row['Title'] ?></div>
            <div class="timestamp"><?= $row['Date'] ?> | <a href="edit.php?id=<?= $row['id'] ?>"> Edit</a></div>
            <div class="content"><?= $row['Content'] ?></div>
            <hr>
        </div>
        <div class="goback">
            <a href="index-1.php">Main Page</a>
        </div>
    </div>
</body>
</html>