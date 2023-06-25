<?php
session_start();
date_default_timezone_set('Asia/Kolkata');
include('config.php');

$veh = $_POST['vehicle'];
$lot = $_POST['lot'];
$cat = $_POST['category'];
$lev = $_POST['level'];
$uid = $_SESSION['log']['useruid'];
$fromtime = $_POST['fromtime'];
$totime = date('Y-m-d H:i:s');

// Start a transaction
mysqli_autocommit($con, false);

// Check if the slot is already booked
$query = "SELECT status FROM lot WHERE lotname='$lot' FOR UPDATE";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);
$status = $row['status'];

if ($status == 'Booked') {
    // Slot is already booked
    $message = "Sorry, the selected slot has already been booked. Please choose another slot.";
    echo $message;
   
} else {
    // Proceed with booking
    $qry = mysqli_query($con, "INSERT INTO logtable (useruid, level, lotname, vehicleno, category, fromtime, totime, status) VALUES ('$uid', '$lev', '$lot', '$veh', '$cat', '$fromtime', '$totime', 'Ongoing booking')");
    $qry1 = mysqli_query($con, "UPDATE lot SET status='Booked' WHERE level = $lev AND lotname='$lot'");

    if ($qry && $qry1) {
        // Commit the transaction
        mysqli_commit($con);
        $message = "Slot booked successfully!";
    } else {
        // Rollback the transaction
        mysqli_rollback($con);
        $message = "Failed to book the slot. Please try again.";
    }
}

// Enable autocommit again
mysqli_autocommit($con, true);

header("location:dashboard.php");
?>
