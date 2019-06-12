<?php
require __DIR__ . '/../api/yelp.php';
require __DIR__ . '/../views/header/restaurant_info_header.php';

if(isset($_GET['id'])){
    $info = get_business_details($_GET['id']);
    $reviews = get_reviews($_GET['id']);
}else{
    echo "Not authorized";
    die();
}
//echo "<pre>";
//var_dump($reviews);
//var_dump($info);
//die();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Date Night</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        .img-thumbnail{
            width: 70% !important;
            height: 50% !important;
           /* margin: 0 25%;*/
        }
        .profile{
            max-width:10%;
            height: auto;
            padding-right: 15px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <h1><?=$info['name']?></h1>
                <p><strong>Display Address: </strong><?=$info['location']['display_address'][0].' '.$info['location']['display_address'][1]?></p>
                <p><strong>Rating: </strong><?=$info['rating']?></p>
                <p><strong>Pricing: </strong><?=$info['price']?></p>
            </div>
            <div class="col-lg-6">
                <h1>SHOW LOCATION ON MAP</h1>
            </div>
        </div>
        <div class="row">
            <?
            foreach($info['photos'] as $image) { 
            ?>
                <div class="col-xs-12 col-md-4">
                    <img class="img-thumbnail" src="<?=$image?>" alt="">
                </div>
            <?php
            }
            ?>
        </div>
        <div class="row">
            <h4>Recent Reviews</h4>
        </div>
        <?php
        foreach($reviews as $review){
            $date = date_create($review['time_created']);
        ?>
            <div class="row">
                <div class="col">
                    <a href="<?=$review['user']['profile_url']?>" target="_blank">

                    <img class="profile rounded float-left" src="<?=$review['user']['image_url']?>" alt="Yelp Profile Picture">
                        <?=$review['user']['name']?>
                    </a>
                    <div class="container">
                        <h5>
                            <?=$review['user']['name']?> reviewed on <?=date_format($date, "m/d/Y")?> 
                        </h5>
                        <p><strong>Rating: </strong><?=$review['rating']?></p>
                        <p><?=$review['text']?><a href="<?=$review['url']?>" target="_blank">See Full Review</a></p>
                    </div>
                </div>
                
            </div>
            <hr>
        <?php    
        }
        ?>
    </div>
    <h1>Restaurant Info</h1>
    <p>
        Phone <?=$info['display_phone']?>
    </p>
    <p>
        Review Count: <?=$info['review_count']?>
    </p>
    <p>Rating: <?=$info['rating']?></p>
    <p>Display Address <?=$info['location']['display_address'][0].' '.$info['location']['display_address'][1]?></p>
    <p><?=$info['photos'][0]?></p>
    <p><?=$info['photos'][1]?></p>
    <p><?=$info['photos'][2]?></p>
    <p>Price: <?=$info['price']?></p>
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>