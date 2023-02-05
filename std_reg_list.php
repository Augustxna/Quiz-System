<?php
require_once("auth.php");
require_once("link.php");
?>
<html>
<head>
    <title>Subject List Registered</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="std_reg_list_css.css">
</head>
<body>
    <div class="top-nav">
    
        <ul>
            
        <li><a href="std_reg.php">Register Subject</a></li>
        <li><a href="logout.php">Log Out</a></li>
            
        </ul>    
    
    </div>
    <h2>Subject List:</h2>
    
    <div class="table">
        
        <table width="100%" border="1" style="border-collapse:collapse;">
        
            <thead>
            
                <tr>
                    <td><h3>No</h3></td>
                    <td><h3>Lecturer</h3></td>
                    <td><h3>Subject</h3></td>
                    <td><h3>Mark T/F</h3></td>
                    <td><h3>Quiz T/F</h3></td>
                    <td><h3>Mark Subjective</h3></td>
                    <td><h3>Quiz Subjective</h3></td>
                </tr>
                
            </thead>
        
            <tbody>
            
                <?php 
                unset($_SESSION['swid']);
                unset($_SESSION['arrayA']);
                unset($_SESSION['flag']);
                unset($_SESSION['srid']);
                $count = 1;
                $suid = $_SESSION['uid'];
                $query = "SELECT * FROM workload_lecturer";
                $qone = "SELECT workload_lecturer.wl_id AS wid, lecturer.lecturer_name AS laoshi, subject.subject_name AS kemu, student_registration.sr_id AS srid, student_registration.qtf_mark AS qtfm, student_registration.qmc_mark AS qmcm FROM workload_lecturer JOIN lecturer ON workload_lecturer.lecturer_id = lecturer.lecturer_id JOIN subject ON workload_lecturer.subject_code = subject.subject_code JOIN student_registration ON student_registration.wl_id = workload_lecturer.wl_id JOIN student ON student.student_id = student_registration.student_id WHERE student.student_id = '$suid' ";
                $result = mysqli_query($con, $qone) or die("SQL sequence invalid.");
                while ($row = mysqli_fetch_assoc($result)) { 
                ?>
                
                <?php 
                    $wwid = $row["wid"];
                    $suid = $_SESSION['uid'];
                    $qa = "SELECT qtf_mark AS qtfm FROM student_registration WHERE wl_id = $wwid AND student_id = '$suid' ";
                    $qar = mysqli_query($con, $qa);
                    $qarn = mysqli_fetch_assoc($qar);
                    $qc = "SELECT qmc_mark AS qmmm FROM student_registration WHERE wl_id = $wwid AND student_id = '$suid' ";
                    $qcr = mysqli_query($con, $qc);
                    $qcrn = mysqli_fetch_assoc($qcr);
                    if (($qarn["qtfm"] == 0) && ($qcrn["qmmm"] == 0) ) { ?>
                        <tr>
                        <td align="left"><?php echo $count; ?><span class="hide"><?php echo $row["wid"]; ?></span></td>
                        <td align="left"><?php echo $row["laoshi"]; ?></td>
                        <td align="left"><?php echo $row["kemu"]; ?></td>
                        <td align="left"><?php if ($row["qtfm"] == NULL) { echo " "; } else echo $row["qtfm"]; ?></td>
                        <td align="left"><a href="std_vqtf.php?srid=<?php echo $row["srid"]; ?>&wid=<?php echo $row["wid"]; ?>">View</a></td>
                        <td align="left"><?php if ($row["qmcm"] == NULL) { echo " "; } else echo $row["qmcm"]; ?></td>
                        <td align="left"><a href="std_vqo.php?srid=<?php echo $row["srid"]; ?>&wid=<?php echo $row["wid"]; ?>">View</a></td>
                        </tr>
    <?php $count++; } else {
                        if (($qarn["qtfm"] == 0) && ($qcrn["qmmm"] != 0)) { ?>
                            <tr>
                            <td align="left"><?php echo $count; ?><span class="hide"><?php echo $row["wid"]; ?></span></td>
                            <td align="left"><?php echo $row["laoshi"]; ?></td>
                            <td align="left"><?php echo $row["kemu"]; ?></td>
                            <td align="left"><?php if ($row["qtfm"] == NULL) { echo " "; } else echo $row["qtfm"]; ?></td>
                            <td align="left"><a href="std_vqtf.php?srid=<?php echo $row["srid"]; ?>&wid=<?php echo $row["wid"]; ?>">View</a></td>
                            <td align="left"><?php if ($row["qmcm"] == NULL) { echo " "; } else echo $row["qmcm"]; ?></td>
                            <td align="left"><a href="cannot_take.php">View</a></td>
                            </tr>
                        
        <?php $count++; } else {
                            if (($qarn["qtfm"] != 0) && ($qcrn["qmmm"] == 0)) { ?>
                                <tr>
                                <td align="left"><?php echo $count; ?><span class="hide"><?php echo $row["wid"]; ?></span></td>
                                <td align="left"><?php echo $row["laoshi"]; ?></td>
                                <td align="left"><?php echo $row["kemu"]; ?></td>
                                <td align="left"><?php if ($row["qtfm"] == NULL) { echo " "; } else echo $row["qtfm"]; ?></td>
                                <td align="left"><a href="cannot_take.php">View</a></td>
                                <td align="left"><?php if ($row["qmcm"] == NULL) { echo " "; } else echo $row["qmcm"]; ?></td>
                                <td align="left"><a href="std_vqo.php?srid=<?php echo $row["srid"]; ?>&wid=<?php echo $row["wid"]; ?>">View</a></td>
                                </tr> 
            <?php $count++; } else {
                                if (($qarn["qtfm"] != 0) && ($qcrn["qmmm"] != 0)) { ?>
                                    <tr>
                                    <td align="left"><?php echo $count; ?><span class="hide"><?php echo $row["wid"]; ?></span></td>
                                    <td align="left"><?php echo $row["laoshi"]; ?></td>
                                    <td align="left"><?php echo $row["kemu"]; ?></td>
                                    <td align="left"><?php if ($row["qtfm"] == NULL) { echo " "; } else echo $row["qtfm"]; ?></td>
                                    <td align="left"><a href="cannot_take.php">View</a></td>
                                    <td align="left"><?php if ($row["qmcm"] == NULL) { echo " "; } else echo $row["qmcm"]; ?></td>
                                    <td align="left"><a href="cannot_take.php">View</a></td>
                                    </tr>
                <?php $count++; }}}}  $count++;} ?>
                
            </tbody>
        
        
        
        
        </table>
    
    </div>
    
    <p>
            
            <?php 
            if(isset($_SESSION['emsg'])) { 
                echo $_SESSION['emsg']; } 
            unset($_SESSION['emsg']);
            ?>
        
    </p>
    
</body>
</html>