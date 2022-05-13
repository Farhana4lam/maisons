<?php

session_start();

$user_id = $_GET['user_id'];

if(!isset($_SESSION['id']))
{
    header("Location: login.php");
    die;
}
include "connection.php";
include "propertyDeleteFunction.php";
if(!isset($_GET['user_id']))
{
    echo "Select user to Delete";
}

?>

<html>
    <head>
        <title>Confirm Delete</title>
        <link href="logo.JPG" rel="shortcut icon">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        <link href="http://fonts.cdnfonts.com/css/jua" rel="stylesheet">
        <link rel="stylesheet" href="css/navbar.css">
        <link rel="stylesheet" href="css/footer.css">
        <link rel="stylesheet" href="css/form.css">
    </head>
    <body>
        <?php include "header.php"; ?>
        <div class="card text-center">
            <div class="card-body">       
        <h1>Are you sure you want to Delete <?php echo $user_id; ?>?</h1>
        <a href="userDelete.php?user_id=<?php echo $user_id; ?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Yes</a>
        
        
        <?php
        if(isset($_SESSION['id']) && $_SESSION['rank'] == "admin")
        {
            ?>
            <a href="admin/viewAllUsers.php" class="btn btn-success">No</a>
            <?php
        }
        else
        {
            ?>
            <a href="accountSettings.php" class="btn btn-success">No</a>
            <?php
        }
        ?>
        </div>
        </div>
        <?php include "footer.php"; ?>