<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Reservation</title>
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
      <h2>Hotel Reservation</h2>
      <form  action="server.php" method="post">
          <input type="hidden" name="hotel" value="<?php echo $_GET['hotel']; ?>">
          <input type="hidden" name="price" value="<?php echo $_GET['price']; ?>">
          <div class="form-group">
              <label for="name">Full Name</label>
              <input type="text" class="form-control" id="name" name="name" required="required" placeholder="Enter your full name">
          </div>
          <div class="form-group">
              <label for="email">Email address</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" pattern="/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/" title="Invalid email address">
          </div>
          <div class="form-group">
              <label for="phone">Phone Number</label>
              <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter phone number" pattern="[0-9]{3}-[0-9]{3}-[0-9]{3}" title="Phone number must be in the format: xxx-xxx-xxx">
          </div>
          <div class="form-group">  
              <label for="checkin">Check-in Date</label>  
              <input type="date" class="form-control" id="checkin" name="checkinDate">
          </div>
          <div class="form-group">
              <label for="checkout">Check-out Date</label>
              <input type="date" class="form-control" id="checkout" name="checkoutDate">
          </div>
          <div class="form-group">
              <label for="comments">Additional Comments</label>
              <textarea class="form-control" id="comments" name="comments" rows="3" placeholder="Enter any additional comments" maxlength="150"></textarea>
          </div>
          <button type="submit" class="btn btn-primary mb-4">Submit</button>
      </form>
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