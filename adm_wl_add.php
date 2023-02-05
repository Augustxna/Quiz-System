<?php
require_once("auth.php");
require_once("link.php");

if (isset($_POST['lnaid']) && isset($_POST['scaid'])) {
    $lnaid = $_POST['lnaid'];
    $scaid = $_POST['scaid'];
    $query = "SELECT * FROM workload_lecturer WHERE lecturer_id = '$lnaid' AND subject_code = '$scaid' ";
    $result = mysqli_query($con, $query) or die("SQL Sequence Invalid");
    $row = mysqli_num_rows($result);
    if ($row == 0) {
        $qone = "INSERT INTO workload_lecturer (subject_code, lecturer_id) VALUES ('$scaid', $lnaid)";
        $qr = mysqli_query($con, $qone) or die("SQL Sequence Invalid");
        if ($qr) {
            $_SESSION['emsg'] = "Workload lecturer data added successful.";
            header("Location: adm_wl_reg.php");
        }
    } else {
         $_SESSION['emsg'] = "Unable to adding lecturer data. Failure for same ID occurrence.";
         header("Location: adm_wl_reg.php");
    }
}
?>