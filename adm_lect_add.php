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
    $up = md5("$uaaid");
    $adminid = $_SESSION['uid'];
    $query = "SELECT * FROM lecturer WHERE lecturer_id = '$uaaid' ";
    $result = mysqli_query($con, $query) or die("SQL Sequence Invalid");
    $row = mysqli_num_rows($result);
    if ($row == 0) {
        $qone = "INSERT INTO lecturer (lecturer_id, lecturer_name, lecturer_password, admin_id, lecturer_mod_date) VALUES ('$uaaid', '$uaname', '$up', '$adminid', current_timestamp() )";
        $qr = mysqli_query($con, $qone) or die("SQL Sequence Invalid");
        if ($qr) {
            $_SESSION['emsg'] = "Lecturer data added successful.";
            header("Location: adm_lect_reg.php");
        }
    } else {
         $_SESSION['emsg'] = "Unable to adding lecturer data. Failure for same ID occurrence.";
         header("Location: adm_lect_reg.php");
    }
}
?>