<?php
include 'database.php';
if ($conn) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "select Id from admin where username='$username' and password='$password'";
    $rw = mysqli_query($conn, $sql);
    $result = mysqli_fetch_all($rw, MYSQLI_ASSOC);
    if (count($result) == 0) {
       die("1");
    } else {
       die("0");
    }
}