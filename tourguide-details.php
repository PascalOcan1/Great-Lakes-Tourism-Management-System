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
    <script src="js/jquery-2.1.4.min.js"></script>
</head>

<body>
<?php include('includes/header.php');?>
<div class="banner-3">
    <div class="container">
        <h1 class="wow zoomIn animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: zoomIn;">TMS - Tour Guide Details</h1>
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
                
                // Safe getters for guide properties with default values
                $guideName = !empty($result->GuideName) ? $result->GuideName : 'Name Not Available';
                $guideId = !empty($result->GuideId) ? $result->GuideId : $guideid;
                $guideExperience = !empty($result->GuideExperience) ? $result->GuideExperience : '0';
                $guideLanguages = !empty($result->GuideLanguages) ? $result->GuideLanguages : 'Not Specified';
                $guideContact = !empty($result->GuideContact) ? $result->GuideContact : '';
                $guidePrice = !empty($result->GuidePrice) ? $result->GuidePrice : '0';
                $guideDescription = !empty($result->GuideDescription) ? $result->GuideDescription : 'No description available';
                $guideImage = !empty($result->GuideImage) ? $result->GuideImage : 'default.jpg';
                ?>
                
                <div class="guide-background" style="--bg-image: url('admin/guideimages/<?php echo htmlentities($guideImage); ?>');">
                    <div class="guide-detail-card wow fadeInUp animated" data-wow-delay=".5s">
                        <div class="guide-image-container">
                            <img src="admin/guideimages/<?php echo htmlentities($guideImage); ?>" class="img-responsive" alt="Guide Image">
                        </div>
                        
                        <div class="guide-info-container">
                            <div class="guide-header">
                                <h2><?php echo htmlentities($guideName); ?></h2>
                                <span class="guide-id">#GUIDE-<?php echo htmlentities($guideId); ?></span>
                            </div>
                            
                            <div class="guide-stats">
                                <div class="stat-item">
                                    <i class="fa fa-clock-o"></i>
                                    <span class="stat-label">Experience</span>
                                    <span class="stat-value"><?php echo htmlentities($guideExperience); ?> years</span>
                                </div>
                                <div class="stat-item">
                                    <i class="fa fa-language"></i>
                                    <span class="stat-label">Languages</span>
                                    <span class="stat-value"><?php echo htmlentities($guideLanguages); ?></span>
                                </div>
                                <?php if(!empty($guideContact)): ?>
                                <div class="stat-item">
                                    <i class="fa fa-phone"></i>
                                    <span class="stat-label">Contact</span>
                                    <span class="stat-value"><?php echo htmlentities($guideContact); ?></span>
                                </div>
                                <?php endif; ?>
                                <div class="stat-item">
                                    <i class="fa fa-dollar"></i>
                                    <span class="stat-label">Price Per Day</span>
                                    <span class="stat-value">$<?php echo htmlentities($guidePrice); ?></span>
                                </div>
                            </div>

                            <div class="guide-description">
                                <h3>About the Guide</h3>
                                <p><?php echo htmlentities($guideDescription); ?></p>
                            </div>

                            <?php if(isset($_SESSION['login'])): ?>
                            <div class="guide-booking">
                                <a href="book-guide.php?guideid=<?php echo htmlentities($guideId); ?>" class="btn btn-primary">Book This Guide</a>
                            </div>
                            <?php else: ?>
                            <div class="guide-booking">
                                <a href="#" data-toggle="modal" data-target="#myModal4" class="btn btn-primary">Login to Book</a>
                            </div>
                            <?php endif; ?>
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
        <a href="select-tour-guide.php" class="btn btn-primary">Back to Guide List</a>
    </div>
</div>

<?php include('includes/footer.php');?>
<!-- signup -->
<?php include('includes/signup.php');?>			
<!-- //signup -->
<!-- signin -->
<?php include('includes/signin.php');?>			
<!-- //signin -->
</body>
</html>