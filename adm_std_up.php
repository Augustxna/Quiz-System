<?php
require_once("auth.php");
require_once("link.php");

if (isset($_POST['uaaid']) && isset($_POST['uaname']) && ($_REQUEST['xz'] == $_POST['uaaid'])) {
    $aid = $_SESSION['uid'];
    $uaid = $_POST['uaaid'];
    $uaid = stripslashes($uaid);
    $uaid = mysqli_real_escape_string($con, $uaid);
    $uaname = $_POST['uaname'];
    $uaname = stripslashes($uaname);
    $uaname = mysqli_real_escape_string($con, $uaname);
    $query = "SELECT student_id, student_name FROM student WHERE student_id = '$uaid' AND student_name = '$uaname' ";
    $result = mysqli_query($con, $query) or die("SQL Sequence Invalid");
    $num = mysqli_num_rows($result);
    
    if ($num == 0) {
        
        $qone = "UPDATE student SET student_id = '$uaid' , student_name = '$uaname' , admin_id = '$aid' WHERE student_id = '$uaid' ";
        $qor = mysqli_query($con, $qone) or die("SQL Sequence Invalid.");
        if ($qor) {
            $_SESSION['emsg'] = "Student Data Update Successful.";
            header("Location: adm_std_reg.php");
        } 
        
    } else {
        
        $_SESSION['emsg'] = "The update data is duplicated. Update Failure.";
        header("Location: adm_std_reg.php");
    }
} else {
    if (isset($_POST['uaaid']) && isset($_POST['uaname']) && ($_REQUEST['xz'] != $_POST['uaaid'])) {
        $aid = $_SESSION['uid'];
        $uaid = $_POST['uaaid'];
        $uaid = stripslashes($uaid);
        $uaid = mysqli_real_escape_string($con, $uaid);
        $uaname = $_POST['uaname'];
        $uaname = stripslashes($uaname);
        $uaname = mysqli_real_escape_string($con, $uaname);
        $query = "SELECT student_id, student_name FROM student WHERE student_id = '$uaid' OR student_name = '$uaname' ";
        $result = mysqli_query($con, $query) or die("SQL Sequence Invalid");
        $num = mysqli_num_rows($result);
    
        if ($num == 0) {
        
            $qone = "UPDATE student SET student_id = '$uaid' , student_name = '$uaname', admin_id = '$aid' WHERE student_id = '$uaid' ";
            $qor = mysqli_query($con, $qone) or die("SQL Sequence Invalid.");
            if ($qor) {
                $_SESSION['emsg'] = "Student Data Update Successful.";
                header("Location: adm_std_reg.php");
            } 
        
        } else {
        
            $_SESSION['emsg'] = "The update data is duplicated. Update Failure.";
            header("Location: adm_std_reg.php");
        } 
    }
}
?>