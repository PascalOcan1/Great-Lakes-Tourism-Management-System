<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
{	
    header('location:index.php');
}
else {
    if(isset($_GET['id'])) {
        $id = intval($_GET['id']);
        $sql = "DELETE FROM tblusers WHERE id=:id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();

        $msg = "User deleted successfully";
        header("Location: manage-users.php?msg=" . urlencode($msg)); // Redirect to manage-users.php with a success message
        exit();
    }
}
?> 