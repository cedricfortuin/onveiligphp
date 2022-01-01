<?php
require "database/database-connection.php";

// get the post id from the url (very secure)
$post_id = $_GET['postid'];

// get all data from post table with the related replies and user
$results = $db->query("SELECT * FROM posts INNER JOIN users ON posts.user_id = users.id WHERE posts.id = $post_id");

?>

<?php
foreach ($results as $result) {
    ?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title><?php echo $result["title"] ?></title>
    </head>
    <body>
        <h2><?php echo $result["title"] ?></h2>
        <h3>post created by <?php echo $result["name"] ?></h3>
    </body>
    </html>
    <?php
}

?>