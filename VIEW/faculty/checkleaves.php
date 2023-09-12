<link rel="stylesheet" href="./css/checkleaves_fac.css">
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


<?php
require('../db/dbconn.php');
if(isset($_SESSION['faculty'])){


if(($_SESSION['faculty']) == 2){
    if(isset($_SESSION['hod'])){
        $count = "SELECT count(enrollno) AS total FROM leaves where approve IS NULL";
        $total = $conn->query($count);
        $row = mysqli_fetch_array($total,MYSQLI_ASSOC);
        $check = "SELECT leaves.*, student_details.student_name, student_details.class 
                    FROM leaves LEFT JOIN student_details 
                        ON leaves.enrollno = student_details.enrollno WHERE approve IS NULL;";
        $result = $conn->query($check);
       
        }
        else{
            if(isset($_SESSION['cc'])){
            $class = $_SESSION['cc'];
            $count = "SELECT count(leaves.enrollno) AS total, student_details.class 
                                FROM leaves LEFT JOIN student_details 
                                    ON leaves.enrollno = student_details.enrollno WHERE approve IS NULL 
                                        and student_details.class = '$class'";
            $total = $conn->query($count);
            $row = mysqli_fetch_array($total,MYSQLI_ASSOC);
            $check = "SELECT leaves.*, student_details.student_name, student_details.class
                        FROM leaves LEFT JOIN student_details 
                            ON leaves.enrollno = student_details.enrollno WHERE approve IS NULL 
                                and student_details.class = '$class'";
            $result = $conn->query($check);
            }
        }     
            ?>  
                    <button id="leave_btn" onclick="showBlock()">PENDING LEAVES</button>
                    <span><?php echo $row['total'].'<br>';?></span>
    
                    <div id="check" style="display:none;">
                    <table>
                        <tr>
                            <th>No.</th>
                            <th>Enrollment Number</th>
                            <th>Student Name</th>
                            <th>REASON</th>
                            <th>FROM</th>
                            <th>TO</th>
                            <th>CLASS</th>
                            <th colspan="2">APPROVE?</th>
                        </tr>
                
                <?php
                 $srno = 1;
                    while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                        $id = $row['id']
                        ?>
                            <tr>
                                <td><?php echo $srno;?></td>
                                <td><?php $er = $row['enrollno']; echo $row['enrollno'];?></td>
                                <td><?php echo $row['student_name'];?></td>
                                <td><?php echo $row['message']; ?></td>
                                <td><?php echo $row['from_date']; ?></td>
                                <td><?php echo $row['to_date']; ?></td>
                                <td><?php echo $row['class']; ?></td>
                                <td>
                                    <?php 
                                    echo "<a href='../db/approve.php?id=".$id."&approve=1&enroll=".$er."'><button>YES</button></a>";
                                    ?> 
                                </td>
                                <td>
                                    <?php 
                                    echo "<a href='../db/approve.php?id=".$id."&approve=0&enroll=".$er."'><button>NO</button></a>";
                                    ?> 
                                </td>
                            </tr>  
                        <?php
                        $srno++;
                    }  
                ?>
                    </table>
                </div> 
            <?php
          
    }
}
?>