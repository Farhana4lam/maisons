<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "re";


if(!$DB = new PDO("mysql:host=localhost;dbname=re","root",""))
{
    die("Failed to connect");
}

?>