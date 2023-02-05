<?php
require_once("auth.php");
require_once("link.php");
?>
<html>
<head>
    <title>Admin Registration</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="admregcss.css">
</head>
<body>

    <div class="topnav">
    
        <a href="admin_dashboard.php">Dashboard</a>
        <a href="logout.php">Logout</a>
        
    </div>
    
    <h2>Register Admin:</h2>
    
    <div class="table">
        
        <table width="100%" border="1" style="border-collapse:collapse;">
        
            <thead>
            
                <tr>
                    <td><h3>Admin ID</h3></td>
                    <td><h3>Admin Name</h3></td>
                    <td><h3>Update</h3></td>
                    <td><h3>Delete</h3></td>
                </tr>
                
            </thead>
        
            <tbody>
            
                <?php 
                if (isset($_REQUEST['uaid'])) {
                    $uaid = $_REQUEST['uaid'];
                    $qone = "SELECT * FROM admin";
                    $qr = mysqli_query($con,$qone) or die("SQL Sequence Incorrect.");
                    while ($num = mysqli_fetch_assoc($qr)) {
                        if($num["admin_id"] == $uaid) { ?>
                    
                        <tr>
                    
                            <form action="adm_up.php?uaid=<?php echo $uaid?>" method="post">
                    
                            <td><input type="text" name="uaaid" required></td>
                            <td><input type="text" name="uaname" required></td>
                            <td><input type="submit" value="Update" style="padding: 3px;">
                                <a href="adm_reg.php">Cancel</a></td>
                            <td><a>Delete</a></td>
                                
                            </form>
                            
                        </tr>
                            
                 <?php } else { ?>
                                <tr>
                                <td align="left"><?php echo $num["admin_id"]; ?></td>
                                <td align="left"><?php echo $num["admin_name"]; ?></td>
                                <td align="left"><a>Update</a></td>
                                <td align="left"><a>Delete</a></td>
                                </tr>
                        
                   <?php } }?>
                <tr>
                    
                    <form action="" method="post">
                    
                        <td><input type="text" name="uaid" required></td>
                        <td><input type="text" name="uaname" required></td>
                        <td></td>
                        <td><input type="submit" value="Add"></td>
                    </form>
                    
                
                </tr>
                    
          <?php } else { 
                
                $query = "SELECT * FROM admin; ";
                $result = mysqli_query($con, $query) or die("SQL sequence invalid.");
                while ($row = mysqli_fetch_assoc($result)) { ?>
                
                <tr>
                    <td align="left"><?php echo $row["admin_id"]; ?></td>
                    <td align="left"><?php echo $row["admin_name"]; ?></td>
                    <td align="left"><a href="adm_reg.php?uaid=<?php echo $row["admin_id"]; ?>">Update</a></td>
                    <td align="left"><a href="adm_del.php?uaid=<?php echo $row["admin_id"]; ?>">Delete</a></td>
                </tr>
            
         <?php } ?>
                
                <tr>
                    
                    <form action="adm_add.php" method="post">
                    
                        <td><input type="text" name="uaaid" required></td>
                        <td><input type="text" name="uaname" required></td>
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