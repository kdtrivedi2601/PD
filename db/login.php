<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <!-- <link rel="stylesheet" href="./css/logreg.css"> -->
  
</body>
</html>
<?php
require('dbconn.php');
session_start();

if(isset($_POST["p_phone"])){
  $p_phone = $_POST["p_phone"];
  $password = $_POST["p_password"];

  $sql_parent = "SELECT parent_name, parent_phone, email, password 
                FROM parents_details WHERE parent_phone = '$p_phone' and password = '$password'";
  $result = $conn->query($sql_parent);

  if($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
    $_SESSION['login'] = $row['parent_name'];
    $_SESSION['id'] = $row['parent_phone'];
    $_SESSION['parent'] = 1;
    header("location: ../VIEW/dashboard.php");
  }
  else {
    $_SESSION['invalid_user'] = 1;
    header('location: ../VIEW/login.php');
  }

}


if(isset($_POST["email"])){
  $email = $_POST["email"];
  $password = $_POST["s_password"];

  $sql_student = "SELECT student_name, enrollno, email, class, password 
                  FROM student_details WHERE email = '$email' and password = '$password'";
  $result1 = $conn->query($sql_student);


  if($row = mysqli_fetch_array($result1,MYSQLI_ASSOC)){
    $_SESSION['login'] = $row['student_name'];
    $_SESSION['id'] = $row['enrollno'];
    $_SESSION['student_email'] = $row['email'];
    $_SESSION['student'] = 1;
    $_SESSION['sclass'] = $row['class'];
    header("location: ../VIEW/dashboard.php");
  }
  else {
    $_SESSION['invalid_user'] = 1;
    header('location: ../VIEW/login.php');
  }
}


if(isset($_POST['emp_no'])){
  $emp_no = $_POST['emp_no'];
  $password = $_POST['e_password'];
  $_SESSION['empcode'] = $_POST['emp_no'];
  $sql_faculty = "SELECT emp_name, emp_no, email, class, password, `admin` 
                  FROM faculty_details WHERE emp_no = '$emp_no' and password = '$password'";
  $result2 = $conn->query($sql_faculty);
    if($row = mysqli_fetch_array($result2,MYSQLI_ASSOC)){
      if($row['admin'] == 1 AND $row['class'] == NULL){
        $_SESSION['login'] = $row['emp_name'];
        $_SESSION['id'] = $row['emp_no'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['hod'] = 1;
        $_SESSION['faculty'] = 2;
        header("location: ../VIEW/dashboard.php");
      }
      else if($row['admin'] == 1 AND $row['class'] == !NULL){
        $_SESSION['login'] = $row['emp_name'];
        $_SESSION['id'] = $row['emp_no'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['cc'] = $row['admin'];
        $_SESSION['class'] = $row['class'];
        $_SESSION['faculty'] = 2;
        header("location: ../VIEW/dashboard.php");
      }
      else{
        $_SESSION['login'] = $row['emp_name'];
        $_SESSION['id'] = $row['emp_no'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['faculty'] = 1;
      }
    }
    else {
      $_SESSION['invalid_user'] = 1;
      header('location: ../VIEW/login.php');
    } 
}
  
?>