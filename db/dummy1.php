<?php
require('dbconn.php');
// Connect to the database and retrieve the user's username based on the user ID


$query = "SELECT student_name FROM student_details WHERE enrollno = $userId";
$result = mysqli_query($conn, $query);
$userData = mysqli_fetch_assoc($result);

// Return the user's username as a JSON object
header('Content-Type: application/json');
echo json_encode($userData);
?>
