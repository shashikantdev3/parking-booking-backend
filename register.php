<?php
include('config.php');
$name = htmlspecialchars(ucfirst($_POST['name']), ENT_QUOTES, 'UTF-8');
$email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
$address = htmlspecialchars($_POST['address'], ENT_QUOTES, 'UTF-8');
$aadhar = htmlspecialchars($_POST['aadhar'], ENT_QUOTES, 'UTF-8');
$contact = htmlspecialchars($_POST['contact'], ENT_QUOTES, 'UTF-8');
$registrationdate = htmlspecialchars($_POST['registrationdate'], ENT_QUOTES, 'UTF-8');
$passwrd = base64_encode($_POST['pass']);
$repasswrd = base64_encode($_POST['repass']);
// $gf=htmlspecialchars($_POST['mytext']);
$qry = mysqli_query($con,"SELECT * FROM user WHERE email='$email' ");
$qry1 = mysqli_num_rows($qry);
$file = 'count.txt';
//get the number from the file
$uniq = file_get_contents($file);
//add +1
$uid = $uniq + 1 ;
// add that new value to text file again for next use
file_put_contents($file, $uid);
if($qry1==0 and $passwrd==$repasswrd)
{
    $sql = mysqli_query($con,"INSERT INTO user (name, email, password, contact,registrationdate, aadhar, address, useruid) VALUES ('$name', '$email', '$passwrd', '$contact' , '$registrationdate' ,'$aadhar', '$address', '$uid') ")or die(mysqli_error($con));
    $qry = mysqli_query($con,"SELECT * FROM user WHERE email='$email' and password='$passwrd' ")or die(mysqli_error($con));
    session_start();
    $row = mysqli_fetch_array($qry);
    $_SESSION['log']=$row;
    $keys="user";
    $_SESSION['log1']=$keys;
    header("location:dashboard.php");
}
else
{
    if($passwrd != $repasswrd)
    {
        ?>
        <script>
            alert("Password Doesn't Match.")
            window.location.href = "signup.php";
        </script>
        <?php
    }
    else
    {
        ?>
        <script>
            alert("Email Already Registered.")
            window.location.href = "signup.php";
        </script>
        <?php
    }
}
?>