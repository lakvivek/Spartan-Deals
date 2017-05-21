<?php   
session_start(); //to ensure you are using same session //destroy the session
unset($_SESSION['session_user']);
header("location:index.html");
exit(); //to redirect back to "index.php" after logging out
?>