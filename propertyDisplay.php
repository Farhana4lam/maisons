<?php

session_start();
include "connection.php";
$property_id = $_GET['property_id'];

$point = 0;

if(isset($_SESSION['id']))
{
    $user['user_id'] = $_SESSION['id'];
    $select_query = "select * from user_activity where user_id = :user_id";
    $select_statement = $DB->prepare($select_query);
    if($select_statement)
        {
            $select_check = $select_statement->execute($user);
            if($select_check)
            {
                $prop_id = $select_statement->fetchAll(PDO::FETCH_ASSOC);
                foreach ($prop_id as $p_id)
                {
                    if($p_id['property_id'] == $property_id)
                    {
                        $point = 1;
                        break;
                    }
                }
            }
        }

    if($point == 0)
    {
        $act['user_id'] = $_SESSION['id'];
        $act['property_id'] = $property_id;
        $act_query = "insert into user_activity values (:user_id, :property_id)";
        $act_statement = $DB->prepare($act_query);
        if($act_statement)
            {
                $act_check = $act_statement->execute($act);
                if(!$act_check)
                {
                    $error = "Saving failed"; 
                    echo $error;
                }
            }
    }
    
}



if($_SERVER['REQUEST_METHOD'] == "POST") 
{
    if(!isset($_SESSION['id']))
    {
        header("Location: login.php");
        die;
    }
    else{
        $arr['user_id'] = $_SESSION['id'];
        $arr['property_id'] = $property_id;
        $query = "insert into saved values (:property_id, :user_id)";
        $statement = $DB->prepare($query);
        if($statement)
            {
                $check = $statement->execute($arr);
                if(!$check)
                {
                    $error = "Saving failed"; 
                    echo $error;
                }
            }
    }
}

?>

<html>
    <head>
        <title>Property Details</title>
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
                height: 1000px;
            }
            
</style>        
</head>
    <body>
        <?php include "header.php"; ?>
        <div class="card">
            <div class="card-header text-center">
                <h1>Property Details</h1>
            </div>
            <div class="card-body">
                       
<iframe src="propertyDetails.php?property_id=<?php echo $property_id; ?> " frameborder="0" scrolling="yes"                           
                                style="height: 100%; 
                                            width: 40%; float: right; " height="100%" width="60px"
                                        >
                              </iframe>  

 <iframe src="showImage.php?property_id=<?php echo $property_id; ?>" frameborder="0" scrolling="yes"  
                                    style="overflow: hidden; height: 100%;

                                    width: 60%; " height="100%" width="70%"                                 
                                     >
                                    </iframe>
                                    
                                    </div>
        <div class="card-footer">
            <div style="float: right;">

            
        <a href="contactOwner.php?property_id=<?php echo $property_id; ?>" class="btn">Contact Owner</a>
                                   

<?php
$flag = 0;
if(isset($_SESSION['id']))
{
    $arr1['user_id'] = $_SESSION['id'];
    $sql = "select property_id from saved where user_id = :user_id";
    $stmt = $DB->prepare($sql);
    if($stmt)
        {
            $chk = $stmt->execute($arr1);
            if($chk)
            {
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if(count($data)>0)
                {
                    foreach ($data as $rows)
                    {
                        if($rows['property_id'] == $property_id)
                        {
                            ?>
                                <button class="btn"><i class="far fa-heart"></i> Saved</button>
                            <?php
                            $flag = 1;
                            break;
                        }
                        
                    }
                }
            }
        }
    }

    if($flag==0)
    {
        ?>
        <form method="post">     
            <input type="submit" value="Save Home" class="btn" style="margin: 20px;">  
        </form>
        <?php
    }
    ?>
 </div>
    <?php
if (isset($_GET['filter']))
{
    ?>
    <a href="showProperty.php?filter=<?php echo $_GET['filter'];?>" class="btn">Back</a>
    <?php
}
?>

</div>
</div>
<?php include "footer.php"; ?>
