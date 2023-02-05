<?php
require_once("auth.php");
require_once("link.php");

if (isset($_REQUEST['uaid'])) {
    $uaid = $_REQUEST['uaid'];
    
    $qd = "DELETE FROM quiz_tf WHERE qtf_id = $uaid ";
    $result = mysqli_query($con,$qd) or die("SQL Sequence Invalid");
    if ($result) {
        $_SESSION['emsg'] = "Selected question delete successful.";
        header("Location: lect_vqtf.php");
    } 
}
?>