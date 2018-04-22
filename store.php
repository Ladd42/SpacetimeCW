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

$userinfo="SELECT * from players where player='$user'";
$userinfo2=mysqli_query($mysqli, $userinfo) or die ("Could not get player stats");
$userinfo3=mysqli_fetch_array($userinfo2);

$userid = $userinfo3['ID'];

$counter = 0;
echo "<small>";
//print"<div style=\"text-align: center;\">";
print "<table border='0' width='70%' cellspacing='25'>";
print "<tr><td width='25%' valign='top'>";
print "</td>";
print "<td valign='top' width='70%'>";
$invinfo="SELECT * from store where amount > 0";
$invinfo2=mysqli_query($mysqli, $invinfo) or die ("could not select anything from the store");
print "<table border = '1' bordercolor = 'black' bgcolor='white'>";
print "<tr><td>Name</td><td>Stat</td><td>Stat Add</td><td>Type</td><td>Price</td>";
while($invinfo3=mysqli_fetch_array($invinfo2))
{
    print "<tr><td>$invinfo3[name]</td><td>$invinfo3[stats]</td><td>$invinfo3[statadd]</td><td>$invinfo3[type]</td><td>$invinfo3[price]</td><td><a href='buyitem.php?randid=$invinfo3[randid]&destroyer=$destroyer'>Buy item</td></tr>";
    $counter = 1;
}

print "</table>";
print "</td><tr></table>";
print"</center>";

if ($counter == 0)
{
    echo "<div style=\"text-align: center;\">There is nothing in the store at this time<br>";
    echo "<a href='battlemode.php?destroyer=$destroyer'Return>";
    exit;
}

echo "<div style=\"text-align: center;\"><a href='battlemode.php?destroyer=$destroyer'>Never mind..";
?>