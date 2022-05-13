<?php

session_start();

include "connection.php";
$error = "";

include "functions.php";

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $arr['user_email'] = $_POST['email'];
    $query = "SELECT * from users where email = :user_email";
    $statement = $DB->prepare($query);

    if($statement)
    {
        $check = $statement->execute($arr);
        if($check)
        {
            $data = $statement->fetchAll(PDO::FETCH_ASSOC);
            if(is_array($data) && count($data) >0)
            {
                $new_password = random_num(5);
                $pass['new_pass'] = trim(hash('sha1', $new_password));
                $pass['user_id'] = $data[0]['user_id'];
                $sql = "UPDATE users SET pass = :new_pass where user_id = :user_id";
                $stmt = $DB->prepare($sql);
                if($stmt)
                {
                    $chk = $stmt->execute($pass);
                    if($chk)
                    {
                        $to = trim($data[0]['email']);
                        $subject = "Password Recovery";
                        $body = "Hello ".$data[0]['name']."! Your new password is ".$new_password."\n Please change it as soon as possible.";
                        $headers = "From: maisons.project@gmail.com";
                        if (mail($to, $subject, $body, $headers)) {
                            echo "A temporary password has been sent to ".$to.", please change your password as soon as possible.";
                        } else {
                            echo "Email sending failed...";
                        }
                    }
                    else
                    {
                        $error = "Password recover failed";
                        echo $error;
                    }
                }
            }
            else{
                $error = "No User Exists!";
                echo $error;
            }
        }
    }
}


?>

<html>
    <head>
        <title>Recover Password</title>
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
                width: 50%;  
                margin-left: 380px;
                margin-top: 20px;
                padding: 20px;
                border-radius: 5px;
            }
            .card-header{
                background: #B65149;
                color: #E8DFCE;
            }
            .btn{
                background: #B65149;
                color: #E8DFCE;
            }
            .btn:hover{
                transform: scale(1.05);
                box-shadow: 0 10px 20px rgba(0,0,0,.12), 0 4px 8px rgba(0,0,0,.06);
            }
            .btn-link{
                background: #E8DFCE;
                color: #B65149;
            }
            .btn-link:hover{
                background: #B65149;
                color: #E8DFCE;
                text-decoration: none;
            }
            
            </style>
    </head>
    <body>
<?php include "header.php"; ?>
<div class="card">
    <div class="card-header text-center">
    <h1>Recover Password</h1>
    </div>
    <div class="card-body">
    <form method="post" class="was-validated">
    <div class="form-group">
            <label for="email">Enter your Email: </label>
            <input id="email" type="email" name="email" class="form-control" placeholder="Email" required>
            <div class="valid-feedback">Valid</div>
            <div class="invalid-feedback">Please fill out this field</div>
        </div>
    
    <input type="submit" value="Submit" class="btn btn-block">
    
</form>
<a href="login.php" class="btn btn-block btn-link">Back</a>

    </div>

</div>

<?php include "footer.php"; ?>

