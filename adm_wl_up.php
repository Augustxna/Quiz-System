<?php
require_once("auth.php");
require_once("link.php");

if (isset($_POST['lnaid']) && isset($_POST['scaid']) && $_REQUEST['xz'] ) {
    
    $lnaid = $_POST['lnaid'];
    $scaid = $_POST['scaid'];
    $wlnoid = $_REQUEST['xz'];
    $query = "SELECT subject_code, lecturer_id FROM workload_lecturer WHERE lecturer_id = $lnaid AND subject_code = '$scaid' ";
    $result = mysqli_query($con, $query) or die("SQL Sequence Invalid");
    $num = mysqli_num_rows($result);
    
    if ($num == 0) {
        
        $qone = "UPDATE workload_lecturer SET lecturer_id = '$lnaid' , subject_code = '$scaid' WHERE wl_id = '$wlnoid' ";
        $qor = mysqli_query($con, $qone) or die("SQL Sequence Invalid.");
        if ($qor) {
            $_SESSION['emsg'] = "Workload Lecturer Data Update Successful.";
            header("Location: adm_wl_reg.php");
        } 
        
    } else {
        
        $_SESSION['emsg'] = "The update data is duplicated. Update Failure.";
        header("Location: adm_wl_reg.php");
    }
} 
?>