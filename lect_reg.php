<?php 
require_once("auth.php");
require_once("link.php");
?>
<html>
<head>
    <title>Lecturer Registration List</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="lect_reg_css.css">
</head>
<body>
 
    <h2>Your Subject List:</h2>
    
    <div class="table">
        
        <table width="100%" border="1" style="border-collapse:collapse;">
        
            <thead>
            
                <tr>
                    <td><h3>No</h3></td>
                    <td><h3>Subject</h3></td>
                    <td><h3>Quiz True/False</h3></td>
                    <td><h3>Quiz Objective</h3></td>
                </tr>
                
            </thead>
        
            <tbody>
            
                <?php 
                unset($_SESSION['swid']);
                $count = 1;
                $lectid = $_SESSION['uid'];
                $qone = "SELECT workload_lecturer.wl_id AS wid, subject.subject_name AS kemu FROM workload_lecturer JOIN subject ON workload_lecturer.subject_code = subject.subject_code WHERE lecturer_id = $lectid";
                $result = mysqli_query($con, $qone) or die("SQL sequence invalid.");
                while ($row = mysqli_fetch_assoc($result)) { 
                ?>
                
                
                <tr>
                    <td align="left"><?php echo $count; ?><span class="hide"><?php echo $row["wid"]?></span></td>
                    <td align="left"><?php echo $row["kemu"]; ?></td>
                    <td align="left"><a href="lect_rqtf.php?wid=<?php echo $row["wid"]; ?>">Result</a>
                    <a href="lect_vqtf.php?wid=<?php echo $row["wid"]; ?>">Create/View Quiz</a></td>
                    <td align="left"><a href="lect_rqo.php?wid=<?php echo $row["wid"]; ?>">Result</a>
                    <a href="lect_vqo.php?wid=<?php echo $row["wid"]; ?>">Create/View Quiz</a></td>
                </tr>
            
                <?php $count++; } ?>
                
            </tbody>
        
        </table>
        
       <p>
            
            <?php 
            if(isset($_SESSION['emsg'])) { 
                echo $_SESSION['emsg']; } 
            unset($_SESSION['emsg']);
            ?>
        
       </p>
    
    </div>
    
</body>
</html>