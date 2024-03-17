<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Apartado 1</title>
    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>

    <header class="header bg-primary text-white py-4">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                <a class="navbar-brand text-light" href="#">Inc Bookings</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
              
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                      <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#">Findings</a>
                    </li>
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Others
                      </a>
                      <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">About Us</a>
                        <a class="dropdown-item" href="#">Contact Us</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Partners and Sponsors</a>
                      </div>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link disabled" href="#">Compare costs</a>
                    </li>
                  </ul>
                  <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>
                  </form>
                </div>
              </nav>
        </div>
    </header>
    <div class="container-fluid ">
        <div class="row">
            <aside class="col-lg-2 left-sidebar bg-light" style="background-image: url('./images/back_main.avif');">
                <div class="sidebar-content">
                    <h4 class="sidebar-title mt-4 text-primary">Explore</h4>
                    <ul class="list-unstyled sidebar-menu">
                        <li><a href="https://www.google.com/search" class="nav-link">Search Hotels</a></li>
                        <li><a href="#" class="nav-link">Top Destinations</a></li>
                        <li><a href="#" class="nav-link">Special Offers</a></li>
                        <li><a href="#" class="nav-link">Last Minute Deals</a></li>
                        <li><a href="#" class="nav-link">Customer Reviews</a></li>
                        <li><a href="#" class="nav-link">Contact Us</a></li>
                    </ul>
                </div>
            </aside>                       
            <main class="col-lg-10 main-content" style="background-image: url('./images/back_main.avif');">
                <h2 class="text-white text-center m-4">Reserve your new home all around the world!</h2>
                <div class="row">
                  <?php
                    // Load hotels from the JSON file
                    $json = file_get_contents('./data/hotels.json');
                    $hotels = json_decode($json, true);

                    foreach ($hotels as $hotel) :
                    ?>
                        <div class="col-lg-3 mb-4">
                            <div class="card h-100" style="width: 18rem; border-radius: 15px;">
                                <img class="card-img-top " style="border-radius: 15px;" src="<?= $hotel['image'] ?>" alt="<?= $hotel['name'] ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $hotel['name'] ?></h5>
                                    <p class="card-text"><?= $hotel['address'] ?></p>
                                    <h5 class="card-title">Price</h5>
                                    <p class="card-text"><?= $hotel['price'] ?></p>
                                    <h5 class="card-title">Rating</h5>
                                    <p class="card-text"><?= $hotel['rating'] ?></p>
                                    <a href="./php/client.php?hotel=<?= urlencode($hotel['name']) ?>&price=<?= urlencode($hotel['price']) ?>" class="btn btn-primary">Reserve</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                  ?>
                </div>
            </main>            
        </div>
    </div>
    <footer class="footer bg-primary text-white py-3">
        <div class="container">
            <p class="m-0 text-center">&copy; Inc Bookings. All Rights Reserved.</p>
        </div>
    </footer>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="/docs/4.3/assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="./js/bootstrap.bundle.min.js"
        integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o"
        crossorigin="anonymous"></script>
</body>

</html>