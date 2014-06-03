<?php
    include "php/dbconnect.php";
    include "php/encrypt.php";
    session_start();
    if(isset($_SESSION['user-email']))
        $user=$_SESSION['user-email'];
    else
        header("Location:./");

    $q=mysqli_query($con,"select * from user where email = '".$user."'");
    if(mysqli_num_rows($q)==0)
        header("Location:./");

    $data=mysqli_fetch_assoc($q);

    if($data['admin']==1)
        $admin=1;


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
    <style type="text/css">
    #subjects .subjects-item .subjects-link .caption .caption-content {
        top: 20%;
    }
    .topic{
        padding: 20px;
        box-shadow: 0px 0px 2px #ccc;
        margin: 10px;
        display: block;
        color: inherit;
    }
    .topic:hover , .topic:focus {
        text-decoration: none;
        color: inherit;
    }
    </style>

</head>

<body id="page-top" class="index">

    <!-- Navigation -->
        
        <style type="text/css">
         body{
            padding-top: 120px;
         }
         .img-rounded{
            height: 210px;
            width: 210px;
            border-radius: 50%;
         }

        </style>
    </head>
    
    <!-- HTML code from Bootply.com editor -->
    
    <body  >
        
        
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
                        <a href="./">Home</a>
                    </li>
                    <li class="page-scroll">
                        <?php
                            if($user){
                                echo '<li class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                      Account <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu">';
                                    if($admin==1){
                                        echo '
                                        <li><a href="question.php">Add question</a></li>
                                        <li><a href="subject.php">Manage topics</a></li>
                                        <li><a href="./edit-question.php">Edit questions</a></li>
                                        ';
                                      }
                                    echo '
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

<!-- Begin Body -->
<div class="container">
    <div class="row">
            <div class="col-md-3 sidebar-fixed" id="leftCol">
                
                <div class="well"> 
                <ul class="nav nav-stacked" id="sidebar">
                  <li><a href="#profile"><i class="fa fa-user"></i> Profile</a></li>
                  <li><a href="#ranking"><i class="fa fa-tachometer"></i> Rankings</a></li>
                  <li><a href="#subjects"><i class="fa fa-book"></i> Subjects</a></li>
                  <li><a href="#dashboard"><i class="fa fa-calendar"></i> Dashboard</a></li>
                </ul>
                </div>

            </div>  
            <div class="col-md-9">
                <hr>
                <h2 id="profile">Welcome <?php echo $data['Name']; ?> ,</h2>               
                    <?php
                        if($data['fotopath']=='')
                            $imgsrc="./img/user.png";
                        else
                            $imgsrc=$data['fotopath'];
                    ?>
                    <div style="text-align:center;">
                        <img src="<?php echo $imgsrc;  ?>" class="img-rounded">
                        <br>
                        <button class="btn btn-sm" id="edit-photo">Edit photo</button>
                        <form enctype="multipart/form-data" id="imgup">
                            <input type="file" onchange="editpic()" accept="image/*" id="logo-upload" name="img" style="display:none;position:absolute;right:0px;top:0px">
                        </form>
                    </div>
                <br>
                <hr>
                <h2 id="ranking">Your Current rankings</h2>
                <div style="padding-left:40px;">
                    <h3>
                         <span class="glyphicon glyphicon-star"></span> Global : <b><?php   echo $data['globalrank'];?></b>
                    </h3>
                    <h3>
                         <span class="glyphicon glyphicon-star"></span> City : <b><?php   echo $data['cityrank'];?></b>
                    </h3>
                </div>
                
              
                <hr>
              
                <h2 id="subjects">Subjects</h2>
                 <div id="subjects">
                    <div class="">
                        <div class="row">
                        <?php
                            $global=json_decode($data['subject_global'],true);
                            $city=json_decode($data['subject_city'],true);
                            $level=json_decode($data['subject_level'],true);
                            $q=mysqli_query($con,"select * from subjects");

                            while($row=mysqli_fetch_assoc($q)){
                                $glrank=0;
                                $cityrank=0;
                                $slevel=1;
                                if(isset($global[$row['subject_id']]))
                                {
                                    $glrank=$global[$row['subject_id']];

                                }
                                else{
                                    $global[$row['subject_id']]=0;
                                    mysqli_query($con,"update user set subject_global='".json_encode($global)."' where email='".$data['email']."'");
                                }

                                if(isset($city[$row['subject_id']]))
                                {
                                    $cityrank=$global[$row['subject_id']];
                                }
                                else{
                                    $city[$row['subject_id']]=0;
                                    mysqli_query($con,"update user set subject_city='".json_encode($city)."' where email='".$data['email']."' ");
                                }
                                if(isset($level[$row['subject_id']]))
                                {
                                    $slevel=$global[$row['subject_id']];
                                }
                                else{
                                    $level[$row['subject_id']]=1;
                                    mysqli_query($con,"update user set subject_level='".json_encode($level)."'  where email='".$data['email']."'");
                                }
                                echo   '<div class="col-sm-4 subjects-item">
                                        <a href="#" data-target="#subjectsModal'.$row['subject_id'].'" class="subjects-link" data-toggle="modal">
                                            <div class="caption">
                                                <div class="caption-content">
                                                    <h4>'.$row['name'].'</h4>
                                                    <h5>Global Rank :'.$glrank.' </h5>
                                                    <h5>City Rank : '.$cityrank.'</h5>
                                                    <h5>Level :'.$slevel.'</h5>
                                                </div>
                                            </div>
                                            <img src="img/subjectimg/'.$row['name'].'.png" class="img-responsive" alt="" />
                                        </a>
                                    </div>';
                            }
                        ?>
                        </div>
                    </div>
                </div>
                <hr>
              
              
              
                <h2 id="dashboard">Section 4</h2>
                
              
                <hr>
            </div> 
    </div>
</div>

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
    
    <!-- subjects Modals -->
     <?php
     $q=mysqli_query($con,"select * from subjects");
        $global=json_decode($data['subject_global'],true);
        $city=json_decode($data['subject_city'],true);
        $level=json_decode($data['subject_level'],true);

        $tglobal=json_decode($data['topic_global'],true);
        $tcity=json_decode($data['topic_city'],true);
        $tlevel=json_decode($data['topic_level'],true);

        while($row=mysqli_fetch_assoc($q)){

            $glrank=0;
            $cityrank=0;
            $slevel=1;
            if(isset($global[$row['subject_id']]))
            {
                $glrank=$global[$row['subject_id']];

            }
            else{
                $global[$row['subject_id']]=0;
            }

            if(isset($city[$row['subject_id']]))
            {
                $cityrank=$global[$row['subject_id']];
            }
            else{
                $city[$row['subject_id']]=0;
            }
            if(isset($level[$row['subject_id']]))
            {
                $slevel=$global[$row['subject_id']];
            }
            else{
                $level[$row['subject_id']]=0;
            }
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
                            <div class="col-lg-10 col-lg-offset-1">
                                <div class="modal-body">
                                    <h2>'.$row['name'].'</h2>
                                    <hr class="star-primary">
                                    <p>'.$row['info'].'</p>

                                    <br>';
                        $q1=mysqli_query($con,'select * from topics where subject_id="'.$row['subject_id'].'"');
                        $i=0;
                        while($col=mysqli_fetch_assoc($q1)){
                            $tglrank=0;
                                $tcityrank=0;
                                $tslevel=1;
                                if(isset($tglobal[$col['topic_id']]))
                                {
                                    $tglrank=$tglobal[$col['topic_id']];

                                }
                                else{
                                    $tglobal[$col['topic_id']]=0;
                                    mysqli_query($con,"update user set topic_global='".json_encode($tglobal)."' where email='".$data['email']."'");
                                }

                                if(isset($tcity[$col['topic_id']]))
                                {
                                    $tcityrank=$tglobal[$col['topic_id']];
                                }
                                else{
                                    $tcity[$col['topic_id']]=0;
                                    mysqli_query($con,"update user set topic_city='".json_encode($tcity)."' where email='".$data['email']."' ");
                                }
                                if(isset($tlevel[$col['topic_id']]))
                                {
                                    $tslevel=$tglobal[$col['topic_id']];
                                }
                                else{
                                    $tlevel[$col['topic_id']]=1;
                                    mysqli_query($con,"update user set topic_level='".json_encode($tlevel)."' , topic_score='".json_encode($tlevel)."'  where email='".$data['email']."'");
                                }

                            if($i%2==0)
                                echo '<div class="row">';
                            echo '<div class = "col-md-6"><div href="#" class="topic">
                            <h4>'.$col['name'].'</h4>
                            '.$col['info'].'<br>
                            Global Rank : '.$tglrank.'
                            <br>
                            City Rank: '.$tcityrank.'
                            <br>
                            Level: '.$tslevel.'
                            <br>
                            <a href="practice.php?t='.encrypt_decrypt('encrypt',$col['topic_id']).'&s='.encrypt_decrypt('encrypt',$row['subject_id']).'">
                             <button   class="btn btn-default btn-sm"><i class="fa fa-sign-in"></i> Begin Practicing
                            </button></a></div></div>';
                            if($i%2==1)
                                echo '</div>';
                            $i++;

                        }
                        if($i%2==1)
                            echo '</div>';  
                        echo '    <hr>    
                                    <h4>Your rankings in this subject</h4>
                                    <h5>
                                         <span class="glyphicon glyphicon-star"></span> Global : <b>'.$glrank.'</b>
                                    </h5>
                                    <h5>
                                         <span class="glyphicon glyphicon-star"></span> City : <b>'.$cityrank.'</b>
                                    </h5> ';

                                    
                        echo '            

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
  
  

    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="js/classie.js"></script>
    <script src="js/cbpAnimatedHeader.js"></script>
    <script src="js/shezarelearning.js"></script>
    <script type="text/javascript" src="js/mainpage.js"></script>
    <script type="text/javascript">
        $("#subjects .subjects-item .subjects-link .caption .caption-content").css("height",$("#subjects .subjects-item .subjects-link .caption .caption-content").css("width"));
    </script>

</body>

</html>
