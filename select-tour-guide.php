<?php
session_start();
include('includes/config.php');

if (!isset($_SESSION['login'])) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit();
}

// Fetch available tour guides from the database
$sql = "SELECT GuideId, GuideName, GuideExperience, GuideLanguages, GuideDescription, GuideImage, GuidePrice FROM tbltourguides";
$query = $dbh->prepare($sql);
$query->execute();
$tourGuides = $query->fetchAll(PDO::FETCH_OBJ);

if (isset($_POST['submit'])) {
    // Get package ID and user email from session or URL parameters
    $pid = $_GET['pkgid'] ?? null;
    $useremail = $_SESSION['login'] ?? null;
    
    if (!$pid || !$useremail) {
        echo "Missing required booking information";
        exit();
    }
   
    $selectedGuide = $_POST['tour_guide'];
    $fromDate = $_POST['from_date'];
    $toDate = $_POST['to_date'];

    // Insert booking details into the database
    $sqlInsert = "INSERT INTO tblbooking (PackageId, GuideId, UserEmail, FromDate, ToDate, GuidePrice) 
                  SELECT :pid, :guideid, :email, :from_date, :to_date, GuidePrice 
                  FROM tbltourguides WHERE GuideId = :guideid";
    $queryInsert = $dbh->prepare($sqlInsert);
    $queryInsert->bindParam(':pid', $pid, PDO::PARAM_INT);
    $queryInsert->bindParam(':guideid', $selectedGuide, PDO::PARAM_INT);
    $queryInsert->bindParam(':email', $useremail, PDO::PARAM_STR);
    $queryInsert->bindParam(':from_date', $fromDate, PDO::PARAM_STR);
    $queryInsert->bindParam(':to_date', $toDate, PDO::PARAM_STR);
    
    if ($queryInsert->execute()) {
        // Redirect to a confirmation page or display a success message
        header("Location: booking-success.php");
        exit();
    } else {
        // Handle error (optional)
        echo "Error in booking. Please try again.";
    }
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Select Tour Guide</title>
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
    <link href="css/style.css" rel='stylesheet' type='text/css' />
</head>
<body>
    <?php include('includes/header.php'); ?>
    <div class="container">
        <h2>Select a Tour Guide</h2>
        <form method="post">
            <div class="form-group">
                <label for="tour_guide">Choose a Tour Guide:</label>
                <select name="tour_guide" id="tour_guide" class="form-control" required>
                    <option value="">Select a guide</option>
                    <?php foreach ($tourGuides as $guide) { ?>
                        <option value="<?php echo htmlentities($guide->GuideId); ?>">
                            <?php echo htmlentities($guide->GuideName); ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
        


            <div class="form-group">
                <label for="from_date">From Date:</label>
                <input type="date" name="from_date" id="from_date" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="to_date">To Date:</label>
                <input type="date" name="to_date" id="to_date" class="form-control" required>
            </div>
            <div class="text-right">
                <button type="submit" name="submit" class="btn btn-primary">Proceed to Book</button>
            </div>
        </form>
    </div>
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
										echo substr($description, 0, 50) . '...';
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





    <?php include('includes/footer.php'); ?>
</body>
</html>