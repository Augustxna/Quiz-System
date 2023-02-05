<?php
require_once("auth.php");
require_once("link.php");

if (isset($_POST['question']) && isset($_POST['tans']) && isset($_POST['ansa']) && isset($_POST['ansb']) && isset($_POST['ansc']) && isset($_POST['ansd']) && isset($_REQUEST['xz'])) {
    $xz = $_REQUEST['xz'];
    $question = $_POST['question'];
    $ansa = $_POST['ansa'];
    $ansb = $_POST['ansb'];
    $ansc = $_POST['ansc'];
    $ansd = $_POST['ansd'];
    $tans = $_POST['tans'];
    $qone = "UPDATE quiz_mc SET qmc_question = '$question' , qmc_answer = '$tans', qmc_choicea = '$ansa', qmc_choiceb = '$ansb', qmc_choicec = '$ansc', qmc_choiced = '$ansd' WHERE qmc_id = $xz";
    $qor = mysqli_query($con, $qone) or die("SQL Sequence Invalid.");
    if ($qor) {
            $_SESSION['emsg'] = "The Question Update Successful.";
            header("Location: lect_vqo.php");
    }
        
} 
?>