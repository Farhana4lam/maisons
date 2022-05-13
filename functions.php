<?php
function random_num($length)
{
    $text = "";

    $len = rand(4,$length);

    for($i=0; $i<$len; $i++)
    {
        $text .= rand(0,9);
    }

    return $text;
}

?>