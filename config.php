<?php

$servername = 'localhost';
$username = 'root';
$password = '';

$mysqli = new mysqli($servername, $username, $password);

if ($mysqli->connect_error) {
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}

$db_selected = mysqli_select_db($mysqli, "magebit_application_test");

if (!$db_selected) {
    $sql = "CREATE DATABASE IF NOT EXISTS magebit_application_test";

    if (!(mysqli_query($mysqli, $sql))) {
        echo "Error creating database";
    }
}
