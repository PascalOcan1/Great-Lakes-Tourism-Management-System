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
    if(isset($_REQUEST['eid'])) {
        $eid=intval($_GET['eid']);
        $status=1;

        $sql = "UPDATE tblenquiry SET Status=:status WHERE id=:eid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':status',$status, PDO::PARAM_STR);
        $query->bindParam(':eid',$eid, PDO::PARAM_STR);
        $query->execute();

        $msg="Enquiry successfully read";
    }
?>
<!DOCTYPE HTML>
<html>
<head>
<title>TMS | Admin Manage Enquiries</title>
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

    .btn-status {
        background-color: #2196F3; /* Primary blue */
        color: white; /* White text */
        padding: 5px 10px;
        border: none;
        border-radius: 4px;
        display: inline-block;
        text-align: center;
        cursor: pointer;
    }

    .btn-status:hover {
        background-color: #1976D2; /* Darker blue on hover */
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
        background-color: darkred; /* Darker red on hover */
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
           <li class="breadcrumb-item"><a href="index.html">Home</a><i class="fa fa-angle-right"></i>Manage Enquiries</li>
       </ol>
       <div class="agile-grids">	
           <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
           else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
           <div class="agile-tables">
               <div class="w3l-table-info">
                   <h2>Manage Enquiries</h2>
                   <div class="table-responsive">
                       <table class="custom-table">
                           <thead>
                               <tr>
                                   <th>Ticket ID</th>
                                   <th>Name</th>
                                   <th>Mobile No</th>
                                   <th>Email</th>
                                   <th>Subject</th>
                                   <th>Description</th>
                                   <th>Posting Date</th>
                                   <th>Action</th>
                               </tr>
                           </thead>
                           <tbody>
                           <?php 
                           $sql = "SELECT * from tblenquiry";
                           $query = $dbh->prepare($sql);
                           $query->execute();
                           $results = $query->fetchAll(PDO::FETCH_OBJ);

                           if($query->rowCount() > 0) {
                               foreach($results as $result) { ?>
                                   <tr>
                                       <td width="120">#TCKT-<?php echo htmlentities($result->id);?></td>
                                       <td width="200"><?php echo htmlentities($result->FullName);?></td>
                                       <td width="50"><?php echo htmlentities($result->MobileNumber);?> 
                                       <td width="50"><?php echo htmlentities($result->EmailId);?>
                                       <td width="200"><?php echo htmlentities($result->Subject);?></td>
                                       <td width="300"><?php echo htmlentities($result->Description);?></td>
                                       <td width="200"><?php echo htmlentities($result->PostingDate);?></td>
                                       <td>
                                           <?php if($result->Status == 1) { ?>
                                               <span class="btn-status">Read</span>
                                           <?php } else { ?>
                                               <a href="manage-enquires.php?eid=<?php echo htmlentities($result->id);?>" onclick="return confirm('Do you really want to read?')" class="btn-cancel">Pending</a>
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