<?php
session_start();
if(!isset($_SESSION['id']))
    {
        header("Location: login.php");
        die;
    }
$arr1['user_id'] =  $_GET['user_id'];

$error = "";

include "../connection.php";

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $arr['old_password'] = trim(hash('sha1', $_POST['old_password']));
    $sql = "select pass from users where user_id = :user_id limit 1";
    $statement = $DB->prepare($sql);

    if($statement)
    {
        $check = $statement->execute($arr1);
            if($check) 
            {
                $data = $statement->fetchAll(PDO::FETCH_ASSOC);
                if(count($data)>0 && ($arr['old_password'] == $data[0]['pass']))
                {
                    $arr2['user_id'] = $arr1['user_id'];
                   $arr2['new_password'] = trim(hash('sha1', $_POST['new_password']));
                   if($arr2['new_password'] == $arr['old_password'])
                   {
                       $error = "Your Previous Password Cannot be Your New Password!";
                   }
                   else
                   {
                       $query = "update users set pass = :new_password where user_id = :user_id";
                       $statement = $DB->prepare($query);
                       if($statement)
                       {
                           $check = $statement->execute($arr2);
                           if(!$check)
                           {
                                $error = "Password Change Failed!";
                           }
                           if($error == "")
                           {
                                echo "Password Updated Successfully";
                           }
                       }
                   }
                }
                else
                {
                    $error = "Previous Password is Wrong!";
                }
            }
    }
}



?>

<html>
    <head>
        <title>Change Password</title>
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
    <?php
            if($error != "")
            {
                echo "<span style:'color: red;'>".$error."</span><br>";
            } 
            ?>
        <div class="card">
            <div class="card-header text-center">
            <h1>Change Password</h1>
            </div>
            <div class="card-body">
            <form method="post" class="was-validated">
            <div class="form-group">
            <label for="old_password">Enter Previous Password: </label>
            <input id="old_password" type="password" name="old_password" class="form-control" required>
            </div>

            <div class="form-group form-check">
            <label class="form-check-label">
            <input type="checkbox" class="form-check-input" onclick="showPassFunction()">Show Password
            </label>
            </div>

            <div class="form-group">
            <label for="new_password">Enter New Password: </label>
            <input id="new_password" type="password" name="new_password" class="form-control" pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{4,20}" required onchange="form.confirm_new_password.pattern=this.value">
            <div class="valid-feedback">Valid</div>
            <div class="invalid-feedback">Password must be 4 to 20 characters long.<br>
            Must contain an uppercase, a lowercase, a number, and no special character!</div>
        </div>

        <div class="form-group form-check">
            <label class="form-check-label">
            <input type="checkbox" class="form-check-input" onclick="showNewPassFunction()">Show Password
            </label>
            </div>
           
        
        <div class="form-group">
            <label for="confirm_new_password">Confirm New Password: </label>
            <input id="confirm_new_password" type="password" name="confirm_new_password" class="form-control" pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{4,20}" required>
            <div class="valid-feedback">Valid</div>
            <div class="invalid-feedback">Please Retype your Password</div>
        </div>

        <div class="form-group form-check">
            <label class="form-check-label">
            <input type="checkbox" class="form-check-input" onclick="showConfirmNewPassFunction()">Show Password
            </label>
            </div>
                
          <input type="submit" value="Submit" class="btn btn-block">
       

    </form>
    <a href="../forgetPassword.php" class="btn btn-block btn-link">Forgot Password?</a>
            </div>
        </div>
    </div>

    <script>
function showPassFunction() {
  var x = document.getElementById("old_password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}

function showNewPassFunction() {
  var x = document.getElementById("new_password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}

function showConfirmNewPassFunction() {
  var x = document.getElementById("confirm_new_password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>

<?php include "../footer.php"; ?>

   
    

    

