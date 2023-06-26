<?php
session_start();
include('config.php');
include('sessioncheck.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fromTime = $_POST['fromtime'];
    $toTime = $_POST['totime'];

    // Calculate the fee based on the from time and to time
    $from = new DateTime($fromTime);
    $to = new DateTime($toTime);
    $diff = $to->diff($from);
    $hours = $diff->h;
    $hours += $diff->days * 24;
    $fee = 60 * $hours;
    $fee = round($fee, 0, PHP_ROUND_HALF_UP);

    echo "Fee generated: $fee";
} else {
    echo '
    <form class="login100-form validate-form flex-sb flex-w" method="post" action="">
        <span class="login100-form-title p-b-53">
            <div class="fee">
                <h1>Generate Fee</h1>
            </div>
        </span>

        <div>
            <label for="fromtime">From Time:</label>
            <input class="amount" type="datetime-local" name="fromtime" required/>
            <span class="focus-input100"></span>
        </div>

        <div>
            <label for="totime">To Time:</label>
            <input class="amount" type="datetime-local" name="totime" required/>
            <span class="focus-input100"></span>
        </div>

        <div class="container-login100-form-btn m-t-17">
            <button class="btn1" type="submit">Generate</button>
        </div>
    </form>';
}
?>
