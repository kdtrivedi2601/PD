<?php
if(isset($_SESSION['parent'])){
   $id = $_SESSION['id'];
$check = "SELECT remarks.*, student_details.student_name 
            FROM remarks LEFT JOIN student_details 
                ON remarks.enrollno = student_details.enrollno WHERE student_details.parent_phone = '$id'";
    $result = $conn->query($check);
    if($result){
        $remarks = 1;
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
                <th>Sr.No</th>
                <th>STUDENT NAME</th>
                <th>FACULTY NAME</th>
                <th>REMARKS</th>
                <th>DATE</th>
                <th>VIOLATION</th>
            </tr>
        
<?php

        while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
            // $a = $row['id'];
        ?>
            <tr>
                <td><?php echo $remarks;?></td>
                <td><?php echo $row['student_name']; ?></td>
                <td><?php echo $row['faculty_name']; ?></td>
                <td><?php echo $row['remark']; ?></td>
                <td><?php echo $row['datte']; ?></td>
                <td>
                    <?php if($row['violation'] == 1 AND $row['checked'] == 0){
                        echo "<a href = '../db/remarks.php?g_s_enroll=".$row['id']."'><button>OK</button></a>";
                    } 
                        else if($row['checked'] == 1 AND $row['violation'] == 1){
                            echo "Message has been checked.";
                        }
            
            ?>
                </td>
            </tr>
           
        <?php
        $remarks++;
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