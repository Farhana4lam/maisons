<?php

session_start();
$arr['user_id'] = $_GET['user_id'];

if(!isset($_SESSION['id']))
{
    header("Location: login.php");
    die;
}
include "connection.php";
include "propertyDeleteFunction.php";
if(!isset($_GET['user_id']))
{
    echo "Select user to Delete";
}
else
{

$query = "SELECT property_id from property where user_id = :user_id";
$stmt = $DB->prepare($query);
if($stmt)
{
    $chk = $stmt->execute($arr);
    if($chk)
    {
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if(count($data) > 0)
        {
            foreach ($data as $p_id)
            {
                $conf = deleteProperty($p_id['property_id']);
                if($conf != 1)
                {
                    echo "Delete Failed";
                }
            }
        }
    }
}

$sql1 = "DELETE FROM preference WHERE user_id = :user_id";
$sql2 = "DELETE FROM saved WHERE user_id = :user_id";
$sql3 = "DELETE FROM user_activity WHERE user_id = :user_id";
$sql4 = "DELETE FROM users WHERE user_id = :user_id";

$statement1 = $DB->prepare($sql1);
$statement2 = $DB->prepare($sql2);
$statement3 = $DB->prepare($sql3);
$statement4 = $DB->prepare($sql4);

if($statement1 && $statement2 && $statement3 && $statement4)
{
    $check1 = $statement1->execute($arr);
    $check2 = $statement2->execute($arr);
    $check3 = $statement3->execute($arr);
    $check4 = $statement4->execute($arr);
    if($check1 && $check2 && $check3 && $check4)
    {
        if(isset($_SESSION['id']) && $_SESSION['rank'] == "user")
        {
            session_destroy();
            header("Location: login.php");
            die;
        }
        else
        {
            header("Location: admin/viewAllUsers.php");
            die;
        }
        
    }
    
}
}



?>