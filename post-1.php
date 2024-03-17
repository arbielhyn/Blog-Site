<?php

/*******w******** 
    
    Name: Arbie Lhyn Lacanlale
    Date: January 22, 2024
    Description:

****************/

require('connect.php');
require('authenticate.php');
$currentPage = 'post';

if ($_POST && !empty($_POST['Title']) && !empty($_POST['Content'])) {
    //  Sanitize user input to escape HTML entities and filter out dangerous characters.
    $title = filter_input(INPUT_POST, 'Title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $content = filter_input(INPUT_POST, 'Content', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
    //  Build the parameterized SQL query and bind to the above sanitized values.
    $query = "INSERT INTO blog (title, content) VALUES (:Title, :Content)";
    $statement = $db->prepare($query);
    
    //  Bind values to the parameters
    $statement ->bindValue(':Title', $title);
    $statement ->bindValue(':Content', $content);

    
    //  Execute the INSERT.
    //  execute() will check for possible SQL injection and remove if necessary
    if ($statement -> execute()) {
        echo "Success!";
        header("Location: index-1.php");
        exit;
    }

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
    <?php include('nav.php'); ?>

    <div class="container">
        <form method="post" action="post-1.php">
            <p id="subject">Write something interesting</p>
            <label for="Title">Title</label>
            <input id="Title" name="Title">
            <label for="Content">Content</label>
            <textarea id="Content" name="Content" rows="10"></textarea>
            <input type="submit">
        </form>
    </div>
</body>
</html>