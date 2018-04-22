<?php
include_once 'connect.php';
session_start();

if (isset($_SESSION['player']))
{
    $user=$_SESSION['player'];
}
else
{
    echo"Not logged in <br> <a href='login.php'</a>";
    exit;
}

$destroyer=$_GET['destroyer'];
$randid=$_GET['randid'];

$userinfo="SELECT * from players where player='$user'";
$userinfo2=mysqli_query($mysqli, $userinfo) or die ("Could not get player stats");
$userinfo3=mysqli_fetch_array($userinfo2);

$userid = $userinfo3['ID'];

$iteminfo="SELECT * from store where randid='$randid'";
$iteminfo2=mysqli_query($mysqli, $iteminfo) or die ("Could not get item stats");
$iteminfo3=mysqli_fetch_array($iteminfo2);

$name = $iteminfo3['name'];
$stats = $iteminfo3['stats'];
$statadd = $iteminfo3['statadd'];
$type = $iteminfo3['type'];
$randid2 = rand(1000,999999999);

$itembought="INSERT into inventory(ID, name, stats, statadd, price, randid,type) values ('$userid','$name','$stats','$statadd', '0', '$randid2','$type')";
mysqli_query($mysqli, $itembought) or die ("Could not add item to inventory");

echo $name . " has been purchased";
echo "<div style=\"text-align: center;\"><a href ='battlemode.php?destroyer=$destroyer'>Return</a>";
?>