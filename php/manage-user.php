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

    $admin=1;


?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="Shezartech e-learning">
    <meta name="author" content="Shezartech e-learning">

    <title>IITJEE Academy | Manage Users</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="css/shezarelearning.css" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" href="http://shezartech.com/SZ/wp-content/uploads/2013/09/logo_1.png">

    <!-- Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.2/css/jquery.dataTables.css">
    <style type="text/css">
    #courses .courses-item .courses-link .caption .caption-content {
        top: 20%;
    }
    .form-group{
        margin-top: 10px;
        overflow: auto;
    }
         body{
            padding-top: 120px;
         }

    </style>
     <script type="text/javascript" src="js/mathjax/MathJax.js?config=TeX-AMS_HTML-full">
    </script>
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
                    <?
                        if($admin==1){
                            ?>
                                <li class="page-scroll">
                                    <li class="dropdown">
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                        Admin <span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a href="manage-user.php">Manage Users</a></li>
                                        </ul>
                                    </li>
                                    
                                </li>

                            <?

                        }
                    ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

<!-- Begin Body -->
    <div class="container" style="text-align:center">
        <h2>Manage Users</h2>
        <hr class="star-primary">
        <button class="btn btn-lg btn-success" data-toggle="modal" data-target="#login-modal">Create new user</button>
        <table class="table table-condensed table-striped table-bordered" id="user-table">
            <thead>
                <tr>
                    <td>Sl no</td>
                    <td>Name</td>
                    <td>Role</td>
                    <td>Action</td>
                </tr>
            </thead>
            <?php
                $q=mysqli_query($con,'select * from user where uid != '.$data['uid']);
                $i=0;
                while($row=mysqli_fetch_assoc($q)){
                    $i++;
                    switch ($row['admin']) {
                        case '1':
                            $str='<option value="0">Student</option>
                                <option value="2">Tutor</option>
                                <option value="1" selected>Admin</option>';
                            break;
                        case '2':
                             $str='<option value="0">Student</option>
                                <option value="2"  selected>Tutor</option>
                                <option value="1">Admin</option>';
                            break;
                        default:
                             $str='<option value="0"  selected>Student</option>
                                <option value="2">Tutor</option>
                                <option value="1">Admin</option>';
                            break;
                    }
                    echo '<tr>
                        <td>'.$i.'</td>
                        <td>'.$row['Name'].'</td>
                        <td>
                            <select class="form-control" onchange="changerole(this.value,'.$row['uid'].')">
                               '.$str.'
                            </select>
                        </td>
                        <td>
                            <button class="btn btn-danger" title="Delete this user" onclick="delete_user('.$row['uid'].',\''.$row['Name'].'\')"><i class="fa fa-trash-o fa-lg"></i></button>
                        </td>

                    </tr>';
                }

            ?>
            
        </table>
           
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
    <script type="text/javascript" src="//cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
    <script src="js/cbpAnimatedHeader.js"></script>
    <script src="js/shezarelearning.js"></script>
    <script type="text/javascript">
    function changerole (role,id) {
        jQuery.ajax({
            url:'php/modify-user.php',
            type:'post',
            data:{id:id,role:role,action:'role'},
             success:function(data){
                if(data=='done')
                location.reload();
                else
                {
                    alert('Error');
                    console.log(data);
                }
            },
            error:function(){
                alert('Error in saving. Check your connection');
            }
        })
    }

    function delete_user (id,name) {
        if(confirm("Are you sure want to remove "+name)){
            jQuery.ajax({
            url:'php/modify-user.php',
            type:'post',
            data:{id:id,action:'delete'},
            success:function(data){
                if(data=='done')
                location.reload();
                else
                {
                    alert('Error');
                    console.log(data);
                }
            },
            error:function(){
                alert('Error in deletion. Check your connection');
            }
        })
        }
    }
    $('#user-table').dataTable( {
        "pagingType": "full_numbers"
    } );
    </script>

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
                                <h2>Create a new user</h2>
                                <hr class="star-primary">
                                <p>
                                    Note : All fields are compulsory
                                </p>
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
                                <br>
                                <br>
                                <div class="well" id="message"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<script type="text/javascript">
    $("#register-form").submit(function(e) {
    e.preventDefault();
    jQuery.ajax({
        url:"./php/register.php",
        type:"POST",
        data:$(this).serialize(),
        success:function(data){
            $("#register-form div:nth-child(1)").removeClass('has-error');
            $("#register-form div:nth-child(2)").removeClass('has-error');
            $("#register-form div:nth-child(3)").removeClass('has-error');
            $("#register-form div:nth-child(4)").removeClass('has-error');
            if(data=='emailerr'){
                $("#message").html("User already present");
                    $("#register-form div:nth-child(2)").addClass('has-error');
            }
            else if(data=='passnotmatch'){
                $("#message").html("Password didn't matched");
                $("#register-form div:nth-child(4)").addClass('has-error');
                $("#register-form div:nth-child(3)").addClass('has-error');
            }
            else if(data=='passworderr'){
                $("#message").html("Password should be of atleast 8 characters");
                $("#register-form div:nth-child(4)").addClass('has-error');
                $("#register-form div:nth-child(3)").addClass('has-error');
            }
            else if(data=='done'){
                $("#register-form")[0].reset();
                $("#message").html("User been successfully registered.. Please send him mail containing password");
            }
        },
        error:function(){
            alert("Network Error");
        }
    })
});
</script>


</body>

</html>
