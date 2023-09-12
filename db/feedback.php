<?php
$fdbk_check = "SELECT emp_name FROM faculty_details WHERE feedback = 1";
$result = $conn->query($fdbk_check);
    if($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
        $empname = $row['emp_name'];
    ?>
    <form method="POST">
        <h1><?php echo $empname?></h1>
        <lable for fdbk_rate_1>Rate me in Terms of Content Delivery</lable>
        <input type="text" name="fdbk_rate_1">
    </form>

<?php
}
?>