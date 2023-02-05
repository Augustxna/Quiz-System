<?php
require_once("auth.php");
require_once("link.php");

if (isset($_POST['uaaid']) && isset($_POST['uaname']) && ($_REQUEST['uaid'] == $_POST['uaaid'])) {
    
    $uaid = $_POST['uaaid'];
    $uaname = $_POST['uaname'];
    $uaname = stripslashes($uaname);
    $uaname = mysqli_real_escape_string($con, $uaname);
    $query = "SELECT admin_id, admin_name FROM admin WHERE admin_id = $uaid AND admin_name = '$uaname' ";
    $result = mysqli_query($con, $query) or die("SQL Sequence Invalid");
    $num = mysqli_num_rows($result);
    
    if ($num == 0) {
        
        $qone = "UPDATE admin SET admin_id = '$uaid' , admin_name = '$uaname' WHERE admin_id = '$uaid' ";
        $qor = mysqli_query($con, $qone) or die("SQL Sequence Invalid.");
        if ($qor) {
            $_SESSION['emsg'] = "Update Successful.";
            header("Location: adm_reg.php");
        } 
        
    } else {
        
        $_SESSION['emsg'] = "The update data is duplicated. Update Failure.";
        header("Location: adm_reg.php");
    }
} else {
    if (isset($_POST['uaaid']) && isset($_POST['uaname']) && ($_REQUEST['uaid'] != $_POST['uaaid'])) {
        $uaid = $_POST['uaaid'];
        $uaname = $_POST['uaname'];
        $uaname = stripslashes($uaname);
        $uaname = mysqli_real_escape_string($con, $uaname);
        $query = "SELECT admin_id, admin_name FROM admin WHERE admin_id = $uaid OR admin_name = '$uaname' ";
        $result = mysqli_query($con, $query) or die("SQL Sequence Invalid");
        $num = mysqli_num_rows($result);
    
        if ($num == 0) {
        
            $qone = "UPDATE admin SET admin_id = '$uaid' , admin_name = '$uaname' WHERE admin_id = '$uaid' ";
            $qor = mysqli_query($con, $qone) or die("SQL Sequence Invalid.");
            if ($qor) {
                $_SESSION['emsg'] = "Update Successful.";
                header("Location: adm_reg.php");
            } 
        
        } else {
        
            $_SESSION['emsg'] = "The update data is duplicated. Update Failure.";
            header("Location: adm_reg.php");
        } 
    }
}
?>