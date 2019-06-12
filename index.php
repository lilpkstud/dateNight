<?php
    //require __DIR__ .'/api/yelp.php';
    require __DIR__ . '/views/header/header.php';

    //$testing = search("dinner", 1, "Seattle, WA");

    /*echo '<pre>';
    var_dump($testing);
    die();*/
  
?>
    <div class="container">
    
        <h1>Welcome to Date Night</h1>
        
        <p>LAT: <span></span></p>
        <p>LONG: <span></span></p>
        <p id="timestamp">TIMESTAMP: <span></span></p>
        <form action="/views/dashboard.php" method="post">
            <input type="hidden" id ="latitude" name="latitude" >
            <input type="hidden" id ="longitude" name="longitude">
            <select name="searchTerm" id="searchTerm">
                <option value="restaurants">Restaurants</option>
                <option value="activities">Activities</option>
            </select>
            <select name="price" id="price">
                <option value="1">$</option>
                <option value="2">$$</option>
                <option value="3">$$$</option>
                <option value="4">$$$$</option>
            </select>
            <select name="location" id="location"> 
                <option value="current_location"> Find Near Me</option>
                <option value="other">Other</option>
            </select>
            <input type="submit" value="Search">
        </form>
    </div>
    <!-- Optional JavaScript -->
    <script src="/js/geolocation.js"></script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>