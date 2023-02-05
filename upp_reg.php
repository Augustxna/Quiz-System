<?php
require_once("auth.php");
require_once("link.php");

if (isset($_POST['np']) && isset($_POST['cp'])) {
    $uuid = $_SESSION['uid'];
    $bgv = $_REQUEST['bg'];
    $np = $_POST['np'];
    $cp = $_POST['cp'];
    $npn = md5("$np");
    $cpn = md5("$cp");
    
    if (($npn == $cpn) && ($bgv == 'std')) {
        $qone = "UPDATE student SET student_password = '$npn' WHERE student_id = '$uuid' ";
        $result = mysqli_query($con, $qone) or die("SQL sequence Invalid");
        if ($result) {
            $_SESSION['emsg'] = "Password update successful. Please log in again.";
            header("Location: login.php");
        }
    } else {
        if (($npn != $cpn) && ($bgv == 'std')) {
            $_SESSION['emsg'] = "The new password and confirmed password not same! Try again";
            header("Location: up_reg.php?bg=std");
        } else {
            if (($npn == $cpn) && ($bgv == 'lect')) {
                $qone = "UPDATE lecturer SET lecturer_password = '$npn' WHERE lecturer_id = '$uuid' ";
                $result = mysqli_query($con, $qone) or die("SQL sequence Invalid");
                if ($result) {
                    $_SESSION['emsg'] = "Password update successful. Please log in again.";
                    header("Location: login.php");
                }
            } else {
                if (($npn != $cpn) && ($bgv == 'lect')) {
                    $_SESSION['emsg'] = "The new password and confirmed password not same! Try again";
                    header("Location: up_reg.php?bg=lect");
                } else {
                    if (($npn == $cpn) && ($bgv == 'adm')) {
                        $qone = "UPDATE admin SET admin_password = '$npn' WHERE admin_id = '$uuid' ";
                        $result = mysqli_query($con, $qone) or die("SQL sequence Invalid");
                        if ($result) {
                            $_SESSION['emsg'] = "Password update successful. Please log in again.";
                            header("Location: login.php");
                        }
                    } else {
                        if (($npn != $cpn) && ($bgv == 'adm')) {
                            $_SESSION['emsg'] = "The new password and confirmed password not same! Try again";
                            header("Location: up_reg.php?bg=adm");
                        }
                    }
                }
            }
        }
    }
}
?>