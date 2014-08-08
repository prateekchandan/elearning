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

    <title>IITJEE Academy | Edit questions</title>

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
     <script type="text/javascript" src="js/mathjax/MathJax.js?config=TeX-AMS_HTML-full">
    </script>
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
         .qout{
            text-align: left;
         }
         img{
            margin: 10px;
            max-height: 200px;
            border-radius: 10px;
         }
         #allques{
            min-height: 100px;
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
        <h2>Edit QUESTIONS</h2>
        <hr class="star-primary">
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
            <div class="col-md-12" id="allques">
                Select a topic to get questions
            </div>
    </div>
 
    <div class="scroll-top page-scroll visible-xs visble-sm">
        <a class="btn btn-primary" href="#page-top">
            <i class="fa fa-chevron-up"></i>
        </a>
    </div>
    
    <?php
        include 'footer.php';
    ?>
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="js/classie.js"></script>
    <script src="js/cbpAnimatedHeader.js"></script>
    <script src="js/shezarelearning.js"></script>
    <script type="text/javascript" src="js/mainpage.js"></script>
    <script src="js/MathToTeX.js"></script>
    <script type="text/javascript"> 
        <?php
            echo "var subjects=".json_encode($sub).";";
            
        ?>
        var questions="";
    </script>
    <script type="text/javascript">
        $("#courses .courses-item .courses-link .caption .caption-content").css("height",$("#courses .courses-item .courses-link .caption .caption-content").css("width"));
        function setcourse() {
            var str="<option value=''>Chose topic</option>",sub=$("#subject").val();
            for (var i = 0; i < subjects[sub].length; i++) {
                str+="<option value='"+subjects[sub][i][0]+"'>"+subjects[sub][i][1]+"</option>";
            };
            $("#course").html(str);
            $("#allques").html('Select a topic to get questions');
        }
        document.getElementById('subject').onchange=setcourse;
        setcourse();

       $("#course").change(function(){
            if($(this).val()==''){
                $("#allques").html('Select a topic to get questions');
                return;
            }


            jQuery.ajax({
                url:"php/getallquestion.php",
                data:{
                        subject:$("#subject").val(),
                        course:$("#course").val()
                    },
                type:"post",
                success:function(data){
                    
                    try{
                        data=JSON.parse(data);
                        questions=data;
                    }
                    catch(e){
                        $("#allques").html("No questions");
                        return;
                    }

                    if(questions.length==0){
                        $("#allques").html("No questions");
                        return;
                    }
                    var n=parseInt(questions.length/10)+((i%10==0)?0:1);
                    var str="<p><b>Showing 1 - "+((10>questions.length)?questions.length:10)+' of ' + questions.length;
                    str+="&nbsp; &nbsp;  Page: <select value=\"1\" onchange=\"setques(this.value)\" class=\"form-control\" style=\"display: initial;width:90px\" id='pagination'>";
                    for (var i = 1; i <= n; i++) {
                       str+='<option value="'+i+'">'+i+'</option>';
                    };
                    str+='</select>';
                    str+='</b></p>  ';
                    $("#allques").html(str);
                    for (var i = 0; i < questions.length && i<10; i++) {
                         $("#allques").append(questions[i]);
                    };
                    MathJax.Hub.Queue(["Typeset", MathJax.Hub,"allques"]);
                },
                error:function(){
                    alert("Network error");
                }
            })
       })

        function deleteq (id) {
            if(confirm("Are you sure want to delete this?")){
            jQuery.ajax({
                    url:"php/delete-q.php",
                    data:{
                           id:id
                        },
                    type:"post",
                    success:function(data){
                        if(data=="done")
                        {
                            $('#'+id).fadeOut(1000);
                        }
                    },
                    error:function(){
                        alert("Network error");
                    }
                })
            }
            return false;
        }

        function setques(id){
            id=id-1;
            var n=parseInt(questions.length/10)+((i%10==0)?0:1);
                    var str="<p><b>Showing "+((id*10)+1)+" - "+( (  ( 10*(id+1))>questions.length)?questions.length:(10*(id+1)))+' of ' + questions.length;
                    str+="&nbsp; &nbsp; Page: <select onchange=\"setques(this.value)\" class=\"form-control\" style=\"display: initial;width:90px\" id='pagination'>";
                    for (var i = 1; i <= n; i++) {
                        if(i==(id+1))
                            str+='<option value="'+i+'" selected>'+i+'</option>';
                        else
                            str+='<option value="'+i+'">'+i+'</option>';
                    };
                    str+='</select>';
                    str+='</b></p>  ';
                    $("#allques").html(str);
                    for (var i = 10*id+1; i < questions.length && i< (10* (id+1) ); i++) {
                         $("#allques").append(questions[i]);
                    };
                    MathJax.Hub.Queue(["Typeset", MathJax.Hub,"allques"]);
        }
    </script>

    <script type="text/x-mathjax-config">
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
         //
         //  Use a closure to hide the local variables from the
         //  global namespace
         //
        window.onload = function () {

            //
            //  The onchange event handler that typesets the
            //  math entered by the user
            //
            window.UpdateMath = function (TeX,no) {
                //set the MathOutput HTML
                /*if (document.getElementById('chk').checked) {
                    var conv = TypedMath.wholeShebang(TeX);
                    document.getElementById("MathOutput").innerHTML = "$$" + conv + "$$";
                    document.getElementById("TeXbox").innerHTML = "<code>" + conv + "</code>";
                } else {
                    document.getElementById("MathOutput").innerHTML = TeX;
                    document.getElementById("TeXbox").innerHTML = "";
                }
                //reprocess the MathOutput Element*/
                TeX = TeX.replace(/(?:\r\n|\r|\n)/g, '<br />');
                var newTeX="";
                var st=0;
                var temp="";
                for (var i = 0; i < TeX.length ; i++) {
                    if(i!=(TeX.length-1) && TeX[i] == '$' && TeX[i+1]=='$')
                    {
                        newTeX+='$';
                        i++;
                    }
                    else if(TeX[i]!='$')
                    {
                        if(st==0){
                            newTeX+=TeX[i];
                        }
                        else{
                            temp+=TeX[i];
                        }
                    }
                    else
                    {
                        if(st==1){
                            var conv = TypedMath.wholeShebang(temp);
                            newTeX+='$'+conv+'$';
                            temp="";

                        }
                        st=(st+1)%2;
                    }
                };
                if(st==1){
                    newTeX+='$'+temp;
                }
                TeX = newTeX;
                document.getElementById("qout"+no).innerHTML = TeX;
                $('.qhid'+no).val(TeX);
                MathJax.Hub.Queue(["Typeset", MathJax.Hub,"qout"+no]);

            }
            window.refreshCheck = function () {
                UpdateMath(document.getElementById("MathInput").value);
                if (document.getElementById('chk').checked) {
                    document.getElementById("TeXWrap").style.display = "block";
                } else {

                    document.getElementById("TeXWrap").style.display = "none";
                }
            }

        };

    function changecheck(id){
        jQuery.ajax({
            data:{id:id},
            url:'php/changecheck.php',
            type:'post',
            success:function(data){
                console.log(data);
            },
            error:function(){
                alert('Network error');
            }
        })
    }
    </script>

</body>

</html>
