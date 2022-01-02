<?php
require "database/database-connection.php";

$reply = $_POST['reply'];
$post_id = $_GET['postid'];

echo $reply;

// save reply to database
$sql = "INSERT INTO replies (post_id, user_id, reply) VALUES ('$post_id', 1 , '$reply')";

$success = $db->query($sql);

if ($success) {
//    header("Location: post.php?postid=$post_id");
    echo "Success!";
} else {
    echo "Error: " . $db->error;
}

?>

<!doctype html>
<html lang="en">
<?php include "components/guest-head.html"; ?>
<body>

</body>
</html>