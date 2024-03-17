<?php

/*******w******** 
    
    Name: Arbie Lhyn Lacanlale
    Date: January 22, 2024
    Description:

****************/

require('connect.php');
require('authenticate.php');
$currentPage = 'post';

// Function to validate title and content with atleast one character
function isValidPost($title, $content) {
    return strlen($title) >= 1 && strlen($content) >= 1;
}

// Delete post
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["delete_post"])) {
    // Sanitize and get the post ID
    $post_id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

    // Build the parameterized SQL query and bind to the above sanitized values.
    $query = "DELETE FROM blog WHERE id = :id";
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $post_id, PDO::PARAM_INT);

    // Execute the DELETE.
    $statement->execute();

    // Redirect after deletion.
    header("Location: index-1.php");
    exit;
}

// UPDATE post if Title, Content, and id are present in POST.
if ($_POST && isset($_POST['Title']) && isset($_POST['Content']) && isset($_POST['id'])) {
    // Sanitize user input to escape HTML entities and filter out dangerous characters.
    $Title  = filter_input(INPUT_POST, 'Title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $Content = filter_input(INPUT_POST, 'Content', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $id      = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

    // Validate title and content
    if (isValidPost($Title, $Content)) {
        // Build the parameterized SQL query and bind to the above sanitized values.
        $query     = "UPDATE blog SET Title = :Title, Content = :Content WHERE id = :id";
        $statement = $db->prepare($query);
        $statement->bindValue(':Title', $Title);
        $statement->bindValue(':Content', $Content);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);

        // Execute the INSERT.
        $statement->execute();

        // Redirect after update.
        header("Location: index-1.php?id={$id}");
        exit;
    } else {
        $error_message = "Invalid title or content. Please make sure both are at least 1 character in length.";
    }
} elseif (isset($_GET['id'])) { // Retrieve post to be edited if id GET parameter is in URL.
    // Sanitize the id. Like above but this time from INPUT_GET.
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    // Build the parametrized SQL query using the filtered id.
    $query = "SELECT * FROM blog WHERE id = :id";
    $statement = $db->prepare($query);
    $statement->bindValue(':id', $id, PDO::PARAM_INT);

    // Execute the SELECT and fetch the single row returned.
    $statement->execute();
    $blog = $statement->fetch();
} else {
    $id = false; // False if we are not UPDATING or SELECTING.
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" Content="IE=edge">
    <meta name="viewport" Content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main-1.css">
    <title>Edit this Post!</title>
</head>
<body>
    <!-- Remember that alternative syntax is good and html inside php is bad -->
    <?php include('nav.php'); ?>

    <div class="container">
    <?php if ($id): ?>
        <?php if ($error_message): ?>
            <p style="color: red;"><?= $error_message ?></p>
        <?php endif ?>
        <form method="post">
            <!-- Hidden input for the blog primary key. -->
            <input type="hidden" name="id" value="<?= $blog['id'] ?>">
            
            <!-- blog Title and Content are echoed into the input value attributes. -->
            <label for="Title">Title</label>
            <input id="Title" name="Title" value="<?= $blog['Title'] ?>">
            <label for="Content">Content</label>
            <textarea id="Content" name="Content" rows="10"><?= $blog['Content'] ?></textarea>
            
            <input type="submit" value="Update">
            <!-- Delete button -->
            <input type="submit" name="delete_post" value="Delete" onclick="return confirm('Are you sure you want to delete this post?');">
        </form>
    <?php endif ?>
    </div>
</body>
</html>