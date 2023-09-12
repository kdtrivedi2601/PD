<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
session_start();
require ('include/PHPMailer.php');
require ('include/SMTP.php');
require 'include/Exception.php';
 require('dbconn.php');
 if(isset($_GET['id'])){
    $er = $_GET['id'];
    $approve = $_GET['approve'];
    if($_GET['approve'] == 1){
        $approve = $_GET['approve'];
        $student = $_GET['enroll'];
        $select = "SELECT email FROM student_details WHERE enrollno = $student";
        $result = $conn -> query($select);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $student_email = $row['email'];

        $update = "UPDATE leaves SET approve = '$approve' WHERE id = '$er'";
        $conn->query($update);

        $mail = new PHPMailer(true);
         try {
         $mail->isSMTP(); // using SMTP protocol                                     
         $mail->Host = 'smtp.gmail.com'; // SMTP host as gmail 
         $mail->SMTPAuth = true;  // enable smtp authentication                             
         $mail->Username = '3000legacy22@gmail.com';  // sender gmail host              
         $mail->Password = 'ixyugqwpkrmgggot'; // sender gmail host password                          
         $mail->SMTPSecure = 'tls';  // for encrypted connection                           
         $mail->Port = 587;   // port for SMTP     

         $mail->setFrom($_SESSION['email'], $_SESSION['login']); // sender's email and name
         $mail->addAddress($student_email, "Receiver");  // receiver's email and name
         
         
            $mail->Subject = "LEAVE APPROVED.";
            $mail->Body    = "YOUR Leave has been Approved.";
         
            // $mail->Subject = "LEAVE DENIED.";
            // $mail->Body    = "YOUR Leave has been Denied.";
         //$mail->addAttachment('');
         $mail->send();
         //echo 'Email has been sent. If not recieved please check SPAM box.';
         //$_SESSION['leave_submitted']=1;
        header('location: ../VIEW/leaves.php');
         } catch (Exception $e) { // handle error.
            $_SESSION['mail_error'] = 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
            
         }
    }
         else {
            $approve = $_GET['approve'];
            $student = $_GET['enroll'];
            $select = "SELECT email FROM student_details WHERE enrollno = $student";
            $result = $conn -> query($select);
            $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
            $student_email = $row['email'];
    
            $update = "UPDATE leaves SET approve = '$approve' WHERE id = '$er'";
            $conn->query($update);
    
            $mail = new PHPMailer(true);
             try {
             $mail->isSMTP(); // using SMTP protocol                                     
             $mail->Host = 'smtp.gmail.com'; // SMTP host as gmail 
             $mail->SMTPAuth = true;  // enable smtp authentication                             
             $mail->Username = '3000legacy22@gmail.com';  // sender gmail host              
             $mail->Password = 'ixyugqwpkrmgggot'; // sender gmail host password                          
             $mail->SMTPSecure = 'tls';  // for encrypted connection                           
             $mail->Port = 587;   // port for SMTP     
    
             $mail->setFrom($_SESSION['email'], $_SESSION['login']); // sender's email and name
             $mail->addAddress($student_email, "Receiver");  // receiver's email and name
             
             
                $mail->Subject = "LEAVE Denied.";
                $mail->Body    = "YOUR Leave has been Denied.";
             
                // $mail->Subject = "LEAVE DENIED.";
                // $mail->Body    = "YOUR Leave has been Denied.";
             //$mail->addAttachment('');
             $mail->send();
             //echo 'Email has been sent. If not recieved please check SPAM box.';
             //$_SESSION['leave_submitted']=1;
            header('location: ../VIEW/leaves.php');
             } catch (Exception $e) { // handle error.
                $_SESSION['mail_error'] = 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
                
             }
        //header('location: ./../VIEW/leaves.php');
    }
    }
   
?>