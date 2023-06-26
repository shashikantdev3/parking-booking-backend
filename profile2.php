<?php
session_start();
include('config.php');
include('sessioncheck.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Profile</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Add Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.7.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="header-footer.css">
    <link rel="stylesheet" href="profile2_style.css">
</head>

<body>
    <header class="header">
        <h1>Profile</h1>
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

   <div class="profile-container">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Contact</th>
                <th>Registration Date</th>
                <th>Address</th>
                <th>Aadhar</th>
                <th>User UID</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $email = $_POST['mail']; // Assuming you're retrieving the email from a form input

            $qry = mysqli_query($con, "SELECT * FROM user WHERE email='$email'");
            if ($row = $qry->fetch_assoc()) {
                $uid = $row['useruid'];

                echo "<tr>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['contact'] . "</td>";
                echo "<td>" . $row['registrationdate'] . "</td>";
                echo "<td>" . $row['address'] . "</td>";
                echo "<td>" . $row['aadhar'] . "</td>";
                echo "<td>" . $row['useruid'] . "</td>";
                echo "</tr>";

            }
                $email = $_POST['mail']; // Assuming you're retrieving the email from a form input
                
                $qry = mysqli_query($con, "SELECT * FROM user WHERE email='$email'");
                if ($row = $qry->fetch_assoc()) {
                    $uid = $row['useruid'];
                
                    echo "<table class='table table-striped'>";
                    echo "<thead>";
                    echo "<tr>";
                    echo "<th>Level</th>";
                    echo "<th>Lot Name</th>";
                    echo "<th>Vehicle Number</th>";
                    echo "<th>Category</th>";
                    echo "<th>From Time</th>";
                    echo "<th>To Time</th>";
                    echo "<th>Payment</th>";
                    echo "<th>Status</th>";
                    echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";
                
                    $qry2 = mysqli_query($con, "SELECT * FROM logtable WHERE useruid='$uid'");
                    while ($row2 = $qry2->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row2['level'] . "</td>";
                        echo "<td>" . $row2['lotname'] . "</td>";
                        echo "<td>" . $row2['vehicleno'] . "</td>";
                        echo "<td>" . $row2['category'] . "</td>";
                        echo "<td>" . $row2['fromtime'] . "</td>";
                        echo "<td>" . $row2['totime'] . "</td>";
                        echo "<td>" . $row2['payment'] . "</td>";
                        echo "<td>" . $row2['status'] . "</td>";
                        echo "</tr>";
                    }
                
                    echo "</tbody>";
                    echo "</table>";
                } else {
                    echo "<p>No user found with the provided email.</p>";
                }
                ?>
                
         
        </tbody>
    </table>
</div>

    <!-- Add Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.7.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
