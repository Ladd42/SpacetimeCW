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

echo"<h1><center>Spacetime</center></h1>";


$userinfo="SELECT * from players where player='$user'";
$userinfo2=mysqli_query($mysqli, $userinfo) or die("could not get player stats!");
$userinfo3=mysqli_fetch_array($userinfo2);

$userhitpoints = $userinfo3['hitpoints'];
$userattack = $userinfo3['attack'];
$userdefence = $userinfo3['defence'];


if (isset($_GET['randid']))
{
    $randid=$_GET['randid'];
    $iteminfo="SELECT * from inventory where randid = '$randid'";
    $iteminfo2=mysqli_query($mysqli, $iteminfo) or die("could not get the item stats!");
    $iteminfo3=mysqli_fetch_array($iteminfo2);

    if (!$iteminfo3['name'])
    {
    }
    else
    {
        $ID = $iteminfo3['ID'];
        $name = $iteminfo3['name'];
        $stats = $iteminfo3['stats'];
        $statadd = $iteminfo3['statadd'];
        $type = $iteminfo3['type'];

        if ($type == "healing")
        {
            $newhitpoints = $statadd + $userhitpoints;
            if ($newhitpoints > $userinfo3['maxhitpoints'])
            {
                $newhitpoints = $userinfo3['maxhitpoints'];
            }
            $updateplayer="UPDATE players set hitpoints='$newhitpoints' where ID = '$ID'";
            mysqli_query($mysqli, $updateplayer) or die ("Could not update player");

            $updateitem="DELETE from inventory where name ='$name' AND randid='$randid' limit 1";
            mysqli_query($mysqli, $updateitem) or die ("Could not delete item");

            $userhitpoints = $newhitpoints;

            echo "Used " . $name . " and recovered " . $statadd . " to ships health<br>";
        }


    }
}

$destroyer = $userinfo3['destroyer'];
if ($destroyer != 0)
{
    $destroyerinfo="SELECT * from destroyers where id = '$destroyer'";
    $destroyerinfo2=mysqli_query($mysqli, $destroyerinfo) or die("could not get the destroyer you were fighting!");
    $destroyerinfo3=mysqli_fetch_array($destroyerinfo2);

}
else
{
    $destroyerinfo="SELECT * from destroyers order by rand() limit 1";
    $destroyerinfo2=mysqli_query($mysqli, $destroyerinfo) or die("could get a destroyer!");
    $destroyerinfo3=mysqli_fetch_array($destroyerinfo2);
    $destroyerid = $destroyerinfo3['ID'];
    $updateplayer="update players set destroyer='$destroyerid' where player = '$user'";
    mysqli_query($mysqli, $updateplayer) or die ("Couldn't update the player");
}

$destroyer = $destroyerinfo3['name'];
$destroyerhp = $destroyerinfo3['hitpoints'];
$destroyerattack = $destroyerinfo3['attack'];
$destroyerdefence = $destroyerinfo3['defence'];

/////player info
echo "<u> " . $userinfo3['player'] . "</u><br>";
echo "Hit points = " . $userhitpoints . "<br>";
echo "Attack = " . $userattack . "<br>";
echo "Defence = " . $userdefence . "<br><br><br>";

///////destroyer info
echo "<u> " . $destroyerinfo3['name'] . "</u><br>";
echo "Hit points = " . $destroyerhp . "<br>";
echo "Attack = " . $destroyerattack . "<br>";
echo "Defence = " . $destroyerdefence . "<br><br><br>";

echo "<a href='attack.php?destroyer=$destroyer'>Attack";

echo "<br><a href='store.php?destroyer=$destroyer'>Go to the store";
echo "<br><a href='useitem.php?destroyer=$destroyer'>Use an item";
echo "<br><a href='profile.php'>Profile</a><br><br><br>";

$i = 0;
$messageinfo="SELECT userid from messages where userid='$user' AND readm = '1'";
$messageinfo2=mysqli_query($mysqli,$messageinfo) or die("Could not get message stats");
while($messageinfo3=mysqli_fetch_array($messageinfo2))
{$i = $i + 1;}
if($i > 0){echo "<a href='profile.php?messages=1'>Messages(" . $i . ")</a><br>";}
else{echo "<a href='profile.php?messages=1'>Messages<br></a>";}






echo "<br><big><u>Scraps</u></big><br>";
echo $userinfo3['scraps'];

echo "<br><big><u>Level</u></big><br>";
echo $userinfo3['level'];

$experneeded = ($userinfo3['level'] * 10) * $userinfo3['level'];
if ($userinfo3['exper'] >= $experneeded)
{
    echo "<br><br><br><a href='levelup.php'>Level Up.</a><br>";
}


echo"<br><br><br><A href = 'Logout.php'>Logout";



?>

