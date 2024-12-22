<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('includes/config.php');

// Initialize variables
$error = null;
$msg = null;

if(strlen($_SESSION['alogin'])==0) {	
    header('location:index.php');
} else {
    $gid = intval($_GET['imgid']);
    
    if(isset($_POST['submit'])) {
        $image = $_FILES["guideimage"]["name"];
        
        // Validate file type
        $allowed_types = array('jpg','jpeg','png');
        $file_ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));
        
        if(!in_array($file_ext, $allowed_types)) {
            $error = "Sorry, only JPG, JPEG, PNG files are allowed.";
        } else {
            try {
                // Generate unique filename
                $newImageName = 'guide_' . $gid . '_' . time() . '.' . $file_ext;
                
                // Upload file
                move_uploaded_file($_FILES["guideimage"]["tmp_name"],"guideimages/".$newImageName);
                
                // Update database
                $sql = "UPDATE tbltourguides SET GuideImage=:image WHERE GuideID=:gid";
                $query = $dbh->prepare($sql);
                $query->bindParam(':image', $newImageName, PDO::PARAM_STR);
                $query->bindParam(':gid', $gid, PDO::PARAM_STR);
                $query->execute();
                
                $msg = "Guide Image Updated Successfully";
            } catch(PDOException $e) {
                $error = "Update failed: " . $e->getMessage();
            }
        }
    }
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>TMS | Guide Image Change</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <link href="css/font-awesome.css" rel="stylesheet">
    <script src="js/jquery-2.1.4.min.js"></script>
</head>
<body>
    <div class="page-container">
        <div class="left-content">
            <div class="mother-grid-inner">
                <?php include('includes/header.php');?>
                <div class="clearfix"> </div>	
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a><i class="fa fa-angle-right"></i>Update Guide Image </li>
                </ol>
                <div class="grid-form">
                    <div class="grid-form1">
                        <h3>Update Guide Image</h3>
                        <?php if($error){?>
                            <div class="errorWrap"><strong>ERROR</strong>: <?php echo htmlentities($error); ?> </div>
                        <?php } 
                        if($msg){?>
                            <div class="succWrap"><strong>SUCCESS</strong>: <?php echo htmlentities($msg); ?> </div>
                        <?php }?>
                        
                        <?php 
                        $sql = "SELECT GuideImage from tbltourguides where GuideID=:gid";
                        $query = $dbh->prepare($sql);
                        $query->bindParam(':gid',$gid,PDO::PARAM_STR);
                        $query->execute();
                        $result=$query->fetch(PDO::FETCH_OBJ);
                        ?>

                        <div class="tab-content">
                            <div class="tab-pane active" id="horizontal-form">
                                <form class="form-horizontal" name="image" method="post" enctype="multipart/form-data">
                                    <?php if($result->GuideImage):?>
                                    <div class="form-group">
                                        <label for="focusedinput" class="col-sm-2 control-label">Current Image</label>
                                        <div class="col-sm-8">
                                            <img src="guideimages/<?php echo htmlentities($result->GuideImage);?>" width="200">
                                        </div>
                                    </div>
                                    <?php endif;?>

                                    <div class="form-group">
                                        <label for="focusedinput" class="col-sm-2 control-label">New Image</label>
                                        <div class="col-sm-8">
                                            <input type="file" name="guideimage" id="guideimage" required>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-8 col-sm-offset-2">
                                            <button type="submit" name="submit" class="btn-primary btn">Update</button>
                                            <a href="update-guide.php?gid=<?php echo $gid;?>" class="btn-inverse btn">Back</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php include('includes/footer.php');?>
            </div>
        </div>
        <?php include('includes/sidebarmenu.php');?>
        <div class="clearfix"></div>		
    </div>
    <script src="js/jquery.nicescroll.js"></script>
    <script src="js/scripts.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
<?php } ?> 