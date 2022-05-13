<?php

session_start();
if(!isset($_SESSION['id']))
{
    header("Location: login.php");
    die;
}
$error="";

include "connection.php";

$arr['property_id'] = $_GET['property_id']; 
if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $arr1['property_id'] = trim($_POST['property_id']);
    $arr1['property_type'] = trim($_POST['property_type']);
    $arr1['address'] = trim($_POST['address']);
    $arr1['region'] = trim($_POST['region']);
    $arr1['subdivision'] = trim($_POST['subdivision']);
    $arr1['status'] = trim($_POST['status']);
    $arr1['home_value'] = trim($_POST['home_value']);
    $arr1['lot_size'] = trim($_POST['lot_size']);
    $arr1['livable_area'] = trim($_POST['livable_area']);
    $arr1['home_type'] = trim($_POST['home_type']);
    $arr1['architechture_type'] = trim($_POST['architechture_type']);
    $arr1['subtype'] = trim($_POST['subtype']);
    $arr1['year_built'] = trim($_POST['year_built']);
    $arr1['heating'] = trim($_POST['heating']);
    $arr1['cooling'] = trim($_POST['cooling']);
    $arr1['parking'] = trim($_POST['parking']);
    $arr1['bedrooms'] = trim($_POST['bedrooms']);
    $arr1['bathrooms'] = trim($_POST['bathrooms']);
    $arr1['flooring'] = trim($_POST['flooring']);
    $arr1['appliences'] = trim($_POST['appliences']);
    $arr1['interior_features'] = trim($_POST['interior_features']);
    $arr1['exterior_features'] = trim($_POST['exterior_features']);
    $arr1['roof'] = trim($_POST['roof']);
    $arr1['tax_amount'] = trim($_POST['tax_amount']);
    $arr1['monthly_cost'] = trim($_POST['monthly_cost']);
    $arr1['rental_value'] = trim($_POST['rental_value']);
    $arr1['overview'] = trim($_POST['overview']);


    $update = "UPDATE property set property_type=:property_type, address=:address, region=:region, subdivision=:subdivision, status=:status, home_value=:home_value, lot_size=:lot_size,
    livable_area=:livable_area, home_type=:home_type, architechture_type=:architechture_type, subtype=:subtype, year_built=:year_built, heating=:heating, cooling=:cooling, parking=:parking, bedrooms=:bedrooms, bathrooms=:bathrooms,
    flooring=:flooring, appliences=:appliences, interior_features=:interior_features, exterior_features=:exterior_features, roof=:roof, tax_amount=:tax_amount, monthly_cost=:monthly_cost, rental_value=:rental_value, overview=:overview where
    property_id=:property_id";
    $statement = $DB->prepare($update);
    if($statement)
        {
            $check = $statement->execute($arr1);
            if(!$check) //if anything went wrong
            {
                $error = "Update failed";
            }
            if($error == "") //no error, everything went well
            {
                //header("Location: uploadPicture.php?property_id={$arr['property_id']}");
                 echo "Succesfully Updated";
            }
        }

}


?>


<html>
    <head>
        <title>Edit Listing</title>
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
        .col{
            padding: 20px;
        }
        </style>
    </head>
    <body>
    <?php include "header.php"; ?>

    <div class="card">
        <div class="card-header text-center">
            <h1>Edit Listing</h1>
        </div>
        <div class="card-body">
    
    <form method="post" class="was-validated">
    <?php
        $sql = "select * from property where property_id = :property_id Limit 1";
        $statement = $DB->prepare($sql);
        if($statement)
        {
            $check = $statement->execute($arr);
            if($check)
            {
                $data = $statement->fetchAll(PDO::FETCH_ASSOC);
                if(count($data)> 0)
                {
                    foreach ($data as $rows)
                    {
                        ?>
                        <div class="form-row">
                        <label for="property_id">Property ID</label>
                        <input type="text" id="property_id" name="property_id" class="form-control" value="<?php echo $rows['property_id']; ?>" readonly required>
                        </div>
                        <div class="form-row">
        <div class="col">
        <label for="property_type">Property Type *</label>
        <select class="form-control" name="property_type" id="property_type" required>
            <option><?php echo $rows['property_type']; ?></option>
                    <option>House</option>
                    <option>Apartment</option>
                </select>
                </div>
        <div class="col">
        <label for="status">Status *</label>
        <select class="form-control" name="status" id="status" required>
            <option><?php echo $rows['status']; ?></option>
        <option>For Sell</option>
        <option>For Rent</option>
         </select>
        </div>  
    </div>
    <div class="form-row">
    <div class="col">    
    <label for="address">Property Address *</label>
    <textarea rows="5" name="address" class="form-control" required><?php echo $rows['address']; ?></textarea>
    <div class="valid-feedback">Valid</div>
    <div class="invalid-feedback">Please fill out this field</div>
    </div>
    <div class="col" style="padding: 20px;">
        <div class="form-row">
        <label for="region">Region *</label>
        <input type="text" id="region" name="region" class="form-control" value="<?php echo $rows['region']; ?>" required>
        <div class="valid-feedback">Valid</div>
        <div class="invalid-feedback">Please fill out this field</div>
        </div>

        <div class="form-row">
        <label for="subdivision">Subdivision *</label>
        <input type="text" id="subdivision" name="subdivision" class="form-control" value="<?php echo $rows['subdivision']; ?>" required>
        <div class="valid-feedback">Valid</div>
        <div class="invalid-feedback">Please fill out this field</div>
        </div>

    </div>
    </div>

    <div class="form-row">
        <div class="col">
        <div class="form-row">    
        <label for="home_value">Property Value *</label>
        <input type="number" id="home_value" name="home_value" class="form-control" value="<?php echo $rows['home_value']; ?>" required>
        <div class="valid-feedback">Valid</div>
        <div class="invalid-feedback">Please fill out this field</div>
        </div>
        <div class="form-row">
        <label for="monthly_cost">Monthly Cost</label>
        <input type="number" id="monthly_cost" name="monthly_cost" class="form-control" value="<?php echo $rows['monthly_cost']; ?>">
        </div>

        <div class="form-row">
        <label for="rental_value">Rental Value</label>
        <input type="number" id="rental_value" name="rental_value" class="form-control" value="<?php echo $rows['rental_value']; ?>">
        </div>

        <div class="form-row">
        <label for="tax_amount">Tax Amount</label>
        <input type="number" id="tax_amount" name="tax_amount" class="form-control" value="<?php echo $rows['tax_amount']; ?>">
        </div>
        </div>

        <div class="col" style="padding: 20px;">
            <div class="form-row">
                <label for="lot_size">Lot Size</label>
                <input type="text" id="lot_size" name="lot_size" class="form-control" value="<?php echo $rows['lot_size']; ?>">
            </div>

            <div class="form-row">
                <label for="livable_area">Livable Area</label>
                <input type="number" id="livable_area" name="livable_area" class="form-control" value="<?php echo $rows['livable_area']; ?>">
            </div>

            <div class="form-row">
                <label for="year_built">Year Built</label>
                <input type="number" id="year_built" name="year_built" class="form-control" value="<?php echo $rows['year_built']; ?>">
            </div>
        </div>

    </div>

    <div class="form-row">
        <div class="col">
        <div class="form-row">
        <label for="bedrooms">Number of Bedrooms</label>
        <input type="number" id="bedrooms" name="bedrooms" class="form-control" value="<?php echo $rows['bedrooms']; ?>">
        </div>

        <div class="form-row">
        <label for="bathrooms">Number of Bathrooms</label>
        <input type="number" id="bathrooms" name="bathrooms" class="form-control" value="<?php echo $rows['bathrooms']; ?>">
        </div>

        <div class="form-row">
        <label for="parking">Number of Parking Spots</label>
        <input type="number" id="parking" name="parking" class="form-control" value="<?php echo $rows['parking']; ?>">
        </div>

    </div>

    <div class="col" style="padding: 20px;">
        <div class="form-row">
        <label for="home_type">Home Type</label>
        <input type="text" id="home_type" name="home_type" class="form-control" value="<?php echo $rows['home_type']; ?>">
        </div>

        <div class="form-row">
        <label for="architechture_type">Architechture Type</label>
        <input type="text" id="architechture_type" name="architechture_type" class="form-control" value="<?php echo $rows['architechture_type']; ?>">
        </div>

        <div class="form-row">
        <label for="subtype">Subtype</label>
        <input type="text" id="subtype" name="subtype" class="form-control" value="<?php echo $rows['subtype']; ?>">
        </div>

    </div>
        </div>

        <div class="form-row">
            <div class="col">
            <label for="heating">Heating</label>
            <input type="text" id="heating" name="heating" class="form-control" value="<?php echo $rows['heating']; ?>">
            </div>

            <div class="col">
            <label for="cooling">Cooling</label>
            <input type="text" id="cooling" name="cooling" class="form-control" value="<?php echo $rows['cooling']; ?>">
            </div>

            <div class="col">
            <label for="appliences">Appliences</label>
            <input type="text" id="appliences" name="appliences" class="form-control" value="<?php echo $rows['appliences']; ?>">
            </div>

        </div>

        <div class="form-row">
            <div class="col">
                <div class="form-row">
                <label for="interior_features">Interior Features</label>
                <input type="text" id="interior_features" name="interior_features" class="form-control" value="<?php echo $rows['interior_features']; ?>">
                </div>

                <div class="form-row">
                <label for="exterior_features">Exterior Features</label>
                <input type="text" id="exterior_features" name="exterior_features" class="form-control" value="<?php echo $rows['exterior_features']; ?>">
                </div>
            </div>

            <div class="col" style="padding: 20px;">
            <div class="form-row">
                <label for="flooring">Flooring Type</label>
                <input type="text" id="flooring" name="flooring" class="form-control" value="<?php echo $rows['flooring']; ?>">
                </div>

                <div class="form-row">
                <label for="roof">Roof</label>
                <input type="text" id="roof" name="roof" class="form-control" value="<?php echo $rows['roof']; ?>">
                </div>

            </div>

        </div>

        <div class="form-row">
        <label for="overview">Overview</label>
        <textarea rows="5" name="overview" id="overview" class="form-control"><?php echo $rows['overview']; ?></textarea>
        </div>

    </div>
                        <?php
                    }
                }
            }
        }

        ?>
        <input type="submit" value="Submit" class="btn btn-block">
        </div>

    </div>

    </form>

    <?php include "footer.php"; ?>