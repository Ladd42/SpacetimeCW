<?php
include 'connect.php';
?>

<?php
$user=$_POST['player'];
$pass=$_POST['pass'];
$pass2=$_POST['pass2'];
$user=strip_tags($user);
$email=$_POST['email'];
$email=strip_tags($email);

if ($email == "")
{
echo "You didn't enter an email address!<br>";
echo " <A href='register.php'>Go Back</a>";
exit;
}
if ($pass==$pass2)
{
$valuser="SELECT * from players where player ='$user'";
$valuser2=mysqli_query($mysqli, $valuser) or die("Could not retrieve players table");
$valuser3 =mysqli_fetch_array($valuser2);

if (!$_POST['pass'] || !$_POST['pass2'])
{
echo "Please enter a password";
echo " <A href='register.php'>Return to register page</a></br>";
exit;
}

else if(($valuser3) || strlen($user)>20 || strlen($user)<1)
{
  print"already an existing user with that name or >20 or <1 character";
  echo " <A href='register.php'>Go Back</a><br>";
  exit;
}
else

$valemail="SELECT * from players where email ='$email'";
$valemail2= mysqli_query($mysqli, $valemail) or die ("unable to query for email");
$valemail3=mysqli_fetch_array($valemail2);
if($valemail3)
{
echo "Already an existing user with that email";
echo " <A href='register.php'>Return to register page</a></br>";
exit;
}
else
{
$pass=md5($pass);

$SQLi = "INSERT into players(player, password, email, level, exper, attack, defence, hitpoints, maxhitpoints, scraps, destroyer) VALUES ('$user', '$pass', '$email', '1', '0', '5', '5', '30', '35', '20', '0')";
mysqli_query($mysqli, $SQLi) or die ("Unable to register");

echo "Thank you for registering with Spacetime!";

}
}

else 
{
echo "Please check the passwords are matching";
echo " <A href='register.php'>Return to register page</a></br>";
exit;
}

echo "<A href='login.php'> Login Page</a><br>";
?>