<?php
    include "php/dbconnect.php";
    session_start();
    if(isset($_SESSION['user-email']))
        $user=$_SESSION['user-email'];
    else
        header("Location:./");

    $q=mysqli_query($con,"select * from user where email = '".$user."'");
    if(mysqli_num_rows($q)==0)
        header("Location:./");

    $data=mysqli_fetch_assoc($q);

    if($data['admin']!=1)
        header("Location:./");


?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="Shezartech e-learning">
    <meta name="author" content="Shezartech e-learning">

    <title>Shezartech | Subjects</title>

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
    #courses .courses-item .courses-link .caption .caption-content {
        top: 20%;
    }
    .form-group{
        margin-top: 10px;
        overflow: auto;
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
                        <a href="./subject.php">Subjects & Topics</a>
                    </li>
                    <li class="page-scroll">
                        <a href="./question.php">Add questions</a>
                    </li>
                    <li class="page-scroll">
                        <a href="./edit-question.php">Edit questions</a>
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

    <!-- Begin Body -->
    <div class="container" style="text-align:center">
        <h2>TOPICS</h2>
        <hr class="star-primary">
        <div class="row">
            <button class="btn btn-success" data-target="#subject-modal"  data-toggle="modal">Add Subject</button>
            <button class="btn btn-success"  data-target="#topic-modal"  data-toggle="modal">Add Topic</button>
        </div>
        <table class="table table-bordered">
            <tr>
                <th>
                    Id
                </th>
                <th>
                    Name
                </th>
            </tr>
            <?php
                $q=mysqli_query($con,"select * from subjects");
                while($row=mysqli_fetch_assoc($q)){
                    echo '<tr>';
                    echo '<td colspan=2><h3>'.$row['name'].'</h3></td>';
                    echo '</tr> ';
                    $q2=mysqli_query($con,'select * from topics where subject_id = "'.$row['subject_id'].'"');
                    while($topic=mysqli_fetch_assoc($q2)){
                        echo '<tr>';
                        echo '<td >'.$topic['topic_id'].'</td>';
                        echo '<td >'.$topic['name'].'</td>';
                        echo '</tr> ';
                    }
                }
            ?>
        </table>      
    </div>
 
    <div class="scroll-top page-scroll visible-xs visble-sm">
        <a class="btn btn-primary" href="#page-top">
            <i class="fa fa-chevron-up"></i>
        </a>
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

    <div class="subjects-modal modal fade" id="subject-modal" tabindex="-1" role="dialog" aria-hidden="true">
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
                            <h2>Add new Subject</h2>
                            <hr class="star-primary">
                            <p>
                                Note : All fields are compulsory
                            </p>
                            <form role="form" id="subject-form" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="id">Subject id: <br>
                                        <div style="font-size:12px"><i>3 - digit id</i></div></label>
                                    <input type="text" class="form-control" name="id" placeholder="Enter 3 character subject id" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Name of subject</label>
                                    <input type="name" class="form-control" name="name" placeholder="Name of subject" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Description</label>
                                    <textarea class="form-control" name="description" placeholder="Description goes here" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="name">Add an image for this subject<br>
                                        <div style="font-size:12px"><i>Used for displaying subjects everywhere</i></div>
                                    </label>
                                    <input type="file" class="form-control" name="img" placeholder="" required>
                                </div>
                                <button class="btn btn-default"><i class="fa fa-plus"></i> Add</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                            </form>
                            <br>
                            <div class="well" id="message">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
     <div class="subjects-modal modal fade" id="topic-modal" tabindex="-1" role="dialog" aria-hidden="true">
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
                            <h2>Add new Topic</h2>
                            <hr class="star-primary">
                            <p>
                                Note : All fields are compulsory
                            </p>
                            <form role="form" id="topic-form" method="POST">
                                <div class="form-group">
                                    <label for="id">Topic id: <br>
                                        <div style="font-size:12px"><i>3 - digit id</i></div></label>
                                    <input type="text" class="form-control" name="id" placeholder="Enter 3 character topic id" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Name of topic</label>
                                    <input type="name" class="form-control" name="name" placeholder="Name of topic" required>
                                </div>
                                 <div class="form-group">
                                    <label for="name">Chose subject for this topic
                                    </label>
                                    <select class="form-control" name="subject" required>
                                        <?php
                                            $q=mysqli_query($con,"select * from subjects");
                                            while($row=mysqli_fetch_assoc($q)){
                                                echo '<option value="'.$row['subject_id'].'">';
                                                echo $row['name'].'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="name">Description</label>
                                    <textarea class="form-control" name="description" placeholder="Description goes here" required></textarea>
                                </div>
                                <button class="btn btn-default"><i class="fa fa-plus"></i> Add</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                            </form>
                            <br>
                            <div class="well" id="message1">
                            </div>
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
    <script type="text/javascript">
        
        $("#subject-form").submit(function(e) {
            e.preventDefault();
            var formData = new FormData($('#subject-form')[0]);
            var str= $('#subject-form').serialize();
            jQuery.ajax({
                url:"./php/addsubjects.php?"+str,
                type:"POST",
                success:function(data){
                    $("subject-form div:nth-child(1)").removeClass('has-error');
                    $("#subject-form div:nth-child(2)").removeClass('has-error');
            
                    if(data=='iderr'){
                        $("#message").html("Please use a different id");
                        $("#subject-form div:nth-child(1)").addClass('has-error');
                    }
                    if(data=='imgerr'){
                        $("#message").html("Image can't be uploaded .. use an image file of max 3MB");
                        $("#subject-form div:nth-child(1)").addClass('has-error');
                    }
                    else if(data=='done'){
                        $("#message").html("Subject added successfully");
                        $("#subject-form")[0].reset();
                        location.reload();
                    }
                    else{
                         $("#message").html("Some unknown error");
                    }

                    console.log(data);

                },
                error:function(){
                    alert("Network Error");
                },
                data: formData,
                cache: false,
                contentType: false,
                processData: false
            })
        });

        $("#topic-form").submit(function(e) {
            e.preventDefault();
            var data= $('#topic-form').serialize();
            jQuery.ajax({
                url:"./php/addtopic.php",
                type:"POST",
                data:data,
                success:function(data){
                    $("subject-form div:nth-child(1)").removeClass('has-error');
                    $("#subject-form div:nth-child(2)").removeClass('has-error');
            
                    if(data=='iderr'){
                        $("#message1").html("Please use a different id");
                        $("#subject-form div:nth-child(1)").addClass('has-error');
                    }
                    else if(data=='done'){
                        $("#message1").html("Topic added successfully");
                        $("#topic-form")[0].reset();
                        location.reload();
                    }
                    else{
                         $("#message1").html("Some unknown error");
                    }

                    console.log(data);

                },
                error:function(){
                    alert("Network Error");
                }             
            })
        });
    </script>

</body>

</html>
