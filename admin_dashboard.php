<?php
require_once("auth.php");
?>

<html>
<head>
    <title>Admin Dashboard</title>
    <meta charset="utf-8">
</head>
<style>
    .menu {
        display: block;
        text-align: center;
        margin-top: 130px;
        border: 1px solid black;
        margin-left: 500px;
        margin-right: 500px;
    }
    ul {
        display: inline-block;
        text-align: left;
    }
    li {
        margin-bottom: 10px;
    }
    a {
        color: blue;
        text-decoration: none;
    }
    a:hover {
        color: red;
    }
</style>
<body>

    <div class="menu">
    
        <h2>Admin Dashboard</h2>
        
        <ul>
        <li><a href="adm_reg.php">Admin Registration</a></li>
        <li><a href="adm_lect_reg.php">Lecturer Registration</a></li>
        <li><a href="adm_std_reg.php">Student Registration</a></li>
        <li><a href="adm_sub_reg.php">Subject Registration</a></li>
        <li><a href="adm_wl_reg.php">Workload Lecturer</a></li>
        </ul>
    
    </div>    

</body>
</html>