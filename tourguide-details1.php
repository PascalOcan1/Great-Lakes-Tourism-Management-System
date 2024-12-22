<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('includes/config.php');

if(!isset($_GET['guideid']) || empty($_GET['guideid'])) {
    header('location: select-tour-guide.php');
    exit();
}

$guideid = intval($_GET['guideid']);
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>TMS | Tour Guide Details</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <link href="css/font-awesome.css" rel="stylesheet">
</head>

<body>
<?php include('includes/header.php');?>
<div class="banner-3">
    <div class="container">
        <h1 class="wow zoomIn animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: zoomIn;"> TMS - Tour Guide Details</h1>
    </div>
</div>

<div class="selectroom">
    <div class="container">    
        <?php 
        $sql = "SELECT * FROM tbltourguides WHERE GuideId = :guideid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':guideid', $guideid, PDO::PARAM_INT);
        
        try {
            $query->execute();
            
            if($query->rowCount() > 0) {
                $result = $query->fetch(PDO::FETCH_OBJ);
                ?>
                <div class="guide-detail-card wow fadeInUp animated" data-wow-delay=".5s">
                    <div class="guide-image-container">
                        <?php 
                        $guideImage = !empty($result->GuideImage) ? htmlentities($result->GuideImage) : 'default.jpg';
                        ?>
                        <img src="admin/guideimages/<?php echo $guideImage; ?>" class="img-responsive" alt="Guide Image">
                    </div>
                    
                    <div class="guide-info-container">
                        <div class="guide-header" style="text-align:center;">
                            <h2><?php echo !empty($result->GuideName) ? htmlentities($result->GuideName) : 'Name Not Available'; ?></h2>
                            <span class="guide-id">#GUIDE-<?php echo !empty($result->GuideId) ? htmlentities($result->GuideId) : $guideid; ?></span>
                        </div>
                        
                        <div class="guide-stats">
                            <div class="stat-item">
                                <i class="fa fa-clock-o"></i>
                                <span class="stat-label">Experience</span>
                                <span class="stat-value">
                                    <?php echo !empty($result->GuideExperience) ? htmlentities($result->GuideExperience) : '0'; ?> years
                                </span>
                            </div>
                            <div class="stat-item">
                                <i class="fa fa-language"></i>
                                <span class="stat-label">Languages</span>
                                <span class="stat-value">
                                    <?php echo !empty($result->GuideLanguages) ? htmlentities($result->GuideLanguages) : 'Not Specified'; ?>
                                </span>
                            </div>
                            <?php if(!empty($result->GuideContact)): ?>
                            <div class="stat-item">
                                <i class="fa fa-phone"></i>
                                <span class="stat-label">Contact</span>
                                <span class="stat-value">
                                    <?php echo htmlentities($result->GuideContact); ?>
                                </span>
                            </div>
                            <?php endif; ?>
                            <div class="stat-item">
                                <i class="fa fa-dollar"></i>
                                <span class="stat-label">Price Per Day</span>
                                <span class="stat-value">
                                    $<?php echo !empty($result->GuidePrice) ? htmlentities($result->GuidePrice) : '0'; ?>
                                </span>
                            </div>
                        </div>

                        <div class="guide-description2">
                            <h3>About the Guide</h3>
                            <p>
                                <?php echo !empty($result->GuideDescription) ? 
                                    htmlentities($result->GuideDescription) : 
                                    'No description available.'; ?>
                            </p>
                        </div>

                
                    </div>
                </div>
                <?php
            } else {
                echo "<div class='alert alert-warning'>No guide found with this ID.</div>";
            }
        } catch(PDOException $e) {
            echo "<div class='alert alert-danger'>Database error: " . $e->getMessage() . "</div>";
        }
        ?>

        <div class="clearfix"></div>
        <a href="tourguide-list.php" class="btn btn-primary">Back to Guide List</a>
    </div>
</div>

<style>
.guide-detail-card {
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    margin-bottom: 30px;
}

.guide-image-container {
    text-align: center;
    margin-bottom: 20px;
}

.guide-image-container img {
    max-width: 300px;
    border-radius: 8px;
	margin: 0 auto;
}

.guide-header {
    margin-bottom: 20px;
	margin-left: 200px
	margin: 0 auto;


}

.guide-header h2 {
    margin: 0;
    color: #333;
	margin: 0 auto;
}

.guide-id {
    color: #666;
    font-size: 0.9em;
}

.guide-stats {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    margin-bottom: 20px;
}

.stat-item {
    flex: 1;
    min-width: 200px;
    padding: 15px;
    background: #f8f9fa;
    border-radius: 6px;
}

.stat-item i {
    color: #007bff;
    margin-right: 10px;
}

.stat-label {
    display: block;
    color: #666;
    font-size: 0.9em;
}

.stat-value {
    display: block;
    font-size: 1.1em;
    font-weight: bold;
    color: #333;
}

.guide-description2 {
    margin: 20px 0;
    padding: 20px;
    background: #f8f9fa;
    border-radius: 6px;
}

.guide-description2 h3 {
    color: #333;
    margin-bottom: 10px;
}

.guide-booking {
    margin-top: 20px;
    text-align: center;
}

.alert {
    margin: 20px 0;
    padding: 15px;
    border-radius: 4px;
}

.alert-warning {
    background-color: #fff3cd;
    border-color: #ffeeba;
    color: #856404;
}

.alert-danger {
    background-color: #f8d7da;
    border-color: #f5c6cb;
    color: #721c24;
}
</style>

<?php include('includes/footer.php');?>
<!-- signup -->
<?php include('includes/signup.php');?>            
<!-- signin -->
<?php include('includes/signin.php');?>            

<script src="js/jquery-2.1.4.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>