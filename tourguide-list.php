<?php
session_start();
error_reporting(0);
include('includes/config.php');
?>
<!DOCTYPE HTML>
	<script>
		 new WOW().init();
	</script>
<!--//end-animate-->
</head>
<body>
<?php include('includes/header.php');?>
<!--- banner ---->
<div class="banner-3">
	<div style="
					background: url(images/carousel-1-elephants.jpg)no-repeat;
				background-size: cover;
				-webkit-background-size: cover;
				-o-background-size: cover;
				-ms-background-size: cover;
				-moz-background-size: cover;
				min-height: 230px;
				background-position-y: top;
				
				"
	>
		<h1 class="wow zoomIn animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: zoomIn; font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;"> Great Lakes TMS - Tour Guide List</h1>
	</div>
</div>
<!--- /banner ---->
<!--- rooms ---->
<div class="rooms">
	<div class="container">
		<div class="room-bottom">
			<h3 style="color: #243D8C;">Tour Guide List</h3>
			
			<div class="row">
				<?php 
				$sql = "SELECT * from tbltourguides";
				$query = $dbh->prepare($sql);
				$query->execute();
				$results=$query->fetchAll(PDO::FETCH_OBJ);
				if($query->rowCount() > 0)
				{
					foreach($results as $result)
					{	
				?>
					<div class="col-md-3 col-sm-6 mb-4">
						<div class="guide-card">
							<div class="guide-img">
								<img src="admin/guideimages/<?php echo htmlentities($result->GuideImage);?>" class="img-responsive" alt="">
							</div>
							<div class="guide-info">
								<h4 style="color: #243D8C;"><?php echo htmlentities($result->GuideName);?></h4>
								<p><b>Experience:</b> <?php echo htmlentities($result->GuideExperience);?> years</p>
								<p><b>Languages:</b> <?php echo htmlentities($result->GuideLanguages);?></p>
								<p class="guide-description"><b>Profile:</b> 
									<?php 
										$description = htmlentities($result->GuideDescription);
										echo substr($description, 0, 30) . '...';
									?>
								</p>
								<div class="guide-buttons">
									<a href="tourguide-details1.php?guideid=<?php echo htmlentities($result->GuideId);?>" 
									   class="btn btn-info">View Profile</a>
							
								</div>
							</div>
						</div>
					</div>
				<?php }} ?>
			</div>
			
		</div>
	</div>
</div>
<!--- /rooms ---->

<!--- /footer-top ---->
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