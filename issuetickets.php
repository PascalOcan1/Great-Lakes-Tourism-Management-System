<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
	{	
header('location:index.php');
}
else{
?>

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
        background-color: #2196F3;
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

    .custom-table a {
        color: #2196F3;
        text-decoration: none;
    }

    .custom-table a:hover {
        text-decoration: underline;
    }

    .custom-table th:nth-child(1),
    .custom-table td:nth-child(1) {
        width: 5%;
    }
    
    .custom-table th:nth-child(2),
    .custom-table td:nth-child(2) {
        width: 10%;
    }
    
    .custom-table th:nth-child(3),
    .custom-table td:nth-child(3) {
        width: 15%;
    }
    
    .custom-table th:nth-child(4),
    .custom-table td:nth-child(4) {
        width: 25%;
    }
    
    .custom-table th:nth-child(5),
    .custom-table td:nth-child(5) {
        width: 25%;
    }
    
    .custom-table th:nth-child(6),
    .custom-table td:nth-child(6),
    .custom-table th:nth-child(7),
    .custom-table td:nth-child(7) {
        width: 10%;
    }
		</style>
</head>
<body>
<!-- top-header -->
<div class="top-header">
<?php include('includes/header.php');?>
<div class="banner-1 ">
	<div class="container">
		<h1 class="wow zoomIn animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: zoomIn;">TMS-Tourism Management System</h1>
	</div>
</div>
<!--- /banner-1 ---->
<!--- privacy ---->
<div class="privacy">
	<div class="container">
		<h3 class="wow fadeInDown animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInDown;">Issue Tickets</h3>
		<form name="chngpwd" method="post" onSubmit="return valid();">
		 <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
	<p>
	<div class="table-responsive">
		<table class="custom-table">
			<thead>
				<tr>
					<th>#</th>
					<th>Ticket Id</th>
					<th>Issue</th>	
					<th>Description</th>
					<th>Admin Remark</th>
					<th>Reg Date</th>
					<th>Remark date</th>
				</tr>
			</thead>
			<tbody>
			<?php 
			$uemail=$_SESSION['login'];
			$sql = "SELECT * from tblissues where UserEmail=:uemail";
			$query = $dbh->prepare($sql);
			$query->bindParam(':uemail', $uemail, PDO::PARAM_STR);
			$query->execute();
			$results=$query->fetchAll(PDO::FETCH_OBJ);
			$cnt=1;
			if($query->rowCount() > 0)
			{
			foreach($results as $result)
			{	?>
				<tr>
					<td><?php echo htmlentities($cnt);?></td>
					<td>#TKT-<?php echo htmlentities($result->id);?></td>
					<td><?php echo htmlentities($result->Issue);?></td>
					<td><?php echo htmlentities($result->Description);?></td>
					<td><?php echo htmlentities($result->AdminRemark);?></td>
					<td><?php echo htmlentities($result->PostingDate);?></td>
					<td><?php echo htmlentities($result->AdminremarkDate);?></td>
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
