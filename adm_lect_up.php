<?php
require_once("auth.php");
require_once("link.php");

if (isset($_POST['uaaid']) && isset($_POST['uaname']) && ($_REQUEST['xz'] == $_POST['uaaid'])) {
    $aid= $_SESSION['uid'];
    $uaid = $_POST['uaaid'];
    $uaname = $_POST['uaname'];
    $uaname = stripslashes($uaname);
    $uaname = mysqli_real_escape_string($con, $uaname);
    $query = "SELECT lecturer_id, lecturer_name FROM lecturer WHERE lecturer_id = $uaid AND lecturer_name = '$uaname' ";
    $result = mysqli_query($con, $query) or die("SQL Sequence Invalid");
    $num = mysqli_num_rows($result);
    
    if ($num == 0) {
        
        $qone = "UPDATE lecturer SET lecturer_id = '$uaid' , lecturer_name = '$uaname' , admin_id = '$aid' WHERE lecturer_id = '$uaid' ";
        $qor = mysqli_query($con, $qone) or die("SQL Sequence Invalid.");
        if ($qor) {
            $_SESSION['emsg'] = "Lecturer Data Update Successful.";
            header("Location: adm_lect_reg.php");
        } 
        
    } else {
        
        $_SESSION['emsg'] = "The update data is duplicated. Update Failure.";
        header("Location: adm_lect_reg.php");
    }
} else {
    if (isset($_POST['uaaid']) && isset($_POST['uaname']) && ($_REQUEST['xz'] != $_POST['uaaid'])) {
        $uaid = $_POST['uaaid'];
        $aid = $_SESSION['uid'];
        $uaname = $_POST['uaname'];
        $uaname = stripslashes($uaname);
        $uaname = mysqli_real_escape_string($con, $uaname);
        $query = "SELECT lecturer_id, lecturer_name FROM lecturer WHERE lecturer_id = $uaid OR lecturer_name = '$uaname' ";
        $result = mysqli_query($con, $query) or die("SQL Sequence Invalid");
        $num = mysqli_num_rows($result);
    
        if ($num == 0) {
        
            $qone = "UPDATE lecturer SET lecturer_id = '$uaid' , lecturer_name = '$uaname' , admin_id = '$aid' WHERE lecturer_id = '$uaid' ";
            $qor = mysqli_query($con, $qone) or die("SQL Sequence Invalid.");
            if ($qor) {
                $_SESSION['emsg'] = "Lecturer Data Update Successful.";
                header("Location: adm_lect_reg.php");
            } 
        
        } else {
        
            $_SESSION['emsg'] = "The update data is duplicated. Update Failure.";
            header("Location: adm_lect_reg.php");
        } 
    }
}
?>