<?php
require_once("auth.php");
require_once("link.php");
?>
<html>
<head>
    <title>Create View Quiz True / False</title>
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
                    <td><h3>True</h3></td>
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
                    $qone = "SELECT workload_lecturer.wl_id AS wid, lecturer.lecturer_name AS ln, quiz_tf.qtf_question AS qq, quiz_tf.qtf_id AS qid, quiz_tf.qtf_answer AS qans, quiz_tf.qtf_mod_date AS qdate FROM workload_lecturer JOIN lecturer ON lecturer.lecturer_id = workload_lecturer.lecturer_id JOIN quiz_tf ON quiz_tf.wl_id = workload_lecturer.wl_id WHERE workload_lecturer.wl_id = $wid";
                    $qr = mysqli_query($con,$qone) or die("SQL Sequence Incorrect.");
                    while ($num = mysqli_fetch_assoc($qr)) {
                        if($num["qid"] == $uaid) { ?>
                    
                        <tr>
                            <td align="left"><?php echo $s; ?><span class="hide"><?php echo $num["qid"]; ?></span></td>
                            <form action="lect_qtf_up.php?xz=<?php echo $uaid; ?>" method="post">
                            <td align="left"><input type="text" name="question" required></td>
                            <td align="left"><input type="checkbox" name="ans" value="true"></td>
                            <td align="left"><?php echo $num["ln"] ?></td>
                            <td align="left"><?php echo $num["qdate"] ?></td>
                            <td align="left"><input type="submit" value="Update" style="padding: 4px;">
                                <a href="lect_vqtf.php">Cancel</a></td>
                            <td align="left"><a>Delete</a></td>
                                
                            </form>
                            
                        </tr>
                            
                 <?php $s++; } else { ?>
                                <tr>
                                <td align="left"><?php echo $num["qid"]; ?><span class="hide"><?php echo $num["qid"]; ?></span></td>
                                <td align="left"><?php echo $num["qq"]; ?></td>
                                <td align="left"><?php if ($num["qans"] == 1) { ?>
                                    <input type="checkbox" checked> <?php }; ?></td>
                                <td align="left"><?php echo $num["ln"]; ?></td>
                                <td align="left"><?php echo $num["qdate"]; ?></td>
                                <td align="left"><a>Update</a></td>
                                <td align="left"><a>Delete</a></td>
                                </tr>
                        
                   <?php $s++; } }?>
                <tr>
                    
                    <form action="" method="post">
                        <td></td>
                        <td><input type="text" name="question" required></td>
                        <td><input type="checkbox" name="ans" required></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><input type="submit" value="Add"></td>
                    </form>
                    
                
                </tr>
                    
          <?php } else { 
                $wid = $_SESSION['swid'];
                $query = "SELECT workload_lecturer.wl_id AS wid, lecturer.lecturer_name AS ln, quiz_tf.qtf_question AS qq, quiz_tf.qtf_id AS qid, quiz_tf.qtf_answer AS qans, quiz_tf.qtf_mod_date AS qdate FROM workload_lecturer JOIN lecturer ON lecturer.lecturer_id = workload_lecturer.lecturer_id JOIN quiz_tf ON quiz_tf.wl_id = workload_lecturer.wl_id WHERE workload_lecturer.wl_id = $wid";
                $result = mysqli_query($con, $query) or die("SQL sequence invalid.");
                while ($row = mysqli_fetch_assoc($result)) { ?>
                
                <tr>
                    <td align="left"><?php echo $s; ?><span class="hide"><?php echo $row["qid"]?></span></td>
                    <td align="left"><?php echo $row["qq"]; ?></td>
                    <td align="left"><?php if ($row["qans"] == 1) { ?> <input type="checkbox" checked> <?php }; ?></td>
                    <td align="left"><?php echo $row["ln"]; ?></td>
                    <td align="left"><?php echo $row["qdate"]; ?></td> 
                    <td align="left"><a href="lect_vqtf.php?uaid=<?php echo $row["qid"]; ?>">Update</a></td>
                    <td align="left"><a href="lect_qtf_del.php?uaid=<?php echo $row["qid"]; ?>">Delete</a></td>
                </tr>
            
         <?php $s++; } ?>
                
                <tr>
                    <td></td>
                    <form action="lect_qtf_add.php" method="post">
                        <td><input type="text" name="question" required></td>
                        <td><input type="checkbox" name="ans"></td>
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