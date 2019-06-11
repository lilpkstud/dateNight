<?php
/**
 * Yelp Fusion API code sample.
 *
 * This program demonstrates the capability of the Yelp Fusion API
 * by using the Business Search API to query for businesses by a 
 * search term and location, and the Business API to query additional 
 * information about the top result from the search query.
 * 
 * Please refer to http://www.yelp.com/developers/v3/documentation 
 * for the API documentation.
 * 
 * Sample usage of the program:
 * `php sample.php --term="dinner" --location="San Francisco, CA"`
 */
// API key placeholders that must be filled in by users.
// You can find it on
// https://www.yelp.com/developers/v3/manage_app
$API_KEY = 'LVbOW3MVWwNW9QcVb4ZubeDlozZ5I6drMN9PX35PxSWeT2J7Bpu9JTNMLxo_QblfKxbcVDrwp9RxSGiJ8aZMjwRk-bum9Rz17TgG8BgByc2F2raYX36ZcMrVBZTTW3Yx';

// API constants, you shouldn't have to change these.
$API_HOST = "https://api.yelp.com";
$SEARCH_PATH = "/v3/businesses/search";
$BUSINESS_PATH = "/v3/businesses/";  // Business ID will come after slash.

/** 
 * Makes a request to the Yelp API and returns the response
 * 
 * @param    $host    The domain host of the API 
 * @param    $path    The path of the API after the domain.
 * @param    $url_params    Array of query-string parameters.
 * @return   The JSON response from the request      
 */
function request($host, $path, $url_params = array()) {
    // Send Yelp API Call
    try {
        $curl = curl_init();
        if (FALSE === $curl)
            throw new Exception('Failed to initialize');
        $url = $host . $path . "?" . http_build_query($url_params);
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,  // Capture response.
            CURLOPT_ENCODING => "",  // Accept gzip/deflate/whatever.
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "authorization: Bearer " . $GLOBALS['API_KEY'],
                "cache-control: no-cache",
            ),
        ));
        $response = curl_exec($curl);
        if (FALSE === $response)
            throw new Exception(curl_error($curl), curl_errno($curl));
        $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if (200 != $http_status)
            throw new Exception($response, $http_status);
        curl_close($curl);
    } catch(Exception $e) {
        trigger_error(sprintf(
            'Curl failed with error #%d: %s',
            $e->getCode(), $e->getMessage()),
            E_USER_ERROR);
    }
    return $response;
}


/**
 * Query the Search API by a search term, price and location 
 * 
 * @param    $term        The search term passed to the API 
 * @param    $price       The search price passed to the API
 * @param    $location    The search location passed to the API 
 * @return   The JSON response from the request 
 */
function search($searchType, $price, $location) {
    $url_params = array();
    
    $url_params['term'] = $searchType;
    $url_params['longitude'] = $location[0];
    $url_params['latitude'] = $location[1];
    //8046.72 is equivalent to 5 miles 16093.44 is equivalent to 10 miles
    $url_params['radius'] = 16093;
    $url_params['price'] = $price;
    $url_params['sort_by'] = 'distance';
    $url_params['open_now'] = true;
    $url_params['limit'] = 15;
    
    //converts into 'https://api.yelp.com/v3/businesses/search/location&limit&price&sort_by&radius'
    $response = request($GLOBALS['API_HOST'], $GLOBALS['SEARCH_PATH'], $url_params);
    
    $pretty_response = json_encode(json_decode($response), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

    $data = json_decode($pretty_response, true);

    return $data['businesses'];
}

/**
 * Query the Business API by business_id
 * @param    $business_id    The ID of the business to query
 * @return   The JSON response from the request 
 */
function get_business_details($business_id) {

    //converts into '/v3/businesses/{id}'
    $business_path = $GLOBALS['BUSINESS_PATH'] . urlencode($business_id);
    
    $response = request($GLOBALS['API_HOST'], $business_path);

    $pretty_response = json_encode(json_decode($response), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

    $data = json_decode($pretty_response, true);

    //var_dump($data);

   return $data;
}
/**
 * Queries the API by the input values from the user 
 * 
 * @param    $business_id        The ID of the business to query
 * @param    $location    The location of the business to query
 */
function get_reviews($business_id) {
    //converts into '/v3/businesses/{id}/reviews'
    $review_path = $GLOBALS['BUSINESS_PATH'] . urlencode($business_id) . '/reviews';

    $response = request($GLOBALS['API_HOST'], $review_path);

    $pretty_response = json_encode(json_decode($response), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

    $data = json_decode($pretty_response, true);


    return $data;


    //converts into 'https://api.yelp.com/v3/businesses/search/location&limit&price&sort_by&radius'
    /*$response = request($GLOBALS['API_HOST'], $GLOBALS['SEARCH_PATH'], $url_params);
    
    $pretty_response = json_encode(json_decode($response), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

    $data = json_decode($pretty_response, true);*/
}
?>