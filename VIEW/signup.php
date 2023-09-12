<?php
  require('../db/dbconn.php');
?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <!-- Bootstrap CSS -->
  <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
  <link rel = "stylesheet" href="./css/Signup.css">
</head>
<body>
<div class="main_class" align = "center">
  <div class="new" align="c">
<form action="../db/signup.php" method="post" align="center" id="fm" class="fm">
    <div class="container">
      <h2 class="header text-center py-3">REGISTER</h2>
      <!-- <p class="lead text-center">Please fill in this form to create an account.</p> -->
      <div class="form-group">
        <label for="name"><b>Full Name</b></label>
        <input type="text" placeholder="Enter Your Name" name="name" id="name" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="phone"><b>Phone Number</b></label>
        <input type="text" placeholder="Enter Your Phone number" name="phone" id="phone" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="erno"><b>Enrollment Number</b></label>
        <input type="text" placeholder="Enter Your Child's Enrollment number" name="erno" id="erno" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="email"><b>Email</b></label>
        <input type="email" placeholder="Enter Email" name="email" id="email" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="psw" id="psw" class="form-control" required>
      </div>
      <div class="form-group">
        <label for="pswr"><b>Confirm Password</b></label>
        <input type="password" placeholder="Confirm Password" name="pswr" id="pswr" class="form-control" required>
      </div>
      <input type="submit" value="signup" class="form-control">
    </div>
    
  </form>  
  <div class="container text-center mt-3" align = "center">
      <p>Already have an account? <a href="./login.php"><button>LOGIN</button></a></p>
    </div>
</div>
</div>
<!-- Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
