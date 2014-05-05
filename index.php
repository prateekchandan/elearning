<?php
    include "php/dbconnect.php";
    session_start();
    if(isset($_SESSION['user-email']))
        $user=$_SESSION['user-email'];
    else
        $user=false;

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="Shezartech e-learning">
    <meta name="author" content="Shezartech e-learning">

    <title>Shezartech | e-learning</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="css/freelancer.css" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" href="http://shezartech.com/SZ/wp-content/uploads/2013/09/logo_1.png">

    <!-- Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

    <!-- IE8 support for HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

</head>

<body id="page-top" class="index">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="./">Shezartech</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li class="page-scroll">
                        <a href="#portfolio">Courses</a>
                    </li>
                    <li class="page-scroll">
                        <a href="#about">Get Started</a>
                    </li>
                    <li class="page-scroll">
                        <a href="#contact">Contact</a>
                    </li>
                    <li class="page-scroll">
                        <?php
                            if($user){
                                echo '<li class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                      Account <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                      <li><a href="user.php">View Account</a></li>
                                      <li><a href="logout.php">Logout</a></li>
                                    </ul>
                                  </li> ';
                            }
                            else{
                              echo '<a data-toggle="modal" data-target="#login-modal" href="#">Login</a>  ';
                            }
                            
                        ?>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <header>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <img class="img-responsive" style="border-radius:50%" src="img/profile.png" alt="">
                    <div class="intro-text">
                        <span class="name">E-learning</span>
                        <hr class="star-light">
                        <span class="skills">Engage . Enhance . Empower</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section id="portfolio">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Running courses</h2>
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">
            <?php
                $q=mysqli_query($con,"select * from courses");
                    while($row=mysqli_fetch_assoc($q)){
                     echo   '<div class="col-sm-4 portfolio-item">
                            <a href="#portfolioModal'.$row['course_id'].'" class="portfolio-link" data-toggle="modal">
                                <div class="caption">
                                    <div class="caption-content">
                                        <i class="fa fa-search-plus fa-2x"></i><br><br><h4>'.$row['name'].'</h4>
                                    </div>
                                </div>
                                <img src="img/courseimg/'.$row['name'].'.png" class="img-responsive" alt="" />
                            </a>
                        </div>';
                    }
            ?>
            </div>
        </div>
    </section>

    <section class="success" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Get Started</h2>
                    <hr class="star-light">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-lg-offset-2">
                    <p>In this e-learning system we provide a vast range of cources to practice and learn and boost your knowledge.To start this you need to login to the site and then chose any one course to start with and then you can begin learning</p>
                </div>
                <div class="col-lg-4">
                    <p>We are a forward thinking company that offers end to end e-Learning consultancy and solutions. From analyzing learner needs to generating learning reports, we are passionate and capable of developing custom learning solutions in record turn around times.</p>
                </div>
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <a data-toggle="modal" data-target="#login-modal" href="#" class="btn btn-lg btn-outline">
                        <i class="fa fa-sign-in"></i> Login to start
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Contact Us</h2>
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <form role="form">
                        <div class="row">
                            <div class="form-group col-xs-12 floating-label-form-group">
                                <label for="name">Name</label>
                                <input class="form-control" type="text" name="name" placeholder="Name">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-xs-12 floating-label-form-group">
                                <label for="email">Email Address</label>
                                <input class="form-control" type="email" name="email" placeholder="Email Address">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-xs-12 floating-label-form-group">
                                <label for="message">Message</label>
                                <textarea placeholder="Message" class="form-control" rows="5"></textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="form-group col-xs-12">
                                <button type="submit" class="btn btn-lg btn-success">Send</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <footer class="text-center">
        <div class="footer-above">
            <div class="container">
                <div class="row">
                    <div class="footer-col col-md-4">
                        <h3>Corporate Office</h3>
                        <p>Shezar Web Technologies Pvt Ltd
                            <br>203, Crystal Paradise, Dattaji Salve Road, Off. Veera Desai Road & New Link Road, Andheri (W), Mumbai - 400053, India</p>
                    </div>
                    <div class="footer-col col-md-4">
                        <h3>Around the Web</h3>
                        <ul class="list-inline">
                            <li><a href="https://www.facebook.com/pages/Shezar-Tech/494763083907105" class="btn-social btn-outline"><i class="fa fa-fw fa-facebook"></i></a>
                            </li>
                            <li><a href="https://www.youtube.com/user/TheShezartech" class="btn-social btn-outline"><i class="fa fa-fw fa-youtube"></i></a>
                            </li>
                            <li><a href="https://twitter.com/ShezarTech" class="btn-social btn-outline"><i class="fa fa-fw fa-twitter"></i></a>
                            </li>
                            <li><a href="http://www.linkedin.com/company/shezar-web-technologies-pvt-ltd-" class="btn-social btn-outline"><i class="fa fa-fw fa-linkedin"></i></a>
                            </li>
                            <li><a href="http://www.shezartech.com" class="btn-social btn-outline"><i class="fa fa-fw fa-dribbble"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="footer-col col-md-4">
                        <h3>About Shezartech</h3>
                        <p>
                            We are a 12 year old professionally managed e-Learning company. We help organizations to take up the challenge of making learning effective and engaging</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-below">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        Copyright &copy; 2014 - Shezar Web Technologies Pvt. Ltd.
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <div class="scroll-top page-scroll visible-xs visble-sm">
        <a class="btn btn-primary" href="#page-top">
            <i class="fa fa-chevron-up"></i>
        </a>
    </div>

    <!-- Portfolio Modals -->
     <?php
                $q=mysqli_query($con,"select * from courses");
                    while($row=mysqli_fetch_assoc($q)){
                        echo '
    <div class="portfolio-modal modal fade" id="portfolioModal'.$row['course_id'].'" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <h2>'.$row['name'].'</h2>
                            <hr class="star-primary">
                            <img src="img/courseimg/'.$row['name'].'.png" class="img-responsive img-centered" alt="">
                            <h4>'.$row['short_info'].'</h4>
                            <p>'.$row['large_info'].'</p>
                            
                            <button type="button" class="btn btn-default"><i class="fa fa-sign-in"></i> Start</button>

                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        ';
    }
    ?>
  

    <div class="portfolio-modal modal fade" id="login-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="modal-body">
                            <h2>Login/Register</h2>
                            <hr class="star-primary">
                            <p>
                                Note : All fields are compulsory
                            </p>
                            <ul class="nav nav-tabs">
                              <li class="active"><a href="#login" data-toggle="tab" >Login</a></li>
                              <li><a href="#register" data-toggle="tab">Register</a></li>
                              <li><a href="#forgetpassword" data-toggle="tab">Forget Password</a></li>
                            </ul>
                            <div class="tab-content">
                              <div class="tab-pane active" id="login">
                                <br>
                                  <form role="form" id="login-form">
                                      <div class="form-group">
                                        <label for="email">Email address</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
                                      </div>
                                      <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                      </div>
                                       <button class="btn btn-default"><i class="fa fa-sign-in"></i> Login</button>

                                         <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                                    </form>
                              </div>
                              <div class="tab-pane" id="register">
                                    <br>
                                   <form role="form" id="register-form">
                                      <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
                                      </div>
                                      <div class="form-group">
                                        <label for="email">Email address</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
                                      </div>
                                      <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                      </div>
                                      <div class="form-group">
                                        <label for="repassword">Retype Password</label>
                                        <input type="password" class="form-control" id="repassword" name="repassword" placeholder="Password" required>
                                      </div>
                                       <button class="btn btn-default"><i class="fa fa-sign-in"></i> Register</button>

                                         <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                                    </form>
                              </div>
                              <div class="tab-pane" id="forgetpassword">
                                  <form role="form" id="forgetpassword-form">
                                    <br>
                                      <div class="form-group">
                                        <label for="email">Type your email address</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
                                      </div>
                                       <button class="btn btn-default"><i class="fa fa-sign-in"></i> Go</button>

                                         <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                                    </form>
                              </div>
                            </div>
                            <br>
                            <br>
                            <div class="well" id="message"></div>
                            
                           


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="js/classie.js"></script>
    <script src="js/cbpAnimatedHeader.js"></script>
    <script src="js/freelancer.js"></script>
    <script type="text/javascript" src="js/mainpage.js"></script>

</body>

</html>
