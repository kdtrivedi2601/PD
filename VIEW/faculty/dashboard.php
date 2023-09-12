<link rel="stylesheet" href="./css/header.css">
<link rel="stylesheet" href="./css/main.css">
<link rel="stylesheet" href="./css/faculty_dashboard.css">
<?php
// include('../db/dbconn.php');
// include('../header.php');
if(isset($_SESSION['cc']) OR isset($_SESSION['hod'])){
?>
    <ul>
        <li><a href="?btn=1"><button>Manage Subjects</button></a></li>
        <li><a href="?anmt=1"><button>Announcement</button></a></li>  
    </ul>

    <div id="mange_subs">
            <?php
                include('../db/manage_subs.php');
             ?>
    </div>

    <div id="announcement">
            <?php
                include('../db/announcement.php');
             ?>
    </div>
    <div id="feedback">
            <?php
            include('../db/dbconn.php');
                
        // Check if the row value has been set in the session
        if (!isset($_SESSION['feedback'])) {
            // Set the initial value of the row to 0
            $_SESSION['feedback'] = 0;
        }

        // Check if the button has been clicked
        if(isset($_POST['feedback'])) {
            // Toggle the row value
            $_SESSION['feedback'] = $_SESSION['feedback'] == 0 ? 1 : 0;
        }

        // Get the current value of the row from the session
        $fdbk = $_SESSION['feedback'];
        $emp = $_SESSION['empcode'];
        $sql = "UPDATE faculty_details SET feedback = '$fdbk' WHERE emp_no = '$emp'";

        if ($fdbk == 1) {
          echo "Feedback Is Open Now";
        } else  if ($fdbk == 0) {
          echo "Feedback Is Closed";
        }
        ?>

        <form method="post">
        <button type="submit" name="feedback">Feedback</button>
    </form>
             
    </div>  
<?php
    
}
?>
