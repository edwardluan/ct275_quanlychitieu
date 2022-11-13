<?php

include_once('connection.php');

function test_input($data)
{

    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = test_input($_POST["username"]);
    $password = test_input($_POST["password"]);
    $stmt = $conn->prepare("SELECT * FROM adminlogin");
    $stmt->execute();
    $users = $stmt->fetchAll();

    foreach ($users as $user) {

        if (($user['username'] == $username) &&
        ($user['password'] == $password)) {
            header("location:http://localhost/Daily-Expense-Tracker-Project/Daily%20Expense%20Tracker%20Project/dets/controler/adminpage.php");
        } else {
            echo "<script language='javascript'>";
            echo "alert('Tài khoản hoặc mật khẩu không đúng !')";
            echo "</script>";

            die();
        }
    }
}

?>