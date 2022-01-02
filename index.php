<?php
require "database/database-connection.php";

// get all posts with related replies
$sql = "SELECT posts.id, posts.title, posts.body, posts.created_at, users.name FROM posts
        LEFT JOIN users ON posts.user_id = users.id ORDER BY posts.id";
$result = $db->query($sql);

?>

<!doctype html>
<html lang="en" class="bg-primary">
<?php include "components/guest-head.html"; ?>
<body>
<?php include "components/guest-navbar.html"; ?>

<h2 class="text-left ml-2">Mooi alle posts op een rijtje</h2>

<div class="container">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Content</th>
                    <th scope="col">Date</th>
                    <th scope="col">Created by</th>
                    <th scope="col">Go to post</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($result as $item => $value)
                {
                    echo "<tr>";
                    echo "<th scope=\"row\">".$value['id']."</th>";
                    echo "<td>".$value['title']."</td>";
                    echo "<td>".$value['body']."</td>";
                    echo "<td>".date('d/m/Y', strtotime($value['created_at']))."</td>";
                    echo "<td>".$value['name']."</td>";
                    echo "<td><a href='post.php?postid=".$value['id']."'>Ga naar de mooie post</a></td>";
                    echo "</tr>";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!--<div style="margin-top: 300000px; text-align: center">-->
<!--    <p>hehehe got yah</p>-->
<!--    <div style="width:20rem;height:auto;margin: 0 auto 0 auto;">-->
<!--        <iframe src="https://giphy.com/embed/Ju7l5y9osyymQ" width="20%" height="20%" style="position:absolute" frameBorder="0" class="giphy-embed" allowFullScreen></iframe>-->
<!--    </div>-->
<!--</div>-->

<?php include "components/guest-footer.html"; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
