<?php
include('config.php');

$query = "SELECT DISTINCT `level` FROM lot";
$result = mysqli_query($con, $query);

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $level = $row['level'];
        echo '<h3>Level ' . $level . '</h3>';
        echo '<div class="row">';

        $query2 = "SELECT * FROM lot WHERE `level` = $level";
        $result2 = mysqli_query($con, $query2);

        if ($result2 && mysqli_num_rows($result2) > 0) {
            while ($row2 = mysqli_fetch_assoc($result2)) {
                $spotName = $row2['lotname'];
                $status = $row2['status'];

                $spotClass = '';
                $spotText = '';

                if ($status == 'Free') {
                    $spotClass = 'free';
                    $spotText = 'Book Now';
                } else if ($status == 'Leaving') {
                    $spotClass = 'leaving';
                    $spotText = 'Leaving Soon';
                } else {
                    $spotClass = 'booked';
                    $spotText = 'Booked';
                }

                echo '<div class="col-md-3">';
                echo '<div class="spot-status ' . $spotClass . '">';
                echo '<a href="book.php" title="Amount per hour: ' . 60 . '">';
                echo $spotText . '<br>Parking Lot - ' . $spotName;
                echo '</a>';
                echo '</div>';
                echo '</div>';
            }
        }

        echo '</div>';
    }
}
?>
