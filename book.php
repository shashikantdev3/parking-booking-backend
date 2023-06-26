<?php
session_start();
date_default_timezone_set('Asia/Kolkata');
include('config.php');
include('sessioncheck.php');

// Include PHPMailer files
require 'C:/xampp/htdocs/phpmailer/includes/PHPMailer.php';
require 'C:/xampp/htdocs/phpmailer/includes/SMTP.php';
require 'C:/xampp/htdocs/phpmailer/includes/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $category = $_POST['category'];
    $vehicle = $_POST['vehicle'];
    $fromtime = $_POST['fromtime'];
    $level = $_POST['level'];
    $lot = $_POST['lot'];

    // Generate a ticket number
    $ticketNumber = uniqid();

    // Insert booking details into the database
    $insertQuery = "INSERT INTO bookings (useruid, category, vehicle, fromtime, level, lot, ticket_number) 
                    VALUES ('".$_SESSION['log']['useruid']."', '$category', '$vehicle', '$fromtime', '$level', '$lot', '$ticketNumber')";
    mysqli_query($con, $insertQuery);

    // Create a new instance of PHPMailer
    $mail = new PHPMailer();

    // Set mailer to use SMTP
    $mail->isSMTP();

    // Define SMTP host (Gmail SMTP)
    $mail->Host = "smtp.gmail.com";

    // Enable SMTP authentication
    $mail->SMTPAuth = true;

    // Set SMTP encryption type (ssl/tls)
    $mail->SMTPSecure = "tls";

    // Set SMTP port (Gmail SMTP)
    $mail->Port = "587";

    // Set Gmail username and password
    $mail->Username = "kunwarubaid3006@gmail.com";
    $mail->Password = "ezeumalnmdyoigre";

    // Set email subject
    $mail->Subject = "Parking Slot Booking Confirmation";

    // Set sender email
    $mail->setFrom("kunwarubaid3006@gmail.com");

    // Enable HTML
    $mail->isHTML(true);

    // Create email body
    $message = "Dear ".$_SESSION['log']['username'].",<br><br>";
    $message .= "Your parking slot booking has been confirmed.<br>";
    $message .= "Ticket Number: ".$ticketNumber."<br>";
    $message .= "Category: ".$category."<br>";
    $message .= "Vehicle No.: ".$vehicle."<br>";
    $message .= "Entry Date and Time: ".$fromtime."<br>";
    $message .= "Level: ".$level."<br>";
    $message .= "Parking Lot: ".$lot."<br><br>";
    $message .= "Thank you for using our parking service.<br><br>";
    $message .= "Best Regards,<br>The Parking Team";

    // Set email body
    $mail->Body = $message;
    $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Enable verbose debug output

    // Add recipient
    $mail->addAddress($_SESSION['log']['email']);
    echo "Recipient's Email: " . $_SESSION['log']['email'] . "<br>";
    // Finally send the email
    if ($mail->send()) {
        echo "Booking successful. An email with the ticket details has been sent.";
    } else {
        echo "Booking successful. Failed to send the email. Mailer Error: " . $mail->ErrorInfo;
    }
    $mail->smtpClose();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Book</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="book_style.css">
    <link rel="stylesheet" href="header-footer.css">
</head>


<body>
<body> <header class="header">
    <h1>Book Parking</h1>
  </header>

<nav class="navbar">
    <ul>
    <li><a href="aboutus.php" class="home">About Us</a></li>
                <li><a href="profile.php" class="home">Profile</a></li>
                <li><a href="givefeedback.php" class="home">Feedback</a></li>
                <li><a href="contactus.php" class="home">Contact us</a></li>
                <li><a href="fee.php" class="home">Payment</a></li>
                <li><a href="logout.php" class="home">Logout</a></li>
    </ul>
  </nav>
    <div id="preloader"></div>

    <div class="limiter">
        <div class="container-login100">
            <div class="login100-more" style="background-image: url('img/carbgdash.jpg');"></div>
            <div class="wrap-login100 p-l-50 p-r-50 p-t-72 p-b-50">
                <?php
                $uid = $_SESSION['log']['useruid'];
                $qry = mysqli_query($con, "SELECT * FROM logtable WHERE useruid='$uid' ORDER BY id DESC");
                $qry1 = mysqli_num_rows($qry);
                if ($qry1) {
                    $row = mysqli_fetch_array($qry);
                    if ($row['payment'] == 'Paid') {
                        ?>
                        <form class="fee" method="post" action="booklot.php">
                            <span>
                                <h2 class="h2">Book a Free Slot</h2>
                            </span>

                            <div class="form-group">
                            <label for="category">Vehicle Category</label>
                            <select class="form-control" name="category" required="required">
                                <option value="Car">Car</option>
                                <option value="Motorcycle">Motorcycle</option>
                                <option value="Bicycle">Bicycle</option>
                                <option value="Van">Van</option>
                                <option value="SUV">SUV</option>
                                <option value="Electric Vehicle">Electric Vehicle</option>
                            </select>
                            </div>
                        
                            <div class="form-group">
                                <label for="vehicle">Vehicle No.</label>
                                <input class="form-control" type="text" name="vehicle" placeholder="Vehicle No...." required="required">
                            </div>

                            <div class="form-group">
                                <label for="fromtime">Entry date and time</label>
                                <input class="form-control" type="text" name="fromtime" placeholder="Date and time....." required="required">
                            </div>
                            <!-- <div class="form__div">
                            <div class="form__div">
                        <label class="form__group">Select Date: </label>
                        <input id="datepicker" class="inputBox" type="text" name="parkingDate" readonly />
                        <span class="focus-input100"></span>
                        </div>

                        <div class="form__div">
                        <label class="form__label">Select Time: </label>
                        <input id="timepicker" class="inputBox" type="text" name="fromime" readonly />
                        <span class="focus-input100"></span>
                        </div> -->
                            <div class="form-group">
                            <label for="Level">Level</label>
                            <select class="form-control" name="level" required="required">
                                <option value="1">Level 1</option>
                                <option value="2">Level 2</option>
                                <option value="3">Level 3</option>
                            </select>
                            </div>

                            <div class="form-group">
                                <label for="lot">Parking Lot</label>
                                <select class="form-control" name="lot" required="required">
                                    <?php
                                    $qry = mysqli_query($con, "SELECT * FROM lot WHERE status='Free' or status='Leaving'");
                                    while ($row = mysqli_fetch_array($qry)) {
                                        ?>
                                        <option value="<?php echo $row['lotname']; ?>"><?php echo $row['lotname']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="ckb1" name="remember-me" required="required">
                                <label class="form-check-label" for="ckb1">I agree to the <a href="#" class="red">Terms of User</a></label>
                            </div>

                            <div class="container-login100-form-btn">
                                <button class="btn1" type="submit">Book Now</button>
                            </div>
                        </form>
                    <?php
                    } else {
                        ?>
                        <form class="lot" method="post" action="booklot.php">
                            <span class="book">
                                <h1>One Lot has already been booked!</h1>
                            </span>
                        </form>
                    <?php
                    }
                } else {
                    ?>
                    <form class="fee" method="post" action="booklot.php">
                        <span class="login100-form-title p-b-59">
                            <h2 class="h2">Book a Free Slot</h2>
                        </span>

                        <div class="form-group">
                            <label for="category">Vehicle Category</label>
                            <input class="form-control" type="text" name="category" placeholder="Category...." required="required">
                        </div>

                        <div class="form-group">
                            <label for="vehicle">Vehicle No.</label>
                            <input class="form-control" type="text" name="vehicle" placeholder="Vehicle No...." required="required">
                        </div>

                        <div class="form-group">
                            <label for="fromtime">Entry date and time</label>
                            <input class="form-control" type="text" name="fromtime" placeholder="Date and time....." required="required">
                        </div>
                       <div class="form-group">
                            <label for="Level">Level</label>
                            <select class="form-control" name="level" required="required">
                                <option value="1">Level 1</option>
                                <option value="2">Level 2</option>
                                <option value="3">Level 3</option>
                            </select>
                            </div>


                        <div class="form-group">
                            <label for="lot">Parking Lot</label>
                            <select class="form-control" name="lot" required="required">
                                <?php
                                $qry = mysqli_query($con, "SELECT * FROM lot WHERE status='Free' or status='Leaving'");
                                while ($row = mysqli_fetch_array($qry)) {
                                    ?>
                                    <option value="<?php echo $row['lotname']; ?>"><?php echo $row['lotname']; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="ckb1" name="remember-me" required="required">
                            <label class="form-check-label" for="ckb1">I agree to the <a href="#" class="txt2 hov1">Terms of User</a></label>
                        </div>

                        <div class="container-login100-form-btn">
                            <button class="btn1" type="submit">Book Now</button>
                        </div>
                    </form>
                    <div class="lot-content">
    <span class="book">
        <h1>Booking Successful!</h1>
        <p>An email with the ticket details has been sent to your email address.</p>
    </span>
</div>

                <?php
                }
                ?>
                
            </div>
        </div>
    </div>

    <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>

    <script>
        $(window).on('load', function() {
            $('#preloader').fadeOut('slow', function() {
                $(this).remove();
            });
        });

        $(document).ready(function() {
            $(window).scroll(function() {
                if ($(this).scrollTop() > 100) {
                    $('.back-to-top').fadeIn('slow');
                } else {
                    $('.back-to-top').fadeOut('slow');
                }
            });

            $('.back-to-top').click(function() {
                $('html, body').animate({
                    scrollTop: 0
                }, 1500, 'easeInOutExpo');
                return false;
            });
        });
    </script>
 
</body>

</html>
