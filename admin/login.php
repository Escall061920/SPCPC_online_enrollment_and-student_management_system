<?php

require_once("../include/initialize.php");

 ?>
  <?php
 if (isset($_SESSION['ACCOUNT_ID'])){
      redirect(web_root."admin/index.php");
     } 
  ?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<title>SPCPC | LOGIN</title>

<!-- Bootstrap core CSS -->
<link href="<?php echo web_root; ?>css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo web_root; ?>css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
<link href="<?php echo web_root; ?>css/dataTables.bootstrap.css" rel="stylesheet" media="screen">
<link rel="stylesheet" type="text/css" href="<?php echo web_root; ?>css/jquery.dataTables.css"> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link href="<?php echo web_root; ?>css/bootstrap.css" rel="stylesheet" media="screen">

<link href="<?php echo web_root; ?>fonts/font-awesome.min.css" rel="stylesheet" media="screen">
<!-- Plugins -->
<script type="text/javascript" language="javascript" src="<?php echo web_root; ?>js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo web_root; ?>js/jquery.dataTables.js"></script>
<!-- <script type="text/javascript" language="javascript" src="<?php echo web_root; ?>js/fixnmix.js"></script> / -->


<style>
@CHARSET "UTF-8";
/*
over-ride "Weak" message, show font in dark grey
*/

.progress-bar {
    color: #333;
} 

/*
Reference:
http://www.bootstrapzen.com/item/135/simple-login-form-logo/
*/

* {
    -webkit-box-sizing: border-box;
     -moz-box-sizing: border-box;
          box-sizing: border-box;
  outline: none;
}

    .form-control {
    position: relative;
    font-size: 16px;
    height: auto;
    padding: 10px;
    @include box-sizing(border-box);

    &:focus {
      z-index: 2;
    }
  }

body {
  background-color: #098744;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
}

.login-form {
  margin-top: 150px;
}

form[role=login] {
  color: #5d5d5d;
  background: #accbb2;
  padding: 26px;
  border-radius: 10px;
  -moz-border-radius: 10px;
  -webkit-border-radius: 10px;
}
  form[role=login] img {
    display: block;
    margin: 0 auto;
    margin-bottom: 35px;
    height: 90px;
   border-radius: 100%;
  }
  form[role=login] input,
  form[role=login] button {
    font-size: 18px;
    margin: 16px 0;
  }
  form[role=login] > div {
    text-align: center;
  }
  
.form-links {
  text-align: center;
  margin-top: 1em;
  margin-bottom: 50px;
}
  .form-links a {
    color: #fff;
  }

.error-message {
  color: #dc3545;
  text-align: center;
  margin-bottom: 15px;
  font-size: 14px;
}
 
</style>
 
<body>


<div class="container">
  
  <div class="row" id="pwd-container">
    <div class="col-md-4"></div>
    
    <div class="col-md-4">

      <section class="login-form">
        <?php echo check_message(); ?>
        <form method="post" action="" role="login">
          <!-- <img src="http://i.imgur.com/RcmcLv4.png" class="img-responsive" alt="" /> -->
           <img src="../img/SPCPC.ico" height="25px" class="img-responsive" alt="" />
         
          <input type="input" name="user_email" placeholder="Username" required class="form-control input-lg" value="" />
          
          <div style="position: relative; max-width: 400px; margin: 20px auto;">
    <input type="password" name="user_pass" class="form-control input-lg" id="password" placeholder="Password" required style="padding-right: 40px;" />
    <i class="fas fa-eye" id="eye-icon" onclick="togglePasswordVisibility()" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer; z-index: 2;"></i>
</div>
         
           
          
          
          <div class="pwstrength_viewport_progress"></div>
          
          <?php
          if(isset($_POST['btnLogin'])) {
            if(!empty($_POST['user_email']) && !empty($_POST['user_pass'])) {
              $user = new User();
              $email = trim($_POST['user_email']);
              $upass = trim($_POST['user_pass']);
              $h_upass = sha1($upass);
              
              // Check if user exists in database
              $sql = "SELECT * FROM useraccounts WHERE ACCOUNT_USERNAME = '$email'";
              $mydb->setQuery($sql);
              $result = $mydb->loadSingleResult();
              
              if(!$result) {
                echo '<div class="error-message">Account does not exist. Please check your username.</div>';
              } else {
                $res = $user::userAuthentication($email, $h_upass);
                if(!$res) {
                  echo '<div class="error-message">Invalid password. Please try again.</div>';
                }
              }
            }
          }
          ?>
          
          <button type="submit" name="btnLogin" class="btn btn-lg btn-primary btn-block">Sign in</button>
          <div class="form-links" style="text-align: center;">
    <a href="http://localhost/onlineenrolmentsystem/" style="font-size: 16px; text-decoration:  font-weight: bold; color: #098744; text-align: center; margin-top: 10px;">Back to Homepage</a>
</div>

          <!-- <div>
            <a href="#">Create account</a> or <a href="#">reset password</a>
          </div>
           -->
        </form>
        
        <div class="form-links">
          <!-- <a href="#">www.website.com</a> -->
        </div>
      </section>  
      </div>
      
      <div class="col-md-4"></div>
      

  </div>
  
     
  
  
</div>
   
<script>
       function togglePasswordVisibility() {
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eye-icon');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.classList.remove('fa-eye');
            eyeIcon.classList.add('fa-eye-slash'); // Change icon to indicate password is visible
        } else {
            passwordInput.type = 'password';
            eyeIcon.classList.remove('fa-eye-slash');
            eyeIcon.classList.add('fa-eye'); // Change back to eye icon
        }
    }
</script>
</body>

 <?php 

if(isset($_POST['btnLogin'])){
  $email = trim($_POST['user_email']);
  $upass  = trim($_POST['user_pass']);
  $h_upass = sha1($upass);
  
   if ($email == '' OR $upass == '') {

      message("Invalid Username and Password!", "error");
      redirect("login.php");
         
    } else {  
  //it creates a new objects of member
    $user = new User();
    
    // Check if user exists first
    $sql = "SELECT * FROM useraccounts WHERE ACCOUNT_USERNAME = '$email'";
    $mydb->setQuery($sql);
    $result = $mydb->loadSingleResult();
    
    if(!$result) {
      message("Account does not exist. Please check your username.", "error");
      redirect(web_root."admin/login.php");
    } else {
      //make use of the static function, and we passed to parameters
      $res = $user::userAuthentication($email, $h_upass);
      if ($res==true) { 
         message("You logon as ".$_SESSION['ACCOUNT_TYPE'].".","success");
         
         $sql="INSERT INTO `tbllogs` (`USERID`, `LOGDATETIME`, `LOGROLE`, `LOGMODE`) 
            VALUES (".$_SESSION['ACCOUNT_ID'].",'".date('Y-m-d H:i:s')."','".$_SESSION['ACCOUNT_TYPE']."','Logged in')";
            $mydb->setQuery($sql);
            $mydb->executeQuery();

        if ($_SESSION['ACCOUNT_TYPE']=='Administrator'){ 
           redirect(web_root."admin/index.php");
        }elseif($_SESSION['ACCOUNT_TYPE']=='Registrar'){
            redirect(web_root."admin/index.php");

        }else{
             redirect(web_root."admin/login.php");
        }
      }else{
        message("Invalid password. Please try again.", "error");
        redirect(web_root."admin/login.php"); 
      }
    }
 }
 } 
 ?> 
</head>
</html>