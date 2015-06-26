<?php

    $query = $_POST['query'];
    $query = preg_replace('/\ /', "+", $query);
    echo $query;
    function curl($url) {
        $ch = curl_init();  // Initialising cURL
        curl_setopt($ch, CURLOPT_URL, $url);    // Setting cURL's URL option with the $url variable passed into the function
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); // Setting cURL's option to return the webpage data
        $data = curl_exec($ch); // Executing the cURL request and assigning the returned data to the $data variable
        curl_close($ch);    // Closing cURL
        return $data;   // Returning the data from the function
    }
    // Defining the basic scraping function
    function scrape_between($data, $start, $end){
        $data = stristr($data, $start); // Stripping all data from before $start
        //$data = substr($data, strlen($start));  // Stripping $start
        $stop = stripos($data, $end);   // Getting the position of the $end of the data to scrape
        $data = substr($data, 0, $stop);    // Stripping all data from after and including the $end of the data to scrape
        return $data;   // Returning the scraped data from the function
    }
    $data = curl("http://www.goodreads.com/search?utf8=%E2%9C%93&query=".$query);
    $data = scrape_between($data, "class=\"tableList", "/table");
    $doc = new DOMDocument();
    $doc->loadHTML($data);
    $div = $doc->getElementsByTagName("a");
    $mytext = $div->item(1)->getAttribute("href");
    echo $mytext;
?>