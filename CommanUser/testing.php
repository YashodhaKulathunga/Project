<?php
$imagePath = './QRIMAGES/TKT001217.png';


if (file_exists($imagePath)) {
    $imageData = file_get_contents($imagePath);  
    $base64Image = base64_encode($imageData);  
    echo $base64Image;
} else {
    echo 'Image file not found.';
}