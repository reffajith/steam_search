<html lang="en">
  <head>
    <meta charset="utf-8">    
    <title>Task 2 - Backend / scraping</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>

  <body>

    <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
      <a class="navbar-brand" href="#">Steam</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </nav>

    <main role="main" class="container">
        <!-- Main jumbotron for a primary marketing message or call to action -->
        <div class="jumbotron">
            <div class="container">
                <h2 class="display-4">Steam Search</h2>
                <p>Retrieve a selection of games from the Steam search page - https://store.steampowered.com/search/ </p>
            </div>
        </div>

        <div class="container">
            <!-- Example row of columns -->
            <div class="row">
                <div class="col-md-12">
                    <p>Selected game should have below requirement: </p>
                    <ul class="list-group">
                        <li class="list-group-item">Is a game</li>
                        <li class="list-group-item">Support for the Norwegian language</li>
                        <li class="list-group-item">Costs a maximum of 90 kroner</li>
                        <li class="list-group-item">Is marked as family friendly</li>
                        <li class="list-group-item">Has positive user reviews</li>
                        <li class="list-group-item">Does not have the letter "a" in the title</li>
                    </ul>   
                    <p>
                        <form class="form-inline mt-2 mt-md-0" method="post" action="download.php">
                        <input class="btn btn-lg btn-primary" type="submit" name="submit" value="Download data as json file &raquo;">  
                        </form> 
                    </p>
                </div>
            </div>
            <hr>
        </div> <!-- /container -->   
      
    </main>
  </body>
</html>
