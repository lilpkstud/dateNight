<?php
require($_SERVER['DOCUMENT_ROOT'].'/api/yelp.php');
require($_SERVER['DOCUMENT_ROOT'].'/views/header/header.php');

$location = [$_POST['longitude'], $_POST['latitude']];
saveLocation($location);

if($_POST['searchTerm'] == 'restaurants'){
    $categories = 
    //var_dump($location);
    //die();
    $search = search('Best places to eat on date night', $_POST['price'], $location, 'restaurants');
}
if($_POST['searchTerm'] == 'happyhour'){
    //$search = search('Happy Hour', $_POST['price'], $location, 'restaurants,breweries, bars, barcrawl');
    /**
     * Not Giving me the proper data I want....change categories and open?
     */
    $search = searchHappy('Happy Hour', $_POST['price'], $location);
}
if($_POST['searchTerm'] == 'activities'){
    $search = searchActivities('Fun Things to Do on Date Night', $location, 'active, escapegames, gokarts,golf,hiking,lasertag,mini_golf,scavengerhunts,zoos,arcades,movietheaters,museums,paintandsip');
    if(empty($search) || count($search) <= 1 ){
        echo "Couldnt find anything or search was ".count($search)."....Retrying";
        $search = search("activities", $_POST['price'], $location, '');
    }
}
//echo "<pre>";
//var_dump($search);
//die();
//echo count($search);
?>
    <div class="container">
        <h1>Dashboard Page</h1>
        <div class="row">
            <?php 
                foreach($search as $info){
                    //echo "<pre>";
                    //var_dump($info);
                    //die();
            ?>
                <div class="col-lg-3">
                    <a href="/views/restaurant_info.php?id=<?=$info['id']?>" style="text-decoration:none">
                    <div class="card" style="width: 18rem;">
                        <img src="<?=$info['image_url']?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h4 class="card-title"><?=$info['name']?></h4>
                            <p class="card-text">
                                <?=$info['location']['display_address'][0].' '.$info['location']['display_address'][1]?><br>
                                <?php
                                if(isset($info['location']['display_address'][2])) {
                                   echo $info['location']['display_address'][2];
                                }
                                ?>
                                <br>
                            </p>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><strong>Favorite:</strong></li>
                            <li class="list-group-item"><strong>Yelp Rating: </strong><?=$info['rating']?></li>
                            <?php
                                if(isset($info['price'])){
                            ?>
                                    <li class="list-group-item"><strong>Price: </strong><?=$info['price']?></li>
                            <?php
                                } else {
                            ?>
                                    <li class="list-group-item"><strong>Price: </strong> Not Given </li>
                            <?php
                                }
                            ?>
                        </ul>
                        <div class="card-body">
                            <a href="#" class="card-link">Card link</a>
                            <a href="#" class="card-link">Another link</a>
                        </div>
                    </div>
                    </a>
                </div>
            <?php
                }
            ?>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>