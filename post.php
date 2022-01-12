<?php
require "database/database-connection.php";
include "functions/sanitize-input.php";


session_start();

// get the post id from the url (very secure)
$post_id = htmlspecialchars($_GET['postid']);

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
                <div class="mt-8 sm:flex-1 sm:min-w-0 sm:flex sm:items-center sm:justify-end sm:space-x-6 sm:pb-1">
                    <div class="sm:hidden md:block mt-6 min-w-0 flex-1">
                        <h1 class="text-3xl font-bold text-gray-900 truncate">
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
        <div class="max-w-4xl mx-auto mb-8">
            <div class="relative mb-8">
                <div class="absolute inset-0 flex items-center" aria-hidden="true">
                    <div class="w-full border-t border-gray-300"></div>
                </div>
                <div class="relative flex items-center justify-between">
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

            <div class="relative my-8">
                <div class="absolute inset-0 flex items-center" aria-hidden="true">
                    <div class="w-full border-t border-gray-300"></div>
                </div>
                <div class="relative flex items-center justify-between">
                    <span class="pr-3 bg-white text-lg font-medium text-gray-900">
                      Reageren haha ik wil niet meer
                    </span>
                </div>
            </div>

            <form action="<?php $_SERVER["PHP_SELF"] ?>" method="POST">
                <div>
                    <label for="comment" class="block text-sm font-medium text-gray-700">Add your comment</label>
                    <div class="mt-1">
                        <textarea rows="4" name="reply" id="comment" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Fuck you"></textarea>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:shadow-outline transition duration-150 ease-in-out">
                            <span>Reageren haha</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php include "components/guest-footer.html"; ?>
    </body>
    </html>
    <?php
}
?>


<?php

$replypost = '';

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $replypost = sanitizeInput($_POST["reply"]);
    $id = $_SESSION["id"];
    $date = date("Y-m-d H:i:s");

    $sql = "INSERT INTO replies (reply, post_id, user_id, created_at) VALUES ('$replypost', '$post_id', '$id', '$date')";
    $result = $db->query($sql);

    if ($result)
    {
        echo "<script>window.location.href = 'post.php?postid=$post_id';</script>";
    }
}
?>
