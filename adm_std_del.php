<?php
require_once("auth.php");
require_once("link.php");

if (isset($_REQUEST['uaid'])) {
    $uaid = $_REQUEST['uaid'];
    $qone = "SELECT * FROM student_registration WHERE student_id = '$uaid' ";
    $qor = mysqli_query($con, $qone) or die("SQL Sequence Invalid");
    $nqor = mysqli_num_rows($qor);
    if ($nqor == 0) {
        $qd = "DELETE FROM student WHERE student_id = '$uaid' ";
        $result = mysqli_query($con,$qd) or die("SQL Sequence Invalid");
        if ($result) {
            $_SESSION['emsg'] = "Student data delete successful.";
            header("Location: adm_std_reg.php");
        }
    } else {
        $_SESSION['emsg'] = "Unsuccessful ! Student data is being used in other tables.";
        header("Location: adm_std_reg.php");
    }
    
}
?>