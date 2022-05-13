<?php
    session_start();

    include "connection.php";

    function showPicture($p_id)
    {
        include "connection.php";
        $arr1['property_id'] = $p_id;
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
                            <img src="user/pictures/<?php echo $row['image_name']; ?>" alt="image" style="width:70%">
                        <?php
                        }
                }
            }
        }
    }
?>
<html>
    <head>
        <title>Home</title>
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
            .custom-container{
                margin-top: 20px;
                background: #e09b80;
                border-radius: 3px;
                padding: 20px;
            }
            .custom-col{
                margin-top: 20px;
                margin-bottom: 20px;
            }
            .container-lg{
                padding: 20px;
            }
            .btn{
                background: #b65149;
            }
            a{
                color: white;
            }
            a:hover{
                text-decoration: none;
                color: white;
            }
            .card:hover .btn{
                transform: scale(1.05);
                background: #e09b80;
            }
            .card-deck{
            margin-top: 10px;
            margin-left: auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            grid-gap: .5rem;
            }

            .btn{
                color: white;
            }
            .btn:hover{
                color:#b65149;
                background: white;
            }
            
        </style>
    </head>
    <body> 

<?php include "header.php"; ?>

<div class="container-lg custom-container">
    <div class="row">
        <div class="col custom-col text-center">
        <h1 style="font-family: 'Jua', sans-serif;">Maisons</h1>
        <h5>Find Your Dream Home</h5>
        </div>
    </div>
    <div class="card-deck">
        <div class="card text-center">
        <div class="card-body">
            <h2 style="text-align: center;">Buy Home</h2>
            <h5 style="text-align: center;">Find your place with an immersive photo experience</h5>
            </div>
            <div class="card-footer">
            <button class="btn btn-block"><a href="showProperty.php?filter=For Sell">Buy</a></button>
            </div>                 
        </div>
        <div class="card">
        <div class="card-body">
            <h2 style="text-align: center;">Rent Home</h2>
            <h5 style="text-align: center;">We can help you to find a place for you to Rent</h5>
        </div>
        <div class="card-footer">
            <button class="btn btn-block"><a href="showProperty.php?filter=For Rent">Rent</a></button>
        </div> 
        </div>
        <div class="card">
        <div class="card-body">
            <h2 style="text-align: center;">Sell Home</h2>
            <h5 style="text-align: center;">We can help you to navigate a successful sell</h5>
        </div>
        <div class="card-footer">
            <button class="btn btn-block">
            <?php
        if(isset($_SESSION['id']))
        {
            ?>
            <a href="user/uploadListing.php">Sell</a>
            <?php
        }
        else
        {
            ?>
            <a href="login.php">Sell</a>
            <?php

        }
            ?>
            </button>
        </div> 
        
        </div>
        </div>
    </div>

    <div class="container-sm custom-container">
    <form method="post" action="searchProperty.php">
    <label for="region"><b style="color: white;">Select Region</b></label>
        <select class="form-control" name="region" id="region" required>
        <option disabled="true" selected>--Select Region--</option>
        <?php
        $reg = "select distinct region from property";
        $reg_stmt = $DB->prepare($reg);
        if($reg_stmt)
        {
            $reg_chk = $reg_stmt->execute();
            if($reg_chk)
            {
                $reg_data = $reg_stmt->fetchAll(PDO::FETCH_ASSOC); 
                if(count($reg_data)>0)
                {
                    foreach ($reg_data as $reg_rows)
                    {
                        ?>
                        <option><?php echo $reg_rows['region'];  ?></option>
                        <?php
                    }
                    
                }
            }
        }
        ?>
                    
                    
        </select>
        <input type="submit" value="Search" class="btn btn-block" style="margin-top: 20px;">
    </form>

    </div>
  

 <div class="container-lg text-center">
 <h4>New Arrivals</h4>
 <div class="card-deck">
<?php
$sql = "select * from property order by timestamp desc limit 4";
$statement = $DB->prepare($sql);
if($statement)
{
    $check = $statement->execute();
    if($check)
    {
        $data = $statement->fetchAll(PDO::FETCH_ASSOC);
        if(count($data)> 0)
        {
            ?>
            <?php
                        
            foreach ($data as $rows)
            {
                ?>
                <div class="card text-center">
                <div class="card-body">
                <?php
                showPicture($rows['property_id']); 
            ?>
                <br>
                <?php echo "$".$rows['home_value'];?><br>
                <?php echo $rows['address']; ?><br>
                <a href="propertyDisplay.php?property_id=<?php echo $rows['property_id'];?>" class="btn btn-block stretched-link">Details</a>
                </div>
                </div>               
            <?php
            }
        }
    }
}
?>
 </div>
</div>   
<?php
if(isset($_SESSION['id']))
{
    $user['user_id'] = $_SESSION['id'];
    $select_query = "(select DISTINCT architechture_type from property, user_activity where property.property_id = user_activity.property_id and user_activity.user_id = :user_id)
    UNION (SELECT preference from preference where user_id = :user_id)";
    $select_statement = $DB->prepare($select_query);
    if($select_statement)
    {
        $select_check = $select_statement->execute($user);
        if($select_check)
        {
            $select_data = $select_statement->fetchAll(PDO::FETCH_ASSOC);
            if(count($select_data)> 0)
            {
                ?>
               
                <h4 class="text-center">Recommended For You</h4>
                <div class="card-deck">
                <?php
                foreach ($select_data as $prop)
                {
                    $arr['archi_type'] = $prop['architechture_type'];
                    $query = "select * from property where architechture_type = :archi_type order by timestamp desc limit 2";
                    $rec_statement = $DB->prepare($query);
                    if($rec_statement)
                    {
                        $rec_check = $rec_statement->execute($arr);
                        if($rec_check)
                        {   
                            ?>
                                
                            <?php
                            $rec_data = $rec_statement->fetchAll(PDO::FETCH_ASSOC);
                            if(count($rec_data)> 0)
                            
                            {  
                                ?>
                                
                                <?php
                                  foreach ($rec_data as $rec_rows)
                                {
                                    ?>
                                    <div class="card text-center">
                                <div class="card-body">
                                    <?php
                                    showPicture($rec_rows['property_id']); 
                                ?>
                                    <br>
                                    <?php echo "$".$rec_rows['home_value'];?><br>
                                    <?php echo $rec_rows['address']; ?><br>
                                    <a href="propertyDisplay.php?property_id=<?php echo $rec_rows['property_id'];?>" class="btn btn-block stretched-link">Details</a>
                                    </div>  
                                    </div>           
                                <?php
                                }
                                ?>           
                                <?php
                            }

                        }

                    }
                }
            }
        }
    }
}

?>
                </div>


        <?php include "footer.php"; ?>