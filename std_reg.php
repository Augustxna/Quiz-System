<?php 
require_once("auth.php");
require_once("link.php");
?>
<html>
<head>
    <title>Student Registration</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="std_reg_css.css">
</head>
<body>

    <div class="top-nav">
    
        <ul>
            
        <li><a href="std_reg_list.php">Subject List Registered</a></li>
        <li><a href="logout.php">Log Out</a></li>
            
        </ul>    
    
    </div>    
    
    <h2>Student Register Subject:</h2>
    
    <div class="table">
        
        <table width="100%" border="1" style="border-collapse:collapse;">
        
            <thead>
            
                <tr>
                    <td><h3>No</h3></td>
                    <td><h3>Lecturer</h3></td>
                    <td><h3>Subject</h3></td>
                    <td><h3>Register</h3></td>
                </tr>
                
            </thead>
        
            <tbody>
            
                <?php 
                $count = 1;
                $qone = "SELECT workload_lecturer.wl_id AS wid, lecturer.lecturer_name AS laoshi, subject.subject_name AS kemu FROM workload_lecturer JOIN lecturer ON workload_lecturer.lecturer_id = lecturer.lecturer_id JOIN subject ON workload_lecturer.subject_code = subject.subject_code ";
                $result = mysqli_query($con, $qone) or die("SQL sequence invalid.");
                while ($row = mysqli_fetch_assoc($result)) { 
                ?>
                
                
                <tr>
                    <td align="left"><?php echo $count; ?></td>
                    <td align="left"><?php echo $row["laoshi"]; ?></td>
                    <td align="left"><?php echo $row["kemu"]; ?></td>
                    <td align="left"><a href="std_rprocess.php?wid=<?php echo $row["wid"]; ?>">Register</a></td>
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