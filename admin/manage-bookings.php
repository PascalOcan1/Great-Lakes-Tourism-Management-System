<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
{	
    header('location:index.php');
}
else { 
    // code for cancel
    if(isset($_REQUEST['bkid'])) {
        $bid=intval($_GET['bkid']);
        $status=2;
        $cancelby='a';
        $sql = "UPDATE tblbooking SET status=:status,CancelledBy=:cancelby WHERE  BookingId=:bid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':status',$status, PDO::PARAM_STR);
        $query->bindParam(':cancelby',$cancelby , PDO::PARAM_STR);
        $query->bindParam(':bid',$bid, PDO::PARAM_STR);
        $query->execute();

        $msg="Booking Cancelled successfully";
    }

    if(isset($_REQUEST['bckid'])) {
        $bcid=intval($_GET['bckid']);
        $status=1;
        $cancelby='a';
        $sql = "UPDATE tblbooking SET status=:status WHERE BookingId=:bcid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':status',$status, PDO::PARAM_STR);
        $query->bindParam(':bcid',$bcid, PDO::PARAM_STR);
        $query->execute();
        $msg="Booking Confirmed successfully";
    }
?>
<!DOCTYPE HTML>
<html>
<head>
<title>TMS | Admin Manage Bookings</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="css/font-awesome.css" rel="stylesheet"> 
<script src="js/jquery-2.1.4.min.js"></script>
<style>
    .custom-table {
        width: 100%;
        background-color: #fff;
        border-collapse: collapse;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        font-size: 13px;
    }

    .custom-table thead {
        background-color: #2196F3; /* Primary blue */
        color: white;
    }

    .custom-table th {
        padding: 12px 8px;
        text-align: left;
        font-weight: 500;
    }

    .custom-table td {
        padding: 8px;
        border-bottom: 1px solid #f0f0f0;
        word-wrap: break-word;
        vertical-align: top;
    }

    .custom-table tbody tr:hover {
        background-color: #f8f9fa;
    }

    .custom-table tbody tr:last-child td {
        border-bottom: none;
    }

 
    .custom-table .btn a {
        color: white; /* Link color */
        text-decoration: none;
    }

    .custom-table a:hover {
        text-decoration: underline;
    }

    .btn-cancel {
        background-color: red; /* Red background */
        color: white; /* White text */
        padding: 5px 10px;
        border: none;
        border-radius: 4px;
        text-decoration: none;
        display: inline-block;
    }

    .btn-cancel:hover {
        background-color: red; /* Darker red on hover */
        color: white;
    }
</style>
</head> 
<body>
   <div class="page-container">
   <div class="left-content">
       <div class="mother-grid-inner">
           <?php include('includes/header.php');?>
           <div class="clearfix"> </div>	
       </div>
       <ol class="breadcrumb">
           <li class="breadcrumb-item"><a href="index.html">Home</a><i class="fa fa-angle-right"></i>Manage Bookings</li>
       </ol>
       <div class="agile-grids">	
           <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
           else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
           <div class="agile-tables">
               <div class="w3l-table-info">
                   <h2>Manage Bookings</h2>
                   <div class="table-responsive">
                       <table class="custom-table">
                           <thead>
                               <tr>
                                   <th>Booking id</th>
                                   <th>Name</th>
                                   <th>Mobile No.</th>
                                   <th>Email Id</th>
                                   <th>Package Details</th>
                                   <th>From</th>
                                   <th>To</th>
                                   <th>Comment</th>
                                   <th>Status</th>
                                   <th>Action</th>
                               </tr>
                           </thead>
                           <tbody>
                           <?php 
                           $sql = "SELECT 
       tblbooking.BookingId AS bookid,
       tblbooking.FromDate AS fromdate,
       tblbooking.ToDate AS todate,
       tblbooking.Comment AS comments,
       tblbooking.status as status,
       tblbooking.CancelledBy as cancelby,
       tblbooking.UpdationDate as upddate,
       tblusers.FullName AS fname,
       tblusers.MobileNumber AS mnumber,
       tblusers.EmailId AS email,
       tblbooking.PackageId as pid,
       tbltourpackages.PackageName AS pckname,
       tbltourguides.GuideID AS guideid
   FROM 
       tblusers 
   JOIN 
       tblbooking ON tblbooking.UserEmail = tblusers.EmailId 
   JOIN 
       tbltourpackages ON tbltourpackages.PackageId = tblbooking.PackageId 
   LEFT JOIN 
       tbltourguides ON tbltourpackages.GuideID = tbltourguides.GuideID;";
                           $query = $dbh->prepare($sql);
                           $query->execute();
                           $results = $query->fetchAll(PDO::FETCH_OBJ);
                           if($query->rowCount() > 0) {
                               foreach($results as $result) { ?>
                                   <tr>
                                       <td width="80px">#BK-<?php echo htmlentities($result->bookid);?></td>
                                       <td  width="80px"><?php echo htmlentities($result->fname);?></td>
                                       <td><?php echo htmlentities($result->mnumber);?></td>
                                       <td width="20px"><?php echo htmlentities($result->email);?></td>
                                       <td><a href="update-package.php?pid=<?php echo htmlentities($result->pid);?>"><?php echo htmlentities($result->pckname);?></a></td>
                                       <td width="90px"><?php echo htmlentities($result->fromdate);?></td>
                                       <td width="90px"> <?php echo htmlentities($result->todate);?></td>
                                       <td><?php echo htmlentities($result->comments);?></td>
                                       <td><?php if($result->status==0) {
                                           echo "Pending";
                                       } elseif($result->status==1) {
                                           echo "Confirmed";
                                       } elseif($result->status==2 && $result->cancelby=='a') {
                                           echo "Canceled by admin at " . htmlentities($result->upddate);
                                       } elseif($result->status==2 && $result->cancelby=='u') {
                                           echo "Canceled by User at " . htmlentities($result->upddate);
                                       } ?></td>
                                       <td>
                                           <?php if($result->status==2) { ?>
                                               <span>Cancelled</span>
                                           <?php } else { ?>
                                               <a href="manage-bookings.php?bkid=<?php echo htmlentities($result->bookid);?>" onclick="return confirm('Do you really want to cancel booking')" class="btn-action btn-cancel">Cancel</a>
                                               
                                           <?php } ?>
                                       </td>
                                   </tr>
                               <?php }
                           } ?>
                           </tbody>
                       </table>
                   </div>
               </div>
           </div>
       </div>
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