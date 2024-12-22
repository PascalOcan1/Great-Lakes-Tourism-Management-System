<?php
session_start();
?>

<body>
    <?php include('includes/header.php'); ?>
    <div class="container">
        <h2>Booking Successful!</h2>
        <p>Your booking has been confirmed. Thank you for choosing us!</p>
        <a href="package-list.php" class="btn btn-primary">Book Another Package</a>
    </div>
    <?php include('includes/footer.php'); ?>
</body>
</html>