<?php
    session_start();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Error</title>
    <!-- Bootstrap core CSS -->
    <link href="../../css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>

    <header class="header bg-primary text-white py-4">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                <a class="navbar-brand text-light" href="../../paginaBootstrap.php">Inc Bookings</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
              
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                      <a class="nav-link" href="../../paginaBootstrap.php">Home <span class="sr-only">(current)</span></a>
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

    <div class="container mt-5 vh-100">
        <h2>Errors</h2>
        <div class="alert alert-danger" role="alert">
            <?php 
            $errors = explode(",", $_GET['errors']);
            foreach ($errors as $error) {
                echo $error . "<br>";
            }
            ?>
            Please go back and correct the errors.
        </div>
        <?php
    // Retrieve original form data from query parameters
    $hotel = isset($_GET['hotel']) ? $_GET['hotel'] : '';
    $price = isset($_GET['price']) ? $_GET['price'] : '';
    ?>
    <!-- Link to go back to the form with original data preserved -->
    <a href="./client.php?hotel=<?php echo $hotel; ?>&price=<?php echo $price?>" class="btn btn-primary">Retry</a>
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
    <script src="../../js/bootstrap.bundle.min.js"
        integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o"
        crossorigin="anonymous"></script>
</body>

</html>