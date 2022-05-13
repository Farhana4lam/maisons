<?php

session_start();

if(!isset($_SESSION['id']))
    {
        header("Location: login.php");
        die;
    }

if (isset($_SESSION['id']) && $_SESSION['rank'] != "admin")
{
    header("Location: ../denied.php");
    die;
}

$error = "";

include "../connection.php";

?>

<html>
    <head>
        <title>View All Users</title>
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

    <?php include "adminHeader.php";  ?>

            <?php
                $sql = "select user_id, name, email from users where rank = 'user'";
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
                            <div class="card">
                                <div class="card-header text-center">
                                <h1>All Users</h1>
                                </div>
                                <div class="card-body">
                            
                            <table class="table table-hover">
                                <thead class="text-center">
                                    <tr>
                                        <th>User ID</th>
                                        <th>User Name</th>
                                        <th>Email</th>
                                        <th colspan="3">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                            <?php
                        
                            foreach ($data as $rows)
                            {
                                ?>
                                    <tr>
                                        <td> <?php echo $rows['user_id']; ?></td>
                                        <td> <?php echo $rows['name']; ?></td>
                                        <td> <?php echo $rows['email']; ?></td>
                                        <td><a href="../user/userEdit.php?user_id=<?php echo $rows['user_id'];?>" class="btn"><i class="fas fa-edit"></i> Edit</a></td>
                                        <td><a href="../userDeleteConf.php?user_id=<?php echo $rows['user_id'];?>" class="btn"><i class="fas fa-trash-alt"></i> Delete</a></td>
                                    </tr>
                                <?php
                            }
                        }
                        else
                        {
                            ?>
                            <h1>There are no users registered right now</h1>
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
