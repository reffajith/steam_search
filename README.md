# steam_search

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
