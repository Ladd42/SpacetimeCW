<?php
include_once 'connect.php';
session_start();

if (isset($_POST['submit']))
{
    $user=$_POST['player'];
    $password=$_POST['pass'];
    $user=strip_tags($user);
    $password=strip_tags($password);
    $password=md5($password);

    $query = "SELECT player,password from players where player='$user' and password='$password'";
    $result = mysqli_query($mysqli, $query) or die("Could not query players");
    $result2 = mysqli_fetch_array($result);
    if ($result2)
    {
        $_SESSION['player']=$user;

        echo "Logged in successfully<br>";
        echo "<A href='battlemode.php'>Continue</a>";
    }
    else
    {
        echo "Wrong username or password.<A href='login.php'>Try Again</a>";
    }
}