<?php
require_once("auth.php");
require_once("link.php");
?>
<html>
<head>
    <title>Create View Quiz Objective</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="lect_quiz_css.css">
</head>
<body>

    <div class="topnav">
    
        <a href="lect_reg.php">List Subject</a>
        <a href="logout.php">Logout</a>
        
    </div>
    
    
    <?php 
        if (isset($_REQUEST['wid'])){
        $_SESSION['swid'] = $_REQUEST['wid'];
        $wid = $_SESSION['swid'];
        $aq = "SELECT workload_lecturer.subject_code AS sc, subject.subject_name AS sn FROM workload_lecturer JOIN subject ON workload_lecturer.subject_code = subject.subject_code WHERE wl_id = $wid ";
        $aqr = mysqli_query($con, $aq) or die("SQL sentence invalid.");
        while ($aqrn = mysqli_fetch_assoc($aqr)){ ?>
             <p>Subject Code: <?php echo $aqrn["sc"]; ?></p>
             <p>Subject Name: <?php echo $aqrn["sn"]; ?></p>
        <?php }} else {
                    if (isset($_SESSION['swid'])){
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
                    <td><h3>Correct Answer</h3></td>
                    <td><h3>Modified By</h3></td>
                    <td><h3>Modified On</h3></td>
                    <td><h3>Update</h3></td>
                    <td><h3>Delete</h3></td>
                </tr>
                
            </thead>
        
            <tbody>
            
                <?php 
                $s = 1;
                if (isset($_REQUEST['uaid'])) {
                    $wid = $_SESSION['swid'];
                    $uaid = $_REQUEST['uaid'];
                    $qone = "SELECT workload_lecturer.wl_id AS wid, quiz_mc.qmc_id AS qmid, quiz_mc.qmc_question AS qmq, quiz_mc.qmc_answer AS qmans, quiz_mc.qmc_mod_date as qmdate, quiz_mc.qmc_choicea AS qca, quiz_mc.qmc_choiceb AS qcb, quiz_mc.qmc_choicec AS qmc, quiz_mc.qmc_choiced AS qmd, lecturer.lecturer_name AS ln FROM workload_lecturer JOIN quiz_mc ON workload_lecturer.wl_id = quiz_mc.wl_id JOIN lecturer ON lecturer.lecturer_id = workload_lecturer.lecturer_id WHERE workload_lecturer.wl_id = $wid";
                    $qr = mysqli_query($con,$qone) or die("SQL Sequence Incorrect.");
                    while ($num = mysqli_fetch_assoc($qr)) {
                        if($num["qmid"] == $uaid) { ?>
                    
                        <tr>
                            <td align="left"><?php echo $s; ?><span class="hid"><?php echo $num["qmid"]; ?></span></td>
                            <form action="lect_qo_up.php?xz=<?php echo $uaid; ?>" method="post">
                            <td align="left"><input type="text" name="question" required></td>
                            <td align="left"><input type="text" name="ansa" required></td>
                            <td align="left"><input type="text" name="ansb" required></td>
                            <td align="left"><input type="text" name="ansc" required></td>
                            <td align="left"><input type="text" name="ansd" required></td>
                            <td align="left"><input type="text" name="tans" required></td>
                            <td align="left"><?php echo $num["ln"] ?></td>
                            <td align="left"><?php echo $num["qmdate"] ?></td>
                            <td align="left"><input type="submit" value="Update" style="padding: 4px;">
                                <a href="lect_vqo.php">Cancel</a></td>
                            <td align="left"><a>Delete</a></td>
                                
                            </form>
                            
                        </tr>
                            
                 <?php $s++; } else { ?>
                                <tr>
                                <td align="left"><?php echo $s; ?><span class="hid"><?php echo $num["qmid"]?></span></td>
                                <td align="left"><?php echo $num["qmq"]; ?></td>
                                <td align="left"><?php echo $num["qca"]; ?></td>
                                <td align="left"><?php echo $num["qcb"]; ?></td>
                                <td align="left"><?php echo $num["qmc"]; ?></td>
                                <td align="left"><?php echo $num["qmd"]; ?></td>
                                <td align="left"><?php echo $num["qmans"]; ?></td>
                                <td align="left"><?php echo $num["ln"]; ?></td>
                                <td align="left"><?php echo $num["qmdate"]; ?></td> 
                                <td align="left"><a href="lect_vqo.php?uaid=<?php echo $num["qmid"]; ?>">Update</a></td>
                                <td align="left"><a href="lect_qo_del.php?uaid=<?php echo $num["qmid"]; ?>">Delete</a></td>
                                </tr>
                        
                   <?php $s++; } }?>
                <tr>
                    
                    <form action="" method="post">
                        <td></td>
                        <td><input type="text" name="question" required></td>
                        <td><input type="text" name="ansa" required></td>
                        <td><input type="text" name="ansb" required></td>
                        <td><input type="text" name="ansc" required></td>
                        <td><input type="text" name="ansd" required></td>
                        <td><input type="text" name="tans" required></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><input type="submit" value="Add"></td>
                    </form>
                    
                
                </tr>
                    
          <?php } else { 
                $wid = $_SESSION['swid'];
                $query = "SELECT workload_lecturer.wl_id AS wid, quiz_mc.qmc_id AS qmid, quiz_mc.qmc_question AS qmq, quiz_mc.qmc_answer AS qmans, quiz_mc.qmc_mod_date as qmdate, quiz_mc.qmc_choicea AS qca, quiz_mc.qmc_choiceb AS qcb, quiz_mc.qmc_choicec AS qmc, quiz_mc.qmc_choiced AS qmd, lecturer.lecturer_name AS ln FROM workload_lecturer JOIN quiz_mc ON workload_lecturer.wl_id = quiz_mc.wl_id JOIN lecturer ON lecturer.lecturer_id = workload_lecturer.lecturer_id WHERE workload_lecturer.wl_id = $wid";
                $result = mysqli_query($con, $query) or die("SQL sequence invalid.");
                while ($row = mysqli_fetch_assoc($result)) { ?>
                
                <tr>
                    <td align="left"><?php echo $s; ?><span class="hid"><?php echo $row["qmid"]?></span></td>
                    <td align="left"><?php echo $row["qmq"]; ?></td>
                    <td align="left"><?php echo $row["qca"]; ?></td>
                    <td align="left"><?php echo $row["qcb"]; ?></td>
                    <td align="left"><?php echo $row["qmc"]; ?></td>
                    <td align="left"><?php echo $row["qmd"]; ?></td>
                    <td align="left"><?php echo $row["qmans"]; ?></td>
                    <td align="left"><?php echo $row["ln"]; ?></td>
                    <td align="left"><?php echo $row["qmdate"]; ?></td> 
                    <td align="left"><a href="lect_vqo.php?uaid=<?php echo $row["qmid"]; ?>">Update</a></td>
                    <td align="left"><a href="lect_qo_del.php?uaid=<?php echo $row["qmid"]; ?>">Delete</a></td>
                </tr>
            
         <?php $s++; } ?>
                
                <tr>
                    <td></td>
                    <form action="lect_qo_add.php" method="post">
                        <td><input type="text" name="question" required></td>
                        <td><input type="text" name="ansa" required></td>
                        <td><input type="text" name="ansb" required></td>
                        <td><input type="text" name="ansc" required></td>
                        <td><input type="text" name="ansd" required></td>
                        <td><input type="text" name="tans" required></td>
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