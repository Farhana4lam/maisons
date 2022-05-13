<?php

session_start();

if(isset($_SESSION['id']))
{
	unset($_SESSION['id']);

}

if(isset($_SESSION['name']))
{
	unset($_SESSION['name']);

}

if(isset($_SESSION['email']))
{
	unset($_SESSION['email']);

}

if(isset($_SESSION['rank']))
{
	unset($_SESSION['rank']);

}

header("Location: login.php");
die;