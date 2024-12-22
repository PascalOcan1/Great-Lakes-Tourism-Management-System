<!DOCTYPE HTML>
<html>
<head>
<title>TMS  | Tour-Guide List</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="applijewelleryion/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
<link href="css/font-awesome.css" rel="stylesheet">
<!-- Custom Theme files -->
<script src="js/jquery-1.12.0.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<!--animate-->
<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="js/wow.min.js"></script>
	<script>
		 new WOW().init();
	</script>
<!--//end-animate-->
</head>
<?php if($_SESSION['login'])
{?>
<div class="top-header">
	<div class="container">
		<ul class="tp-hd-lft wow fadeInLeft animated" data-wow-delay=".5s">
			<li class="hm"><a href="index.html"><i class="fa fa-home"></i></a></li>
			<li class="prnt"><a href="profile.php">My Profile</a></li>
				<li class="prnt"><a href="change-password.php">Change Password</a></li>
			<li class="prnt"><a href="tour-history.php">My Tour History</a></li>
			<li class="prnt"><a href="issuetickets.php">Issue Tickets</a></li>
		</ul>
		<ul class="tp-hd-rgt wow fadeInRight animated" data-wow-delay=".5s"> 
			<li class="tol">Welcome :</li>				
			<li class="sig"><?php echo htmlentities($_SESSION['login']);?></li> 
			<li class="sigi"><a href="logout.php" >/ Logout</a></li>
        </ul>
		<div class="clearfix"></div>
	</div>
</div><?php } else {?>
<div class="top-header" style="
	background-color: #243D8C;
	
	
	">
	<div class="container">
		<ul class="tp-hd-lft wow fadeInLeft animated" data-wow-delay=".5s">
			<li class="hm"><a href="index.php"><i class="fa fa-home"></i></a></li>
				<li class="hm"><a href="admin/index.php">Admin Login</a></li>
		</ul>
		<ul class="tp-hd-rgt wow fadeInRight animated" data-wow-delay=".5s"> 
			<li class="tol">Toll Number : 0778715187</li>				
			<li class="sig"><a href="#" data-toggle="modal" data-target="#myModal" >Sign Up</a></li> 
			<li class="sigi"><a href="#" data-toggle="modal" data-target="#myModal4" >/ Sign In</a></li>
        </ul>
		<div class="clearfix"></div>
	</div>
</div>
<?php }?>
<!--- /top-header ---->
<!--- header ---->
<div class="header">
	<div style=" 
    display: flex;
    justify-content: center;
    align-items: center;
	flex-direction: column"
	

>
		<div class="wow fadeInDown animated" data-wow-delay=".3s">
			<img src="images/TMS-logo-blue.png" alt="" width="400px" >
	
		</div>
	
		<div class="fadeInDown animated" data-wow-delay=".1s"> 
            <div style="
			color: #222;
			font-weight: 600;
			font-size: 14px;
			
			">For all your travel packages, customer bookings, and tour guides.</div>
			<div class="clearfix"></div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
<!--- /header ---->
<!--- footer-btm ---->
<div class="footer-btm wow fadeInLeft animated" data-wow-delay=".5s" style="
	background-color: #243D8C;
	">
	<div class="container" >
	<div class="navigation" >
			<nav class="navbar navbar-default" >
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header" >
				  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				  </button>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse nav-wil" id="bs-example-navbar-collapse-1" style="
	background-color: #243D8C;
">
					<nav class="cl-effect-1" style="
					display: flex;
					justify-content: center;
					align-items: center;
					flex-direction: column">

						<ul class="nav navbar-nav">
							<li><a href="index.php" style="a:hover color:#222;">Home</a></li>
							<li><a href="page.php?type=aboutus">About</a></li>

								<li><a href="page.php?type=privacy">Privacy Policy</a></li>
								<?php if($_SESSION['login'])
{?>
								<li><a href="package-list.php"> Tour Packages </a>  </li>
								<li><a href="tourguide-list.php"> Tour Guides </a>  </li>
								<?php } else { ?>
								
								<?php } ?>
								<li><a href="page.php?type=terms">Terms of Use</a></li>
								<li><a href="page.php?type=contact">Contact Us</a></li>
								<?php if($_SESSION['login'])
{?>
								<li>Need Help?<a href="#" data-toggle="modal" data-target="#myModal3"> / Write Us </a>  </li>
		
								<?php } else { ?>
								<li><a href="enquiry.php"> Enquiry </a>  </li>
								<?php } ?>
								<div class="clearfix"></div>

						</ul>
					</nav>
				</div><!-- /.navbar-collapse -->	
			</nav>
		</div>
		
		<div class="clearfix"></div>
	</div>
</div>