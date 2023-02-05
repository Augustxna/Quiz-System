<?php
session_start();
?>
<html>
<head>
    <title>Login Page</title>
    <meta charset="utf-8">
    <link type="text/css" rel="stylesheet" href="logincss.css">
</head>
<body>
<div class="form">

    <form action="loginProcess.php" method="post">
    
        <h1>Login Page</h1>
        
        <div class="label-field">
            
            <label>ID</label>
            <input type="text" name="id" required>
            
        </div>
        
        <div class="label-field">
            
            <label>Password</label>
            <input type="password" name="password" required>
            
        </div>
        
        <div class="label-input-radio">
        
            <input type="radio" name="bg" value="std">
            <label>Student</label><br>
            <input type="radio" name="bg" value="lect">
            <label>Lecturer</label><br>
            <input type="radio" name="bg" value="adm">
            <label>Admin</label><br>
        
        </div>
        
        <div class="sub-btn">
        
            <input type="submit" name="submit" value="Login">
        
        </div>
        
    </form>   
    
    <p><?php if (isset($_SESSION['emsg'])) { echo $_SESSION['emsg']; } 
        unset($_SESSION['emsg']);
        ?></p>
    
</div>    
</body>
</html>