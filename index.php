<?php

/*******w******** 
    
    Name: Arbie Lhyn Lacanlale
    Date: January 22, 2024
    Description:

****************/

require('connect.php');
$currentPage = 'home';

     // SQL is written as a String.
     $query = "SELECT * FROM blog ORDER BY Date DESC LIMIT 5";

     // A PDO::Statement is prepared from the query.
     $statement = $db->prepare($query);

     // Execution on the DB server is delayed until we execute().
     $statement->execute();

     // Function to format date
    function formatDate($dateString) {
        return date("F d, Y, h:i a", strtotime($dateString));
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main-1.css">
    <title>Welcome to my Blog!</title>
</head>
<body>
    <!-- Remember that alternative syntax is good and html inside php is bad -->
    <?php include('nav.php'); ?>

    <div class="container">
        <div id="subject">Latest Posts</div>
        <!-- Fetch each table row in turn. Each $row is a table row hash.
            Fetch returns FALSE when out of rows, halting the loop. -->
        <?php while($row = $statement->fetch()): ?>
            <div class="post">
            <div class="title">
                    <a href="show.php?id=<?= $row['id'] ?>">
                        <?= $row['Title'] ?>
                    </a>
                </div>
                <div class="timestamp"><?= formatDate($row['Date']) ?> <a href="edit.php?id=<?= $row['id'] ?>"> - Edit</a></div>
                <div class="content">
                <div class="content">
                    <?php
                    $content = $row['Content'];
                    $truncatedContent = strlen($content) > 200 ? substr($content, 0, 200) . '...' : $content;
                    echo $truncatedContent;
                    ?>
                </div>
                <div class="read-more">
                    <?php if (strlen($content) > 200): ?>
                        <a href="show.php?id=<?= $row['id'] ?>">More...</a>
                    <?php endif; ?>
                    <hr>
                </div>
            </div>
        </div>
        <?php endwhile ?>
            <a href="post-1.php" class="button" id="newpost">Create a new post</a>
    </div>
</body>
</html>
