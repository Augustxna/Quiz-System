<?php
require_once("auth.php");
require_once("link.php");

if (isset($_REQUEST['uaid'])) {
    $uaid = $_REQUEST['uaid'];
    $qone = "SELECT * FROM subject WHERE admin_id = '$uaid' ";
    $qor = mysqli_query($con, $qone) or die("SQL Sequence Invalid");
    $nqor = mysqli_num_rows($qor);
    $qtwo = "SELECT * FROM student WHERE admin_id= '$uaid' ";
    $qtr = mysqli_query($con, $qtwo) or die("SQL Sequence Invalid");
    $nqtr = mysqli_num_rows($qtr);
    $qthre = "SELECT * FROM lecturer WHERE admin_id= '$uaid' ";
    $qthr = mysqli_query($con, $qthre) or die("SQL Sequence Invalid");
    $nqthr = mysqli_num_rows($qthr);
    if (($nqor == 0) && ($nqtr == 0) && ($nqthr == 0)) {
        $qd = "DELETE FROM admin WHERE admin_id = '$uaid' ";
        $result = mysqli_query($con,$qd) or die("SQL Sequence Invalid");
        if ($result) {
            $_SESSION['emsg'] = "Admin data delete successful.";
            header("Location: adm_reg.php");
        }
    } else {
        $_SESSION['emsg'] = "Unsuccessful ! Admin data is being used in other tables.";
        header("Location: adm_reg.php");
    }
    
}
?>