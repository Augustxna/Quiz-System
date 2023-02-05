<?php 
require_once("link.php");
require_once("auth.php");

if (isset($_POST['tf']) && isset($_REQUEST['check'])) {
        $wid = $_SESSION['swid'];
        $tf = $_POST['tf'];
        $no = $_REQUEST['check'];
    
        if($tf == 1) {
            $_SESSION['arrayA'][$no] = 1;
            $_SESSION['flag'][$no] = 1;
            $_SESSION['emsg'] = $tf;
            header("Location: std_vqtf.php");
        } else {
            if ($tf == 0) {
                $_SESSION['arrayA'][$no] = 0;
                $_SESSION['flag'][$no] = 1;
                $_SESSION['emsg'] = "$no";
                header("Location: std_vqtf.php");
            }
        }
}

?>