<?php
require_once("auth.php");
require_once("link.php");

    $_SESSION['emsg'] = "You took the quiz!";
    header("Location: std_reg_list.php");

?>