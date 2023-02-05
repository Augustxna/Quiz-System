<?php
require_once("auth.php");
require_once("link.php");

$wid = $_REQUEST['wid'];
$sid = $_SESSION['uid'];

$qq = "SELECT * FROM student_registration WHERE student_id = '$sid' AND wl_id = '$wid' ";
$rs = mysqli_query($con, $qq) or die("Invalid SQL Sequence.");
$row = mysqli_fetch_assoc($rs);
if ($row) {
    $_SESSION['emsg'] = "You have already registered the subject!";
    header("Location: std_reg.php");
} else {
    $qone = "INSERT INTO student_registration (student_id, wl_id) VALUES ('$sid', '$wid') ";
    $result = mysqli_query($con, $qone) or die("Invalid SQL Sequence.");

    if ($result) {
        $_SESSION['emsg'] = "Register successful.";
        header("Location: std_reg.php");
    } else {
        echo "Register Failure.";
    }
}
 
?>