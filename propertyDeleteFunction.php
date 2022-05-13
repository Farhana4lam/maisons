<?php


function deleteProperty($property_id)
{
    include "connection.php";
    $arr['property_id'] = $property_id;
    $sql1 = "DELETE FROM picture WHERE property_id = :property_id";
    $sql2 = "DELETE FROM user_activity WHERE property_id = :property_id";
    $sql3 = "DELETE FROM saved WHERE property_id = :property_id";
    $sql4 = "DELETE FROM property WHERE property_id = :property_id";

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
            return 1;
        }
    }
}