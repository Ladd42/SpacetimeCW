<?php
$mysqli = mysqli_connect("localhost", "root","") or die ("Could not connect to DB");
if(!$mysqli)
die ("No DB found");
if(!mysqli_select_db($mysqli,"spacetime"))
die ("No DB selected");

?>