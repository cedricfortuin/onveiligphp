<?php
require "database/database-connection.php";

$name = $password = $email = "";

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // create a 2fa key
    $secret = bin2hex(openssl_random_pseudo_bytes(16));

    $created_at = date("Y-m-d H:i:s");

    // insert new user into database
    $sql = "INSERT INTO users (name, email, password, TwoFA_secret, created_at) VALUES ('$name', '$email', '$password', '$secret', '$created_at')";
    $success = $db->query($sql);

    if ($success)
    {
        // get user id
        $sql = "SELECT id FROM users WHERE email = '$email'";
        $result = $db->query($sql);
        $id = $result->fetchColumn(0);

        session_start();
        $_SESSION["loggedin"] = true;
        $_SESSION["id"] = $id;

        header("Location: login.php");
    }
    else
    {
        echo "Error: " . $sql . "<br>" . $db->error;
    }
}

?>

<!doctype html>
<html lang="en">
<?php include 'components/guest-head.html'; ?>
<body>
<?php include 'components/guest-navbar.html'; ?>
<div class="max-w-7xl mx-auto bg-gray-200 px-4 pb-4 mt-3 shadow-sm rounded-md">
    <form class="space-y-8 divide-y divide-gray-200" action="<?php $_SERVER["PHP_SELF"] ?>" method="POST">
        <div class="space-y-8 divide-y divide-gray-200 sm:space-y-5">
            <div class="pt-8 space-y-6 sm:pt-10 sm:space-y-5">
                <h2 class="text-3xl">Registreerenrerennren</h2>
                <div class="space-y-6 sm:space-y-5">
                    <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5 bg-gray-100 py-3 rounded-md">
                        <label for="first-name" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                            Name
                        </label>
                        <div class="mt-1 sm:mt-0 sm:col-span-2">
                            <input type="text" name="name" id="first-name" autocomplete="given-name" class="max-w-lg block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                        </div>
                    </div>

                    <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5 bg-gray-100 py-3 rounded-md">
                        <label for="email" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                            Email address
                        </label>
                        <div class="mt-1 sm:mt-0 sm:col-span-2">
                            <input id="email" name="email" type="email" autocomplete="email" class="block max-w-lg w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md">
                        </div>
                    </div>

                    <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5 bg-gray-100 py-3 rounded-md">
                        <label for="password" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                            Password
                        </label>
                        <div class="mt-1 sm:mt-0 sm:col-span-2">
                            <input type="password" name="password" id="password" class="max-w-lg block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                        </div>
                    </div>

                    <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5 bg-gray-100 py-3 rounded-md">
                        <label for="2fa" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                            Two Factor Authentication
                        </label>
                        <div class="mt-1 sm:mt-0 sm:col-span-2">
                            <p class="text-sm text-gray-600">
                                Two Factor Authentication is automatisch enabled.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="pt-5">
            <div class="flex justify-end">
                <button type="submit" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Save
                </button>
            </div>
        </div>
    </form>
</div>

</body>
</html>
