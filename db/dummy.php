
    
 

<?php
require('dbconn.php');
$sql = "SELECT enrollno FROM student_details WHERE class= '6TK1'";
$result = mysqli_query($conn,$sql);

while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
    $send_mail_to_this_erno = $row['enrollno'];

    $check_0 = "SELECT ".$send_mail_to_this_erno." FROM se WHERE `".$send_mail_to_this_erno."` = '0' AND attendance_date = '2023-03-07'";
    $result1 = mysqli_query($conn,$check_0);

    while($row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)){
        echo $row1[''.$send_mail_to_this_erno.''].'<br>';
    }
}

   // $sql = "CREATE TABLE attendance ( id int NOT NULL, attendance_date date, PRIMARY KEY (id))";
    // $result = mysqli_query($conn,$sql);
    // $sql1 = "SELECT student_name, enrollno FROM student_details";
    // $result1 = mysqli_query($conn,$sql1);

    // while($row = mysqli_fetch_array($result1, MYSQLI_ASSOC)){

    //     if($result1){

    //         $name = $row['enrollno'];
    //         $alter = "ALTER TABLE attendance ADD COLUMN `".$name."` int DEFAULT '0';";
    //         // echo $alter.'<br>'; 
    //         mysqli_query($conn, $alter);
    //     }
    // }
?>