<?php
require_once("auth.php");
require_once("link.php");
?>
<html>
<head>
    <title>View Result Quiz Objective</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="lect_quiz_css.css">
</head>
<body>

   <div class="topnav">
    
        <a href="lect_reg.php">List Subject</a>
        <a href="logout.php">Logout</a>
        
    </div>
    
    <?php 
        if (isset($_REQUEST['wid'])){
        $wid = $_REQUEST['wid'];
        $aq = "SELECT workload_lecturer.subject_code AS sc, subject.subject_name AS sn FROM workload_lecturer JOIN subject ON workload_lecturer.subject_code = subject.subject_code WHERE wl_id = $wid ";
        $aqr = mysqli_query($con, $aq) or die("SQL sentence invalid.");
        while ($aqrn = mysqli_fetch_assoc($aqr)){ ?>
             <p>Subject Code: <?php echo $aqrn["sc"]; ?></p>
             <p>Subject Name: <?php echo $aqrn["sn"]; ?></p>
    <?php }} ?>
    
    <div class="table">
        
        <table width="100%" border="1" style="border-collapse:collapse;">
        
            <thead>
            
                <tr>
                    <td><h3>No</h3></td>
                    <td><h3>Student ID</h3></td>
                    <td><h3>Student Name</h3></td>
                    <td><h3>Result Quiz Objective</h3></td>
                </tr>
                
            </thead>
        
            <tbody>
                
            <?php 
            $s = 1;
            $pass = 0;
            $fail = 0;
            if (isset($_REQUEST['wid'])) {
                $wid = $_REQUEST['wid'];
                $cq = "SELECT COUNT(*) AS total FROM quiz_tf WHERE wl_id = $wid";
                $cqr = mysqli_query($con, $cq);
                $cqrow = mysqli_fetch_assoc($cqr);
                $bq = "SELECT student_registration.sr_id AS srid, student_registration.student_id AS sid, student.student_name AS sn, student_registration.qmc_mark AS qmm FROM student_registration JOIN student ON student.student_id = student_registration.student_id WHERE student_registration.wl_id = $wid";
                $rb = mysqli_query($con, $bq);
                while ($row = mysqli_fetch_assoc($rb)) { ?>
                
                <tr>
                <td><?php echo $s; ?><span class="hide"><?php echo $row["srid"]?></span></td>  
                <td><?php echo $row["sid"]; ?></td>
                <td><?php echo $row["sn"];?></td>
                <td><?php echo $row["qmm"]; 
                    if ($row["qmm"] < $cqrow["total"]) {
                        ++$fail;
                    } else {
                        ++$pass;
                    } ?></td>
                </tr>
            <?php  $s++; }} ?>
            
            </tbody>   
        
        
        </table>
        
       <p>
            
            <?php 
            echo "Number student pass: ".$pass.". Number of student fail: ".$fail.".";
            ?>
        
       </p>
    
    </div>
    
</body>
</html>