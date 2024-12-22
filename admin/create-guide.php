<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
{   
    header('location:index.php');
}
else{
if(isset($_POST['submit']))
{
    $gname=$_POST['guidename'];
    $gexperience=$_POST['guideexperience'];    
    $glanguages=$_POST['guidelanguages'];
    $gcontact=$_POST['guidecontact'];    
    $gdescription=$_POST['guidedescription'];
    $gimage=$_FILES["guideimage"]["name"];
    move_uploaded_file($_FILES["guideimage"]["tmp_name"],"guideimages/".$_FILES["guideimage"]["name"]);
    
    $sql="INSERT INTO tbltourguides(GuideName,GuideExperience,GuideLanguages,GuideContact,GuideImage,GuideDescription) VALUES(:gname,:gexperience,:glanguages,:gcontact,:gimage,:gdescription)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':gname',$gname,PDO::PARAM_STR);
    $query->bindParam(':gexperience',$gexperience,PDO::PARAM_INT);
    $query->bindParam(':glanguages',$glanguages,PDO::PARAM_STR);
    $query->bindParam(':gcontact',$gcontact,PDO::PARAM_STR);
    $query->bindParam(':gimage',$gimage,PDO::PARAM_STR);
    $query->bindParam(':gdescription',$gdescription,PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    if($lastInsertId)
    {
        $msg="Guide Created Successfully";
    }
    else 
    {
        $error="Something went wrong. Please try again";
    }
}
?>

<!-- ... header HTML code remains same as create-package.php ... -->
<!DOCTYPE HTML>
<html>
<head>
<title>TMS | Admin Package Creation</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Pooled Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="css/morris.css" type="text/css"/>
<link href="css/font-awesome.css" rel="stylesheet"> 
<script src="js/jquery-2.1.4.min.js"></script>
<link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'/>
<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
  <style>
		.errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
		</style>

</head> 
<body>
   <div class="page-container">
   <!--/content-inner-->
<div class="left-content">
	   <div class="mother-grid-inner">
              <!--header start here-->
<?php include('includes/header.php');?>
							
				     <div class="clearfix"> </div>	
				</div>
<!--heder end here-->
	<ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a><i class="fa fa-angle-right"></i>Create Tour Guide </li>
            </ol>
		<!--grid-->
 	<div class="grid-form">
    <div class="grid-form1">
        <h3>Create Guide</h3>
        <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
        else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
        <div class="tab-content">
            <div class="tab-pane active" id="horizontal-form">
                <form class="form-horizontal" name="guide" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="focusedinput" class="col-sm-2 control-label">Guide Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control1" name="guidename" id="guidename" placeholder="Guide Full Name" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="focusedinput" class="col-sm-2 control-label">Years of Experience</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control1" name="guideexperience" id="guideexperience" placeholder="Years of Experience" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="focusedinput" class="col-sm-2 control-label">Languages Spoken</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control1" name="guidelanguages" id="guidelanguages" placeholder="Languages (comma separated)" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="focusedinput" class="col-sm-2 control-label">Contact Number</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control1" name="guidecontact" id="guidecontact" placeholder="Contact Number" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="focusedinput" class="col-sm-2 control-label">Guide Description</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" rows="5" cols="50" name="guidedescription" id="guidedescription" placeholder="Guide Description and Specializations" required></textarea> 
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="focusedinput" class="col-sm-2 control-label">Guide Image</label>
                        <div class="col-sm-8">
                            <input type="file" name="guideimage" id="guideimage" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2">
                            <button type="submit" name="submit" class="btn-primary btn">Create</button>
                            <button type="reset" class="btn-inverse btn">Reset</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- ... footer HTML code remains same as create-package.php ... -->


<!-- script-for sticky-nav -->
<script>
		$(document).ready(function() {
			 var navoffeset=$(".header-main").offset().top;
			 $(window).scroll(function(){
				var scrollpos=$(window).scrollTop(); 
				if(scrollpos >=navoffeset){
					$(".header-main").addClass("fixed");
				}else{
					$(".header-main").removeClass("fixed");
				}
			 });
			 
		});
		</script>
		<!-- /script-for sticky-nav -->
<!--inner block start here-->
<div class="inner-block">

</div>
<!--inner block end here-->
<!--copy rights start here-->
<?php include('includes/footer.php');?>
<!--COPY rights end here-->
</div>
</div>
  <!--//content-inner-->
		<!--/sidebar-menu-->
					<?php include('includes/sidebarmenu.php');?>
							  <div class="clearfix"></div>		
							</div>
							<script>
							var toggle = true;
										
							$(".sidebar-icon").click(function() {                
							  if (toggle)
							  {
								$(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
								$("#menu span").css({"position":"absolute"});
							  }
							  else
							  {
								$(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
								setTimeout(function() {
								  $("#menu span").css({"position":"relative"});
								}, 400);
							  }
											
											toggle = !toggle;
										});
							</script>
<!--js -->
<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>
<!-- Bootstrap Core JavaScript -->
   <script src="js/bootstrap.min.js"></script>
   <!-- /Bootstrap Core JavaScript -->	   

</body>
</html>
<?php } ?> 