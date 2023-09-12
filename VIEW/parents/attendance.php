<style>
 table {
    border-collapse: collapse;
    border: 1px solid black;
  }
  th, td {
    border: 1px solid black;
    padding: 8px;
    text-align: center;
  }
</style>
<?php
if(isset($_SESSION['parent'])){
    $phone = $_SESSION['id'];
        $name = "SELECT student_details.student_name, student_details.enrollno FROM student_details INNER JOIN parents_details
                            ON parents_details.parent_phone = student_details.parent_phone 
                                    where student_details.parent_phone = '$phone'";
        $result1 = mysqli_query($conn,$name);
        if($result1){
            $row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC);
            echo '<h1>'.$row1['student_name'].'</h1>';

            $enroll = $row1['enrollno'];
             
           $get_attendance = "SELECT * FROM 1tet WHERE enrollno = '$enroll'";
           $got_attendance = $conn->query($get_attendance);

           $show = mysqli_fetch_array($got_attendance, MYSQLI_ASSOC);
        
            echo "<h3>Total Lectures: ".$show['total']."<h3>";
            echo "<h3>Total Attended Lectures: ".$show['present']."<h3>";
            echo "<h3>Total Attendance: ".$show['percentage']."%<h3>";
        }
}
?>
