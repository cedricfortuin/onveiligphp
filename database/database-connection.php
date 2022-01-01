<?php

// make the sqlite connection
$db = new PDO('sqlite:'.dirname(__FILE__).'/../database/database.sqlite');

// check if the connection was successful
if ($db){
    echo "<i>connection successful</i>";
} else {
    die("connection failed");
}