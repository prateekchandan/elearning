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

    <title>Shezartech | Upload questions</title>

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
        <h2>UPLOAD QUESTIONS</h2>
        <hr class="star-primary">
        <form class="col-md-10 col-md-offset-1" enctype="multipart/form-data" id="question">
            <div class="form-group">
                <label class="col-md-2">Subject:</label>
                <div class="col-md-4">
                    <select class="form-control" name="subject" id="subject" required>
                        <?php
                            $sub=array();
                            $q=mysqli_query($con,"select * from subjects");
                            while($row=mysqli_fetch_assoc($q)){
                                echo '<option value="'.$row['subject_id'].'">'.strtoupper($row['name']).'</option>';
                                $sub[$row['subject_id']]=array();
                                $q1=mysqli_query($con,"select * from topics where subject_id='".$row['subject_id']."'");
                                while($topic=mysqli_fetch_assoc($q1)){
                                    array_push($sub[$row['subject_id']], [$topic['topic_id'],$topic['name']]);
                                }

                            }
                        ?>
                    </select>
                </div>
                <label class="col-md-2">Topic:</label>
                <div class="col-md-4">
                    <select class="form-control" name="course" id="course" required>
                        <option value=''>Select Topic</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2">Question:</label>
                <div class="col-md-10">
                    <textarea class="form-control" name='description' required></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2">Image:</label>
                <div class="col-md-10">
                    <input type="file" name="pic" accept="image/*">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-2">Option A:</label>
                <div class="col-md-10">
                    <textarea class="form-control" name='cha' required></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-10 col-md-offset-2">
                    <input type="file" name="pica" accept="image/*">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-2">Option B:</label>
                <div class="col-md-10">
                    <textarea class="form-control" name='chb' required></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-10 col-md-offset-2">
                    <input type="file" name="picb" accept="image/*">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-2">Option C:</label>
                <div class="col-md-10">
                    <textarea class="form-control" name='chc' required></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-10 col-md-offset-2">
                    <input type="file" name="picc" accept="image/*">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-2">Option D:</label>
                <div class="col-md-10">
                    <textarea class="form-control" name='chd' required></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-10 col-md-offset-2">
                    <input type="file" name="picd" accept="image/*">
                </div>
            </div>
            <div class="form-group"> 
                <label class="col-md-12">Correct Answer</label>
                <div class="col-md-3">
                    <input type="radio" name="answer" value="a" checked>
                    Option A
                </div>
                <div class="col-md-3">
                    <input type="radio" name="answer" value="b">
                    Option B
                </div>
                <div class="col-md-3">
                    <input type="radio" name="answer" value="c">
                    Option C
                </div>
                <div class="col-md-3">
                    <input type="radio" name="answer" value="d">
                    Option D
                </div>
            </div>
            <div class="form-group"> 
                <label class="col-md-2">Estimated Level</label>
                <div class="col-md-10">
                    <select name="level" class="form-control">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                        <option>6</option>
                        <option>7</option>
                    </select>
                </div>
            </div>
            
            <button class="btn btn-success">SUBMIT</button>
        </form>
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

    
    
  
  

    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="js/classie.js"></script>
    <script src="js/cbpAnimatedHeader.js"></script>
    <script src="js/shezarelearning.js"></script>
    <script type="text/javascript" src="js/mainpage.js"></script>
    <script type="text/javascript"> 
        <?php
            echo "var subjects=".json_encode($sub).";";
        ?>
    </script>
    <script type="text/javascript">
        $("#courses .courses-item .courses-link .caption .caption-content").css("height",$("#courses .courses-item .courses-link .caption .caption-content").css("width"));
        function setcourse() {
            var str='',sub=$("#subject").val();
            for (var i = 0; i < subjects[sub].length; i++) {
                str+="<option value='"+subjects[sub][i][0]+"'>"+subjects[sub][i][1]+"</option>";
            };
            $("#course").html(str);
        }
        document.getElementById('subject').onchange=setcourse;
        setcourse();

        $("#question").submit(function(e){
            e.preventDefault();
            var formData = new FormData($('#question')[0]);
            var str= $('#question').serialize();
            $.ajax({
                url: 'php/question-upload.php?'+str,  //Server script to process data
                type: 'POST',
                success: function(data){
                    if(data=="done")
                        $("#question")[0].reset();
                    else{
                        alert(data);
                    }
                },
                error: function(data){
                    alert("error");
                },
                data: formData,
                cache: false,
                contentType: false,
                processData: false
            });

        })
    </script>

</body>

</html>
