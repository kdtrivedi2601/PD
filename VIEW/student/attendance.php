<style>
table,td,th {
    border:1px solid #000;
    border-collapse:collapse;
    text-align: center;
}
 
</style>
<?php
if(isset($_SESSION['student'])){
        $enroll = $_SESSION['id'];
      
            $get_attendance = "SELECT * FROM 1tet WHERE enrollno = '$enroll'";
            $got_attendance = $conn->query($get_attendance);
 
            $show = mysqli_fetch_array($got_attendance, MYSQLI_ASSOC);
         
             echo "<h3>Total Lectures: ".$show['total']."<h3>";
             echo "<h3>Total Attended Lectures: ".$show['present']."<h3>";
             echo "<h3>Total Attendance: ".$show['percentage']."%<h3>";
        
 }
 ?>