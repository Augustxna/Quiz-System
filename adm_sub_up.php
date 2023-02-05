<?php
require_once("auth.php");
require_once("link.php");

if (isset($_POST['uaaid']) && isset($_POST['uaname']) && ($_REQUEST['xz'] == $_POST['uaaid'])) {
    
    $uaid = $_POST['uaaid'];
    $uaname = $_POST['uaname'];
    $uaname = stripslashes($uaname);
    $uaname = mysqli_real_escape_string($con, $uaname);
    $query = "SELECT subject_code, subject_name FROM subject WHERE subject_code = '$uaid' AND subject_name = '$uaname' ";
    $result = mysqli_query($con, $query) or die("SQL Sequence Invalid");
    $num = mysqli_num_rows($result);
    
    if ($num == 0) {
        
        $qone = "UPDATE subject SET subject_code = '$uaid' , subject_name = '$uaname' WHERE subject_code = '$uaid' ";
        $qor = mysqli_query($con, $qone) or die("SQL Sequence Invalid.");
        if ($qor) {
            $_SESSION['emsg'] = "Subject Data Update Successful.";
            header("Location: adm_sub_reg.php");
        } 
        
    } else {
        
        $_SESSION['emsg'] = "The update data is duplicated. Update Failure.";
        header("Location: adm_sub_reg.php");
    }
} else {
    if (isset($_POST['uaaid']) && isset($_POST['uaname']) && ($_REQUEST['xz'] != $_POST['uaaid'])) {
        $uaid = $_POST['uaaid'];
        $uaname = $_POST['uaname'];
        $uaname = stripslashes($uaname);
        $uaname = mysqli_real_escape_string($con, $uaname);
        $query = "SELECT subject_code, subject_name FROM subject WHERE subject_code = '$uaid' OR subject_name = '$uaname' ";
        $result = mysqli_query($con, $query) or die("SQL Sequence Invalid");
        $num = mysqli_num_rows($result);
    
        if ($num == 0) {
        
            $qone = "UPDATE subject SET subject_code = '$uaid' , subject_name = '$uaname' WHERE subject_code = '$uaid' ";
            $qor = mysqli_query($con, $qone) or die("SQL Sequence Invalid.");
            if ($qor) {
                $_SESSION['emsg'] = "Subject Data Update Successful.";
                header("Location: adm_sub_reg.php");
            } 
        
        } else {
        
            $_SESSION['emsg'] = "The update data is duplicated. Update Failure.";
            header("Location: adm_sub_reg.php");
        } 
    }
}
?>