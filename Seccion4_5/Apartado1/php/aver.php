<?php
session_start();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title></title>
    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../authenticate/loginCSS.css">
</head>

<body>

    <header class="header bg-primary text-white py-4">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                <a class="navbar-brand text-light" href="../paginaBootstrap.php">Inc Bookings</a>
            </nav>
        </div>
    </header>

    <section class="vh-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-dark text-white" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">

                            <div class="mb-md-5 mt-md-4 pb-5">
                                <h2 class="fw-bold mb-2 text-uppercase">Sign Up</h2>
                                <p class="text-white-50 mb-5">Please enter your name, email, and password!</p>

                                <form id="signupForm" action="./User/userServer.php" method="post">
                                    <input type="hidden" name="action" value="signup">
                                    <div class="form-outline form-white mb-2">
                                        <input type="text" name="nameInput" id="typeNameX" class="form-control form-control-lg mb-2" />
                                        <label class="form-label" for="typeNameX">Name</label>
                                    </div>

                                    <div class="form-outline form-white mb-2">
                                        <input type="email" name="emailInput" id="typeEmailX" class="form-control form-control-lg mb-2" />
                                        <label class="form-label" for="typeEmailX">Email</label>
                                    </div>
                                    <div class="form-outline form-white mb-2 mt-2">
                                        <input type="password" name="passwordInput" id="typePasswordX" class="form-control form-control-lg mb-2" />
                                        <label class="form-label" for="typePasswordX">Password</label>
                                    </div>
                                    <button class="btn btn-outline-light btn-lg px-5" type="submit">Sign Up</button>
                                </form>
                            </div>
                            <div>
                                <p class="mb-0">Already have an account? <a href="../authenticate/login.php" class="text-white-50 fw-bold">Login</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer bg-primary text-white py-3">
        <div class="container">
            <p class="m-0 text-center">&copy; Inc Bookings. All Rights Reserved.</p>
        </div>
    </footer>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>
        window.jQuery || document.write('<script src="/docs/4.3/assets/js/vendor/jquery-slim.min.js"><\/script>')
    </script>
    <script src="../js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../scriptaculous-js-1.9.0/lib/prototype.js"></script>
    <script type="text/javascript" src="../scriptaculous-js-1.9.0/src/scriptaculous.js"></script>

    <script>
        document.observe('submit', function(event) {
            var form = Event.element(event);
            if (form.id === 'signupForm') {
                var name = $('typeNameX').getValue();
                console.log(name)
                var email = $('typeEmailX').getValue();
                var password = $('typePasswordX').getValue();

                var nameField = $('typeNameX');
                var emailField = $('typeEmailX');
                var passwordField = $('typePasswordX');

                var emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
                var passwordPattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/;

                if (name === '') {
                    nameField.setStyle({
                        backgroundColor: '#FFCCCC'
                    });
                    setTimeout(function() {
                        nameField.setStyle({
                            backgroundColor: ''
                        });
                    }, 1000);
                    event.stop();
                    return;
                }

                if (email === '' || !email.match(emailPattern)) {
                    emailField.setStyle({
                        backgroundColor: '#FFCCCC'
                    });
                    setTimeout(function() {
                        emailField.setStyle({
                            backgroundColor: ''
                        });
                    }, 2000);
                    event.stop();
                    return;
                }

                if (password === '' || !password.match(passwordPattern)) {
                    passwordField.setStyle({
                        backgroundColor: '#FFCCCC'
                    });
                    setTimeout(function() {
                        passwordField.setStyle({
                            backgroundColor: ''
                        });
                    }, 2000);
                    alert('Password must be 6-20 characters long and contain at least one digit, one lowercase and one uppercase letter!');
                    event.stop();
                    return;
                }

                setTimeout(function() {
                    form.submit();
                }, 2000);
                event.stop();
            }
        });
    </script>


</body>

</html>