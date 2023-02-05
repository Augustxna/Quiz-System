<?php
require_once("link.php");
require_once("auth.php");
?>
<html>
<head>
    <title>Quiz Objective</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="std_vqo_css.css">
</head>
<body>

    <div class="topnav">
    
        <a href="std_reg_list.php">Subject List Registered</a>
        <a href="logout.php">Logout</a>
        
    </div>
    
    
    <?php 
    
        if (isset($_REQUEST['wid']) && isset($_REQUEST['srid'])){
        $_SESSION['swid'] = $_REQUEST['wid'];
        $_SESSION['srid'] = $_REQUEST['srid'];
        $wid = $_SESSION['swid'];
        $aq = "SELECT workload_lecturer.subject_code AS sc, subject.subject_name AS sn FROM workload_lecturer JOIN subject ON workload_lecturer.subject_code = subject.subject_code WHERE wl_id = $wid ";
        $aqr = mysqli_query($con, $aq) or die("SQL sentence invalid.");
        while ($aqrn = mysqli_fetch_assoc($aqr)){ ?>
             <p>Subject Code: <?php echo $aqrn["sc"]; ?></p>
             <p>Subject Name: <?php echo $aqrn["sn"]; ?></p>
        <?php }} else {
                    if (isset($_SESSION['swid']) && isset($_SESSION['srid'])){
                    $wid = $_SESSION['swid'];
                    $aq = "SELECT workload_lecturer.subject_code AS sc, subject.subject_name AS sn FROM workload_lecturer JOIN subject ON workload_lecturer.subject_code = subject.subject_code WHERE wl_id = $wid ";
                    $aqr = mysqli_query($con, $aq) or die("SQL sentence invalid.");
                    while ($aqrn = mysqli_fetch_assoc($aqr)){ ?>
                        <p>Subject Code: <?php echo $aqrn["sc"]; ?></p>
                        <p>Subject Name: <?php echo $aqrn["sn"]; ?></p>
        <?php }} } ?>
        
    
    <div class="table">
        
        <table width="100%" border="1" style="border-collapse:collapse;">
        
            <thead>
            
                <tr>
                    <td><h3>No</h3></td>
                    <td><h3>Question</h3></td>
                    <td><h3>Answer A</h3></td>
                    <td><h3>Answer B</h3></td>
                    <td><h3>Answer C</h3></td>
                    <td><h3>Answer D</h3></td>
                    <td><h3>Your Answer</h3></td>
                    <td><h3>Confirm Your Answer</h3></td>
                </tr>
                
            </thead>
        
            <tbody>
            
                <?php
                     //create input status flag
                    
                    $ccc = "SELECT COUNT(*) AS total FROM quiz_mc WHERE wl_id = '$wid' ";
                    $cccr = mysqli_query($con, $ccc) or die("SQL invalid.");
                    $cccrn = mysqli_fetch_assoc($cccr);
                    $length = $cccrn["total"];
                    $input = array_fill(0,$length,0);    //use to store flag
                    
                    $cc = "SELECT COUNT(*) AS total FROM quiz_mc WHERE wl_id = '$wid' ";
                    $ccr = mysqli_query($con, $cc) or die("SQL invalid.");
                    $ccrn = mysqli_fetch_assoc($ccr);
                    $lengthi = $ccrn["total"];
                    $inputi = array_fill(0,$lengthi,0);
                    if (!isset($_SESSION['flag']) && !isset($_SESSION['arrayA'])) {
                        $_SESSION['flag'] = $input;
                        $_SESSION['arrayA'] = $inputi;
                    }
                    $s = 1;
                    $sa = 0;
                    $wid = $_SESSION['swid'];
                    $qone = "SELECT qmc_question AS qq, qmc_id AS qmcid , qmc_choicea AS qa, qmc_choiceb AS qb, qmc_choicec AS qc, qmc_choiced AS qd FROM quiz_mc WHERE wl_id = $wid";
                    $qr = mysqli_query($con,$qone) or die("SQL Sequence Incorrect.");
                
                    while ($num = mysqli_fetch_assoc($qr)) { 
                    if (($_SESSION['flag'][$sa]) == 1) { ?>   
                    
                    <tr>
                    <td align="left"><?php echo $s; ?><span class="hid"><?php echo $num["qmcid"]; ?></span></td>
                    <td align="left"><?php echo $num["qq"]; ?></td>
                    <td align="left"><?php echo $num["qa"]; ?></td>
                    <td align="left"><?php echo $num["qb"]; ?></td>
                    <td align="left"><?php echo $num["qc"]; ?></td>
                    <td align="left"><?php echo $num["qd"]; ?></td>
                    <form action="experiment7.php?check=<?php echo $sa; ?>" method="post">
                        <td> 
                            <input type="text" name="ans" value="<?php echo $_SESSION['arrayA'][$sa]; ?>" style="background-color:#DCDCDC;">
                        </td>
                        <td><input type="submit" name="submit" value="Confirm"></td>
                    </form>
                    </tr>
            
         <?php $s++; $sa++;} else { 
                    if (($_SESSION['flag'][$sa]) == 0) { ?>
                
                    <tr>
                    <td align="left"><?php echo $s; ?><span class="hid"><?php echo $num["qmcid"]; ?></span></td>
                    <td align="left"><?php echo $num["qq"]; ?></td>
                    <td align="left"><?php echo $num["qa"]; ?></td>
                    <td align="left"><?php echo $num["qb"]; ?></td>
                    <td align="left"><?php echo $num["qc"]; ?></td>
                    <td align="left"><?php echo $num["qd"]; ?></td>
                    <form action="experiment7.php?check=<?php echo $sa; ?>" method="post">
                        <td><input type="text" name="ans">
                        </td>
                        <td><input type="submit" name="submit" value="Confirm"></td>
                    </form>
                    </tr>
             
                
                <?php $s++; $sa++;} } } ?>
                
            </tbody>
        
        </table>
        
        <div class="down"><a href="std_markmc_check.php?halt=<?php $srid=$_SESSION['srid']; echo $srid; ?>">Finish Quiz</a></div>
        
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