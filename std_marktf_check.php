<?php
require_once("auth.php");
require_once("link.php");

if (isset($_REQUEST['halt'])) {
    $halt = $_REQUEST['halt']; //srid
    $wid = $_SESSION['swid'];
    $tfmark = $_SESSION['arrayA'];
    $q = "SELECT qtf_answer AS qn FROM quiz_tf WHERE wl_id = '$wid'";
    $qr = mysqli_query($con, $q) or die("SQL Sequence Invalid.");
    $container = array();
    
    while ($qrn = mysqli_fetch_assoc($qr)) {
         $container[] = $qrn["qn"];
    }
    
    $ccc = "SELECT COUNT(*) AS total FROM quiz_tf WHERE wl_id = '$wid' ";
    $cccr = mysqli_query($con, $ccc) or die("SQL invalid.");
    $cccrn = mysqli_fetch_assoc($cccr);
    $length = $cccrn["total"]; 
    $markcounter =0;
    $tmark = $length * 2;
     for($i = 0; $i< $length; $i++) {
         if ($tfmark[$i] == $container[$i]) {
             $markcounter += 2;
             
         } else {
             $markcounter += 0;
         }
     }
    
     $alp = "UPDATE student_registration SET qtf_mark = $markcounter WHERE sr_id = $halt ";
     $alpr = mysqli_query($con, $alp) or die("SQL Sequence Invalid.");
     if ($alpr) {
         $_SESSION['emsg'] = "Thank You! Your mark are $markcounter / $tmark.";
         header("Location: std_vqtf.php");
     }
    
}


?>