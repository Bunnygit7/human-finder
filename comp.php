<?php
$img1="images/parents/66ccc5cf09892.png";
$img2="images/parents/66ccc7861c2ba.png";
$md5img1=md5(file_get_contents($img1));
$md5img2=md5(file_get_contents($img2));
if($md5img1==$md5img2){
    echo "same";
}else{
    echo "different";
}

?>