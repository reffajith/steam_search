<?php

/**
 *
 * Author: Ajith Sebastian
 * Purpose : Retrieve a selection of games from the Steam search page and save the information as structured data. Here we are saving the grab data into a json file. 
 *
 * Method : We are using simple html dom class to extract the data from the URL https://store.steampowered.com/search/?&maxprice=90&tags=5350&category1=998&supportedlang=norwegian
 * We are extracting data page by page with the given condition.  
 * 
 * Requirements are : Requirements for the committee are:   
 *  1. Is a game
 *  2. Support for the Norwegian language
 *  3. Costs a maximum of 90 kroner
 *  4. Is marked as family friendly
 *  5. Has positive user reviews
 *  6. Does not have the letter "a" in the title 
 * 
 * Get the below details of the game:
 *  1. Title
 *  2. Image url
 *  3. Price
 *  4. Release date
 * 
 * Output : Extracted data saved as json file and downloaded to local machine.
 * 
 * 
 * 
 */

 //Include once the simple html dom class for extract the data from URL
include_once('inc/simple_html_dom.php');


//check whether user click on the submit button
if ($_SERVER["REQUEST_METHOD"] == "POST") {

// take results page by page to get full results
$searching = true;
// set the page to one to get the first page data
$page = 1;
// set to count the result row
$result_rows = 0;

//to fetch all a with class 'search_result_row' from a webpage
$data = array();

//check whether still need to grab data
while($searching){

    //get the URL data using simple html dom class for the each pages
    $html               = file_get_html('https://store.steampowered.com/search/?&maxprice=90&tags=5350&category1=998&supportedlang=norwegian&page='.$page);

    //select the count of the search result anchor tag to get the game data
    $result_count       = count($html->find('a.search_result_row'));

    if($result_count==0){
        // we will stop extracting the data when search row count is zero 
        $searching = false;
    }else{

        // we will start getting each game data if search row count greater than zero

        //$es = $html->find('div.search_resultsRows a');

        //retrive each game data by selecting the anchor tag
        foreach($html->find('a.search_result_row') as $anchor) {

            //we are saving the game data to a array whose id equal to game app id to remove mutliple data
            $app_id  = $anchor->getAttribute('data-ds-appid');

            if($anchor->children(1)->children(2)->hasChildNodes()){

            $reviews     = trim($anchor->children(1)->children(2)->children(0)->getAttribute('class'));
            // print_r($reviews);
            if (strpos($reviews, 'positive') !== false) {
                    
                    //print $anchor->children(0)->children(0)->getAttribute('src').'</br>';
                    
                    $title                           = urldecode($anchor->children(1)->children(0)->children(0)->plaintext);
                    
                    //check whether title contains letter a
                    // if the title doesn't contain letter 'a' then proceed to get the data from the html node else get the next node
                    if(!preg_match("/[a]/i", $title)){

                        //save title if it doesn't have letter a
                        $data[$app_id]['title']          = $title;
                        
                        //save the image to array
                        $img_src                         = urldecode(stripcslashes($anchor->children(0)->children(0)->src));
                        $data[$app_id]['image']          = $img_src;
                        
                        //save the release date
                        $release_date                    = $anchor->children(1)->children(1)->plaintext;
                        $data[$app_id]['release_date']   = $release_date;

                        //check whether price has discount by checking the child node
                        //if price has discount then extract the final price else get the price from the node
                        if($anchor->children(1)->children(3)->children(1)->hasChildNodes()){

                            //split discount price and actual price
                            $price_with_discount        = $anchor->children(1)->children(3)->children(1)->plaintext;
                            $price_with_arr             = explode('kr', $price_with_discount);

                            //print $price_with_arr[1].' kr';
                            //print '</br>';

                            //save the actual price to array
                            if(!empty($price_with_arr[1]))
                                $data[$app_id]['price']     = trim($price_with_arr[1].' kr');
                            else
                                $data[$app_id]['price']     = '0,00 kr';

                        }else{
                            
                            // if price doesn't has discount then extract the price from the node
                            $price                      = $anchor->children(1)->children(3)->children(1)->plaintext;
                            $data[$app_id]['price']     = trim($price);
                        }                        

                        $result_rows++;

                    }                    

                }     
            }  
            
        }

    }

    $page++;

}

$html->clear();
unset($html);

//create a json file with extracted data and download the file to local machine
$date = date('YmdHis');

// create a json data
$data = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

// save the data to a file and download to the local machine
header('Content-Type: application/json');
header('Content-Disposition: attachment; filename='.$date.'_data.json');
header('Expires: 0'); //No caching allowed
header('Cache-Control: must-revalidate');
header('Content-Length: ' . strlen($data));
file_put_contents('php://output', $data);

}

?>