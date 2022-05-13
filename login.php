<?php
session_start();
$error = "";
include("connection.php");
include("functions.php");


if($_SERVER['REQUEST_METHOD'] == "POST") 
{    
    $arr['user_email'] = $_POST['user_email'];
    $arr['password'] = trim(hash('sha1', $_POST['password']));
    if(isset($_POST['remember']))
    {
        setcookie("user_email",$_POST['user_email'],time()+ 60*10);
        setcookie("password",$_POST['password'],time()+ 60*10);
    }
	$query = "select * from users where email = :user_email && pass = :password limit 1";

    $statement = $DB->prepare($query);

    if($statement)
        {       
            $check = $statement->execute($arr);
            if($check)
            {
                $data = $statement->fetchAll(PDO::FETCH_ASSOC);
                if(is_array($data) && count($data) >0)
                {
                    $_SESSION['id'] = $data[0]['user_id'];
                    $_SESSION['name'] = $data[0]['name'];
                    $_SESSION['email'] = $data[0]['email'];
                    $_SESSION['rank'] = $data[0]['rank'];
                }
                else{
                    $error = "Wrong Email or Password!";
                }
            }

            if($error == "") 
            {

                header("Location: index.php"); //will redirect to login page 
                die; //if redirect went wrong break 
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
        <title>Login</title>
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
            .card{          
                width: 50%;
                margin-left: 400px;
            } 
        </style>
    </head>
    <body>

<?php include "header.php" ?>
<div class="containter">
    <div class="card">
        <div class="card-header text-center">
        <h1 style="font-family: 'Jua', sans-serif;">LOGIN</h1>
        </div>
<?php
        if($error != "")
        {
            echo "<span style:'color: red;'>".$error."</span><br>";
        } 
        ?>
    <div class="card-body">
        <form method="post" class="was-validated">
            <div class="form-group">
            <label for="user_email">Enter Email:</label>
            <input id="user_email" type="email" class="form-control" name="user_email" placeholder="Enter Email" value="<?php if(isset($_COOKIE["user_email"])) { echo $_COOKIE["user_email"]; } ?>" required>
			<div class="valid-feedback">Valid</div>
            <div class="invalid-feedback">Please fill out this field</div>
            </div>

            <div class="form-group">
            <label for="password">Enter Password:</label>
            <input id="password" type="password" class="form-control" name="password" placeholder="Enter Password" value="<?php if(isset($_COOKIE["password"])) { echo $_COOKIE["password"]; } ?>" required>
			<div class="valid-feedback">Valid</div>
            <div class="invalid-feedback">Please fill out this field</div>
            </div>

            <div class="form-group form-check">
            <label class="form-check-label">
            <input type="checkbox" class="form-check-input" onclick="showPassFunction()">Show Password
            </label>
            </div>
            
            <div class="form-group form-check">
            <label class="form-check-label">
            <input type="checkbox" class="form-check-input" name="remember" value="yes">Remember Me<br><br>
            </label>
            </div>
			<input type="submit" class="btn btn-block" value="Login">
    </div>       
        </form>
        <a href="signup.php" class="btn btn-block btn-link">Click to Signup</a>
        <a href="forgetPassword.php" class="btn btn-block btn-link">Forgot Password?</a>
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
</script>


<?php include "footer.php"?>