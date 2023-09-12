<?php
$class =  $_SESSION['class'];
if(isset($_SESSION['hod'])){

}
if(isset($_GET['below']) OR isset($_GET['btwn'])){


if(isset($_GET['below'])){
    // echo '75';
    $query = "SELECT COUNT(*) as total_records FROM 1tet WHERE `percentage` < 75 AND class = '$class'" ;
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $total_records = $row['total_records'];

    // Determine number of records to display per page and current page number
    $records_per_page = 10;
    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;


    // Calculate offset for SQL query based on current page number and number of records per page
    $offset = ($current_page - 1) * $records_per_page;
    $filter = "SELECT 1tet.*, student_details.student_name FROM `1tet` LEFT JOIN student_details ON 1tet.enrollno = student_details.enrollno WHERE 1tet.percentage BETWEEN 75 AND 89 AND 1tet.class = '$class'  LIMIT $offset, $records_per_page ";
   
}
if(isset($_GET['btwn'])){
    $query = "SELECT COUNT(*) as total_records FROM 1tet WHERE `percentage` BETWEEN 75 AND 89 AND class = '$class'" ;
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $total_records = $row['total_records'];

    // Determine number of records to display per page and current page number
    $records_per_page = 10;
    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
    // Calculate offset for SQL query based on current page number and number of records per page
    $offset = ($current_page - 1) * $records_per_page;
    //$filter = "SELECT * FROM 1tet WHERE `percentage` BETWEEN 75 AND 89 AND class = '$class'  LIMIT $offset, $records_per_page";
    $filter = "SELECT 1tet.*, student_details.student_name FROM `1tet` LEFT JOIN student_details ON 1tet.enrollno = student_details.enrollno WHERE 1tet.percentage BETWEEN 75 AND 89 AND 1tet.class = '$class'  LIMIT $offset, $records_per_page ";

}

$filter_result = $conn->query($filter);
if($filter_result){
?>

    <table>
        <tr>
            <th></th>
            <th>ENROLLMENT NO.</th>
            <th>NAME</th>
            <th>TOTAL LECTURES</th>
            <th>PRESENT</th>
            <th>ATTENDANCE</th>
        </tr>
       
    
<?php
    $abc = 1;
        while($attendace_table_row = mysqli_fetch_array($filter_result, MYSQLI_ASSOC)){
        ?>
         <tr>
            <td><?php echo $abc; ?></td>
            <td><?php echo $attendace_table_row['enrollno']; ?></td>
            <td><?php echo $attendace_table_row['student_name']; ?></td>
            <td><?php echo $attendace_table_row['total']; ?></td>
            <td><?php echo $attendace_table_row['present']; ?></td>
            <td><?php echo $attendace_table_row['percentage'].'%'; ?></td>
        </tr>
        <?php
        $abc++;
        }
    }
?>   
</table>
<table id="pagination">
<tr>

<?php

if(isset($_GET['below'])){
    $total_pages = ceil($total_records / $records_per_page);
    for ($i = 1; $i <= $total_pages; $i++) {
    ?>
        <td>
    <?php
        echo '<a id="pagination" href="?below=75&page=' . $i . '">' . $i . '</a> </td>';
    }
}

if(isset($_GET['btwn'])){
    $total_pages = ceil($total_records / $records_per_page);
    for ($i = 1; $i <= $total_pages; $i++) {
        ?>
        <td>
    <?php
        echo '<a id="pagination" href="?btwn=75-90&page=' . $i . '">' . $i . '</a> </td>';
    }
}
}

?>

</tr>
  </table>