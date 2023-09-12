<?php
if(isset($_SESSION['parent'])){
   $id = $_SESSION['id'];
$check = "SELECT leaves.*, student_details.student_name 
            FROM leaves LEFT JOIN student_details 
                ON leaves.enrollno = student_details.enrollno WHERE student_details.parent_phone = '$id'";
    $result = $conn->query($check);
    if($result){
        $leave = 1;
        //echo $check;
?>
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
        <table>
            <tr>
                <th>LEAVE</th>
                <th>STUDENT NAME</th>
                <th>REASON</th>
                <th>FROM</th>
                <th>TO</th>
                <th>LEAVE STATUS</th>
            </tr>
        
<?php

        while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
        ?>
            <tr>
                <td><?php echo $leave;?></td>
                <td><?php echo $row['student_name']; ?></td>
                <td><?php echo $row['message']; ?></td>
                <td><?php echo $row['from_date']; ?></td>
                <td><?php echo $row['to_date']; ?></td>
                <td>
                    <?php 
                        if($row['approve'] == NULL){
                            echo 'PENDING';
                        }
                        else if($row['approve'] == 0){
                            echo 'DENIED';
                        }
                        else{
                            echo 'APPROVED';
                        }
                    ?>
                </td>
            </tr>
            
        <?php
        $leave++;
        }
    }
    else{
        echo 'NO Leaves are taken.';
    }
    // while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        
    // }

?>
</table>
<?php
}
?>