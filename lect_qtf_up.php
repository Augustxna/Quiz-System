<?php
require_once("auth.php");
require_once("link.php");

if (isset($_POST['question']) && isset($_POST['ans']) && isset($_REQUEST['xz'])) {
    $qn = $_POST['question'];
    $xz = $_REQUEST['xz'];
    $qone = "UPDATE quiz_tf SET qtf_question = '$qn' , qtf_answer = 1 WHERE qtf_id = $xz";
    $qor = mysqli_query($con, $qone) or die("SQL Sequence Invalid.");
    if ($qor) {
            $_SESSION['emsg'] = "The Question Update Successful.";
            header("Location: lect_vqtf.php");
    } 
        
} else {
    if (isset($_POST['question']) && !isset($_POST['ans']) && isset($_REQUEST['xz'])) {
        $qn = $_POST['question'];
        $xz = $_REQUEST['xz'];
        $qone = "UPDATE quiz_tf SET qtf_question = '$qn' , qtf_answer = 0 WHERE qtf_id = $xz ";
        $qor = mysqli_query($con, $qone) or die("SQL Sequence Invalid.");
        if ($qor) {
            $_SESSION['emsg'] = "The Question Update Successful.";
            header("Location: lect_vqtf.php");
        } 
    }
}
?>