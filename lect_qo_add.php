<?php
require_once("auth.php");
require_once("link.php");

if (isset($_POST['question']) && isset($_POST['tans']) && isset($_POST['ansa']) && isset($_POST['ansb']) && isset($_POST['ansc']) && isset($_POST['ansd'])) {
    $wid = $_SESSION['swid'];
    $question = $_POST['question'];
    $ansa = $_POST['ansa'];
    $ansb = $_POST['ansb'];
    $ansc = $_POST['ansc'];
    $ansd = $_POST['ansd'];
    $tans = $_POST['tans'];
    $qone = "INSERT INTO quiz_mc (qmc_question, wl_id, qmc_answer, qmc_choicea,  qmc_choiceb,  qmc_choicec,  qmc_choiced, qmc_mod_date) VALUES ('$question', $wid,'$tans', '$ansa', '$ansb', '$ansc', '$ansd', current_timestamp())";
    $qr = mysqli_query($con, $qone) or die("SQL Sequence Invalid");
    if ($qr) {
        $_SESSION['emsg'] = "Question data added successful.";
        header("Location: lect_vqo.php");
    }
}
?>