<?php
session_start();

include "connection.php";

$region = $_POST['region'];

?>


<html>
    <head>
        <title>Search</title>
        <link href="logo.JPG" rel="shortcut icon">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <link href="http://fonts.cdnfonts.com/css/jua" rel="stylesheet">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>     
        <link rel="stylesheet" href="css/navbar.css">
        <link rel="stylesheet" href="css/footer.css">
        <link rel="stylesheet" href="css/card.css">
        <style>
            .container-lg{
                padding: 20px;
            }
            .card-deck{
            margin-top: 10px;
            margin-left: auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            grid-gap: .5rem;
            }

        </style>
</head>
    <body>
    <?php include "header.php";?>
    <?php
        $arr['region'] = $region;
        $sql = "select * from property where region = :region order by timestamp desc";
        
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
                            <div class="container-lg text-center">
                            <h1>Properties in <?php echo $region; ?></h1>
                            <div class="card-deck">
                            
                            <?php
                        
                            foreach ($data as $rows)
                            {
                                ?>
                                    <div class="card text-center">
                                <div class="card-body">
                                <?php

                                $arr1['property_id'] = $rows['property_id'];
                                $pic = "SELECT * FROM picture where property_id = :property_id ORDER BY id desc limit 1";
                                $stmt = $DB->prepare($pic);
                                if($stmt)
                                {
                                    $check1 = $stmt->execute($arr1);
                                    if($check1)
                                    {
                                        $pics = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                        if(count($pics) >0)
                                        {   
                                            foreach ($pics as $row)
                                                {
                                                    ?>
                                                    <img src="user/pictures/<?php echo $row['image_name']; ?>" style="width:70%">
                                                <?php
                                                }
                                        }
                                    }
                                }

                                ?>
                                <br>
                                <?php echo "$".$rows['home_value'];?><br>
                                <?php echo $rows['address']; ?><br>
                                <a href="propertyDisplay.php?property_id=<?php echo $rows['property_id'];?>" class="btn btn-block stretched-link">Details</a>
                            </div>
                            </div>
                                <?php
                            }
                            ?>
                            </div>
         </div>
                            <?php
                        }
                        
                        else
                        {
                            ?>
                            <div class="container-lg text-center">
                            <h1>There are no Properties Listed <?php echo $filter; ?></h1>
                            </div>
                            <?php
                        }
                    }
                }


            ?>
         <?php include "footer.php"; ?>   





