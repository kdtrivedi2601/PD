<?php
    session_start();
    require("dbconn.php");
    
    $name = $_POST['name'];   
    $email = $_POST['email'];
    $number = $_POST['phone']; 
    $erno = $_POST['erno'];
    $pass = $_POST['psw'];
    
    
    $erno_check = "SELECT enrollno FROM student_details WHERE enrollno = '$erno' AND parent_phone = ''";
    $if_exsist = $conn->query($erno_check);
    // echo $erno_check.'<br>';
    if($if_exsist){
    
    $check = "SELECT email, parent_phone FROM parents_details WHERE email = '$email' OR parent_phone = '$number'";
    $result = $conn->query($check);
    
    // echo $check;
    // exit (0);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

    if($email == $row['email']){
        $_SESSION['email_exists'] = 1;
        header("location: ../VIEW/signup.php");
    }
    else if($number == $row['phone']){
        $_SESSION['number_exists'] = 1;
        header("location: ../VIEW/signup.php");
    }
    else if($_POST['psw'] != $_POST['pswr']){
        $_SESSION['password_error'] = 1;
        header("location: ../VIEW/signup.php");
    }
    else{
        $sql = "INSERT INTO parents_details (parent_name, parent_phone,  email, password) 
                    VALUES('$name','$number','$email','$pass')";
        $conn->query($sql);

        $update = "UPDATE student_details SET parent_phone = '$number' WHERE enrollno = '$erno'";
        $conn->query($update);
        $_SESSION['registered'] = 1;
        header("location: ../VIEW/login.php");
    }
}
?>