<?php
session_start();

$error = "";

include "connection.php";

$arr['property_id'] = $_GET['property_id'];

$query = "SELECT * FROM picture where property_id = :property_id ORDER BY id desc";

$statement = $DB->prepare($query);
if($statement)
{
    $check = $statement->execute($arr);
    if($check)
        {
            $data = $statement->fetchAll(PDO::FETCH_ASSOC);
            if(count($data) >0)
            {
                foreach ($data as $rows)
                {
                    ?>
                    <img src="user/pictures/<?php echo $rows['image_name']; ?>" style="width:100%">

                    <?php
                }
            }
        }
}




?>