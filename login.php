<?php
  session_start();
  include_once('functions.php');

$nameErr = $passErr = "";
$username = $password  = "";

  if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    if(empty($username) & empty($password)){
      $nameErr = "Username is required";
      $passErr = "Password is required";
    }elseif(!$username) {
      $nameErr = "Username is required";
    }elseif (!preg_match("/^[a-zA-Z ]*$/",$username)) {
      $nameErr = "Only letters and white space allowed";
    }elseif(empty($password)) {
      $passErr = "Password is required";
    }else{
      login($username, $password);
  }
}



?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> KENYA MRS </title>

    <!-- Bootstrap Core CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <!-- Custom CSS -->
    <!-- <link href="bootstrap/css/small-business.css" rel="stylesheet"> -->
          <script src="jquery-1.9.0.min.js"></script>
             <script src="jquery.js"></script>
              <script src="jquery.validate.js"></script>
	           <script src="ckeditor/ckeditor.js"></script>
			

</head>
<body style="background-image:url(1.jpg);">
    <div class="navbar navbar-default navbar-static-top navbar navbar-inverse header" role="navigation">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header container-fluid">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
       
      </div></div>
<div class="col-md-4"></div>
<div class='container .centre'>
<div class="col-lg-4" style="padding-left: 0; padding-right: 0;" >
  <?php echo errors(); echo messages(); ?>
<div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title">Staff Portal </h3>
          </div>
          <!-- <img class="img-circle img-responsive centre" src="2.jpg" width="50px" />  -->
            <div  class="panel-body">
          <fieldset>
              <!-- <legend>User details</legend> -->
                <?php echo errors(); echo messages(); ?>
                <form class="form-horizonta" autocomplete="off" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"  method="post">
                <div class="form-group">
                <label class="control-label"><span class="required">*</span>Username:</label>
                <input name="username"  class="form-control" placeholder=" Username " type="text" value="<?php echo $username; ?>">
                <span class="required"><?php echo $nameErr ;?></span>
                </div>

                <div class="form-group">
                <label><span class="required">*</span> Password :</label>
                <input name="password" class="form-control" placeholder="**********" type="password" value="<?php echo $password; ?>">
                <span class="required"><?php echo $passErr;?> </span>
                <br />
                </div>

                <div class="form-group">
                  <div class="col-lg-5 col-lg-offset-4">
                <input name="submit" class="btn btn-primary btn-lg" type="submit" value=" Login ">
                </div>
                </div>
            </fieldset>    
                </form>
        </div>
      </div>
</div>
</div>



    <footer class="navbar navbar-default navbar-fixed-bottom">
      <div class="navbar navbar-inverse footer">
        <div class="container-fluid">
          <div class="copyright">
            <a href="www.maseno.ac.ke" target="_blank">&copy; Kenya MRS <?php echo date("Y"); ?></a> All rights reserved
          </div>
        </div>
      </div>
    </footer>


    <!-- /.container -->

    <!-- jQuery -->
    <script src="bootstrap/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="bootstrap/js/bootstrap.min.js"></script>

</body>

</html>
    </div>