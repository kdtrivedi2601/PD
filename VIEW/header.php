<?php
session_start();
?>  
<link rel="stylesheet" href="css/header.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="js/header.js"></script>
</head>
<body>
  
<div id="myDIV">
    <nav>
        <ul>
            <li><a class="nav-link" href="dashboard.php">Home</a></li>
          
            <li><a class="nav-link" href="leaves.php">Check Leaves</a></li>
           
            <li><a class="nav-link" href="attendance.php">Attendance</a></li>
            <li><a class="nav-link" href="remarks.php">Remarks</a></li>
            <li><a class="nav-link" href="profileupdate.php"><?php echo $_SESSION['login'];?></a></li>
            <li><a class="nav-link" href="signout.php">Sign Out</a></li>
        </ul>
    </nav>
</div>
</body>
</html>
