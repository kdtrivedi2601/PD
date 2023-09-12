<?php

// echo $_SESSION['sclass'];
   use PHPMailer\PHPMailer\PHPMailer;
   use PHPMailer\PHPMailer\Exception;
   require ('include/PHPMailer.php');
   require ('include/SMTP.php');
   require 'include/Exception.php';
   session_start();
   require("dbconn.php");
    
    $name = $_SESSION['login'];
    $from = $_POST['start_date'];   
    $to = $_POST['end_date'];
    $reason = mysqli_real_escape_string($conn,$_POST['reason']); 
    $message = mysqli_real_escape_string($conn,$_POST['message']);
    $erno = $_SESSION['id'];
    $sql = "INSERT INTO leaves (enrollno, reason, `message`, from_date, to_date)
                        VALUES('$erno', '$reason', '$message', '$from', '$to')";
     if($conn->query($sql)){
       

        $class = $_SESSION['sclass'];
        $student_email = $_SESSION['student_email'];
        $select = "SELECT email FROM faculty_details WHERE 
                           class = '$class'";
        $result = $conn->query($select);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $receiver = $row['email'];
         $mail = new PHPMailer(true);
         try {
         $mail->isSMTP(); // using SMTP protocol                                     
         $mail->Host = 'smtp.gmail.com'; // SMTP host as gmail 
         $mail->SMTPAuth = true;  // enable smtp authentication                             
         $mail->Username = '3000legacy22@gmail.com';  // sender gmail host              
         $mail->Password = 'ixyugqwpkrmgggot'; // sender gmail host password                          
         $mail->SMTPSecure = 'tls';  // for encrypted connection                           
         $mail->Port = 587;   // port for SMTP     

         $mail->setFrom($student_email, $name); // sender's email and name
         $mail->addAddress($receiver, "Receiver");  // receiver's email and name

         $mail->Subject = $reason;
         $mail->Body    = $message;
         //$mail->addAttachment('');
         $mail->send();
         //echo 'Email has been sent. If not recieved please check SPAM box.';
         $_SESSION['leave_submitted']=1;
         header('location: ../VIEW/leaves.php');
         } catch (Exception $e) { // handle error.
            $_SESSION['mail_error'] = 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
         }
         
     }
   

?>