<?php
session_start();
if(isset($_SESSION['login'])){
  header('location: dashboard.php');
}
?>

<html>
  <head>
    <title>Login</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="js/checklogin.js"></script>
    <link rel="stylesheet" href="./css/Login1.css">

</head>
<body>
  <div class="main_class" align = "center">
  <h1 id="title">LOGIN</h1>
  <div>
  <form action="../db/login.php" method="post">
    <div>
      <label><input type="radio" name="login" value="student" id="student">STUDENT</label>
      <label><input type="radio" name="login" value="Parent" id="Parent">PARENT</label>
      <label><input type="radio" name="login" value="faculty" id="faculty" >FACULTY</label>
    </div><br><br>
    
    <div class="parent login" id="parent_login" >
      <label for="email">Enter Your Phone Number:</label>
      <input type="text" id="p_phone" name="p_phone" >
      <br><br>
      <label for="password">Password:</label>
      <input type="password" id="password" name="p_password" ><br>
      <br><br>
      <input type="submit" value="LOGIN">
    </div>
    
    <div class="student login" id="student_login">
      <label for="email">Enter your Email ID:</label>
      <input type="email" id="email" name="email" >
      <br><br>
      <label for="password">Password:</label>
      <input type="password" id="password" name="s_password" ><br>
      <br><br>
      <input type="submit" value="LOGIN">
    </div>
    
    <div class="faculty login">
      <label for="email">Enter your Employe Number:</label>
      <input type="text" id="emp_no" name="emp_no" >
      <br><br>
      <label for="password">Password:</label>
      <input type="password" id="password" name="e_password" ><br>
      <br><br>
      <input type="submit" value="LOGIN">
    </div>
  </form>
  </div>
  Don't have an account ?
  <a href = "./signup.php"><Button>SIGNUP</button></a>
</div>
    </body>
  </html>
  <?php
    if(isset($_SESSION['invalid_user'])){
      ?>
        <span id = 'message'>Invalid Password!</span>
        <script>setTimeout(function() {
          document.getElementById("message").style.display = 'none';
        }, 3000);</script>
    <?php
    unset($_SESSION['invalid_user']);
  }
  
  ?>
    <?php
    if(isset($_SESSION['registered'])){
      ?>
        <span id = 'message'>Registration Successfull</span>
        <script>setTimeout(function() {
          document.getElementById("message").style.display = 'none';
        }, 3000);</script>
    <?php
    unset($_SESSION['registered']);
  }
  ?>  