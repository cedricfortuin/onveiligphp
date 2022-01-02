<?php
require "database/database-connection.php";

// get the post id from the url (very secure)
$post_id = $_GET['postid'];

// get all data from post table with the related replies and user
$results = $db->query("SELECT * FROM posts 
                                INNER JOIN users ON posts.user_id = users.id WHERE posts.id = $post_id");

// get the replies from the post
$replies = $db->query("SELECT * FROM replies
                                INNER JOIN users ON replies.user_id = users.id WHERE replies.post_id = $post_id");

?>

<?php
foreach ($results as $result) {
    ?>
    <!doctype html>
    <html lang="en">
    <?php include "components/guest-head.html"; ?>
    <body>
    <?php include "components/guest-navbar.html"; ?>

    <div>
        <div>
            <?php

            if (isset($result['image'])) {
                ?>
                <img class="h-64 w-full object-cover lg:h-96" src="<?php echo $result['image']; ?>" alt="">
                <?php
            }
            ?>

        </div>
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="-mt-12 sm:-mt-16 sm:flex sm:items-end sm:space-x-5">
                <div class="flex">
                    <img class="h-24 w-24 rounded-full ring-4 ring-white sm:h-32 sm:w-32"
                         src="https://eu.ui-avatars.com/api/?name=<?php echo str_replace(' ', '+', $result["name"]) ?>"
                         alt="<?php echo $result["name"] ?>">
                </div>
                <div class="mt-6 sm:flex-1 sm:min-w-0 sm:flex sm:items-center sm:justify-end sm:space-x-6 sm:pb-1">
                    <div class="sm:hidden md:block mt-6 min-w-0 flex-1">
                        <h1 class="text-2xl font-bold text-gray-900 truncate">
                            <?php echo $result["name"] ?>
                        </h1>
                        <p>Posted on: <?php echo date("d/m/Y", strtotime($result["created_at"])) ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="relative py-16 bg-white overflow-hidden">
        <div class="relative px-4 sm:px-6 lg:px-8">
            <div class="text-lg max-w-prose mx-auto">
                <h1>
                    <span class="mt-2 block text-3xl text-start leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl"><?php echo $result["title"] ?></span>
                </h1>
            </div>
            <div class="mt-6 prose prose-indigo prose-lg text-gray-500 mx-auto max-w-3xl">
                <?php echo $result["body"] ?>
            </div>
        </div>
    </div>


    <div>
        <div class="max-w-4xl mx-auto">
            <div class="relative mb-8">
                <div class="absolute inset-0 flex items-center" aria-hidden="true">
                    <div class="w-full border-t border-gray-300"></div>
                </div>
                <div class="relative flex justify-start">
                <span class="pr-3 bg-white text-lg font-medium text-gray-900">
                  Replies
                </span>
                </div>
            </div>
            <div class="flow-root">
                <ul role="list" class="-mb-8">
                    <?php
                    foreach ($replies as $reply) {
                        ?>
                        <li>
                            <div class="relative pb-8">
                                <div class="relative flex items-start space-x-3">
                                    <div class="relative">
                                        <img class="h-10 w-10 rounded-full bg-gray-400 flex items-center justify-center ring-8 ring-white"
                                             src="https://eu.ui-avatars.com/api/?name=<?php echo str_replace(' ', '+', $reply["name"]) ?>"
                                             alt="<?php echo $reply["name"] ?>">
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <div>
                                            <div class="text-sm">
                                                <p class="font-medium text-gray-900"><?php echo $reply["name"] ?></p>
                                            </div>
                                            <p class="mt-0.5 text-sm text-gray-500">
                                                Commented on: <?php echo date("d/m/Y", strtotime($reply["created_at"])) ?>
                                            </p>
                                        </div>
                                        <div class="mt-2 text-sm text-gray-700">
                                            <p>
                                                <?php echo $reply["reply"] ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>


    <!--
        <p>Wil je reageren? dan heb je pech</p>
        <form action="reply.php?postid=<?php echo $result["id"] ?>" method="POST">
            <label for="reply">jk reageer dan l*l</label>
            <input type="text" id="reply" name="reply">
            <input type="submit" value="Reageer">
        </form>

        <h2>Alle replies mooi</h2>


        -->
    </body>
    </html>
    <?php
}

?>