<?php
session_start();
include "connection.php";
$error="";


$arr['user_id'] = $_GET['user_id'];
if($_SERVER['REQUEST_METHOD'] == "POST") 
{
    if(!empty($_POST['preference_list']))
    {
        foreach ($_POST['preference_list'] as $pref)
        {
            $arr['preference'] = $pref;
            $sql = "insert into preference values (:user_id, :preference)";
            $stmt = $DB->prepare($sql);
            if($stmt)
            {
                $check = $stmt->execute($arr);
                if(!$check)
                {
                    $error = "Database entry failed"; 
                    echo $error;
                }


            }
    }
    if($error == "")
    {
        if(!isset($_SESSION['id']))
        {
            header("Location: login.php?"); 
            die;
        }
        else
        {
            header("Location: accountSettings.php?"); 
            die;
        }
    }
}
}



?>

<html>
    <head>
        <title>Preferences</title>
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
            .container {
                display: block;
            position: relative;
            padding-left: 35px;
            margin-bottom: 12px;
            cursor: pointer;
            
    
                }
        /* Hide the browser's default checkbox */
        .container input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
        height: 0;
        width: 0;
        }

        .checkmark {
        position: absolute;
        top: 0;
        left: 0;
        height: 25px;
        width: 25px;
        background-color: #e09b80;
  
border-radius: 15px;
}

.container input:checked ~ .checkmark {
  background-color: #B65149;
}

.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the checkmark when checked */
.container input:checked ~ .checkmark:after {
  display: block;
}

/* Style the checkmark/indicator */
.container .checkmark:after {
  left: 9px;
  top: 5px;
  width: 5px;
  height: 10px;
  border: solid white;
  border-width: 0 3px 3px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
}
        </style>
    </head>
    <body>


<?php include "header.php"; ?>
<div class="card">
        <div class="card-header text-center">
        <h1>Choose Your House Style Preference</h1>
        </div> 
        <div class="card-body">
            <div class="card-deck"> 
        <form method="post">
<?php
    $query = "SELECT distinct architechture_type from property";
    $statement = $DB->prepare($query);
    if($statement)
    {
        $check = $statement->execute();
        if($check)
        {
            $data = $statement->fetchAll(PDO::FETCH_ASSOC);
            if(count($data)>0)
            {
                foreach ($data as $rows)
                {
                    ?>
                    <div class="card" style="border: none;">
                    <div class="form-group form-check">     
                    <label class="container"><?php echo $rows['architechture_type']; ?>
                    <input type="checkbox" name="preference_list[]" value="<?php echo $rows['architechture_type'];?>">
                    <span class="checkmark"></span>
                </label>
                </div>
                </div>
                    <?php
                }
            }
           
            else{
                echo "No data found!";
            }
        }
    }

?>
 </div> 
<input type="submit" value="Submit" class="btn btn-block">
</form>


<?php
if(!isset($_SESSION['id']))
{
    ?>
    <a href="login.php" class="btn btn-block">Skip this step</a>
    <?php
}
?>
</div>
</div>        
    



<?php include "footer.php"; ?>