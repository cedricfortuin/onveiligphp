<?php
require "database/database-connection.php";

// get the post id from the url (very secure)
$post_id = $_GET['postid'];

// get all data from post table with the related replies and user
$results = $db->query("SELECT * FROM posts 
                                INNER JOIN users ON posts.user_id = users.id WHERE posts.id = $post_id");

?>

<?php
foreach ($results as $result) {
    ?>
    <!doctype html>
    <html lang="en">
    <?php include "components/guest-head.html"; ?>
    <body>
        <h2><?php echo $result["title"] ?></h2>
        <h3>post created by <?php echo $result["name"] ?></h3>

        <div>
            <?php echo $result["body"] ?>
        </div>


        <p>Wil je reageren? dan heb je pech</p>
        <form action="reply.php?postid=<?php echo $result["id"] ?>" method="POST">
            <label for="reply">Reageren man</label>
            <input type="text" id="reply" name="reply">
            <input type="submit" value="Reageer">
        </form>
    </body>
    </html>
    <?php
}

?>