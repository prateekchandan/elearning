<?php
    include "php/dbconnect.php";
    $admin=0;
    session_start();
    
    if(isset($_SESSION['user-email'])){

        $user=$_SESSION['user-email'];
        $q=mysqli_query($con,"select * from user where email = '".$user."'");
        if(mysqli_num_rows($q)>0){
        
            header("Location:./user.php");
        }
    }
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

    <title>IITJEE Academy | e-learning</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="css/shezarelearning.css" rel="stylesheet" type="text/css">
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
                <a class="navbar-brand" href="./">IITJEE Academy</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li class="page-scroll">
                        <a href="#about-iitjee">About IITJEE Academy</a>
                    </li>
                    <li class="page-scroll">
                        <a href="#working">How it works</a>
                    </li>
                    <li class="page-scroll">
                        <a href="#helping">How it helps</a>
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
                                      ';
                                      if($admin==1){
                                        echo '
                                        <li><a href="question.php">Add question</a></li>
                                        <li><a href="subject.php">Manage topics</a></li>
                                        <li><a href="./edit-question.php">Edit questions</a></li>
                                        ';
                                      }
                                      echo '
                                      <li><a href="logout.php">Logout</a></li>
                                    </ul>
                                  </li> ';
                            }
                            else{
                              echo '<a data-toggle="modal" data-target="#login-modal" href="#">Login/signup</a>  ';
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
                    <!--img class="img-responsive" style="border-radius:50%" src="img/profile.png" alt=""-->
                    <!--div class="intro-text">
                        <span class="name">E-learning</span>
                        <hr class="star-light">
                        <span class="skills">Engage . Enhance . Empower</span>
                    </div-->
                    <div class="intro-text">
                        <span class="name">Practise that makes you an IITIAN Seven steps to gear up in the way, just appropriate for you.</span>
                        <hr class="star-light">
                        <span class="skills">Dynamic and adaptive practise that serves you according to your capabilities and realise you run harder at the facets where you necessitate to pay more attention.</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <section id="about-iitjee">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>About IITJEE Academy:</h2>
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">
                <ul>
                    <li>
                        <p>IITJEE Practise Package has been designed by top ranking IITIANS who are acquaintedwith the
                        strategies utilised in the exam preparations and lay down the path to gear your preparations for the same.</p>
                    </li>
                    <li>
                        <p>Our motto is to ease and direct your efforts in a correct direction while making sure to adjust it to your needs.</p>
                    </li>
                    <li>
                        <p>The Module is self-paced, Adaptive, most comprehensive practice package</p>
                    </li>
                    <li>
                        <p>Helps you to bridge the gaps to get maximum returns on the time invested</p>
                    </li>
                    <li>
                        <p>Money back guarantee</p>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <section class="success" id="working">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>How it Works</h2>
                    <hr class="star-light">
                </div>
            </div>
            <div class="row">
                <ul>
                    <li>
                        <p>IITJEE is a Comprehensive coverage of the syllabusfor IIT Join Entrance Examination</p>
                    </li>
                    <li>
                        <p>It comprises of a Deep and exhaustive question bank for each topic at each level.</p>
                    </li>
                    <li>
                        <p>Know your AIR/State Rank</p>
                    </li>
                    <li>
                        <p>You can compare Rankings and Know where you abide.</p>
                    </li>
                    <li>
                        <p>Each question is hand-picked and reviewed by IITians and rankers</p>
                    </li>
                    <li>
                        <p>Find your weak spots and improve speed and accuracy.</p>
                    </li>
                    <li>
                        <p>Goal based adaptive tests arecreated specifically for you.</p>
                    </li>
                    <li>
                        <p>Balances the preparations in all the subjects and topics</p>
                    </li>
                    <li>
                        <p>Tracks the effort required for each topic/ subject to reach the ultimate goal</p>
                    </li>
                    <li>
                        <p>Questions are exam based</p>
                    </li>
                    <li>
                        <p>You can practise at ease of your electronic devices</p>
                    </li>
                    <li>
                        <p>Utilises your time correctly</p>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <section class="contacts" id="helping">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>How it Helps</h2>
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">
                <ul>
                    <li>
                        <p>All the candidates start at level 1 and they need to cross 7 levels to reach the goal.</p>
                    </li>
                    <li>
                        <p>The difficulty level increases as the level progresses.</p>
                    </li>
                    <li>
                        <p>Till the candidate is proficient enough to move to the next level the system keeps assigning questions to make him/her practise at that level.</p>
                    </li>
                    <li>
                        <p>If the candidate has attained proficiency at a certain level, the system analyses this automatically and takes the candidate to the next level.</p>
                    </li>
                    <li>
                        <p>Each question is hand-picked and reviewed by IITians and rankers</p>
                    </li>
                    <li>
                        <p>For each subject / topic the system makes sure that practise is made, precisely in the levels where it is most needed.</p>
                    </li>
                    <li>
                        <p>This serves the candidate to use the time in the correct way.</p>
                    </li>
                    <li>
                        <p>We do not provide solutions as we aim in honing your nails while you scramble to find right answers.</p>
                    </li>
                    <li>
                        <p>All questions at all levels and for all topics are based on IITJEE examination pattern, helping the candidate to facilitate the preparations.</p>
                    </li>
                    <li>
                        <p>It is accessible through Desktops, Laptops, mobile phones and Tablets.</p>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    
    <?php
        include 'footer.php';
    ?>

    <div class="scroll-top page-scroll visible-xs visble-sm">
        <a class="btn btn-primary" href="#page-top">
            <i class="fa fa-chevron-up"></i>
        </a>
    </div>

    <!-- subjects Modals -->
     <?php
                $q=mysqli_query($con,"select * from subjects");
                    while($row=mysqli_fetch_assoc($q)){
                        echo '
    <div class="subjects-modal modal fade" id="subjectsModal'.$row['subject_id'].'" tabindex="-1" role="dialog" aria-hidden="true">
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
                            <img src="img/subjectimg/'.$row['name'].'.png" class="img-responsive img-centered" alt="">
                            <p>'.$row['info'].'</p>

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
  

        <div class="subjects-modal modal fade" id="login-modal" tabindex="-1" role="dialog" aria-hidden="true">
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
    <script src="js/shezarelearning.js"></script>
    <script type="text/javascript" src="js/mainpage.js"></script>

</body>

</html>
