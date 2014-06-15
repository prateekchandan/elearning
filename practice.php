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

    <title>IITJEE Academy | e-learning</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="css/shezarelearning.css" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" href="http://shezartech.com/SZ/wp-content/uploads/2013/09/logo_1.png">

    <!-- Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!--link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'-->
    <style type="text/css">
        .questiontext{
            font-size: 1.4em;
        }
        .answertext{
            font-size: 1.1em;
            padding: 10px;
        }
        .slideThree{
            font-size: 1.2em;
            padding: 10px;
        }
        input[type=checkbox] {
        display: none;
        }
        label:before {
            content: "";
            display: inline-block;

            width: 30px;
            height: 23px;

            margin-right: 10px;
            padding-bottom: 3px;
            padding-top: 3px;
            position: absolute;
            left: 0px;
            top:0px;
            background-color: #aaa;
            box-shadow: inset 0px 2px 3px 0px rgba(0, 0, 0, .3), 0px 1px 0px 0px rgba(255, 255, 255, .8);
        }
        label {
       
        cursor: pointer;
        position: relative;
        padding-left: 25px;
        margin-right: 15px;
        font-size: 13px;
    }
    .checkbox label:before {
        border-radius: 3px;
    }  
    input[type=checkbox]:checked + label:before {
        content: "YES";
        text-shadow: 1px 1px 1px rgba(0, 0, 0, .2);
        font-size: 15px;
        color: #f3f3f3;
        text-align: center;
        line-height: 15px;
        margin-top: -11px;
        background-color: rgb(0, 54, 192);
    }
    input[type=checkbox] + label:before {
        content: "NO";
        text-shadow: 1px 1px 1px rgba(0, 0, 0, .2);
        font-size: 15px;
        color: #f3f3f3;
        text-align: center;
        line-height: 15px;
        margin-top: -11px;
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
                <a class="navbar-brand" href="./">IITJEE Academy</a>
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
                        str+='<div class="slideThree"><input type="checkbox" id="ans1"  name="ans" value="a"> <label for="ans1"></label><span>'+data['cha']+'</span></div>';
                        str+='<div class="slideThree"><input type="checkbox" id="ans2"  name="ans" value="b"> <label for="ans2"></label><span>'+data['chb']+'</span></div>';
                        str+='<div class="slideThree"><input type="checkbox" id="ans3"  name="ans" value="c"> <label for="ans3"></label><span>'+data['chc']+'</span></div>';
                        str+='<div class="slideThree"><input type="checkbox" id="ans4"  name="ans" value="d"> <label for="ans4"></label><span>'+data['chd']+'</span></div>';
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
                subject:data['subject'],
                error:0

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
            var ans=[];
            if($("#ans1").is(":checked")){
                ans.push('a');
            }
            if($("#ans2").is(":checked")){
                ans.push('b');
            }
            if($("#ans3").is(":checked")){
                ans.push('c');
            }
            if($("#ans4").is(":checked")){
                ans.push('d');
            }

            if(ans.length == 0){
                $('#btn-submit').addClass('btn-danger');
                $('#msg').addClass('well');
                $('#msg').html('Please select an answer')
                return false;
            }
             ans=JSON.stringify(ans);
            
            var datatosub={
                time:data['servedtime'],
                id:data['id'],
                response:ans,
                topic:data['topic'],
                subject:data['subject'],
                error:0
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
                    else if(datatosub['error']==2){
                       $("#question").html("<br><br><br><br><h3>"+datatosub['response']+"<br><br><br><button class='btn btn-success' onclick='location.reload()'>Next Question</button></h3>");                        
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