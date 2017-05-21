<?php
session_start();
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

$email= $_POST['email'];
$f_name = $_POST['firstName'];
$l_name = $_POST['lastName'];
//$email = stripcslashes($email);
$sql = "SELECT * FROM User where UserEmail ='" . $email . "'";
 $result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $sql_username = $row['UserEmail'];
                if ($sql_username == $email ){
                $_SESSION['session_user'] = $sql_username;
                $_SESSION['session_id'] = $row['UserId'];
                }
        }
} else {
$sql = "INSERT INTO User (UserName, UserPassword, UserEmail)
VALUES ('$f_name $l_name', '', '$email')";
$conn->query($sql);
$sql = "SELECT * FROM User where UserEmail ='" . $email . "'";
 $result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $sql_username = $row['UserEmail'];
                if ($sql_username == $email ){
                $_SESSION['session_user'] = $sql_username;
                $_SESSION['session_id'] = $row['UserId'];
                }
        }
    }
}
?>