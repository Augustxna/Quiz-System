<?php
$con = mysqli_connect("localhost", "root", "", "quiz");
if (mysqli_connect_error()) {
    echo "Failed to connect SQL database ".mysqli_connect_error();
}
?>