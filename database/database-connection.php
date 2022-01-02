<?php

// make the sqlite connection
$db = new PDO('sqlite:'.dirname(__FILE__).'/../database/database.sqlite');

// check if the connection was successful
if ($db){
    echo "<p class='alert alert-success'>Connection successful</p>";
} else {
    echo "<p class='alert alert-danger'>Connection failed....doe het zelf maar</p>";
    die("connection failed");
}