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

    if(!isset($_GET['id']))
        header("Location:./edit-question.php");

    $qid=mysqli_real_escape_string($con,$_GET['id']);

    $q=mysqli_query($con,"select * from questions where id = '".$qid."'");

    if(mysqli_num_rows($q)==0)
        header("Location:./edit-question.php");

    $question=mysqli_fetch_assoc($q);


?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="Shezartech e-learning">
    <meta name="author" content="Shezartech e-learning">

    <title>IITJEE Academy |Edit questions</title>

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
        <h2>EDIT QUESTION</h2>
        <hr class="star-primary">
        <blockquote>You can type the math in LateX or directly your math equation which will be conevrted
        <a class="btn btn-success" data-toggle="modal" data-target="#tutorial" href="#">Tutorial</a></blockquote>
        <form class="col-md-10 col-md-offset-1" enctype="multipart/form-data" id="question">
            <input type="hidden" name="qid" value="<?php echo $question['id']; ?>">
            <div class="form-group">
                <label class="col-md-2">Subject:</label>
                <div class="col-md-4">
                    <select class="form-control" name="subject" id="subject" required>
                        <?php
                            $sub=array();
                            $q=mysqli_query($con,"select * from subjects");
                           
                            while($row=mysqli_fetch_assoc($q)){
                                if($row['subject_id']==$question['subject_id'])
                                    echo '<option value="'.$row['subject_id'].'" selected>'.strtoupper($row['name']).'</option>';
                                else
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
                        <?php
                            foreach ($sub[$question['subject_id']] as $value) {
                                if($value[0]==$question['topic_id'])
                                    echo '<option value="'.$value[0].'" selected>'.$value[1].'</option>';
                                else
                                    echo '<option value="'.$value[0].'">'.$value[1].'</option>';
                            }

                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2">Question:</label>
                <div class="col-md-10">
                    <textarea class="form-control"  onKeyUp="UpdateMath(this.value,1)" required><?php echo str_replace('$', '$$', $question['description']);?></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-10 col-md-offset-2 qout" id="qout1">
                   <?php echo $question['description'];?>
                </div>
                <input type="hidden" class="qhid1" name='description' value="<?php echo $question['description'];?>">
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
                    <textarea class="form-control"  onKeyUp="UpdateMath(this.value,2)" required>
                    <?php echo str_replace('$', '$$', $question['cha']);?></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-10 col-md-offset-2 qout" id="qout2">
                    <?php echo $question['cha'];?>
                </div>
                <input type="hidden" class="qhid2" name='cha' value="<?php echo $question['cha'];?>">
            </div>
            <div class="form-group">
                <div class="col-md-10 col-md-offset-2">
                    <input type="file" name="pica" accept="image/*">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-2">Option B:</label>
                <div class="col-md-10">
                    <textarea class="form-control" onKeyUp="UpdateMath(this.value,3)" required>
                    <?php echo str_replace('$', '$$', $question['chb']);?></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-10 col-md-offset-2 qout" id="qout3">
                   <?php echo $question['chb'];?> 
                </div>
                <input type="hidden" class="qhid3" name='chb' value="<?php echo $question['chb'];?>">

            </div>
            <div class="form-group">
                <div class="col-md-10 col-md-offset-2">
                    <input type="file" name="picb" accept="image/*">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-2">Option C:</label>
                <div class="col-md-10">
                    <textarea class="form-control"  onKeyUp="UpdateMath(this.value,4)" required>
                    <?php echo str_replace('$', '$$', $question['chc']);?></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-10 col-md-offset-2 qout" id="qout4">
                    <?php echo $question['chc'];?>
                </div>
                <input type="hidden" class="qhid4" name='chc' value="<?php echo $question['chc'];?>">

            </div>
            <div class="form-group">
                <div class="col-md-10 col-md-offset-2">
                    <input type="file" name="picc" accept="image/*">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-2">Option D:</label>
                <div class="col-md-10">
                    <textarea class="form-control" onKeyUp="UpdateMath(this.value,5)" required>
                    <?php echo str_replace('$', '$$', $question['chd']);?></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-10 col-md-offset-2 qout" id="qout5">
                    <?php echo $question['chd'];?>
                </div>
                <input type="hidden" class="qhid5" name='chd' value="<?php echo $question['chd'];?>">

            </div>
            <div class="form-group">
                <div class="col-md-10 col-md-offset-2">
                    <input type="file" name="picd" accept="image/*">
                </div>
            </div>
            <div class="form-group"> 
                <label class="col-md-12">Correct Answer</label>
                <?php
                    $ans_a=0;
                    $ans_b=0;
                    $ans_c=0;
                    $ans_d=0;
                    if($question['answer']=='a')
                        $ans_a=1;
                    else if($question['answer']=='b')
                        $ans_b=1;
                    else if($question['answer']=='c')
                        $ans_c=1;
                    else if($question['answer']=='d')
                        $ans_d=1;
                    else{
                        $answers=json_decode($question['answer']);
                        if(in_array('a', $answers)) $ans_a=1;
                        if(in_array('b', $answers)) $ans_b=1;
                        if(in_array('c', $answers)) $ans_c=1;
                        if(in_array('d', $answers)) $ans_d=1;
                    }
                ?>
                <div class="col-md-3">
                    <input type="checkbox" name="answera" value="a" <?php if($ans_a) echo 'checked';?>>
                    Option A
                </div>
                <div class="col-md-3">
                    <input type="checkbox" name="answerb" value="b" <?php if($ans_b) echo 'checked';?>>
                    Option B
                </div>
                <div class="col-md-3">
                    <input type="checkbox" name="answerc" value="c" <?php if($ans_c) echo 'checked';?>>
                    Option C
                </div>
                <div class="col-md-3">
                    <input type="checkbox" name="answerd" value="d" <?php if($ans_d) echo 'checked';?>>
                    Option D
                </div>
            </div>
            <div class="form-group"> 
                <label class="col-md-2">Estimated Level</label>
                <div class="col-md-10">
                    <select name="level" class="form-control" value="<?php  echo $question['level'];?>">
                        <?php
                            for ($i=1; $i < 8; $i++) { 
                                if($i==$question['level'])
                                    echo '<option selected>'.$i.'</option>';
                                else
                                    echo '<option>'.$i.'</option>';
                            }
                        ?>
                        
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
    
    <?php
        include 'footer.php';
    ?>
  <div class="subjects-modal modal fade" id="tutorial" tabindex="-1" role="dialog" aria-hidden="true">
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
                                <h2>Instruction to type Math</h2>
                                <hr class="star-primary">
                               <ul>
                                   <li>
                                       Type your question directly into the text boxes and to include math equations type inside $ \$ $ .. $ \$ $
                                       <br>
                                       For Example : Find the value of $ \$ $ (m_0)/(sqrt(1-(v^2)/(c^2))) $ \$ $ becomes $\frac{m_0}{\sqrt{1-\frac{v^2}{c^2}}}$
                                       
                                    </li>
                                    <li>You can type wide range of greek characters and all other in math equations. <br>Try writing these:
                                        <ul>
                                            <li>e^pii+1=0;  </li>
                                            <li>(kq_1 q_2)/(r^2) </li>
                                            <li>(Gm_1 m_2)/(r^2)</li>
                                            <li>nabla.E=rho/(epsilon_0)</li>
                                            <li>nabla*E= -(∂B)/(∂t)  </li>
                                            <li>nabla*B=mu_0 J+mu_0 epsilon_0(∂E)/(∂t) </li>
                                        </ul>
                                    </li>
                                    <li>
                                        If you want to write more complex mathematical expressions like integrals , matrices etc.. you can include latex formatting in your page with a '$$' at end and beginning of your latex code
                                        for example<br>
                                        <code>$$\begin{bmatrix}1&2\\3&4\\ \end{bmatrix}$$</code> will become $\begin{bmatrix}1&2\\3&4\\ \end{bmatrix} $<br>
                                        and <code>$$\sum_{i=0}^n i^2 = \frac{(n^2+n)(2n+1)}{6}$$</code> 
                                        will become $\sum_{i=0}^n i^2 = \frac{(n^2+n)(2n+1)}{6}$
                                    </li>
                                    <li>
                                        For info on typing math refer them 
                                        <ul>
                                            <li><a href="http://meta.math.stackexchange.com/questions/5020/mathjax-basic-tutorial-and-quick-reference" target="_blank">Resource 1</a></li>
                                            <li><a href="http://www.calculatorium.com/mathjax-quick-start-tutorial/" target="_blank">Resource 2</a></li>
                                            <li><a href="http://www.mathjax.org/resources/articles-and-presentations/integrating-mathjax/" target="_blank">Resource 3</a></li>
                                        </ul>
                                    </li>
                               </ul>
                               Note : To Get latex code of any of the math expression right click on the expression $\rightarrow$ select show math as $\rightarrow$ show tex commands
                           
                               
                                
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
    <script src="js/MathToTeX.js"></script>
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
        

        $("#question").submit(function(e){
            e.preventDefault();
            var subj=$('#subject').val();
            var formData = new FormData($('#question')[0]);
            var str= $('#question').serialize(),topj=$("#course").val();
            $.ajax({
                url: 'php/question-edit.php?'+str,  //Server script to process data
                type: 'POST',
                success: function(data){
                    if(data=="done"){
                        $("#question")[0].reset();
                        $('.qout').html("");
                        $('#subject').val(subj);
                        setcourse();
                        $("#course").val(topj);

                        alert("This question is edited");
                        window.close();
                    }
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

        
    </script>

</body>

</html>
