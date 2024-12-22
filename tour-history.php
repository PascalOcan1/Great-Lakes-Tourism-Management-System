<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
	{	
header('location:index.php');
}
else{
if(isset($_REQUEST['bkid']))
	{
		$bid=intval($_GET['bkid']);
$email=$_SESSION['login'];
	$sql ="SELECT FromDate FROM tblbooking WHERE UserEmail=:email and BookingId=:bid";
$query= $dbh -> prepare($sql);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> bindParam(':bid', $bid, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
{
	 $fdate=$result->FromDate;

	$a=explode("/",$fdate);
	$val=array_reverse($a);
	 $mydate =implode("/",$val);
	$cdate=date('Y/m/d');
	$date1=date_create("$cdate");
	$date2=date_create("$fdate");
 $diff=date_diff($date1,$date2);
echo $df=$diff->format("%a");
if($df>1)
{
$status=2;
$cancelby='u';
$sql = "UPDATE tblbooking SET status=:status,CancelledBy=:cancelby WHERE UserEmail=:email and BookingId=:bid";
$query = $dbh->prepare($sql);
$query -> bindParam(':status',$status, PDO::PARAM_STR);
$query -> bindParam(':cancelby',$cancelby , PDO::PARAM_STR);
$query-> bindParam(':email',$email, PDO::PARAM_STR);
$query-> bindParam(':bid',$bid, PDO::PARAM_STR);
$query -> execute();

$msg="Booking Cancelled successfully";
}
else
{
$error="You can't cancel booking before 24 hours";
}
}
}
}

?>
<!DOCTYPE HTML>
<html>
<head>
<title>TMS | Tourism Management System</title>

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

    <style>
        .custom-table {
            width: 100%;
            background-color: #fff;
            border-collapse: collapse;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
			font-size: 14px;
        }

        .custom-table thead {
            background-color: #2196F3;  /* Primary blue color - adjust to match your system */
            color: white;
        }

        .custom-table th {
            padding: 15px;
            text-align: left;
            font-weight: 500;
        }

        .custom-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #f0f0f0;
			
        }

        .custom-table tbody tr:hover {
            background-color: #f8f9fa;
        }

        .custom-table tbody tr:last-child td {
            border-bottom: none;
        }

        .custom-table a {
            color: #2196F3;  /* Primary blue color for links */
            text-decoration: none;
        }

		.custom-tables a {
            color: white;  
            text-decoration: none;
        }

        .custom-table a:hover {
            text-decoration: underline;
        }

        .btn-cancel {
            background-color: #ff5722;  /* Warning/Cancel color */
            color: white;
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: background-color 0.3s;
        }

        .btn-cancel:hover {
            background-color: #f4511e;
            text-decoration: none;
            color: white;
        }

        .status-pending {
            color: #ffa000;  /* Orange for pending */
            font-weight: 500;
        }

        .status-confirmed {
            color: #4caf50;  /* Green for confirmed */
            font-weight: 500;
        }

        .status-cancelled {
            color: #f44336;  /* Red for cancelled */
            font-weight: 500;
        }
    </style>
</head>
<body>
<!-- top-header -->
<div class="top-header">
<?php include('includes/header.php');?>
<div class="banner-1 ">
	<div class="container">
		<h1 class="wow zoomIn animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: zoomIn;">Great Lakes Tourism Management System</h1>
	</div>
</div>
<!--- /banner-1 ---->
<!--- privacy ---->
<div class="privacy">
	<div class="container">
		<h3 class="wow fadeInDown animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInDown;">My Tour History</h3>
		<form name="chngpwd" method="post" onSubmit="return valid();">
		 <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
	<p>
	<div class="table-responsive">
		<table class="custom-table">
			<thead>
				<tr>
					<th>#</th>
					<th>Booking Id</th>
					<th>Package Name</th>	
					<th>From</th>
					<th>To</th>
					<th>Comment</th>
					<th>Status</th>
					<th>Booking Date</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php 
			$uemail=$_SESSION['login'];
			$sql = "SELECT tblbooking.BookingId as bookid,tblbooking.PackageId as pkgid,tbltourpackages.PackageName as packagename,tblbooking.FromDate as fromdate,tblbooking.ToDate as todate,tblbooking.Comment as comment,tblbooking.status as status,tblbooking.RegDate as regdate,tblbooking.CancelledBy as cancelby,tblbooking.UpdationDate as upddate from tblbooking join tbltourpackages on tbltourpackages.PackageId=tblbooking.PackageId where UserEmail=:uemail";
			$query = $dbh->prepare($sql);
			$query -> bindParam(':uemail', $uemail, PDO::PARAM_STR);
			$query->execute();
			$results=$query->fetchAll(PDO::FETCH_OBJ);
			$cnt=1;
			if($query->rowCount() > 0)
			{
			foreach($results as $result)
			{	?>
				<tr>
					<td><?php echo htmlentities($cnt);?></td>
					<td>#BK<?php echo htmlentities($result->bookid);?></td>
					<td><a href="package-details.php?pkgid=<?php echo htmlentities($result->pkgid);?>"><?php echo htmlentities($result->packagename);?></a></td>
					<td><?php echo htmlentities($result->fromdate);?></td>
					<td><?php echo htmlentities($result->todate);?></td>
					<td><?php echo htmlentities($result->comment);?></td>
					<td>
						<?php if($result->status==0) { ?>
							<span class="status-pending">Pending</span>
						<?php } 
						if($result->status==1) { ?>
							<span class="status-confirmed">Confirmed</span>
						<?php }
						if($result->status==2 and $result->cancelby=='u') { ?>
							<span class="status-cancelled">Canceled by you at <?php echo htmlentities($result->upddate);?></span>
						<?php }
						if($result->status==2 and $result->cancelby=='a') { ?>
							<span class="status-cancelled">Canceled by admin at <?php echo htmlentities($result->upddate);?></span>
						<?php } ?>
					</td>
					<td><?php echo htmlentities($result->regdate);?></td>
					<?php if($result->status==2) { ?>
						<td><span class="status-cancelled">Cancelled</span></td>
					<?php } else { ?>
						<td><a href="tour-history.php?bkid=<?php echo htmlentities($result->bookid);?>" onclick="return confirm('Do you really want to cancel booking')" class="btn-cancel" style="color:white;">Cancel</a></td>
					<?php } ?>
				</tr>
			<?php $cnt=$cnt+1; }} ?>
			</tbody>
		</table>
	</div>
			</p>
			</form>

		
	</div>
</div>
<!--- /privacy ---->
<!--- footer-top ---->
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
</body>
</html>
<?php } ?>