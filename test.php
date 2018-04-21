<?php
include 'connect.php';

$playerdetails ="Select * from players where name = 'User1'";
$playerdetails2 = mysqli_query($db, $playerdetails) or die ("Couldn't find details for player");
$playerdetails3 = mysqli_fetch_array($playerdetails2);

echo "User 1 email = " . $playerdetails3['email'];
echo "<br> User 1 ID = " . $playerdetails3['ID'];
