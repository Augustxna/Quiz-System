<?php 
require_once("link.php");
require_once("auth.php");

if (isset($_POST['ans']) && isset($_REQUEST['check'])) {
        $wid = $_SESSION['swid'];
        $ans = $_POST['ans'];
        $no = $_REQUEST['check'];
    
        if($ans == A || $ans == a) {
            $_SESSION['arrayA'][$no] = "a";
            $_SESSION['flag'][$no] = 1;
            header("Location: std_vqo.php");
        } else {
            if ($ans == B || $ans == b) {
                $_SESSION['arrayA'][$no] = "b";
                $_SESSION['flag'][$no] = 1;
                header("Location: std_vqo.php");
            } else {
                if ($ans == C || $ans == c) {
                    $_SESSION['arrayA'][$no] = "c";
                    $_SESSION['flag'][$no] = 1;
                    header("Location: std_vqo.php");
                } else {
                    if ($ans == C || $ans == c) {
                        $_SESSION['arrayA'][$no] = "d";
                        $_SESSION['flag'][$no] = 1;
                        header("Location: std_vqo.php");
                    }
                }
            }
        }
}

?>