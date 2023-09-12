<?php
error_reporting(0);
if(isset($_SESSION['faculty'])) {
    $get_student_enrollment = "SELECT * FROM student_details";
    $query_get_student_enrollment = mysqli_query($conn,$get_student_enrollment);
    
?>
    <html>
        <head>
        </head>
        <body>
        <script>
 function showBlock() {
                var block = document.getElementById("remark");
                    if (block.style.display === "none") {
                        block.style.display = "block";
                    } else {
                        block.style.display = "none ";
                    }
            }
function showBlock2() {
                var block = document.getElementById("table");
                    if (block.style.display === "none") {
                        block.style.display = "block";
                    } else {
                        block.style.display = "none ";
                    }
            }
</script>
 <div id="give_remarks">
    <button onclick="showBlock()">GIVE REMARKS</button>
</div>
    <div id="remark" style="display:none;">
            <form action="../db/remarks.php" method="POST">
                <label>Students Enrollment</label>
            <input list="browsers" name="s_enroll" id="browser" placeholder="SEARCH" required>
                <datalist id="browsers">
                <?php
                    while($s_enroll = mysqli_fetch_array($query_get_student_enrollment,MYSQLI_ASSOC)) {
                        $a = $s_enroll['enrollno'];
                        $b = $s_enroll['id'];
                        $c = $s_enroll['student_name'];
                        echo "<option value='$a'>$c</option>";
                    }
                ?>
                </datalist><br><br>
                
                <label>Date:</label>
                <input type="date" name="s_date" required><br><br>
                <label for="my-textarea"><b>Remarks!<b></label><br>
                    <textarea id="my-textarea" name="remarks" rows="4" cols="40" required></textarea><br><br>
                    <label>Important</label>
                <input type="radio" name="violation"><br>
                <button>SUBMIT</button>
            </form>
            </div>
            <?php
                if(isset($_SESSION['remark'])){
                ?>
                    <span id = 'message'>Remark has been sent!</span>
                    <script>setTimeout(function() {
                    document.getElementById("message").style.display = 'none';
                    }, 3000);</script>
                <?php
                    unset($_SESSION['invalid_user']);
                }
            
            ?>
            <form action="" method="GET">
   <label for="check attendance">CHECK REMARK</label>
   <br>
   <input type="text" name="erno" class="input" placeholder="enter student's enrollment number" required>
   <br>
   <button>SEARCH</button>
</form>  
<div>
        <table>
            <tr>
                <th>Sr No</th>
                <th>STUDENT NAME</th>
                <th>FACULTY NAME</th>
                <th>REMARKS</th>
                <th>DATE</th>
                <th>REMARKS</th>
                <th>CHECKED</th>
            </tr>
    </div>      
    <?php
    $erno=$_GET['erno'];
    $remarks = " SELECT remarks.*, student_details.student_name FROM `remarks` LEFT JOIN student_details ON remarks.enrollno = student_details.enrollno
    WHERE remarks.enrollno = $erno";
    $result = $conn->query($remarks);
    if($result){
        $srno = 1;
        //echo $check;
        while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
        ?>
            <tr>
                <td><?php echo $srno?></td>
                <td><?php echo $row['student_name']; ?></td>
                <td><?php echo $row['faculty_name']; ?></td>
                <td><?php echo $row['remark']; ?></td>
                <td><?php echo $row['datte']; ?></td>
                <td><?php echo $row['violation']?></td>
                       
                <td>
                    <?php if($row['checked'] == 1 AND $row['violation'] == 1){
                            echo "Remark has been checked.";
                    }
                    ?>
                </td>
            </tr>
            
        <?php
        $srno++;
        }
    }
?>
</table>
</body>
</html>
<?php
}
?>