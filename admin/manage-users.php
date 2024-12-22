<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
{	
    header('location:index.php');
}
else { 
    // Check for success message
    if(isset($_GET['msg'])) {
        $msg = $_GET['msg'];
    }
?>
<!DOCTYPE HTML>
<html>
<head>
<title>TMS | Admin Manage Users</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="css/font-awesome.css" rel="stylesheet"> 
<script src="js/jquery-2.1.4.min.js"></script>
<style>
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

    .custom-table a {
        text-decoration: none;
    }

    /* Button styles */
    .btn-edit {
        background-color: #2196F3; /* Primary blue */
        color: white; /* White text */
        padding: 5px 10px;
        border: none;
        border-radius: 4px;
        display: inline-block;
    }

    .btn-edit:hover {
        background-color: white; /* Darker blue on hover */
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
        background-color: white; /* Darker red on hover */
    }
</style>

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
           <li class="breadcrumb-item"><a href="index.html">Home</a><i class="fa fa-angle-right"></i>Manage Users</li>
       </ol>
       <div class="agile-grids">	
           <div class="agile-tables">
               <div class="w3l-table-info">
                   <h2>Manage Users</h2>
                   <?php if(isset($msg)){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
                   <div class="table-responsive">
                       <table class="custom-table">
                           <thead>
                               <tr>
                                   <th>User ID</th>
                                   <th>Name</th>
                                   <th>Email</th>
                                   <th>Mobile No.</th>
                                   <th>Registration Date</th>
                                   <th>Action</th>
                               </tr>
                           </thead>
                           <tbody>
                           <?php 
                           $sql = "SELECT * from tblusers"; // Adjust this query as needed
                           $query = $dbh->prepare($sql);
                           $query->execute();
                           $results = $query->fetchAll(PDO::FETCH_OBJ);
                           if($query->rowCount() > 0) {
                               foreach($results as $result) { ?>
                                   <tr>
                                       <td>#USR-<?php echo htmlentities($result->id);?></td>
                                       <td><?php echo htmlentities($result->FullName);?></td>
                                       <td><?php echo htmlentities($result->EmailId);?></td>
                                       <td><?php echo htmlentities($result->MobileNumber);?></td>
                                       <td><?php echo htmlentities($result->RegDate);?></td>
                                       <td style="text-align:right;">
                                           <a href="edit-user.php?id=<?php echo htmlentities($result->id);?>" class="btn-edit">Edit</a>
                                           <a href="delete-user.php?id=<?php echo htmlentities($result->id);?>" onclick="return confirm('Do you really want to delete this user?')" class="btn-cancel">Delete</a>
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