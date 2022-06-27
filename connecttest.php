<?php

$username = "root";
$password = "";
$localhost = "localhost";
$dbname = "Voting";
$connectvar = mysqli_connect("$localhost","$username","$password");

mysqli_connect("$localhost","$username","$password")or die(mysqli_error($connectvar));
mysqli_select_db($connectvar,"$dbname")or die(mysqli_error($connectvar));
?>