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

    if(!isset($_GET['t'])||!isset($_GET['s'])){
        header("Location:./");
    }

    $subject=mysqli_real_escape_string($con,encrypt_decrypt('decrypt',$_GET['s']));
    $topic=mysqli_real_escape_string($con,encrypt_decrypt('decrypt',$_GET['t']));

    echo $topic;

    $q=mysqli_query($con,'select * from topics where topic_id="'.$topic.'"');
    if(mysqli_num_rows($q)==0)
        header("Location:./");

    $topic_name=mysqli_fetch_assoc($q)['name'];

    $topic_level=json_decode($data['topic_level'],true);
    $topic_level=$topic_level[$topic];
    $q=mysqli_query($con,'select * from subjects where subject_id="'.$subject.'"');
    if(mysqli_num_rows($q)==0)
        header("Location:./");

    $subject_name=mysqli_fetch_assoc($q)['name'];


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
    <!--link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'-->
    <style type="text/css">
        .questiontext{
            font-size: 2em;
        }
        .answertext{
            font-size: 1.4em;
            padding: 10px;
        }
        .regular-radio {
            display: none;
        }
        
        label {
            display: inline;
            margin-bottom: -3px;
        }
        .regular-radio + label {
            -webkit-appearance: none;
            background-color: #fafafa;
            border: 1px solid #cacece;
            box-shadow: 0 1px 2px rgba(0,0,0,0.05), inset 0px -15px 10px -12px rgba(0,0,0,0.05);
            padding: 9px;
            border-radius: 50px;
            display: inline-block;
            position: relative;
        }

        .regular-radio:checked + label:after {
            content: ' ';
            width: 12px;
            height: 12px;
            border-radius: 50px;
            position: absolute;
            top: 3px;
            background: #99a1a7;
            box-shadow: inset 0px 0px 10px rgba(0,0,0,0.3);
            text-shadow: 0px;
            left: 3px;
            font-size: 32px;
        }

        .regular-radio:checked + label {
            background-color: #e9ecee;
            color: #99a1a7;
            border: 1px solid #adb8c0;
            box-shadow: 0 1px 2px rgba(0,0,0,0.05), inset 0px -15px 10px -12px rgba(0,0,0,0.05), inset 15px 10px -12px rgba(255,255,255,0.1), inset 0px 0px 10px rgba(0,0,0,0.1);
        }

        .regular-radio + label:active, .regular-radio:checked + label:active {
            box-shadow: 0 1px 2px rgba(0,0,0,0.05), inset 0px 1px 3px rgba(0,0,0,0.1);
        }

        .big-radio + label {
            padding: 16px;
        }

        .big-radio:checked + label:after {
            width: 24px;
            height: 24px;
            left: 4px;
            top: 4px;
        }
        h3{
            text-transform: inherit;
        }
    </style>
</head>

<body id="page-top" class="index">
        
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
    <section id="subjects" style="padding-top:120px">
        <div class="container">
            <div class="row">
                <h4>
                    <div class="col-md-4 text-center">Subject : <?php echo $subject_name;?></div>
                    <div class="col-md-4 text-center">Topic : <?php echo $topic_name;?></div>
                    <div class="col-md-4 text-center">Level: <?php echo $topic_level;?></div>
                </h4>
            </div>
            <hr class="star-primary">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2" id="question">
                    <br>
                    <br>
                    <br>
                    <br>
                    <div style="text-align:center"><img src="img/loader.gif" height="50"> <span style="padding:20px;font-size:20px">Loading Question</span></div>
                    
                </div>
            </div>
            <div class="row">
            
            </div>
        </div>
    </section>


<script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!--script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script-->
    <script src="js/classie.js"></script>
    <script src="js/cbpAnimatedHeader.js"></script>
    <script src="js/shezarelearning.js"></script>
  
     <script type="text/javascript" src="js/mathjax/MathJax.js?config=TeX-AMS_HTML-full">
    </script>

    <script type="text/javascript">
        MathJax.Hub.Config({
            tex2jax: {
                inlineMath: [
                    ["$", "$"],
                    ["\\(", "\\)"]
                ]
            },
            TeX: {
              extensions: ["mhchem.js"]
            }
        });
         var data={error:1,topic:<?php echo '"'.$topic.'"';?>,subject:<?php echo '"'.$subject.'"';?>};

         function loadnextquestion(){
            jQuery.ajax({
                url:'php/getquestion.php',
                type:'post',
                data:data,
                success:function(ans){
                    console.log(ans);
                    try{
                        a=JSON.parse(ans);
                    }catch(e){
                       $("#question").html("<br><br><br><br><h3>Error Loading question Please <a href=\"\">refresh</a></h3>");
                       return;
                    }
                    data=a;
                    if(data['error']==1){
                        $("#question").html("<br><br><br><br><h3>Error Loading question Please <a href=\"\">refresh</a></h3>");
                    }
                    else if(data['error']==2){
                        $("#question").html("<br><br><br><br><h3>No Question Available from this topic ☹ </h3>");
                    }
                    else if(data['error']==3){
                        $("#question").html("<br><br><br><br><h3>You have completed all questions in this topic </h3><br><h4>Please visit <a href='user.php'>your account</a> to practice new topic</h4>");
                    }
                    else{
                        var str='';
                        str+='<form id="newquestion" onsubmit="return false;"><div class="questiontext">'+data['description']+'</div>';
                        str+='<div class="answertext"><input type="radio" id="ans1" class="regular-radio" name="ans" value="a"> <label for="ans1"></label> <span class="ansp">'+data['cha']+'</span></div>';
                        str+='<div class="answertext"><input type="radio" id="ans2" class="regular-radio" name="ans" value="b"> <label for="ans2"></label> <span  class="ansp">'+data['chb']+'</span></div>';
                        str+='<div class="answertext"><input type="radio" id="ans3" class="regular-radio" name="ans" value="c"> <label for="ans3"></label> <span  class="ansp">'+data['chc']+'</span></div>';
                        str+='<div class="answertext"><input type="radio" id="ans4" class="regular-radio" name="ans" value="d"> <label for="ans4"></label> <span  class="ansp">'+data['chd']+'</span></div>';
                        str+='<div class="text-center"><button style="margin-right:20px" class="btn btn-success" type="button" id="btn-submit" onclick="submitans()">Submit!</button><button class="btn btn-success" type="button" id="btn-skip" onclick="skipans()">Skip!</button></div></form><div id="msg"></div>';
                        $("#question").html(str);
                        MathJax.Hub.Queue(["Typeset", MathJax.Hub,"question"]);
                    }
                },
                error:function(){
                    $("#question").html("<br><br><br><br><h3>Error Loading question Please <a href=\"\">refresh</a></h3>");
                }
            })
         }
         loadnextquestion();
         
         function skipans(){
            var datatosub={
                time:data['servedtime'],
                id:data['id'],
                response:'e',
                topic:data['topic'],
                subject:data['subject']
            }
            jQuery.ajax({
                url:'php/submitquestion.php',
                type:'post',
                data:datatosub,
                success:function(ans){
                    loadnextquestion();
                },
                error:function(){
                    alert('Error while submitting');
                }
            })
         }

         function submitans(){
            if($('input[type=radio]:checked').size() == 0){
                $('#btn-submit').addClass('btn-danger');
                $('#msg').addClass('well');
                $('#msg').html('Please select an answer')
                return false;
            }
            var datatosub={
                time:data['servedtime'],
                id:data['id'],
                response:$('input[type=radio]:checked').val(),
                topic:data['topic'],
                subject:data['subject']
            }
            jQuery.ajax({
                url:'php/submitquestion.php',
                type:'post',
                data:datatosub,
                success:function(ans){
                    console.log(ans);
                    try{
                        a=JSON.parse(ans);
                    }catch(e){
                        alert('Error while submitting');                       
                       return;
                    }
                    datatosub=a;
                    if(datatosub['error']==1){
                        alert('Error while submitting');
                    }
                    else{
                       $("#question").html("<br><br><br><br><h3>"+datatosub['response']+"<br><br><br><button class='btn btn-success' onclick='loadnextquestion()'>Next Question</button></h3>");                        
                    }
                },
                error:function(){
                    alert('Error while submitting');
                }
            })
         }
                       

    </script>

</body>

</html>