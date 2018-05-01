<?php
include 'connect.php';
session_start();


session_destroy();
echo "Logged out. <A href = 'Login.php'><br><br>Log Back in?";

?>