<?php

session_start();

$property_id = $_GET['property_id'];
$arr['property_id'] = $property_id;

if(!isset($_SESSION['id']))
{
    header("Location: login.php");
    die;
}

include "connection.php";

if($_SERVER['REQUEST_METHOD'] == "POST")
{
   $email = $_POST['email'];
   $message = $_POST['message'];
   $query = "SELECT name,email from users natural join property where property_id = :property_id";
   $statement = $DB->prepare($query);

    if($statement)
    {
        $check = $statement->execute($arr);
        if($check)
        {
            $data = $statement->fetchAll(PDO::FETCH_ASSOC);
            if(is_array($data) && count($data) >0)
            {
                $to = trim($data[0]['email']);
                $subject = "Someone wants to Buy/Rent your Property!";
                $body = "Hello ".$data[0]['name']."! ".$email." has sent you a message.\n".$message;
                $headers = "From: maisons.project@gmail.com";
                if (mail($to, $subject, $body, $headers)) {
                    echo "Message sent Successfully";
                }
                else {
                    echo "Message sending failed...";
                }
            }
        }
    }

}




?>

<html>
    <head>
        <title>Contact Owner</title>
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
                margin-left: 380px;
            }
            </style>
    </head>
    <body>
        <?php include "header.php"; ?>
        <div class="card">
        <div class="card-header text-center">
        <h1>Contact Owner</h1>
        </div>
        <div class="card-body">

     <form method="post">
     <div class="form-group">
            <label for="email">User Email: </label>
            <input type="email" id="email"  class="form-control" name="email" value="<?php echo $_SESSION['email']; ?>" readonly>
        </div>

        <div class="form-group">
            <label for="message">Message: </label>
            <textarea rows="5" name="message" class="form-control">Hi, I'm Interested to </textarea>
        </div>
        
         <input type="submit" value="Submit" class="btn btn-block">

     </form> 
     <a href="propertyDisplay.php?property_id=<?php echo $property_id;?>" class="btn btn-block btn-link">Back</a>
     </div>
    </div>
 
    <?php include "footer.php"; ?>