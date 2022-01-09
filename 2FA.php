<!doctype html>
<html lang="en">
<?php include "components/guest-head.html" ?>
<body>
<?php include "components/guest-navbar.html" ?>
<?php
require "database/database-connection.php";

$TwoFA = $_GET['2FA'];
$email = $_GET['email'];

$sql = "SELECT * FROM users WHERE email = '$email'";
try {
    $result = $db->query($sql);
    $dbTwoFA = $result->fetchColumn(4);
} catch(Exception $e) {
    echo "Error: " . $e->getMessage();
}
if ($TwoFA == $dbTwoFA) {
    echo "2FA code is correct";
    header("Location: index.php");
} else {
    die("2FA code is incorrect, please try again.");
}

?>
</body>
</html>
