<?php
require_once("auth.php");
require_once("link.php");
?>
<html>
<head>
    <title>Subject Registration</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="adm_sub_reg_css.css">
</head>
<body>

    <div class="topnav">
    
        <a href="admin_dashboard.php">Dashboard</a>
        <a href="logout.php">Logout</a>
        
    </div>
    
    <h2>Register Subject:</h2>
    
    <div class="table">
        
        <table width="100%" border="1" style="border-collapse:collapse;">
        
            <thead>
            
                <tr>
                    <td><h3>Subject Code</h3></td>
                    <td><h3>Subject Name</h3></td>
                    <td><h3>Modified By</h3></td>
                    <td><h3>Modified On</h3></td>
                    <td><h3>Update</h3></td>
                    <td><h3>Delete</h3></td>
                </tr>
                
            </thead>
        
            <tbody>
            
                <?php 
                if (isset($_REQUEST['uaid'])) {
                    $uaid = $_REQUEST['uaid'];
                    $qone = "SELECT subject.subject_code AS sc, subject.subject_name AS sn, subject.subject_mod_date AS smd, admin.admin_name AS an FROM subject JOIN admin ON admin.admin_id = subject.admin_id";
                    $qr = mysqli_query($con,$qone) or die("SQL Sequence Incorrect.");
                    while ($num = mysqli_fetch_assoc($qr)) {
                        if($num["sc"] == $uaid) { ?>
                    
                        <tr>
                    
                            <form action="adm_sub_up.php?xz=<?php echo $uaid;?>" method="post">
                    
                            <td><input type="text" name="uaaid" required></td>
                            <td><input type="text" name="uaname" required></td>
                            <td><?php echo $num["an"] ?></td>
                            <td><?php echo $num["smd"] ?></td>
                            <td><input type="submit" value="Update" style="padding: 3px;">
                                <a href="adm_sub_reg.php">Cancel</a></td>
                            <td><a>Delete</a></td>
                                
                            </form>
                            
                        </tr>
                            
                 <?php } else { ?>
                                <tr>
                                <td align="left"><?php echo $num["sc"]; ?></td>
                                <td align="left"><?php echo $num["sn"]; ?></td>
                                <td align="left"><?php echo $num["an"]; ?></td>
                                <td align="left"><?php echo $num["smd"]; ?></td>
                                <td align="left"><a>Update</a></td>
                                <td align="left"><a>Delete</a></td>
                                </tr>
                        
                   <?php } }?>
                <tr>
                    
                    <form action="" method="post">
                    
                        <td><input type="text" name="uaid" required></td>
                        <td><input type="text" name="uaname" required></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><input type="submit" value="Add"></td>
                    </form>
                    
                
                </tr>
                    
          <?php } else { 
                
                $query = "SELECT subject.subject_code AS sc, subject.subject_name AS sn, subject.subject_mod_date AS smd, admin.admin_name AS an FROM subject JOIN admin ON admin.admin_id = subject.admin_id";
                $result = mysqli_query($con, $query) or die("SQL sequence invalid.");
                while ($row = mysqli_fetch_assoc($result)) { ?>
                
                <tr>
                    <td align="left"><?php echo $row["sc"]; ?></td>
                    <td align="left"><?php echo $row["sn"]; ?></td>
                    <td align="left"><?php echo $row["an"]; ?></td> 
                    <td align="left"><?php echo $row["smd"]; ?></td> 
                    <td align="left"><a href="adm_sub_reg.php?uaid=<?php echo $row["sc"]; ?>">Update</a></td>
                    <td align="left"><a href="adm_sub_del.php?uaid=<?php echo $row["sc"]; ?>">Delete</a></td>
                </tr>
            
         <?php } ?>
                
                <tr>
                    
                    <form action="adm_sub_add.php" method="post">
                    
                        <td><input type="text" name="uaaid" required></td>
                        <td><input type="text" name="uaname" required></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><input type="submit" value="Add"></td>
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