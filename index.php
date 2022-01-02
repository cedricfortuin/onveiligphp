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
<body class="font-sans antialiased">
<?php include "components/guest-navbar.html"; ?>

<p class="max-w-xl mt-5 text-center text-xl text-gray-500">Mooi alle posts op een rijtje</p>


<div class="bg-white shadow overflow-hidden sm:rounded-md">
    <ul role="list" class="divide-y divide-gray-200">
        <?php
        foreach ($result as $item => $value) {
            ?>
            <li>
                <a href="post.php?postid=<?php echo $value['id'] ?>" class="block hover:bg-gray-50">
                    <div class="px-4 py-4 sm:px-6">
                        <div class="flex items-center justify-between">
                            <p class="text-sm font-medium text-indigo-600 truncate">
                                <?php echo $value['title'] ?>
                            </p>
                        </div>
                        <div class="mt-2 sm:flex sm:justify-between">
                            <div class="sm:flex">
                                <p class="flex items-center text-sm text-gray-500">
                                    <!-- Heroicon name: solid/users -->
                                    <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400"
                                         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                         aria-hidden="true">
                                        <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                                    </svg>
                                    <?php echo $value['name'] ?>
                                </p>
                            </div>
                            <div class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0">
                                <!-- Heroicon name: solid/calendar -->
                                <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400"
                                     xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                     aria-hidden="true">
                                    <path fill-rule="evenodd"
                                          d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                          clip-rule="evenodd"/>
                                </svg>
                                <p>
                                    Posted on
                                    <?php echo date('d/m/Y', strtotime($value['created_at'])) ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
            </li>
            <?php
        }
        ?>
    </ul>
</div>


<!--<div style="margin-top: 300000px; text-align: center">-->
<!--    <p>hehehe got yah</p>-->
<!--    <div style="width:20rem;height:auto;margin: 0 auto 0 auto;">-->
<!--        <iframe src="https://giphy.com/embed/Ju7l5y9osyymQ" width="20%" height="20%" style="position:absolute" frameBorder="0" class="giphy-embed" allowFullScreen></iframe>-->
<!--    </div>-->
<!--</div>-->

<?php include "components/guest-footer.html"; ?>
</body>
</html>
