<?php
session_start();
if(!isset($_SESSION['id']))
    {
        header("Location: login.php");
        die;
    }
$arr['user_id'] =  $_GET['user_id'];
$error = "";

include "../connection.php";

if($_SERVER['REQUEST_METHOD'] == "POST")
{

    $arr1['user_id'] = $_POST['user_id'];
    $arr1['name'] = $_POST['name'];
    $sql = "update users set name = :name where user_id = :user_id";
    $statement = $DB->prepare($sql);

    if($statement)
        {       
            $check = $statement->execute($arr1);
            if(!$check) //if anything went wrong
            {
                $error = "Database entry failed";
            }
            if($error == "") //no error, everything went well
            {
                    $_SESSION['name'] = $arr1['name'];
                echo "Succesfully Updated!";
            }
        }

            
}



?>

<html>
    <head>
    <title>Edit User Info</title>
    <link href="../logo.JPG" rel="shortcut icon">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link href="http://fonts.cdnfonts.com/css/jua" rel="stylesheet">
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/form.css">
    
    </head>
    <body>
    
   <?php include "userHeader.php"; ?>
   <div class="container">
       <div class="card">
           <div class="card-header text-center">
           <h1>Edit Info</h1>
           </div>
           <div class="card-body">
           <form method="post" class="was-validated">
        <?php
        $sql = "select * from users where user_id = :user_id Limit 1";
        $statement = $DB->prepare($sql);
        if($statement)
        {
            $check = $statement->execute($arr);
            if($check)
            {
                $data = $statement->fetchAll(PDO::FETCH_ASSOC);
                if(count($data)> 0)
                {
                    foreach ($data as $rows)
                    {
                        ?>
                        <div class="form-group">
                            <label for="user_id">User ID:</label>
                            <input id="user_id" type="text" name="user_id" class="form-control" value="<?php echo $rows['user_id']; ?>" required readonly>
                        </div>
                        

                        <div class="form-group">
                            <label for="name">User Name:</label>
                            <input id="name" type="text" name="name" class="form-control" placeholder="FirstName MiddleName LastName" pattern="([a-zA-Z]+)\s([a-zA-Z]+)\s?([a-zA-Z]+)" value="<?php echo $rows['name']; ?>" required>
                            <div class="valid-feedback">Valid</div>
                            <div class="invalid-feedback">Please fill out this field Correctly</div>
                        </div>
                        
                    <?php
                    }
                    
                }
            }
        }
        ?>
			<input type="submit" value="Submit" class="btn btn-block">

        </form>
        <a href="../accountSettings.php" class="btn btn-block btn-link">Back</a>
        </div>

       </div>

   </div>
    
    

        <?php include "../footer.php"; ?>
    