<?php
require_once("auth.php");
require_once("link.php");
?>
<html>
<head>
    <title>Workload Lecturer Registration</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="adm_wl_reg_css.css">
</head>
<body>

    <div class="topnav">
    
        <a href="admin_dashboard.php">Dashboard</a>
        <a href="logout.php">Logout</a>
        
    </div>
    
    <h2>Assign Workload Lecturer:</h2>
    
    <div class="table">
        
        <table width="100%" border="1" style="border-collapse:collapse;">
        
            <thead>
            
                <tr>
                    <td><h3>No</h3></td>
                    <td><h3>Lecturer</h3></td>
                    <td><h3>Subject</h3></td>
                    <td><h3>Update</h3></td>
                    <td><h3>Delete</h3></td>
                </tr>
                
            </thead>
        
            <tbody>
            
                <?php
                $nom = 1;
                if (isset($_REQUEST['uaid'])) {
                    $uaid = $_REQUEST['uaid'];
                    $qone = "SELECT workload_lecturer.wl_id AS wlid, subject.subject_name AS sn, lecturer.lecturer_name AS ln FROM workload_lecturer JOIN subject ON subject.subject_code = workload_lecturer.subject_code JOIN lecturer ON lecturer.lecturer_id = workload_lecturer.lecturer_id";
                    $qr = mysqli_query($con,$qone) or die("SQL Sequence Incorrect.");
                    while ($num = mysqli_fetch_assoc($qr)) {
                        if($num["wlid"] == $uaid) { ?>
                    
                        <tr>
                            <td align="left"><?php echo $nom; ?><span class="hide"><?php echo $num["wlid"]?></span></td>
                            <form action="adm_wl_up.php?xz=<?php echo $uaid;?>" method="post">
                    
                            <td align="left"><select name="lnaid" required>
                                <?php
                                $query = "SELECT * FROM lecturer";
                                $result = mysqli_query($con, $query) or die("SQL Sequence Invalid.");
                                while($uxz = mysqli_fetch_assoc($result)) {
                                    $lname = $uxz["lecturer_name"];
                                    $lsid = $uxz["lecturer_id"];
                                    echo"<option value='$lsid'>$lname</option>";
                                }
                                ?>
                                </select></td>
                            <td align="left"><select name="scaid" required>
                                <?php
                                $queryb = "SELECT * FROM subject";
                                $resultb = mysqli_query($con, $queryb) or die("SQL Sequence Invalid.");
                                while($uxzb = mysqli_fetch_assoc($resultb)) {
                                    $sname = $uxzb["subject_name"];
                                    $ssid = $uxzb["subject_code"];
                                    echo"<option value='$ssid'>$sname</option>";
                                }
                                ?>
                                </select></td>
                            <td align="left"><input type="submit" value="Update" style="padding: 3px;">
                                <a href="adm_wl_reg.php">Cancel</a></td>
                            <td align="left"><a>Delete</a></td>
                                
                            </form>
                            
                        </tr>
                            
                 <?php $nom++; } else { ?>
                                <tr>
                                <td align="left"><?php echo $nom; ?><span class="hide"><?php echo $num["wlid"]?></span></td>
                                <td align="left"><?php echo $num["ln"]; ?></td>
                                <td align="left"><?php echo $num["sn"]; ?></td>
                                <td align="left"><a>Update</a></td>
                                <td align="left"><a>Delete</a></td>
                                </tr>
                        
                   <?php $nom++; } }?>
                <tr>
                    <td></td>
                    <form action="" method="post">
                    
                        <td align="left"><select name="lnaid" required>
                                <?php
                                $queryd = "SELECT * FROM lecturer";
                                $resultd = mysqli_query($con, $queryd) or die("SQL Sequence Invalid.");
                                while($uxzd = mysqli_fetch_assoc($resultd)) {
                                    $lnamed = $uxzd["lecturer_name"];
                                    $lnid = $uxzd["lecturer_id"];
                                    echo"<option value='$lnid'>$lnamed</option>";
                                }
                                ?>
                            </select></td>
                        <td align="left"><select name="scaid" required>
                                <?php
                                $queryc = "SELECT * FROM subject";
                                $resultc= mysqli_query($con, $queryc) or die("SQL Sequence Invalid.");
                                while($uxzc = mysqli_fetch_assoc($resultc)) {
                                    $cname = $uxzc["subject_name"];
                                    $cnid = $uxzc["subject_code"];
                                    echo"<option value='$cnid'>$cname</option>";
                                }
                                ?>
                            </select></td>
                        <td></td>
                        <td align="left"><input type="submit" value="Add"></td>
                    </form>
                    
                
                </tr>
                    
          <?php } else { 
                $query = "SELECT workload_lecturer.wl_id AS wlid, subject.subject_name AS sn, lecturer.lecturer_name AS ln FROM workload_lecturer JOIN subject ON subject.subject_code = workload_lecturer.subject_code JOIN lecturer ON lecturer.lecturer_id = workload_lecturer.lecturer_id";
                $result = mysqli_query($con, $query) or die("SQL sequence invalid.");
                while ($row = mysqli_fetch_assoc($result)) { ?>
                
                <tr>
                    <td align="left"><?php echo $nom; ?><span class="hide"><?php echo $row["wlid"]?></span></td>
                    <td align="left"><?php echo $row["ln"]; ?></td>
                    <td align="left"><?php echo $row["sn"]; ?></td> 
                    <td align="left"><a href="adm_wl_reg.php?uaid=<?php echo $row["wlid"]; ?>">Update</a></td>
                    <td align="left"><a href="adm_wl_del.php?uaid=<?php echo $row["wlid"]; ?>">Delete</a></td>
                </tr>
            
         <?php  $nom++;} ?>
                
                <tr>
                    <td align="left"></td>
                    <form action="adm_wl_add.php" method="post">
                    
                        <td align="left"><select name="lnaid" required>
                                <?php
                                $queryd = "SELECT * FROM lecturer";
                                $resultd = mysqli_query($con, $queryd) or die("SQL Sequence Invalid.");
                                while($uxzd = mysqli_fetch_assoc($resultd)) {
                                    $lnamed = $uxzd["lecturer_name"];
                                    $lnoid = $uxzd["lecturer_id"];
                                    echo"<option value='$lnoid'>$lnamed</option>";
                                }
                                ?>
                            </select></td>
                        <td align="left"><select name="scaid" required>
                                <?php
                                $queryb = "SELECT * FROM subject";
                                $resultb = mysqli_query($con, $queryb) or die("SQL Sequence Invalid.");
                                while($uxzb = mysqli_fetch_assoc($resultb)) {
                                    $sname = $uxzb["subject_name"];
                                    $snameid = $uxzb["subject_code"];
                                    echo"<option value='$snameid'>$sname</option>";
                                }
                                ?>
                                </select></td>
                        <td align="left"></td>
                        <td align="left"><input type="submit" value="Add"></td>
                    </form>
                    
                
                </tr>
                
            <?php } ?>    
                
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