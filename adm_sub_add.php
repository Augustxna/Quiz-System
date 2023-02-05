<?php
require_once("auth.php");
require_once("link.php");

if (isset($_POST['uaaid']) && isset($_POST['uaname'])) {
    $uaaid = $_POST['uaaid'];
    $uaaid = stripslashes($uaaid);
    $uaaid = mysqli_real_escape_string($con, $uaaid);
    $uaname = $_POST['uaname'];
    $uaname = stripslashes($uaname);
    $uaname = mysqli_real_escape_string($con, $uaname);
    $adminid = $_SESSION['uid'];
    $query = "SELECT * FROM subject WHERE subject_code = '$uaaid' ";
    $result = mysqli_query($con, $query) or die("SQL Sequence Invalid");
    $row = mysqli_num_rows($result);
    if ($row == 0) {
        $qone = "INSERT INTO subject (subject_code, subject_name, admin_id, subject_mod_date) VALUES ('$uaaid', '$uaname', '$adminid', current_timestamp() )";
        $qr = mysqli_query($con, $qone) or die("SQL Sequence Invalid");
        if ($qr) {
            $_SESSION['emsg'] = "Subject data added successful.";
            header("Location: adm_sub_reg.php");
        }
    } else {
         $_SESSION['emsg'] = "Unable to adding subject data. Failure for same ID occurrence.";
         header("Location: adm_sub_reg.php");
    }
}
?>