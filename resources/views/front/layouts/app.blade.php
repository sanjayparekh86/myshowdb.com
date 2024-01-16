<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7 no-js" lang="en-US">
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8 no-js" lang="en-US">
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html lang="en" class="no-js">


<head>
    <!-- Basic need -->
    <title>Open Pediatrics</title>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <link rel="profile" href="#">

    <!--Google Font-->
    <link rel="stylesheet" href='http://fonts.googleapis.com/css?family=Dosis:400,700,500|Nunito:300,400,600' />
    <!-- Mobile specific meta -->
    <meta name=viewport content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone-no">

    <!-- CSS files -->
    <link rel="stylesheet" href="css/plugins.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <!--preloading-->
    <!-- <div id="preloader">
    <img class="logo" src="images/logo1.png" alt="" width="119" height="58">
    <div id="status">
        <span></span>
        <span></span>
    </div>
</div> -->
    <!--end of preloading-->
    <!--login form popup-->
    <div class="login-wrapper" id="login-content">
        <div class="login-content">
            <a href="#" class="close">x</a>
            <h3>Login</h3>
            <form method="post" action="" id="loginForm" name="loginForm">
                @csrf
                <div class="row">
                    <label for="email">
                        Email:
                        <input type="email" name="email" id="user_email" placeholder="Enter Your Email"
                            value="{{ old('email') }}" pattern="^[a-zA-Z][a-zA-Z0-9-_\.]{8,20}$">
                        <p class="invalid"></p>
                    </label>
                </div>

                <div class="row">
                    <label for="password">
                        Password:
                        <input type="password" name="password" id="user_password" placeholder="Enter Password">
                        <p class="invalid"></p>
                    </label>
                </div>
                <div class="row">
                    <div class="remember">
                        <div>
                            <input type="checkbox" name="remember" value="Remember me"><span>Remember me</span>
                        </div>
                        <a href="#">Forget password ?</a>
                    </div>
                </div>
                <div class="row">
                    <button type="submit" value="login">Login</button>
                </div>
            </form>
            <div class="row">
                <p>Or via social</p>
                <div class="social-btn-2">
                    <a class="fb" href="#"><i class="ion-social-facebook"></i>Facebook</a>
                    <a class="tw" href="{{ url('auth/google') }}"><i class="fa-brands fa-google"></i>google</a>
                </div>
            </div>
        </div>
    </div>
    <!--end of login form popup-->
    <!--signup form popup-->
    <div class="login-wrapper" id="signup-content">
        <div class="login-content">
            <a href="#" class="close">x</a>
            <h3>sign up</h3>
            <form method="post" action="" id="registrationForm">
                @csrf
                <div class="row">
                    <label for="first_name">
                        First Name:
                        <input type="text" name="first_name" id="first_name" placeholder="Enter Your First Name"
                            pattern="^[a-zA-Z][a-zA-Z0-9-_\.]{8,20}$">
                        <p class="error"></p>
                    </label>
                </div>
                <div class="row">
                    <label for="last_name">
                        Last Name:
                        <input type="text" name="last_name" id="last_name" placeholder="Enter Your Last Name"
                            pattern="^[a-zA-Z][a-zA-Z0-9-_\.]{8,20}$">
                        <p class="error"></p>
                    </label>
                </div>
                <div class="row">
                    <label for="nick_name">
                        Nick Name:
                        <input type="text" name="nick_name" id="nick_name" placeholder="Enter Your Nick Name"
                            pattern="^[a-zA-Z][a-zA-Z0-9-_\.]{8,20}$">
                        <p class="error"></p>
                    </label>
                </div>
                <div class="row">
                    <label for="email">
                        Email:
                        <input type="email" name="email" id="email" placeholder="Enter Your Email"
                            pattern="^[a-zA-Z][a-zA-Z0-9-_\.]{8,20}$">
                        <p class="error"></p>
                    </label>
                </div>
                <div class="row">
                    <label for="password">
                        Password:
                        <input type="password" name="password" id="password" placeholder="Enter Password">
                        <p class="error"></p>
                    </label>
                </div>
                <div class="row">
                    <label for="password_confirmation">
                        Confirm Password:
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            placeholder="Confirm Password">
                        <p class="error"></p>
                    </label>
                </div>
                <div class="row">
                    <button type="submit">sign up</button>
                </div>

                <div class="row">
                    <p>Or via social</p>
                    <div class="social-btn-2">
                        <a class="fb" href="#"><i class="ion-social-facebook"></i>Facebook</a>
                        <a class="tw" href="{{ url('auth/google') }}"><i
                                class="fa-brands fa-google"></i>google</a>
                    </div>
                </div>
            </form>

        </div>
    </div>
    <!--end of signup form popup-->

    <!-- BEGIN | Header -->
    <header class="ht-header">
        <div class="container">
            <nav class="navbar navbar-default navbar-custom">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header logo">
                    <div class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <div id="nav-icon1">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                    <a href="index-2.html"><img class="logo" src="images/logo1.png" alt="" width="119"
                            height="58"></a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse flex-parent" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav flex-child-menu menu-left">
                        <li class="hidden">
                            <a href="#page-top"></a>
                        </li>
                        <li class="dropdown first">
                            <a class="btn btn-default dropdown-toggle lv1" data-toggle="dropdown">
                                Home <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </a>
                            <ul class="dropdown-menu level1">
                                <li><a href="index-2.html">Home 01</a></li>
                                <li><a href="homev2.html">Home 02</a></li>
                                <li><a href="homev3.html">Home 03</a></li>
                            </ul>
                        </li>
                        <li class="dropdown first">
                            <a class="btn btn-default dropdown-toggle lv1" data-toggle="dropdown"
                                data-hover="dropdown">
                                movies<i class="fa fa-angle-down" aria-hidden="true"></i>
                            </a>
                            <ul class="dropdown-menu level1">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Movie grid<i
                                            class="ion-ios-arrow-forward"></i></a>
                                    <ul class="dropdown-menu level2">
                                        <li><a href="moviegrid.html">Movie grid</a></li>
                                        <li><a href="moviegridfw.html">movie grid full width</a></li>
                                    </ul>
                                </li>
                                <li><a href="movielist.html">Movie list</a></li>
                                <li><a href="moviesingle.html">Movie single</a></li>
                                <li class="it-last"><a href="seriessingle.html">Series single</a></li>
                            </ul>
                        </li>
                        <li class="dropdown first">
                            <a class="btn btn-default dropdown-toggle lv1" data-toggle="dropdown"
                                data-hover="dropdown">
                                celebrities <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </a>
                            <ul class="dropdown-menu level1">
                                <li><a href="celebritygrid01.html">celebrity grid 01</a></li>
                                <li><a href="celebritygrid02.html">celebrity grid 02 </a></li>
                                <li><a href="celebritylist.html">celebrity list</a></li>
                                <li class="it-last"><a href="celebritysingle.html">celebrity single</a></li>
                            </ul>
                        </li>
                        <li class="dropdown first">
                            <a class="btn btn-default dropdown-toggle lv1" data-toggle="dropdown"
                                data-hover="dropdown">
                                news <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </a>
                            <ul class="dropdown-menu level1">
                                <li><a href="bloglist.html">blog List</a></li>
                                <li><a href="bloggrid.html">blog Grid</a></li>
                                <li class="it-last"><a href="blogdetail.html">blog Detail</a></li>
                            </ul>
                        </li>
                        <li class="dropdown first">
                            <a class="btn btn-default dropdown-toggle lv1" data-toggle="dropdown"
                                data-hover="dropdown">
                                community <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </a>
                            <ul class="dropdown-menu level1">
                                <li><a href="userfavoritegrid.html">user favorite grid</a></li>
                                <li><a href="userfavoritelist.html">user favorite list</a></li>
                                <li><a href="userprofile.html">user profile</a></li>
                                <li class="it-last"><a href="userrate.html">user rate</a></li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav flex-child-menu menu-right">
                        <li class="dropdown first">
                            <a class="btn btn-default dropdown-toggle lv1" data-toggle="dropdown"
                                data-hover="dropdown">
                                pages <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </a>
                            <ul class="dropdown-menu level1">
                                <li><a href="landing.html">Landing</a></li>
                                <li><a href="404.html">404 Page</a></li>
                                <li class="it-last"><a href="comingsoon.html">Coming soon</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Help</a></li>
                        <li class="loginLink"><a href="#">LOG In</a></li>
                        <li class="btn signupLink"><a href="#">sign up</a></li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </nav>

            <!-- top search form -->
            <div class="top-search">
                <select>
                    <option value="united">TV show</option>
                    <option value="saab">Others</option>
                </select>
                <input type="text" placeholder="Search for a movie, TV Show or celebrity that you are looking for">
            </div>
        </div>
    </header>

    @yield('content')


    <footer class="ht-footer">
        <div class="container">
            <div class="flex-parent-ft">
                <div class="flex-child-ft item1">
                    <a href="index-2.html"><img class="logo" src="images/logo1.png" alt=""></a>
                    <p>5th Avenue st, manhattan<br>
                        New York, NY 10001</p>
                    <p>Call us: <a href="#">(+01) 202 342 6789</a></p>
                </div>
                <div class="flex-child-ft item2">
                    <h4>Resources</h4>
                    <ul>
                        <li><a href="#">About</a></li>
                        <li><a href="#">Blockbuster</a></li>
                        <li><a href="#">Contact Us</a></li>
                        <li><a href="#">Forums</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Help Center</a></li>
                    </ul>
                </div>
                <div class="flex-child-ft item3">
                    <h4>Legal</h4>
                    <ul>
                        <li><a href="#">Terms of Use</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Security</a></li>
                    </ul>
                </div>
                <div class="flex-child-ft item4">
                    <h4>Account</h4>
                    <ul>
                        <li><a href="#">My Account</a></li>
                        <li><a href="#">Watchlist</a></li>
                        <li><a href="#">Collections</a></li>
                        <li><a href="#">User Guide</a></li>
                    </ul>
                </div>
                <div class="flex-child-ft item5">
                    <h4>Newsletter</h4>
                    <p>Subscribe to our newsletter system now <br> to get latest news from us.</p>
                    <form action="#">
                        <input type="text" placeholder="Enter your email...">
                    </form>
                    <a href="#" class="btn">Subscribe now <i class="ion-ios-arrow-forward"></i></a>
                </div>
            </div>
        </div>
        <div class="ft-copyright">
            <div class="ft-left">
                <p><a target="_blank" href="https://www.templateshub.net">Templates Hub</a></p>
            </div>
            <div class="backtotop">
                <p><a href="#" id="back-to-top">Back to top <i class="ion-ios-arrow-thin-up"></i></a></p>
            </div>
        </div>
    </footer>
    <!-- end of footer section-->
    <script language="javascript" type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.5.12/p5.js">
    </script>
    <script language="javascript" type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.5.12/addons/p5.dom.js"></script>
    <script language="javascript" type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.5.12/addons/p5.sound.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/plugins2.js"></script>
    <script src="js/custom.js"></script>
    <script>
        $("#registrationForm").submit(function(event) {
            event.preventDefault();

            $.ajax({
                type: "post",
                url: "{{ route('auth.processRegister') }}",
                data: $(this).serializeArray(),
                dataType: 'json',
                success: function(response) {
                    if (response['status'] == true) {
                        window.location.href = "{{ route('movies.home') }}";
                        $(".error").removeClass('invalid-feedback').html('');
                        $("input[type='text'], select, input[type='number']").removeClass('is-invalid');
                    } else {
                        var error = response['errors'];
                        $(".error").removeClass('invalid-feedback').html('');
                        $("input[type='text'], select, input[type='number']").removeClass('is-invalid');
                        $.each(error, function(key, value) {
                            $(`#${key}`).addClass('is-invalid').siblings('p').addClass(
                                'invalid-feedback').html(value);
                        });
                    }
                },
                error: function(jQXHR, execption) {
                    console.log("Something went wrong");
                }
            });
        })

        $("#registrationForm input, #categoryForm select, #categoryForm textarea").on("input", function() {
            $(this).removeClass("is-invalid");
            $(this).siblings("p.invalid-feedback").html("");
        });

        $("#loginForm").submit(function(e) {
            e.preventDefault();

            $.ajax({
                type: "post",
                url: "{{ route('auth.authenticate') }}",
                data: $(this).serializeArray(),
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        window.location.href = "{{ route('movies.home') }}";
                        $("#user_email").removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html("");
                        $("#user_password").removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html("");

                    } else {
                        var errors = response['errors'];
                        if (errors['email']) {
                            $("#user_email").addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback').html(errors['email']);
                        } else {
                            $("#user_email").removeClass('is-invalid')
                                .siblings('p')
                                .removeClass('invalid-feedback').html("");
                        }

                        if (errors['password']) {
                            $("#user_password").addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback').html(errors['password']);
                        } else {
                            $("#user_password").removeClass('is-invalid')
                                .siblings('p')
                                .removeClass('invalid-feedback').html("");
                        }
                    }
                },
                error: function(jQXHR, execption) {
                    console.log("Something went wrong");
                }
            });
        });

        $("#loginForm input, #loginForm select, #loginForm textarea").on("input", function() {
            $(this).removeClass("is-invalid");
            $(this).siblings("p.invalid-feedback").html("");
        });
    </script>

    @yield('customJs')
</body>


</html>
