<?php
include 'constants.php';

// make the sqlite connection
$db = new PDO('sqlite:'.dirname(__FILE__).'/../database/database.sqlite');

// check if the connection was successful
if (!$db){
    // hehe fuck you
    ?>
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">DATABASE CONNECTION FAILED</strong><br/>
        <span class="block sm:inline">Ga janken dan bij je mama</span>
    </div>
    <?php
}