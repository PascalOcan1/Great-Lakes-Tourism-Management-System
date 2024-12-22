<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('includes/config.php');

// Initialize error and message variables
$error = null;
$msg = null;

if(strlen($_SESSION['alogin'])==0)
{	
    header('location:index.php');
}
else{
    if(!isset($_GET['gid']) || empty($_GET['gid'])) {
        $error = "No guide ID specified";
    } else {
        $gid = intval($_GET['gid']);
        
        if(isset($_POST['submit']))
        {
            $gname=$_POST['guidename'];
            $gexperience=$_POST['guideexperience'];    
            $glanguages=$_POST['guidelanguages'];
            $gcontact=$_POST['guidecontact'] ?? '';    
            $gdescription=$_POST['guidedescription'];
            $gprice=$_POST['guideprice'];

            // Handle image upload
            if(isset($_FILES["guideimage"]["name"]) && $_FILES["guideimage"]["name"] != "") {
                $file = $_FILES["guideimage"]["name"];
                $extension = substr($file, strlen($file)-4, strlen($file));
                // Allowed file extensions
                $allowed_extensions = array(".jpg",".jpeg",".png");
                
                if(!in_array(strtolower($extension), $allowed_extensions)) {
                    $error = "Invalid file format. Only jpg / jpeg / png format allowed";
                } else {
                    // Create new filename
                    $imgnewfile = md5($file.time()).$extension;
                    // Upload the file
                    if(move_uploaded_file($_FILES["guideimage"]["tmp_name"],"guideimages/".$imgnewfile)) {
                        // Include image in update query
                        $sql = "UPDATE tbltourguides SET 
                            GuideName=:gname,
                            GuideExperience=:gexperience,
                            GuideLanguages=:glanguages,
                            GuideContact=:gcontact,
                            GuideDescription=:gdescription,
                            GuidePrice=:gprice,
                            GuideImage=:gimage 
                            WHERE GuideID=:gid";
                        
                        try {
                            $query = $dbh->prepare($sql);
                            $query->bindParam(':gname',$gname,PDO::PARAM_STR);
                            $query->bindParam(':gexperience',$gexperience,PDO::PARAM_INT);
                            $query->bindParam(':glanguages',$glanguages,PDO::PARAM_STR);
                            $query->bindParam(':gcontact',$gcontact,PDO::PARAM_STR);
                            $query->bindParam(':gdescription',$gdescription,PDO::PARAM_STR);
                            $query->bindParam(':gprice',$gprice,PDO::PARAM_STR);
                            $query->bindParam(':gimage',$imgnewfile,PDO::PARAM_STR);
                            $query->bindParam(':gid',$gid,PDO::PARAM_STR);
                            $query->execute();
                            $msg = "Guide Updated Successfully";
                        } catch(PDOException $e) {
                            $error = "Update failed: " . $e->getMessage();
                        }
                    } else {
                        $error = "Failed to upload image";
                    }
                }
            } else {
                // Update without changing image
                $sql = "UPDATE tbltourguides SET 
                    GuideName=:gname,
                    GuideExperience=:gexperience,
                    GuideLanguages=:glanguages,
                    GuideContact=:gcontact,
                    GuideDescription=:gdescription,
                    GuidePrice=:gprice 
                    WHERE GuideID=:gid";

                try {
                    $query = $dbh->prepare($sql);
                    $query->bindParam(':gname',$gname,PDO::PARAM_STR);
                    $query->bindParam(':gexperience',$gexperience,PDO::PARAM_INT);
                    $query->bindParam(':glanguages',$glanguages,PDO::PARAM_STR);
                    $query->bindParam(':gcontact',$gcontact,PDO::PARAM_STR);
                    $query->bindParam(':gdescription',$gdescription,PDO::PARAM_STR);
                    $query->bindParam(':gprice',$gprice,PDO::PARAM_STR);
                    $query->bindParam(':gid',$gid,PDO::PARAM_STR);
                    $query->execute();
                    $msg = "Guide Updated Successfully";
                } catch(PDOException $e) {
                    $error = "Update failed: " . $e->getMessage();
                }
            }
        }

        // Create guideimages directory if it doesn't exist
        if (!file_exists('guideimages')) {
            mkdir('guideimages', 0777, true);
        }

        // Fetch guide details
        try {
            $sql = "SELECT * FROM tbltourguides WHERE GuideID = :gid";
            $query = $dbh->prepare($sql);
            $query->bindParam(':gid', $gid, PDO::PARAM_INT);
            $query->execute();
            
            if($query->rowCount() == 0) {
                $error = "No guide found with ID: " . $gid;
            } else {
                $result = $query->fetch(PDO::FETCH_OBJ);
            }
        } catch(PDOException $e) {
            $error = "Database error: " . $e->getMessage();
        }
    }
?>
<!DOCTYPE HTML>
<html>
<head>
<title>TMS | Admin Update Guide</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
   <div class="left-content">
        <div class="mother-grid-inner">
            <?php include('includes/header.php');?>
            <div class="clearfix"> </div>	
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a><i class="fa fa-angle-right"></i>Update Tour Guide </li>
            </ol>
            <div class="grid-form">
                <div class="grid-form1">
                    <h3>Update Guide</h3>
                    <?php if($error){?>
                        <div class="errorWrap"><strong>ERROR</strong>: <?php echo htmlentities($error); ?> </div>
                    <?php } 
                    if($msg){?>
                        <div class="succWrap"><strong>SUCCESS</strong>: <?php echo htmlentities($msg); ?> </div>
                    <?php }?>
                    
                    <?php if(isset($result)): ?>
                    <div class="tab-content">
                        <div class="tab-pane active" id="horizontal-form">
                            <form class="form-horizontal" name="guide" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="focusedinput" class="col-sm-2 control-label">Guide Name</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control1" name="guidename" id="guidename" 
                                            value="<?php echo isset($result->GuideName) ? htmlentities($result->GuideName) : ''; ?>" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="focusedinput" class="col-sm-2 control-label">Experience (Years)</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control1" name="guideexperience" id="guideexperience" 
                                            value="<?php echo isset($result->GuideExperience) ? htmlentities($result->GuideExperience) : ''; ?>" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="focusedinput" class="col-sm-2 control-label">Languages</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control1" name="guidelanguages" id="guidelanguages" 
                                            value="<?php echo isset($result->GuideLanguages) ? htmlentities($result->GuideLanguages) : ''; ?>" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="focusedinput" class="col-sm-2 control-label">Contact</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control1" name="guidecontact" id="guidecontact" 
                                            value="<?php echo isset($result->GuideContact) ? htmlentities($result->GuideContact) : ''; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="focusedinput" class="col-sm-2 control-label">Description</label>
                                    <div class="col-sm-8">
                                        <textarea class="form-control" rows="5" name="guidedescription" id="guidedescription" 
                                            required><?php echo isset($result->GuideDescription) ? htmlentities($result->GuideDescription) : ''; ?></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="focusedinput" class="col-sm-2 control-label">Price Per Day</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control1" name="guideprice" id="guideprice" 
                                            value="<?php echo isset($result->GuidePrice) ? htmlentities($result->GuidePrice) : ''; ?>" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="focusedinput" class="col-sm-2 control-label">Status</label>
                                    <div class="col-sm-8">
                                        <select name="status" class="form-control1" required>
                                            <option value="">Select Status</option>
                                            <option value="1" <?php echo (isset($result->Status) && $result->Status==1) ? 'selected' : ''; ?>>Active</option>
                                            <option value="0" <?php echo (isset($result->Status) && $result->Status==0) ? 'selected' : ''; ?>>Inactive</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="focusedinput" class="col-sm-2 control-label">Guide Image</label>
                                    <div class="col-sm-8">
                                        <?php if(isset($result->GuideImage) && !empty($result->GuideImage)): ?>
                                            <img src="guideimages/<?php echo htmlentities($result->GuideImage);?>" width="200" style="border:solid 1px #000">
                                            <br><br>
                                        <?php endif; ?>
                                        <input type="file" name="guideimage" id="guideimage" class="form-control1">
                                        <small>Please select an image (jpg, jpeg, png only)</small>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-8 col-sm-offset-2">
                                        <button type="submit" name="submit" class="btn-primary btn">Update</button>
                                        <button type="reset" class="btn-inverse btn">Reset</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php include('includes/footer.php');?>
        </div>
    </div>
    <?php include('includes/sidebarmenu.php');?>
    <div class="clearfix"></div>		
</div>

<script>
var toggle = true;
$(".sidebar-icon").click(function() {                
    if (toggle) {
        $(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
        $("#menu span").css({"position":"absolute"});
    } else {
        $(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
        setTimeout(function() {
            $("#menu span").css({"position":"relative"});
        }, 400);
    }
    toggle = !toggle;
});
</script>
<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
<?php } ?>