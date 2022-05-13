<?php
session_start();
if(!isset($_SESSION['id']))
    {
        header("Location: login.php");
        die;
    }

$error = "";

include "connection.php";
?>

<html>
    <head>
        <title>Account Settings</title>
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
        <style> 
        .card-header{
            background: white;
            color: #B65149;
        }
        </style> 
    </head>
    <body>
    <?php include "header.php"; ?>
<div class="container-lg">
<div class="card">
<div class="card-header">
<h1>Personal Information</h1>
</div>

<div class="card-body">

<table class="table">
    <tr>
        <th>User ID</th>
        <td><?php echo $_SESSION['id']; ?></td>
    </tr>
    <tr>
        <th>Name</th>
        <td><?php echo $_SESSION['name']; ?></td>
    </tr>
        
</table>
<a href="user/userEdit.php?user_id=<?php echo $_SESSION['id'];?>" class="btn btn-block"><i class="fas fa-edit"></i> Edit Profile</a>
</div>
</div>

<div class="card">
    <div class="card-header">
        <h1>Preferences</h1>
    </div>
    <div class="card-body text-center">
       <h3>Choose Your House Preferences</h3> <br>
        <a href="preferenceChoosing.php?user_id=<?php echo $_SESSION['id'];?>" class="btn btn-block"><i class="far fa-check-circle"></i> Choose Preferences</a>
    </div>
</div>



        
<div class="card">
    <div class="card-header">
    <h1>Security</h1>
    </div>
    <div class="card-body">
    <table class="table">
    <tr>
        <th>Email</th>
        <td><?php echo $_SESSION['email']; ?></td>
    </tr>
    <tr>
        <th>Password</th>
        <th><a href="user/userPasswordEdit.php?user_id=<?php echo $_SESSION['id'];?>" class="btn btn-block"><i class="fas fa-edit"></i> Change Password</a></th>
    </tr>
</table>
    </div>
</div>

<div class="card">
    <div class="card-header">
    <h1>Manage Account</h1>
    </div>
    <div class="card-body">
    <table class="table">
    <tr>
        <th>Delete Account</th>
        <th><a href="userDeleteConf.php?user_id=<?php echo $_SESSION['id'];?>" class="btn btn-block"><i class="fas fa-trash-alt"></i> Delete Account</a></th>
    </tr>
</table>
    </div>

</div>
</div>

<?php include "footer.php"; ?>