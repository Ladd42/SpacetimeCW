<?php
include_once 'connect.php';
session_start();

if (isset($_SESSION['player']))
{
    $user=$_SESSION['player'];
}
else
{
    echo"Not logged in <br> <a href='login.php'>Login</a>";
    exit;
}

$destroyer=$_GET['destroyer'];

$userinfo="SELECT * from players where player='$user'";
$userinfo2=mysqli_query($mysqli, $userinfo) or die ("Could not get player stats");
$userinfo3=mysqli_fetch_array($userinfo2);

$userid = $userinfo3['ID'];

$counter = 0;
echo "<small>";
print"<div style=\"text-align: center;\">";
print "<table border='0' width='70%' cellspacing='25'>";
print "<tr><td width='25%' valign='top'>";
print "</td>";
print "<td valign='top' width='70%'>";
$invinfo="SELECT * from inventory where ID='$userid'";
$invinfo2=mysqli_query($mysqli, $invinfo) or die ("could not get player inventory");
print "<table border = '1' bordercolor = 'black' bgcolor='#ffffff'>";
print "<tr><td>Name<font color='ffffff'>________________</font></td><td>Stat<font color='ffffff'>______</td><td>Stat Add<font color='ffffff'>______</td><td>Type<font color='ffffff'>______</td><td><font color='ffffff'>________________</td></tr>";
while($invinfo3=mysqli_fetch_array($invinfo2))
{
    print "<tr><td>$invinfo3[name]</td><td>$invinfo3[stats]</td><td>$invinfo3[statadd]</td><td>$invinfo3[type]</td><td><a href='battlemode.php?randid=$invinfo3[randid]&destroyer=$destroyer'>Use item</td></tr>";
$counter = 1;
}

print "</table>";
print "</td><tr></table>";
print"</center>";

if ($counter == 0)
{
    echo "<div style=\"text-align: center;\">You have nothing in inventory<br>";
    echo "<a href='battlemode.php?destroyer=$destroyer'>Return";
    exit;
}

echo "<div style=\"text-align: center;\"><a href='battlemode.php?destroyer=$destroyer'>Never mind..";
?>