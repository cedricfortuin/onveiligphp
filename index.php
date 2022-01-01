<?php
require "database/database-connection.php";

// get all posts with related replies
$sql = "SELECT * FROM posts
        LEFT JOIN users ON posts.user_id = users.id
        LEFT JOIN replies ON posts.id = replies.post_id ORDER BY posts.id DESC";
$result = $db->query($sql);

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

</head>
<body>

<h2>Mooi alle posts op een rijtje</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Slug</th>
        <th>Content</th>
        <th>Date</th>
        <th>Created by</th>
        <th>Go to post</th>
    </tr>
    <?php
        foreach ($result as $item => $value)
        {
            echo "<tr>";
            echo "<td>".$value['id']."</td>";
            echo "<td>".$value['title']."</td>";
            echo "<td>".$value['slug']."</td>";
            echo "<td>".$value['body']."</td>";
            echo "<td>".date('d/m/Y', strtotime($value['created_at']))."</td>";
            echo "<td>".$value['name']."</td>";
            echo "<td><a href='post.php?postid=".$value['id']."'>Ga naar de mooie post</a></td>";
            echo "</tr>";
        }
    ?>
</table>


<!--<div style="margin-top: 300000px; text-align: center">-->
<!--    <p>hehehe got yah</p>-->
<!--    <div style="width:20rem;height:auto;margin: 0 auto 0 auto;">-->
<!--        <iframe src="https://giphy.com/embed/Ju7l5y9osyymQ" width="20%" height="20%" style="position:absolute" frameBorder="0" class="giphy-embed" allowFullScreen></iframe>-->
<!--    </div>-->
<!--</div>-->

</body>
</html>
