<?php session_start();
  require_once('functions.php');
  require_once 'config.php';
?>
<?php

global $connection;
global $errors;

$query = "SELECT * FROM staff WHERE username='{$_SESSION['username']}' ";
$staff = mysqli_fetch_assoc(mysqli_query($connection, $query));

if(isset($_POST['submit'])){

$password = trim($_POST['password']);

if (!$password){
  $_SESSION['msg'] = "No password Entered please open the lock and try again";
}

  if (md5($password) == $staff['password']){
    $level = $staff['level'];
    redirect_session($level);
  }else{
    $_SESSION['msg'] = "Username and password does not match";
  }

}


 ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>KENYA MRS</title>

    <!-- Bootstrap core CSS -->
    <link href="admin/assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="admin/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="admin/assets/css/style.css" rel="stylesheet">
    <link href="admin/assets/css/style-responsive.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body onload="getTime()">

      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->

	  	<div class="container">

	  		<div id="showtime"></div>

          <div class="centered">
            <?php echo msgs(); ?>
          </div>


	  			<div class="col-lg-4 col-lg-offset-4">
	  				<div class="lock-screen">
		  				<h2><a data-toggle="modal" href="#myModal"><i class="fa fa-lock"></i></a></h2>
		  				<p>UNLOCK</p>

				          <!-- Modal -->
				          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
				              <div class="modal-dialog">
				                  <div class="modal-content">
				                      <div class="modal-header">
				                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                          <h4 class="modal-title"> Welcome Back <?php echo ucwords($_SESSION['fname'].' '.$_SESSION['lname']); ?></h4>
				                      </div>
				                      <div class="modal-body">
				                          <p class="centered">

                                    <?php if ($staff["profile_image"] == null ){ ?>
                                         <img  src="profile_image/no_avatar.png" class="img-circle" alt="profile pick" width="80px" height="80px" >
                                      <?php }else{ ?>
                                         <a href="profile_image/staff/<?php echo $staff['profile_image']?>" target="_blank"><img  src="profile_image/staff/<?php echo $staff['profile_image']?>" class="img-circle" alt="" width="80" height="80" ></a>
                                     <?php } ?>

                                  </p>
                                  <form class="form horizontal" action="lock_screen.php" method="post">
                                    <input type="password" name="password" placeholder="Password" autocomplete="off" class="form-control placeholder-no-fix">



				                      </div>
				                      <div class="modal-footer centered">
				                          <button data-dismiss="modal" class="btn btn-theme04" type="button">Cancel</button>
				                          <input class="btn btn-theme03" type="submit" value="Login Back" name="submit" >
				                      </div>
                              </form>

				                  </div>
				              </div>
				          </div>
				          <!-- modal -->


	  				</div>
            <! --/lock-screen -->
	  			</div><!-- /col-lg-4 -->

	  	</div><!-- /container -->

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="admin/assets/js/jquery.js"></script>
    <script src="admin/assets/js/bootstrap.min.js"></script>

    <!--BACKSTRETCH-->
    <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
    <script type="text/javascript" src="admin/assets/js/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("admin/assets/img/login-bg.jpg", {speed: 500});
    </script>

    <script>
        function getTime()
        {
            var today=new Date();
            var h=today.getHours();
            var m=today.getMinutes();
            var s=today.getSeconds();
            // add a zero in front of numbers<10
            m=checkTime(m);
            s=checkTime(s);
            document.getElementById('showtime').innerHTML=h+":"+m+":"+s;
            t=setTimeout(function(){getTime()},500);
        }

        function checkTime(i)
        {
            if (i<10)
            {
                i="0" + i;
            }
            return i;
        }
    </script>

  </body>
</html>
