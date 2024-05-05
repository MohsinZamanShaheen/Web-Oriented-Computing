<?php
session_start();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Apartado 1</title>
    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="./css/custom.css" rel="stylesheet">
    <link rel="stylesheet" href="./jquery-ui-1.12.1/jquery-ui.css">
    </link>
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
                    <?php if (!isset($_SESSION['user'])) { ?>
                        <button class="btn btn-dark btn-outline-light my-2 my-sm-0 ml-2" onclick="window.location.href='./authenticate/login.php'">Login</button>
                        <button class="btn btn-dark btn-outline-light my-2 my-sm-0 ml-2" onclick="window.location.href='./php/aver.php'">Sign Up</button>
                    <?php } else { ?>
                        <form class="form-inline" action="./authenticate/logout.php" method="post">
                            <button class="btn btn-dark btn-outline-light my-2 my-sm-0 ml-2" type="submit" name="logout">Logout</button>
                        </form>
                    <?php } ?>

                </div>
            </nav>
        </div>
    </header>
    <div class="container-fluid">
        <div class="row">
            <aside class="col-lg-2 left-sidebar bg-light">
                <div class="sidebar-content">
                    <h4 class="sidebar-title mt-4 text-primary">Explore</h4>
                    <ul class="list-unstyled sidebar-menu">
                        <li><a href="#" class="nav-link">Search Hotels</a></li>
                        <li><a href="#" class="nav-link">Top Destinations</a></li>
                        <li><a href="#" class="nav-link">Special Offers</a></li>
                        <li><a href="#" class="nav-link">Last Minute Deals</a></li>
                        <li><a href="#" class="nav-link">Customer Reviews</a></li>
                        <li><a href="#" class="nav-link">Contact Us</a></li>
                    </ul>
                </div>
            </aside>
            <!-- style="background-image: url('./images/back_main.avif');"-->
            <main class="col-lg-10 main-content">
                <div class="search-container mt-4" style="border: 1px solid black; padding: 20px; margin-bottom: 20px;">
                    <div class="row">
                        <form id="searchForm" class="form-inline mx-auto my-2 my-lg-0">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                </div>
                                <input class="form-control mr-sm-2" id="destinationInput" type="search" placeholder="Where are you going?" aria-label="Destination">
                            </div>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                </div>
                                <input type="text" class="form-control mr-sm-2" id="checkinDateInput" placeholder="Check-in Date">
                            </div>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                </div>
                                <input type="text" class="form-control mr-sm-2" id="checkoutDateInput" placeholder="Check-out Date">
                            </div>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-users"></i></span>
                                </div>
                                <input class="form-control mr-sm-2" id="guestsInput" type="number" placeholder="Number of guests">
                            </div>
                            <button class="btn btn-primary btn-outline-light my-2 my-sm-0 ml-2" onclick="performSearch(event)" type="submit">Search</button>
                        </form>
                    </div>
                    <div id="hintContainer"></div>
                </div>
                <h2 class="text-black text-center m-4">Reserve your new home all around the world!</h2>
                <div class="row cardsContainer">
                    <?php
                    require_once './php/db_management/db_connection.php';

                    // Load hotels from the JSON file
                    $json = file_get_contents('./data/hotels.json');
                    $hotels = json_decode($json, true);

                    function isHotelReserved($hotelName, $conn)
                    {

                        $statement = $conn->prepare("SELECT 1 FROM information_schema.tables WHERE table_schema = ? AND table_name = ?");
                        $statement->execute(['world', 'reservations']);
                        $tableExists = ($statement->fetchColumn() !== false);

                        if ($tableExists) {
                            if (isset($_SESSION['user'])) {
                                // Check if the hotel is reserved by the current user
                                $result = $conn->query("SELECT * FROM reservations WHERE hotel_name = '$hotelName' AND user_id = {$_SESSION['user']['user_id']}");
                                if ($result->rowCount() > 0) {
                                    return "by_current";
                                } else {
                                    // Check if the hotel is reserved by any other user
                                    $otherReservations = $conn->query("SELECT * FROM reservations WHERE hotel_name = '$hotelName'");
                                    if ($otherReservations->rowCount() > 0) {
                                        return "by_other";
                                    }
                                }
                            } else {
                                return false;
                            }
                        }

                        return false; // Return false if the table does not exist or any other error occurs
                    }

                    foreach ($hotels as $index => $hotel) :
                        // Check if the hotel is reserved in the database
                        $isReserved = isHotelReserved($hotel['name'], $conn);
                    ?>
                        <div class="col-lg-3 mb-4 hotel-card-container">
                            <div class="card h-100" style="width: 18rem; border-radius: 15px;">
                                <img class="card-img-top " style="border-radius: 15px;" src="<?= $hotel['image'] ?>" alt="<?= $hotel['name'] ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $hotel['name'] ?></h5>
                                    <p class="card-text"><?= $hotel['address'] ?></p>
                                    <h5 class="card-title">Price</h5>
                                    <p class="card-text"><?= $hotel['price'] ?></p>
                                    <h5 class="card-title">Rating</h5>
                                    <p class="card-text"><?= $hotel['rating'] ?></p>
                                    <?php if ($isReserved == "by_current") : ?>
                                        <div class="row">
                                            <button class="btn btn-secondary mr-4" disabled>Reserved</button>
                                            <form action="./php/reservation_handling/cancel_reservation.php" method="post">
                                                <input type="hidden" name="hotelName" value="<?= $hotel['name'] ?>">
                                                <button type="submit" class="btn btn-danger">Cancel Reservation</button>
                                            </form>
                                        </div>
                                    <?php elseif ($isReserved == "by_other") : ?>
                                        <button class="btn btn-secondary mr-4" disabled>Not available</button>
                                    <?php else : ?>
                                        <div class="row pl-4">
                                            <button class="btn btn-primary reserve-button" data-hotel="<?= urlencode($hotel['name']) ?>" data-price="<?= urlencode($hotel['price']) ?>" onclick="reserveHotel(this)">Reserve</button>
                                            <button class="btn btn-info ml-4 details-button" data-index="<?= $index ?>">Details</button>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </main>
        </div>
    </div>
    <div id="detailsDialog" style="display:none;"></div>
    <footer class="footer bg-primary text-white py-3">
        <div class="container">
            <p class="m-0 text-center">&copy; Inc Bookings. All Rights Reserved.</p>
        </div>
    </footer>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>
        window.jQuery || document.write('<script src="/docs/4.3/assets/js/vendor/jquery-slim.min.js"><\/script>')
    </script>
    <script src="./js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./scriptaculous-js-1.9.0/lib/prototype.js"></script>
    <script type="text/javascript" src="./scriptaculous-js-1.9.0/src/scriptaculous.js"></script>
    <script type="text/javascript" src="./jquery_3_4_0/jquery-3.4.0.min.js"></script>
    <script type="text/javascript" src="./jquery-ui-1.12.1/jquery-ui.min.js"></script>
    <script type="text/javascript">
        document.observe('dom:loaded', function() {
            $$('.hotel-card-container').each(function(card) {
                new Effect.SlideDown(card, {
                    duration: 2
                });
                new Effect.Highlight(card, {
                    duration: 3
                });
            });
        });
    </script>


    <script>
        function reserveHotel(button) {
            var isLoggedIn = <?php echo isset($_SESSION['user']) ? 'true' : 'false'; ?>;
            if (!isLoggedIn) {
                window.alert("Please login to reserve the hotel.");
            } else {
                var hotelName = button.getAttribute('data-hotel');
                var hotelPrice = button.getAttribute('data-price');
                window.location.href = './php/reservation_handling/client.php?hotel=' + hotelName + '&price=' + hotelPrice;
            }
        }

        // Function to filter hotels based on city name
        function filterHotelsByCity(city) {
            var hotels = <?php echo json_encode($hotels); ?>; // Get hotels data from PHP
            var filteredHotels = hotels.filter(function(hotel) {
                return hotel.address.toLowerCase().includes(city.toLowerCase());
            });
            return filteredHotels;
        }

        // Function to update the hotel display based on filtered results
        function updateHotelDisplay(filteredHotels) {
            var hotelContainer = document.querySelector('.cardsContainer');
            hotelContainer.innerHTML = ''; // Clear the existing content
            filteredHotels.forEach(function(hotel) {
                // Create HTML for each hotel card
                var cardHtml = `
                    <div class="col-lg-3 mb-4 hotel-card-container">
                        <div class="card h-100" style="width: 18rem; border-radius: 15px;">
                            <img class="card-img-top" style="border-radius: 15px;" src="${hotel.image}" alt="${hotel.name}">
                            <div class="card-body">
                                <h5 class="card-title">${hotel.name}</h5>
                                <p class="card-text">${hotel.address}</p>
                                <h5 class="card-title">Price</h5>
                                <p class="card-text">${hotel.price}</p>
                                <h5 class="card-title">Rating</h5>
                                <p class="card-text">${hotel.rating}</p>
                                <?php
                                $isReserved = isHotelReserved($hotel['name'], $conn);
                                if ($isReserved == "by_current") : ?>
                                    <div class="row">
                                        <button class="btn btn-secondary mr-4" disabled>Reserved</button>
                                        <form action="./php/reservation_handling/cancel_reservation.php" method="post">
                                            <input type="hidden" name="hotelName" value="${hotel['name']}">
                                            <button type="submit" class="btn btn-danger">Cancel Reservation</button>
                                        </form>
                                    </div>
                                <?php elseif ($isReserved == "by_other") : ?>
                                    <button class="btn btn-secondary mr-4" disabled>Not available</button>
                                <?php else : ?>
                                    <button class="btn btn-primary reserve-button" data-hotel="<?= urlencode($hotel['name']) ?>" data-price="<?= urlencode($hotel['price']) ?>" onclick="reserveHotel(this)">Reserve</button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                `;
                hotelContainer.innerHTML += cardHtml; // Append the hotel card HTML to the container
            });
        }

        // Function to handle search submission
        function performSearch(event) {
            event.preventDefault(); // Prevent the default form submission
            var cityInput = document.getElementById('destinationInput').value;
            var filteredHotels = filterHotelsByCity(cityInput);
            updateHotelDisplay(filteredHotels);
        }

        $(document).ready(function() {
            $('#destinationInput').on('keyup', function() {
                var input = $(this).val();
                if (input.length == 0) {
                    $('#hintContainer').empty();
                } else {
                    $.ajax({
                        url: './php/searchHint.php',
                        type: 'GET',
                        data: {
                            q: input
                        },
                        success: function(data) {
                            if (data === 'no suggestion') {
                                $('#hintContainer').empty();
                            } else {
                                $('#hintContainer').html("<div class='suggestion-box'>" + data + "</div>");
                                $('.suggestion-box .suggestion-item').on('click', function() {
                                    $('#destinationInput').val($(this).text()).focus();
                                    $('#hintContainer').empty();
                                });
                            }
                        }
                    });
                }
            });
        });

        $(document).ready(function() {
            $("#detailsDialog").dialog({
                autoOpen: false,
                width: 600, // Width of the dialog
                height: 600, // Height of the dialog
                modal: true,
                resizable: true, // Prevent resizing
                draggable: true, // Allow moving the dialog
                title: 'Hotel Details', // Title of the dialog
                show: {
                    effect: "fade",
                    duration: 300
                },
                hide: {
                    effect: "fade",
                    duration: 300
                }
            });

            $(".details-button").click(function() {
                var index = $(this).data('index'); // Get the index of the hotel from the data-index attribute
                $.getJSON('./data/hotels.json', function(data) {
                    var hotel = data[index];
                    var detailsHtml = '<div><strong>Name:</strong> ' + hotel.name +
                        '</div><div><strong>Address:</strong> ' + hotel.address +
                        '</div><div><strong>Price:</strong> ' + hotel.price +
                        '</div><div><strong>Rating:</strong> ' + hotel.rating +
                        '</div><img src="' + hotel.image + '" style="width:100%; margin-top:10px;">';
                    $("#detailsDialog").html(detailsHtml).dialog("open");
                });
            });
        });


        $(function() {
            $('#checkinDateInput, #checkoutDateInput').datepicker({
                // Set the minimum date to today
                minDate: new Date(),
                dateFormat: 'yy-mm-dd'
            });
        });
    </script>

</body>