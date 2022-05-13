<?php

session_start();

$error = "";

include "connection.php";

$arr['property_id'] = $_GET['property_id'];


?>

<html>
    <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        <link href="http://fonts.cdnfonts.com/css/jua" rel="stylesheet">
        <link rel="stylesheet" href="css/form.css">
        <style>
            .card{
                border: none;
            }
            .row{
                margin-top: 20px;
            }
        </style>
</head>
    <body>
<?php
    $sql = "select * from property where property_id = :property_id";
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
                        

                        </div>
                            <table>
                                
                                <tbody>
                                <?php
                        
                                foreach ($data as $rows)
                                    {
                                    ?>
                                    <div class="card">
                            <div class="card-header text-center" style="background: #e8dfce; color:black">
                            <h1>Property Value: $<?php echo $rows['home_value']; ?></h1>
                            <h5><?php echo $rows['bedrooms']; ?> bd | <?php echo $rows['bathrooms']; ?> ba | <?php echo $rows['livable_area']; ?> sqft</h5>
                            <h5><?php echo $rows['address']; ?></h5>
                            <h5>Status: <?php echo $rows['status']; ?></h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                <div class="col-12">
                                    <h3>Overview</h3>
                                    <?php echo $rows['overview']; ?>
                                </div>
                                </div>
                                <br><h3>Facts & Features</h3>
                               <div class="row" >
                               <br>
                                <div class="col-6">
                                    <h5>Type & Style</h5>
                                    Home Type: <?php echo $rows['home_type']; ?><br>
                                    Architechture Style: <?php echo $rows['architechture_type']; ?><br>
                                    SubType: <?php echo $rows['subtype']; ?>
                                </div>
                                <div class="col-6">
                                    <h5>Lot Details</h5>
                                    Lot Size: <?php echo $rows['lot_size']; ?> sqft<br>
                                    Livable Area: <?php echo $rows['livable_area']; ?> sqft<br>
                                    Year Built: <?php echo $rows['year_built']; ?>
                                </div>
                               </div>
                               <div class="row">
                                   <div class="col-6">
                                       <h5>Interior Details</h5>
                                        Bedrooms: <?php echo $rows['bedrooms']; ?><br>
                                        Bathrooms: <?php echo $rows['bathrooms']; ?><br>
                                        Heating: <?php echo $rows['heating']; ?><br>
                                        Cooling: <?php echo $rows['cooling']; ?>
                                   </div>
                                   <div class="col-6">
                                       Appliences: <?php echo $rows['appliences']; ?><br>
                                       Interior Features: <?php echo $rows['interior_features']; ?><br>
                                       Floor: <?php echo $rows['flooring']; ?>
                                   </div>
                               </div>
                               <div class="row">
                                   <div class="col-6">
                                       <h5>Exterior Details</h5>
                                       Parking: <?php echo $rows['parking']; ?><br>
                                       Exterior Features: <?php echo $rows['exterior_features']; ?><br>
                                       Roof: <?php echo $rows['roof']; ?>
                                   </div>
                                   <div class="col-6">
                                       <h5>Location</h5>
                                       Region: <?php echo $rows['region']; ?><br>
                                       Subdivision: <?php echo $rows['subdivision']; ?>

                                   </div>

                               </div>
                                <br><h3>Price & Taxes</h3>
                               <div class="row">
                                   <div class="col-6">  
                                   Property Value: $<?php echo $rows['home_value']; ?><br>
                                   Tax Amount: $<?php echo $rows['tax_amount']; ?><br>
                                   Monthly Cost: $<?php echo $rows['monthly_cost']; ?><br>
                                   Rental Value: $<?php echo $rows['rental_value']; ?>
                                   </div>
                                   <div class="col-6">
                                       <h5>Listed By</h5>
                                       <?php echo $rows['user_id']; ?>

                                   </div>
                               </div>
                                

                            </div>
                                
                                    <?php
                                    }
                        }
                    }
                }

                ?>



