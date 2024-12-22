<?php
session_start();
error_reporting(0);
include('includes/config.php');
?>
<!DOCTYPE HTML>
<html>

<body>
<?php include('includes/header.php');?>
        <!-- Banner Start -->
        <div >
            <div>
                <div 
				style="
				background: url(images/carousel-4-vacation.jpg)no-repeat;
				background-size: cover;
				-webkit-background-size: cover;
				-o-background-size: cover;
				-ms-background-size: cover;
				-moz-background-size: cover;
				min-height: 530px;
				background-position-y: bottom;
				
				">


                </div>
				<div class="carousel-caption">
                            <div class="p-3" style="max-width: 900px;">
                              
                                <h1 class="display-2 text-capitalize text-white mb-4" style="
								font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
								font-size:70px;
								
								
								"> Meet your Next vacation</h1>
                                <div class="col-md-12">
                                    <h2 style="
									color: #4679F9; 
									font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
									margin-bottom: 30px;">Travel Packages, <span style="font-weight: 500; color:white;">tailored specifically for </span>you.</h2>

                    
                                <div class="d-flex align-items-center justify-content-center">
                                    <a class="btn-hover-bg btn btn-primary rounded-pill text-white py-3 px-5" href="#">Discover Now</a>
                                </div>
                            </div>
                        </div>

                    

            </div>
        </div>
        <!-- Banner End -->


<?php include('includes/footer.php');?>
<!-- signup -->
<?php include('includes/signup.php');?>			
<!-- //signu -->
<!-- signin -->
<?php include('includes/signin.php');?>			
<!-- //signin -->
<!-- write us -->
<?php include('includes/write-us.php');?>			
<!-- //write us -->
</body>
</html>