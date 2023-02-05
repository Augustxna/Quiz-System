<?php
require_once("auth.php");
require_once("link.php");
?>
<html>
<head>
    <title>Lecturer Registration</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="adm_lect_reg_css.css">
</head>
<body>

    <div class="topnav">
    
        <a href="admin_dashboard.php">Dashboard</a>
        <a href="logout.php">Logout</a>
        
    </div>
    
    <h2>Register Lecturer:</h2>
    
    <div class="table">
        
        <table width="100%" border="1" style="border-collapse:collapse;">
        
            <thead>
            
                <tr>
                    <td><h3>Lecturer ID</h3></td>
                    <td><h3>Lecturer Name</h3></td>
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
                    $qone = "SELECT lecturer.lecturer_id AS lid, lecturer.lecturer_name AS ln, lecturer.lecturer_mod_date AS lmd, admin.admin_name AS an FROM lecturer JOIN admin ON admin.admin_id = lecturer.admin_id";
                    $qr = mysqli_query($con,$qone) or die("SQL Sequence Incorrect.");
                    while ($num = mysqli_fetch_assoc($qr)) {
                        if($num["lid"] == $uaid) { ?>
                    
                        <tr>
                    
                            <form action="adm_lect_up.php?xz=<?php echo $uaid;?>" method="post">
                    
                            <td><input type="text" name="uaaid" required></td>
                            <td><input type="text" name="uaname" required></td>
                            <td><?php echo $num["an"] ?></td>
                            <td><?php echo $num["lmd"] ?></td>
                            <td><input type="submit" value="Update" style="padding: 3px;">
                                <a href="adm_lect_reg.php">Cancel</a></td>
                            <td><a>Delete</a></td>
                                
                            </form>
                            
                        </tr>
                            
                 <?php } else { ?>
                                <tr>
                                <td align="left"><?php echo $num["lid"]; ?></td>
                                <td align="left"><?php echo $num["ln"]; ?></td>
                                <td align="left"><?php echo $num["an"]; ?></td>
                                <td align="left"><?php echo $num["lmd"]; ?></td>
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
                
                $query = "SELECT lecturer.lecturer_id AS lid, lecturer.lecturer_name AS ln, lecturer.lecturer_mod_date AS lmd, admin.admin_name AS an FROM lecturer JOIN admin ON admin.admin_id = lecturer.admin_id";
                $result = mysqli_query($con, $query) or die("SQL sequence invalid.");
                while ($row = mysqli_fetch_assoc($result)) { ?>
                
                <tr>
                    <td align="left"><?php echo $row["lid"]; ?></td>
                    <td align="left"><?php echo $row["ln"]; ?></td>
                    <td align="left"><?php echo $row["an"]; ?></td> 
                    <td align="left"><?php echo $row["lmd"]; ?></td> 
                    <td align="left"><a href="adm_lect_reg.php?uaid=<?php echo $row["lid"]; ?>">Update</a></td>
                    <td align="left"><a href="adm_lect_del.php?uaid=<?php echo $row["lid"]; ?>">Delete</a></td>
                </tr>
            
         <?php } ?>
                
                <tr>
                    
                    <form action="adm_lect_add.php" method="post">
                    
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