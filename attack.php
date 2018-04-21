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




$userinfo="SELECT * from players where player='$user'";
$userinfo2=mysqli_query($mysqli, $userinfo) or die("could not get player stats!");
$userinfo3=mysqli_fetch_array($userinfo2);



if (isset($_GET['destroyer']))
{
    $destroyer=$_GET['destroyer'];
    $destroyerinfo="SELECT * from destroyers where name = '$destroyer'";
    $destroyerinfo2=mysqli_query($mysqli, $destroyerinfo) or die("could not get the destroyer you were fighting!");
    $destroyerinfo3=mysqli_fetch_array($destroyerinfo2);

}
else
{
    echo "<a href='battlemode.php'>No Destroyer selected. Return.";
    exit;
}

$userhp = $userinfo3['hitpoints'];
$userattack = $userinfo3['attack'];
$userdefence = $userinfo3['defence'];

$destroyer = $destroyerinfo3['name'];
$destroyerhp = $destroyerinfo3['hitpoints'];
$destroyerattack = $destroyerinfo3['attack'];
$destroyerdefence = $destroyerinfo3['defence'];


////////////////////////////PLAYER/////////////////////////////



echo "<u> " . $userinfo3['player'] . "'s Attack</u><br>";
$userattack = rand(1,20) + $userattack;
$destroyerdefence = rand(1,20) + $destroyerdefence;

echo $userinfo3 ['player'] . "'s Attack roll is " . $userattack . "<br>";
echo $destroyer . "'s defence roll is " . $destroyerdefence . "<br>";

if($userattack > $destroyerdefence)
{
    echo $userinfo3['player'] . "hits! <br>";
    $userdamage = rand(1, 6);
    $newdestroyerhp = $destroyerhp - $userdamage;
    echo "For " . $userdamage . "points of damage . <br>";
    if ($newdestroyerhp < 1)
    {
        echo "The " . $destroyer . "has been killed";

        $updatedestroyer="DELETE from destroyers where name ='$destroyer' limit 1";
        mysqli_query($mysqli, $updatedestroyer) or die ("Could not update destroyer");

        if ($userinfo3['level'] > $destroyerinfo3['level'])
{
    $mod = $userinfo3['level'] - $destroyerinfo3['level'];
    $mod2 = $mod * 10;
    if ($mod2 > 90) ($mod2 = 90);
    $mod3 = ($mod2 / 100) * $destroyerinfo3['exper'];
    $totalexper = $destroyerinfo3['exper'] - $mod3;
}
else
{
    $mod = $userinfo3['level'] - $destroyerinfo3['level'];
    $mod2 = $mod * 10;
    if ($mod2 > 90) ($mod2 = 90);
    $mod3 = ($mod2 / 100) * $destroyerinfo3['exper'];
    $totalexper = $destroyerinfo3['exper'] + $mod3;

}
$totalexper = (int) $totalexper;
echo "<br><br> You Gain " . $totalexper . " experience.</br></br>";
$updateuser="update players set exper=exper+'$totalexper' where player='$user'";
mysqli_query($mysqli, $updateuser) or die ("Could not update player");




        echo "<a href='battlemode.php'> Return";
        exit;
    }
    $updatedestroyer = "update destroyers set hitpoints='$newdestroyerhp' where name='$destroyer' limit 1";
    mysqli_query($mysqli, $updatedestroyer) or die("could not update destroyer");
}

else
{
    echo $userinfo3['player'] . " misses!<br>";
}


////////////////////////////DESTROYER/////////////////////////////



echo "<u> " . $destroyer . "'s Attack</u><br>";
$destroyerattack = rand(1,20) + $destroyerattack;
$userdefence = rand(1,20) + $userdefence;

echo $destroyer . "'s Attack roll is " . $destroyerattack . "<br>";
echo $userinfo3 ['player']. "'s defence roll is " . $userdefence . "<br>";

if($destroyerattack > $userdefence) {
    echo $destroyer . "hits! <br>";
    $destroyerdamage = rand(1, 6);
    $newuserhp = $userhp - $destroyerdamage;
    echo "For " . $destroyerdamage . "points of damage . <br>";
    if ($newuserhp < 1) {
        echo $userinfo3['player'] . "has been killed";
        echo "<a href ='gameend.php'>Continue";
        exit;
    }
    $updateuser ="UPDATE players set hitpoints='$newuserhp' where player ='$user'";
    mysqli_query($mysqli, $updateuser) or die ("Could not update the current player");
}
else
{
    echo $destroyer . "missed!";
}

echo"<br><a href='battlemode.php?destroyer=$destroyer'> Re Engage enemy.";
