<?php
require "database/database-connection.php";

session_start();
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
} else {
    echo "<script>window.location.href = 'login.php';</script>";
    exit;
}

?>

<!doctype html>
<html lang="en" class="bg-primary">
<?php include "components/guest-head.html"; ?>
<body class="font-sans antialiased">
<?php include "components/guest-navbar.html"; ?>


<div class="max-w-7xl mx-auto mb-8">
    <p class="mt-5 text-center text-xl text-gray-500">kuttige nieuwe post</p>
    <div class="relative">
        <div class="absolute inset-0 flex items-center" aria-hidden="true">
            <div class="w-full border-t border-gray-300"></div>
        </div>
    </div>
</div>


<section class="text-gray-600 body-font relative">
    <div class="container px-5 py-24 mx-auto">
        <div class="flex flex-col text-center w-full mb-12">
            <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">Haha nieuw</h1>
        </div>
        <div class="lg:w-1/2 md:w-2/3 mx-auto">
            <form action="<?php $_SERVER["PHP_SELF"] ?>" method="POST">
                <div class="flex flex-wrap -m-2">
                    <div class="p-2 w-full">
                        <div class="relative">
                            <label for="title" class="leading-7 text-sm text-gray-600">Title</label>
                            <input type="text" id="title" name="title" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        </div>
                    </div>
                    <div class="p-2 w-full">
                        <div class="relative">
                            <label for="body" class="leading-7 text-sm text-gray-600">Body :)</label>
                            <textarea id="body" name="body" placeholder="ooh you touch my tralala"
                                      class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea>
                        </div>
                    </div>
                    <div class="p-2 w-full">
                        <button type="submit" class="flex mx-auto text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg">SEND NUDES</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>



<?php include "components/guest-footer.html"; ?>
</body>
</html>

<?php
$title = $body = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_SESSION['id'];
    $title = $_POST["title"];
    $body = $_POST["body"];

    $sql = "INSERT INTO posts (title, body, user_id) VALUES ('$title', '$body', '$id')";
    $mieter = $db->query($sql);
    if ($mieter) {
        error_log("UserId {$id} created a post with title {$title} and body {$body} on " . date("Y-m-d H:i:s") . "\n\r", 3, POST_LOGGING_PATH);

        echo "<script>window.location.href = 'my-posts.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $mieter->error;
    }
}

?>
