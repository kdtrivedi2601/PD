<?php
if(isset($_SESSION['student'])){
    $enroll = $_SESSION['id'];
?>
<script>
 function showBlock() {
                var block = document.getElementById("check");
                    if (block.style.display === "none") {
                        block.style.display = "block";
                    } else {
                        block.style.display = "none";
                    }
            }
           
</script>
    <button onclick="showBlock()">Apply For Leave</button>

<div id='check' style="display:none;">
<form action="../db/leaves.php" method = "post">
  <div class="container">
    <h1>Leave Application</h1>

    <label for="start_date"><b>FROM:</b></label>
    <input type="date"  name="start_date" id="start_date" required><br>

    <label for="end_date"><b>TO:</b></label>
    <input type="date"  name="end_date" id="end_date" required><br>
    
    <label for="reason"><b>Enter Reason</b></label>
    <input type="text" placeholder="Enter Your Reason" name="reason" id="reason" required><br>

    <label for="my-textarea"><b>Enter your leave application<b></label>
    <textarea id="my-textarea" name="message" rows="4" cols="40"></textarea><br>

    <button type="submit" class="registerbtn">SUBMIT</button>
  </div>
</form>
</div>


<?php
$check = "SELECT * FROM leaves WHERE enrollno = '$enroll'";
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
if(isset($_SESSION['leave_submitted'])){
    echo '<br>Leave Application Submitted.';
    unset($_SESSION['leave_submitted']);
}
if(isset($_SESSION['mail_error'])){
    echo $_SESSION['mail_error'];
}
?>
<?php
}
?>