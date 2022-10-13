<?php
    $conn = mysqli_connect("localhost", "root", "", "ajax_quanlykhachhang");

    if(mysqli_connect_error()){
        echo "Failed to connect to MySQL: " .mysqli_connect_error();
    }
?>