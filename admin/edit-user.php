<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
{	
    header('location:index.php');
}
else {
    if(isset($_POST['update'])) {
        $id = intval($_POST['id']);
        $fullName = $_POST['fullName'];
        $email = $_POST['email'];
        $mobileNumber = $_POST['mobileNumber'];

        $sql = "UPDATE tblusers SET FullName=:fullName, EmailId=:email, MobileNumber=:mobileNumber WHERE id=:id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':fullName', $fullName, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':mobileNumber', $mobileNumber, PDO::PARAM_STR);
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();

        $msg = "User details updated successfully";
    }

    // Fetch user details
    if(isset($_GET['id'])) {
        $id = intval($_GET['id']);
        $sql = "SELECT * FROM tblusers WHERE id=:id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_OBJ);
    }
?>
<!DOCTYPE HTML>
<html>
<head>
<title>TMS | Edit User</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="css/font-awesome.css" rel="stylesheet"> 
</head> 
<body>
   <div class="page-container">
   <div class="left-content">
       <div class="mother-grid-inner">
           <?php include('includes/header.php');?>
           <div class="clearfix"> </div>	
       </div>
       <ol class="breadcrumb">
           <li class="breadcrumb-item"><a href="index.html">Home</a><i class="fa fa-angle-right"></i>Edit User</li>
       </ol>
       <div class="agile-grids">	
           <div class="agile-tables">
               <div class="w3l-table-info">
                   <h2>Edit User</h2>
                   <?php if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
                   <form method="post">
                       <input type="hidden" name="id" value="<?php echo htmlentities($result->id);?>">
                       <div class="form-group">
                           <label for="fullName">Full Name</label>
                           <input type="text" class="form-control" name="fullName" value="<?php echo htmlentities($result->FullName);?>" required>
                       </div>
                       <div class="form-group">
                           <label for="email">Email</label>
                           <input type="email" class="form-control" name="email" value="<?php echo htmlentities($result->EmailId);?>" required>
                       </div>
                       <div class="form-group">
                           <label for="mobileNumber">Mobile Number</label>
                           <input type="text" class="form-control" name="mobileNumber" value="<?php echo htmlentities($result->MobileNumber);?>" required>
                       </div>
                       <button type="submit" name="update" class="btn btn-primary">Update</button>
                   </form>
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