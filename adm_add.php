<?php
require_once("auth.php");
require_once("link.php");

if (isset($_POST['uaaid']) && isset($_POST['uaname'])) {
    $uaaid = $_POST['uaaid'];
    $uaname = $_POST['uaname'];
    $uaname = stripslashes($uaname);
    $uaname = mysqli_real_escape_string($con, $uaname);
    $up = md5("$uaaid");
    $query = "SELECT * FROM admin WHERE admin_id = '$uaaid' ";
    $result = mysqli_query($con, $query) or die("SQL Sequence Invalid");
    $row = mysqli_num_rows($result);
    if ($row == 0) {
        $qone = "INSERT INTO admin (admin_id, admin_name, admin_password) VALUES ($uaaid, '$uaname', '$up')";
        $qr = mysqli_query($con, $qone) or die("SQL Sequence Invalid");
        if ($qr) {
            $_SESSION['emsg'] = "Admin data added successful.";
            header("Location: adm_reg.php");
        }
    } else {
         $_SESSION['emsg'] = "Unable to adding admin data. Failure for same ID occurrence.";
         header("Location: adm_reg.php");
    }
}
?>