<?php
session_start();

include "../connection.php";
if(!isset($_SESSION['id']))
    {
        header("Location: login.php");
        die;
    }

$error = "";

$property_id = $_GET['property_id'];


if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $uploadTo = "pictures/";
    $allowedImageType = array('jpg','png','jpeg','gif','JPG','PNG','JPEG','GIF','webp');
    $imageName = array_filter($_FILES['image_gallery']['name']);
    $imageTempName=$_FILES["image_gallery"]["tmp_name"];

    if(empty($imageName))
    {
        $error = "Please Select Atleast 1 Image";
    }
    else
    {
        foreach($imageName as $index=>$file)
        {
            $savedImageBasename='';
            $imageBasename = basename($imageName[$index]);
            $imagePath = $uploadTo.$imageBasename; 
            $imageType = pathinfo($imagePath, PATHINFO_EXTENSION);
            if(in_array($imageType, $allowedImageType))
            {
                if(move_uploaded_file($imageTempName[$index],$imagePath))
                {
                    $savedImageBasename = $imageBasename;
                }
                else
                {
                    $error = 'File Not uploaded ! try again';
                }
            }
            else
            {
                $error .= $_FILES['file_name']['name'][$index].' - file extensions not allowed<br> ';
            }
        

        if(!empty($savedImageBasename))
        {
            $value['property_id'] = $property_id;
            $value['image_name'] = trim($savedImageBasename);
            $sql ="INSERT INTO picture (property_id,image_name) VALUES (:property_id, :image_name)";
            $statement = $DB->prepare($sql);
            if ($statement)
            {
                $check = $statement->execute($value);
                if(!$check)
                {
                    echo  "Error: " .  $saveImage . "<br>" . $db->error;
                }
            }
        }
    }
    }
}





?>


<html>
    <head>
        <title>Upload A Listing</title>
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

    <div class="card">
        <div class="card-header text-center">
        <h1>Upload Images</h1>
        </div>
        <div class="card-body">      
    <form  method="post" enctype="multipart/form-data">
    <div class="custom-file">
    <input type="file" name="image_gallery[]" multiple class="custom-file-input" id="customFile" required>
    <label class="custom-file-label" for="customFile">Choose file</label><br>
    </div>
    <br>
    <input type="submit" value="Upload Now" name="submit" class="btn btn-block">
    </form>

    <?php
    if(isset($_SESSION['rank']) && $_SESSION['rank'] == "admin")
    {
        ?>
        <a href="../admin.php" class="btn btn-block btn-link">Finish</a>
        <?php
    }
    else
    {
        ?>
        <a href="../user.php" class="btn btn-block btn-link">Finish</a>
        <?php

    }
    ?>
    </div>

</div>

<script>
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>

<?php include "../footer.php"; ?>

    