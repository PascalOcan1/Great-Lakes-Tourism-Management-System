<?php
session_start();
include('includes/config.php');

if (!isset($_SESSION['login'])) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit();
}

$pid = intval($_GET['pkgid']);
$guideid = intval($_GET['guideid']);
$useremail = $_GET['email'];

// Fetch package details
$sql = "SELECT * FROM tbltourpackages WHERE PackageId = :pid";
$query = $dbh->prepare($sql);
$query->bindParam(':pid', $pid, PDO::PARAM_INT);
$query->execute();
$package = $query->fetch(PDO::FETCH_OBJ);

// Fetch guide details
$sqlGuide = "SELECT * FROM tbltourguides WHERE GuideId = :guideid";
$queryGuide = $dbh->prepare($sqlGuide);
$queryGuide->bindParam(':guideid', $guideid, PDO::PARAM_INT);
$queryGuide->execute();
$guide = $queryGuide->fetch(PDO::FETCH_OBJ);

// Handle booking confirmation
if (isset($_POST['confirm_booking'])) {
    // Insert booking details into the database
    $sqlInsert = "INSERT INTO tblbookings (PackageId, GuideId, UserEmail) VALUES (:pid, :guideid, :email)";
    $queryInsert = $dbh->prepare($sqlInsert);
    $queryInsert->bindParam(':pid', $pid, PDO::PARAM_INT);
    $queryInsert->bindParam(':guideid', $guideid, PDO::PARAM_INT);
    $queryInsert->bindParam(':email', $useremail, PDO::PARAM_STR);
    $queryInsert->execute();

    // Redirect to a success page or display a success message
    header("Location: booking-success.php");
    exit();
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Booking Confirmation</title>
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
    <link href="css/style.css" rel='stylesheet' type='text/css' />
</head>
<body>
    <?php include('includes/header.php'); ?>
    <div class="container">
        <h2>Booking Confirmation</h2>
        <h4>Package Details:</h4>
        <p><strong>Package Name:</strong> <?php echo htmlentities($package->PackageName); ?></p>
        <p><strong>Guide Name:</strong> <?php echo htmlentities($guide->GuideName); ?></p>
        <p><strong>User Email:</strong> <?php echo htmlentities($useremail); ?></p>

        <form method="post">
            <button type="submit" name="confirm_booking" class="btn btn-success">Confirm Booking</button>
        </form>
    </div>
    <?php include('includes/footer.php'); ?>
</body>
</html>