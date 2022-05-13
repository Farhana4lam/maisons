<?php
session_start();
if(!isset($_SESSION['id']))
    {
        header("Location: login.php");
        die;
    }
if (isset($_SESSION['id']) && $_SESSION['rank'] != "admin")
{
    header("Location: denied.php");
    die;
} 
 ?>
 <html>
    <head>
        <title>Admin</title>
        <link href="logo.JPG" rel="shortcut icon">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>   
        <link href="http://fonts.cdnfonts.com/css/jua" rel="stylesheet">
        <link rel="stylesheet" href="css/navbar.css">
        <link rel="stylesheet" href="css/footer.css">
        <style>
        .card{
                background: white;
                border: 2px solid #B65149;
               
                margin-top: 20px;
                padding: 20px;
               
                border-radius: 5px;
            }
            .card-header{
                background: #B65149;
                color: #E8DFCE;
            }
            .btn{
                background: #E8DFCE;
                color: #B65149;
            }
            .btn:hover{
                background: #B65149;
                color: #E8DFCE;
                transform: scale(1.05);
                box-shadow: 0 10px 20px rgba(0,0,0,.12), 0 4px 8px rgba(0,0,0,.06);
            }
            a:hover{
                color: #E8DFCE;
            }
            </style>
    </head>
    <body>
        <?php include "header.php"; ?>
        <div class="container">
            <div class="card text-center">
                <div class="card-header">
            <h1 style="font-family: 'Jua', sans-serif;"><?php echo "Hello ".$_SESSION['name']; ?></h1>
            </div>
            <div class="card-body">
            <a href="accountSettings.php" class="btn btn-block">Account Settings</a>
            <a href="user/uploadListing.php" class="btn btn-block">Upload a Listing</a>
            <a href="admin/viewAllListings.php" class="btn btn-block">All Listings</a>
            <a href="admin/viewAllUsers.php" class="btn btn-block">All Users</a>
            </div>
            </div>

        </div>
<?php include "footer.php"; ?>