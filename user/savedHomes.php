<?php

session_start();
if(!isset($_SESSION['id']))
    {
        header("Location: login.php");
        die;
    }

$error = "";

include "../connection.php";

if($_SERVER['REQUEST_METHOD'] == "POST") 
{
        $arr1['user_id'] = $_SESSION['id'];
        $arr1['property_id'] = $_POST['property_id'];
        $query = "delete from saved where user_id=:user_id and property_id=:property_id";
        $stmt = $DB->prepare($query);
        if($stmt)
            {
                $chk = $stmt->execute($arr1);
                if(!$chk)
                {
                    $error = "Delete failed"; 
                    echo $error;
                }
            }
}

?>

<html>
    <head>
        <title>View Saved Homes</title>
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
    <style>
        thead{
            background: #E8DFCE;
        }
        td{
            text-align: center;
        }
        </style>
    </head>
    <body>
    <?php include "userHeader.php"; ?>

            <?php
                $arr['user_id'] = $_SESSION['id'];
                $sql = "select * from saved, property where property.property_id = saved.property_id and saved.user_id = :user_id";
                $statement = $DB->prepare($sql);
                if($statement)
                {
                    $check = $statement->execute($arr);
                    if($check)
                    {
                        $data = $statement->fetchAll(PDO::FETCH_ASSOC);
                        if(count($data)> 0)
                        {
                            ?>
                            <div class="card">
                                <div class="card-header text-center">
                                <h1>Saved Homes</h1>
                                </div>
                                <div class="card-body">
                            
                            <table class="table table-hover">
                                <thead class="text-center">
                                    <tr>
                                        <th>Property ID</th>
                                        <th>Property Address</th>
                                        <th colspan="2">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                            <?php
                        
                            foreach ($data as $rows)
                            {
                                ?>
                                    <tr>
                                        <td> <?php echo $rows['property_id']; ?></td>
                                        <td> <?php echo $rows['address']; ?></td>
                                        <td><a href="../propertyDisplay.php?property_id=<?php echo $rows['property_id'];?>" class="btn"><i class="fas fa-info-circle"></i> Details</a></td>
                                        <td>
                                            <form method="post">
                                            <input type="hidden" name="property_id" value="<?php echo $rows['property_id'];?>">
                                           <input type="submit" value="Unsave" class="btn">
                                        </form>
                                        </td>
                                    </tr>
                                <?php
                            }
                        }
                        else
                        {
                            ?>
                            <h1>You Don't have any Saved Homes</h1>
                            <?php
                        }
                    }
                }


            ?>
        </tbody>

    </table>

                                </div>
                            </div>
                            

    <?php include "../footer.php"; ?>
