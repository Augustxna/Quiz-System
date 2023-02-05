<?php
require_once("auth.php");
?>

<html>
<head>
    <title>Update Your Password</title>
    <meta charset="utf-8">
    <link type="text/css" rel="stylesheet" href="upcss.css">
</head>
<body>

    <div class="form">
    
        <form action="upp_reg.php?bg=<?php echo $_REQUEST['bg']?>" method="post">
        
            <h1>Update Your Password</h1>
            
            <div class="label-field-one ">
            
                <label>New Password</label>
                <input type="password" name="np" required>
            
            </div>
        
            <div class="label-field-two">
            
                <label>Confirm Password</label>
                <input type="password" name="cp" required>
            
            </div>
            
            <input type="submit" value="Update" name="submit">
        
        </form>
        
        <p><?php if (isset($_SESSION['emsg'])) { echo $_SESSION['emsg']; } 
        unset($_SESSION['emsg']);
        ?></p>
    
    </div>    
    
</body>    

</html>