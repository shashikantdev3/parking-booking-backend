<!DOCTYPE html>
<html>
<head>
    <title>Payment</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="header-footer.css">
    <style>
        .container-login100-form-btn {
            display: flex;
            justify-content: center;
            margin-top: 17px;
        }

        .amount {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .fee {
            text-align: center;
        }
        body {
    background-color: #f8f9fa;
    background-image: url('p1.jpg');
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
}

    </style>
</head>
<body>
<header class="header">
    <h1>Payment</h1>
</header>

<nav class="navbar">
    <ul>
        <li><a href="aboutus.php" class="home">About Us</a></li>
        <li><a href="profile.php" class="home">Profile</a></li>
        <li><a href="dashboard.php" class="home">Book Parking</a></li>
        <li><a href="givefeedback.php" class="home">Feedback</a></li>
        <li><a href="contactus.php" class="home">Contact us</a></li>
        <li><a href="fee.php" class="home">Payment</a></li>
        <li><a href="logout.php" class="home">Logout</a></li>
    </ul>
</nav>

<?php
session_start();
include('config.php');
include('sessioncheck.php');
date_default_timezone_set('Asia/Kolkata');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the fromtime from the database
    $uid = $_SESSION['log']['useruid'];
    $qry = mysqli_query($con, "SELECT * FROM logtable WHERE useruid='$uid' ORDER BY id DESC");
    $row = mysqli_fetch_array($qry);
    $fromTime = $row['fromtime'];

    // Update the totime in the logtable with the current time
    $toTime = date('Y-m-d H:i:s');
    $qry1 = mysqli_query($con, "UPDATE logtable SET totime='$toTime' WHERE useruid='$uid'");

    // Calculate the fee based on the fromtime and totime
    $from = new DateTime($fromTime);
    $to = new DateTime($toTime);
    $diff = $to->diff($from);
    $hours = $diff->h;
    $hours += $diff->days * 24;
    $fee = 60 * $hours;
    $fee = round($fee, 0, PHP_ROUND_HALF_UP);

    echo '<div class="container">
            <h2>Fee generated: $' . $fee . '</h2>
            <form method="post" action="payment.php">
              <input type="hidden" name="fee" value="' . $fee . '">
              <input type="hidden" name="id" value="' . $row['id'] . '">
              <button type="submit" class="btn btn-primary">Pay</button>
            </form>
          </div>';
} else {
    $uid = $_SESSION['log']['useruid'];
    $qry = mysqli_query($con, "SELECT * FROM logtable WHERE useruid='$uid' ORDER BY id DESC");
    $row = mysqli_fetch_array($qry);

    $fromTime = $row['fromtime'];
    $toTime = $row['totime'];

    echo '<div class="container">
            <form class="login100-form validate-form flex-sb flex-w" method="post" action="">
                <div class="fee">
                    <h1>Generate Fee</h1>
                </div>

                <div class="form-group">
                    <label for="fromtime">In Time:</label>
                    <input class="amount" type="text" name="fromtime" value="' . $fromTime . '" readonly/>
                </div>

                <div class="form-group">
                    <label for="totime">Out Time:</label>
                    <input class="amount" type="text" name="totime" value="' . $toTime . '" readonly/>
                </div>
                <input type="hidden" name="id" value="' . $row['id'] . '">

                <div class="container-login100-form-btn m-t-17">
                    <button class="btn btn-primary" type="submit">Generate</button>
                </div>
            </form>
          </div>';
}
?>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
