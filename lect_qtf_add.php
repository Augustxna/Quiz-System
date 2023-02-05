<?php
require_once("auth.php");
require_once("link.php");

if (isset($_POST['question']) && isset($_POST['ans'])) {
    $wid = $_SESSION['swid'];
    $question = $_POST['question'];
    $qone = "INSERT INTO quiz_tf (qtf_question, wl_id, qtf_answer, qtf_mod_date) VALUES ('$question', $wid, 1, current_timestamp())";
    $qr = mysqli_query($con, $qone) or die("SQL Sequence Invalid");
    if ($qr) {
        $_SESSION['emsg'] = "Question data added successful.";
        header("Location: lect_vqtf.php");
    }
} else {
    if (isset($_POST['question']) && !isset($_POST['ans'])) {
        $wid = $_SESSION['swid'];
        $question = $_POST['question'];
        $qone = "INSERT INTO quiz_tf (qtf_question, wl_id, qtf_answer, qtf_mod_date) VALUES ('$question', $wid, 0, current_timestamp())";
        $qr = mysqli_query($con, $qone) or die("SQL Sequence Invalid");
        if ($qr) {
            $_SESSION['emsg'] = "Question data added successful.";
            header("Location: lect_vqtf.php");
    }
    }
}
?>