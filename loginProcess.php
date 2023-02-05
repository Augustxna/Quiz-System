<?php
require_once("link.php");
session_start();

if (isset($_POST['id']) && isset($_POST['password']) &&  (!isset($_POST['bg']))) {
    $_SESSION['emsg'] = "*Choose either Student Login ，Lecturer Login or Admin Login. Try Again!";
    header("Location: login.php");
} else {
    if (isset($_POST['id']) && isset($_POST['password']) &&  (isset($_POST['bg']))) {
        $uid = $_POST['id']; 
        $uid = stripslashes($uid);
        $uid = mysqli_real_escape_string($con, $uid);
        $pwd = $_POST['password'];
        $pwd = stripslashes($pwd);
        $pwd = mysqli_real_escape_string($con, $pwd);
        $pswd = md5("$pwd");
        $bg_value = $_POST['bg'];
        if ($bg_value == 'std' && ($pwd == $uid)) {
            $query = "SELECT * FROM student WHERE student_id = '$uid' AND student_password = '$pswd' ";
            $result = mysqli_query($con, $query) or die("SQL is invalid.");
            $row = mysqli_num_rows($result);
            if ($row == 1) {
                $_SESSION['uid'] = $uid;
                header("Location: up_reg.php?bg=std");
            } else {
                $_SESSION['emsg'] = "Incorrect Student No or Password. Try Again!";
                header("Location: login.php");
            }
        } else {
            if ($bg_value == 'lect' && ($pwd == $uid)) {
                $query = "SELECT * FROM lecturer WHERE lecturer_id = '$uid' AND lecturer_password = '$pswd' ";
                $result = mysqli_query($con, $query) or die("SQL is invalid.");
                $row = mysqli_num_rows($result);
                if ($row == 1) {
                    $_SESSION['uid'] = $uid;
                    header("Location: up_reg.php?bg=lect");
                } else {
                    $_SESSION['emsg'] = "Incorrect Lecturer No or Password. Try Again!";
                    header("Location: login.php");
                }
            } else {
                if ($bg_value == 'adm' && ($pwd == $uid)) {
                    $query = "SELECT * FROM admin WHERE admin_id = '$uid' AND admin_password = '$pswd' ";
                    $result = mysqli_query($con, $query) or die("SQL is invalid.");
                    $row = mysqli_num_rows($result);
                    if ($row == 1) {
                        $_SESSION['uid'] = $uid;
                        header("Location: up_reg.php?bg=adm");
                    } else {
                        $_SESSION['emsg'] = "Incorrect Admin No or Password. Try Again!";
                        header("Location: login.php");
                    }
                } else {
                    if ($bg_value == 'std' && ($pwd != $uid)) {
                        $query = "SELECT * FROM student WHERE student_id = '$uid' AND student_password = '$pswd' ";
                        $result = mysqli_query($con, $query) or die("SQL is invalid.");
                        $row = mysqli_num_rows($result);
                        if ($row == 1) {
                            $_SESSION['uid'] = $uid;
                            header("Location: std_reg.php");
                        } else {
                            $_SESSION['emsg'] = "Incorrect Student No or Password. Try Again!";
                            header("Location: login.php");
                        }
                     } else {
                            if ($bg_value == 'lect' && ($pwd != $uid)) {
                                $query = "SELECT * FROM lecturer WHERE lecturer_id = '$uid' AND lecturer_password = '$pswd' ";
                                $result = mysqli_query($con, $query) or die("SQL is invalid.");
                                $row = mysqli_num_rows($result);
                                if ($row == 1) {
                                    $_SESSION['uid'] = $uid;
                                    header("Location: lect_reg.php");
                                } else {
                                    $_SESSION['emsg'] = "Incorrect Lecturer No or Password. Try Again!";
                                    header("Location: login.php");
                                }
                            } else {
                                if ($bg_value == 'adm' && ($pwd != $uid)) {
                                    $query = "SELECT * FROM admin WHERE admin_id = '$uid' AND admin_password = '$pswd' ";
                                    $result = mysqli_query($con, $query) or die("SQL is invalid.");
                                    $row = mysqli_num_rows($result);
                                    if ($row == 1) {
                                        $_SESSION['uid'] = $uid;
                                        header("Location: admin_dashboard.php");
                                    } else {
                                        $_SESSION['emsg'] = "Incorrect Admin No or Password. Try Again!";
                                        header("Location: login.php");
                                    }
                                }
                            }
                        }
                    }
                }
          }
    }
}

?>