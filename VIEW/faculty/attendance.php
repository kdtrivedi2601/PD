<?php
if(isset($_SESSION['faculty'])){  
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>

   <style>
      table,td,th {
         border:2px solid #000;
         border-collapse:collapse;
         text-align: center;
      }
   
   </style>

</head>
<body>
   
</body>
</html>
<div class="main_div">
<form action="" method="GET">
   <label for="check attendance">CHECK ATTENDANCE</label>
   <br>
   <input type="text" name="erno" class="input" placeholder="enter student's enrollment number" required>
   <br>
   <button>SEARCH</button>
</form>

<div id="show_attendance">
<?php
   if(isset($_GET['erno'])){
      $erno = $_GET['erno'];
      $name = "SELECT * FROM 1tet where enrollno = '$erno'";
        $result1 = mysqli_query($conn,$name);
        if($result1){
            $get_specific_attendance = mysqli_fetch_array($result1, MYSQLI_ASSOC);

            echo "<h3>Total Lectures: ".$get_specific_attendance['total']."<h3>";
            echo "<h3>Total Attended Lectures: ".$get_specific_attendance['present']."<h3>";
            echo "<h3>Total Attendance: ".$get_specific_attendance['percentage']."%<h3>";
        }       
   ?>
</div>
<button id="hide" onclick="hide()">HIDE</button>
<script>
   function hide(){
      location.href="attendance.php";
   }
</script>
</div>
<?php
}
?>
<?php
if($_SESSION['faculty'] == 2){
?>
<div>
   <ul>
      <li><a href="?below=75"><button>BELOW 75</button></a></li>
      <li><a href="?btwn=75-90"><button>75-90</button></a></li>
   </ul>
</div>
<div id="filter_attendance">
   <h1></h1>
   <!-- <a href = '../db/give_attendance.php'><button>click</button></a> -->
   <?php 
      //  if(isset($_GET['below'])){
      //       $filter = 75;
            require('../db/filter_attendance.php');
      //  }
      
   ?>
</div>

<?php
if(isset($_SESSION['cc'])){
?>
<br><button id='give_attendance' onclick="give_attendance()">MAKE ATTENDANCE</button>
<div id="upload_attendance" style="display:none">
   <h1></h1>
   <!-- <a href = '../db/give_attendance.php'><button>click</button></a> -->
   <?php 
            require('../db/give_attendance.php');

   ?>
</div>
<?php
}
}
?>

<?php
}
?>
