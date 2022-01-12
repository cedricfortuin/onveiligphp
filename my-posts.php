<?php
require "database/database-connection.php";

session_start();
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
} else {
    echo "<script>window.location.href = 'login.php';</script>";
    exit;
}

// get all posts with related replies
$id = $_SESSION['id'];
$sql3 = "SELECT * FROM posts WHERE posts.user_id = '$id'";
$result3 = $db->query($sql3);
?>

<!doctype html>
<html lang="en" class="bg-primary">
<?php include "components/guest-head.html"; ?>
<body class="font-sans antialiased">
<?php include "components/guest-navbar.html"; ?>


<div class="max-w-7xl mx-auto mb-8">
    <p class="mt-5 text-center text-xl text-gray-500">Mooi al jouw posts op een rijtje</p>
    <div class="relative">
        <div class="absolute inset-0 flex items-center" aria-hidden="true">
            <div class="w-full border-t border-gray-300"></div>
        </div>
    </div>
    <a href="new-post.php" class="inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
        Nieuwe post ja
    </a>
</div>


<div class="bg-white shadow overflow-hidden max-w-7xl mx-auto sm:rounded-md">
    <ul role="list" class="divide-y divide-gray-200">
        <?php
        foreach ($result3 as $item => $value) {
            ?>
            <li>
                <a href="post.php?postid=<?php echo htmlspecialchars($value['id']) ?>" class="block hover:bg-gray-50">
                    <div class="px-4 py-4 sm:px-6">
                        <div class="flex items-center justify-between">
                            <p class="text-sm font-medium text-indigo-600 truncate">
                                <?php echo htmlspecialchars($value['title']) ?>
                            </p>
                        </div>
                        <div class="mt-2 sm:flex sm:justify-between">
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
                                    <?php echo date('d/m/Y', strtotime(htmlspecialchars($value['created_at']))) ?>
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
<?php include "components/guest-footer.html"; ?>
</body>
</html>
