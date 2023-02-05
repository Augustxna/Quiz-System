<?php
require_once("auth.php");
require_once("link.php");

if (isset($_REQUEST['uaid'])) {
    $uaid = $_REQUEST['uaid'];
    
    $qone = "SELECT * FROM quiz_tf WHERE wl_id = $uaid ";
    $qoner = mysqli_query($con, $qone) or die("SQL Sequence Invalid");
    $nqoner = mysqli_num_rows($qoner);
    
    $qtwo = "SELECT * FROM quiz_mc WHERE wl_id = $uaid ";
    $qtwor = mysqli_query($con, $qtwo) or die("SQL Sequence Invalid");
    $nqtwor = mysqli_num_rows($qtwor);
    
    $qthree = "SELECT * FROM student_registration WHERE wl_id = $uaid ";
    $qthreer = mysqli_query($con, $qthree) or die("SQL Sequence Invalid");
    $nqthreer = mysqli_num_rows($qthreer);
    
    if ($nqoner == 0  && $nqtwor == 0 && nqthreer == 0) {
        $qd = "DELETE FROM workload_lecturer WHERE wl_id = $uaid ";
        $result = mysqli_query($con,$qd) or die("SQL Sequence Invalid");
        if ($result) {
            $_SESSION['emsg'] = "Workload lecturer data delete successful.";
            header("Location: adm_wl_reg.php");
        }
    } else {
        $_SESSION['emsg'] = "Unsuccessful ! Workload lecturer data is being used in other tables.";
        header("Location: adm_wl_reg.php");
    }
    
}
?>