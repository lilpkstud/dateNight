<?php
require __DIR__ . '/../api/yelp.php';
//var_dump($_POST);
//die();

$location = [$_POST['longitude'], $_POST['latitude']];


if($_POST['searchTerm'] == 'restaurants'){
    $categories = 
    //var_dump($location);
    //die();
    search('Date Night', $_POST['price'], $location);
}
if($_POST['searchTerm'] == 'activities'){
    echo "User is looking for activities";
    die();
}

/*First Date Restaurants
First Date Spots
Date Night*/


?>