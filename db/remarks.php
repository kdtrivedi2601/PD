<?php
session_start();
require('dbconn.php');
if(isset($_POST['s_enroll'])){
    $s_enroll =  $_POST['s_enroll'];
    $remarks = $_POST['remarks'];
    $date = $_POST['s_date'];
    $name = $_SESSION['login'];
     if(isset($_POST['violation'])){
        $violation = 1;
     }

    $sql = "INSERT INTO remarks(enrollno, faculty_name, remark, datte,violation) VALUES ('$s_enroll', '$name','$remarks', '$date','$violation')";
    echo $sql;
    
    $query = mysqli_query($conn, $sql);

    if(!$query){
        echo "Error: ". mysqli_error($conn);
    }
    else{
        $_SESSION['remark'] = 1;
        header('Location: ../VIEW/remarks.php');
    }
}

if(isset($_GET['g_s_enroll'])){
    $g_s_enroll = $_GET['g_s_enroll'];
    $update = "UPDATE remarks SET checked = '1' WHERE id = '$g_s_enroll'";
    $updated = mysqli_query($conn, $update);
    if($updated){
        $_SESSION['checked'] = 1;
        header('Location:../VIEW/remarks.php');
    }
}
?>