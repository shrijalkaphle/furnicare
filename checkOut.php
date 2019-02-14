<?php

session_start();

include ('include/connect.php');

    $currentUser = $_GET['user'];
    $sql = "SELECT * FROM cost WHERE username = '$currentUser'";
    $result = mysqli_query($conn,$sql);
    
    while ($row = mysqli_fetch_assoc($result)) {
        $p_id = $row['product_id'];
        $qty = $row['qty'];
        $sql1 = "insert into checkout (uname,p_id,qty) VALUES ('$currentUser','$p_id',$qty)";
            mysqli_query($conn,$sql1) or die("error");
    }

    $query = "DELETE FROM cost where username = '$currentUser'";
    $result0 = mysqli_query($conn,$query);

    echo "<script>alert('Order Success!!')</script>";
    //echo "<script>window.location = 'index.php'</script>";
?>