<?php
//session_start();

$error = "";

include("connection.php");
include("functions.php");

if($_SERVER['REQUEST_METHOD'] == "POST") 
{
    //print_r($_POST);
    $fullname = $_POST['user_name'];
    $nameParts = explode(' ', $fullname);
    $f_name = $nameParts[0];

    $u_id = $f_name.random_num(5);
    $arr['user_id'] = $u_id;
    $arr['user_name']  = ucfirst($_POST['user_name']);
    $arr['user_email'] = $_POST['user_email'];
    $arr['password'] = trim(hash('sha1', $_POST['password'])); 
    $arr['rank'] = "user"; 

    
    if(!empty($arr['user_name']) && !empty($arr['password']) && !is_numeric($arr['user_name'])) //means user name is not numeric
    {
	    $query = "insert into users (user_id,name,email,pass,rank) values (:user_id, :user_name, :user_email, :password, :rank)";

        $statement = $DB->prepare($query); //prepared statement

        if($statement)
        {
            $check = $statement->execute($arr);
            if(!$check) //if anything went wrong
            {
                $error = "Database entry failed";
            }
            if($error == "") //no error, everything went well
            {
                header("Location: preferenceChoosing.php?user_id=$u_id"); 
                die; //if redirect went wrong break 
            }
        }
    }
    else
    {
        echo "Please enter valid information!";
    }

}

?>
<html>
    <head>
        <title>Sign Up</title>
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
<div class="container">
    <div class="card">
        <div class="card-header text-center">
        <h1>Sign Up</h1>
        </div>
        <div class="card-body">
        <?php
        if($error != "")
        {
            echo "<span style:'color: red;'>".$error."</span><br>";
        } 
        ?>
        <form method="post" class="was-validated">
        <div class="form-group">
            <label for="user_name">User Name: </label>
            <input id="user_name" type="text" name="user_name" class="form-control" placeholder="FirstName MiddleName LastName" pattern="([a-zA-Z]+)\s([a-zA-Z]+)\s?([a-zA-Z]+)" required>
            <div class="valid-feedback">Valid</div>
            <div class="invalid-feedback">Please fill out this field Correctly</div>
        </div>

        <div class="form-group">
            <label for="user_email">Email: </label>
            <input id="user_email" type="email" name="user_email" class="form-control" placeholder="Email" required>
            <div class="valid-feedback">Valid</div>
            <div class="invalid-feedback">Please fill out this field</div>
        </div>

        <div class="form-group">
            <label for="password">Password: </label>
            <input id="password" type="password" name="password" placeholder="Password" class="form-control" pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{4,20}" required onchange="form.confirm_password.pattern=this.value">
            <div class="valid-feedback">Valid</div>
            <div class="invalid-feedback">Password must be 4 to 20 characters long.<br>
            Must contain an uppercase, a lowercase, a number, and no special character!</div>
        </div>

        <div class="form-group form-check">
            <label class="form-check-label">
            <input type="checkbox" class="form-check-input" onclick="showPassFunction()">Show Password
            </label>
            </div>
            
        <div class="form-group">
            <label for="confirm_password">Confirm Password: </label>
            <input id="confirm_password" type="password" name="confirm_password" class="form-control" placeholder="Confirm Password" pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{4,20}" required>
            <div class="valid-feedback">Valid</div>
            <div class="invalid-feedback">Please Retype your Password</div>
        </div>

        <div class="form-group form-check">
            <label class="form-check-label">
            <input type="checkbox" class="form-check-input" onclick="showConfirmPassFunction()">Show Password
            </label>
            </div>
            
            <input type="submit" value="Signup" class="btn btn-block">
            </form>
            <a href="login.php" class="btn btn-block btn-link">Click to Login</a>

        
        </div>
    </div>

</div>

<script>
function showPassFunction() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}

function showConfirmPassFunction() {
  var x = document.getElementById("confirm_password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>
        
        

<?php include "footer.php"; ?>