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

$bp = 0;
$userinfo="SELECT * from players where player='$user'";
$userinfo2=mysqli_query($mysqli, $userinfo) or die("could not get player stats!");
$userinfo3=mysqli_fetch_array($userinfo2);

if(isset($_POST['sendmessage']))
{
    $message = $_POST['message'];
    $subject = $_POST['subject'];
    $receiver = $_POST['receiver'];
    $randid = rand(999, 9999999);


    $SQL = "INSERT into messages(userid, sender, message, subject, randid) VALUES ('$receiver', '$user', '$message', '$subject', '$randid')";
    mysqli_query($mysqli, $SQL) or die ("Could not add to messages");
    echo "<p align='center''>";
    echo"<b>Message Sent!</b><br>";
}

















///////////////////////see message list
if(isset($_GET['messages']))
{
    $bp = 1;
    echo "<b>Messages</b><br>";
    echo "<small>";
    print "<center>";
    print "<table border='0' width='90%' cellspacing='10'>";
    print "<tr><td width='25%' valign='top'>";
    print "</td>";
    print "<td valign='top' width='85%'>";
    $selectmsg="SELECT * from messages where userid='$userinfo3[player] 'order by date desc";
    $selectmsg2=mysqli_query($mysqli,$selectmsg) or die("could not select messages");
    print "<table border='1' bordercolor='black' bgcolor='#FFFFFF'>";
    print "<tr><td></td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td>Sender</td><td>Subject</td></tr>";
    while($selectmsg3=mysqli_fetch_array($selectmsg2))
    {
        if($selectmsg3['readm'] == 1)
        {
            echo "<tr><td><center>&nbsp;&nbsp;NEW!&nbsp;&nbsp;</td>";
        }
        else
        {
            echo "<tr><td><center>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>";
        }
        echo "<td><center>$selectmsg3[date]</td><td><center>&nbsp;&nbsp;$selectmsg3[sender]&nbsp;&nbsp;</td><td><center>$selectmsg3[subject]</td><td><center><form method='post' action='profile.php'><input type='submit' value='Read'>
	   <input type='hidden' name='readmessage' value='1'>
	   <input type='hidden' name='randid' value='$selectmsg3[randid]'>
	   <input type='hidden' name='date' value='$selectmsg3[date]'>
	    </form></td></tr>";

    }
    print "</table>";
    print "</td></tr></table>";
    echo "</small>";

}


////////////////////////////////read a message

if(isset($_POST['readmessage']))
{
    $bp = 1;
    echo "<b>Read Messages</b><br><br>";
    $randid = $_POST['randid'];
    $date = $_POST['date'];
    $updateship="Update messages SET readm='0' WHERE userid='$user' AND date='$date' AND randid='$randid'";
    mysqli_query($mysqli,$updateship) or die("Could not update player");
    $message="SELECT * from messages where userid='$user' AND date='$date' AND randid='$randid'";
    $message2=mysqli_query($mysqli,$message) or die("Could not get message");
    $message3=mysqli_fetch_array($message2);
    echo "<b>" . $message3['subject'] . "<br></b>From: " . $message3['sender'] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; " . $message3['date'] . "<br><br>";
    echo " " . $message3['message'] . "<br><br><br><br>";
    echo "<form method='post' action='profile.php'><input type='submit' value='Delete'>
	   <input type='hidden' name='deletemessage' value='1'>
	   <input type='hidden' name='randid' value='$message3[randid]'>
	   <input type='hidden' name='date' value='$message3[date]'>
	   </form>";
    echo "<br><center><form method='post' action='profile.php'><input type='submit' value='Back to Inbox'>
	   <input type='hidden' name='messages' value='1'>
	      </form>";
}

if(isset($_POST['deletemessage']))
{
    $bp = 1;
    echo "<b>Delete Messages</b><br><br>";
    $randid = $_POST['randid'];
    $date = $_POST['date'];
    $updateback="DELETE from messages where userid='$user' AND randid='$randid' AND date='$date'";
    mysqli_query( $mysqli,$updateback) or die("Could not delete from messages");
    echo "<center>Message Deleted <b><b><br><br>";
    echo "<form method='post' action='profile.php'><input type='submit' value='Back to Inbox'>
	   <input type='hidden' name='messages' value='1'>
	      </form>";
}







































if ($bp != 1)
{
    echo "<p align='center''>";
    echo "<b>----------------------Send Private Message ---------------------</b>";
    echo "<p align='center''>";
    echo "<br><form method='post' action='profile.php'>";
    echo "<p align='center''>";
    echo "Subject &nbsp;<input type='text' name='subject' size='44'><br>";
    echo "<p align='center''>";
    echo "<textarea rows='4' cols='40' name='message' >";
    echo "</textarea><br>";
    echo "<p align='center''>";
    echo "<input type='hidden' name='sendmessage' value='1'>";
    echo "<p align='center''>";
    echo "Send To: &nbsp;<input type='text' name='receiver' size='21'><br>";
    echo "<p align='center''>";
    echo "&nbsp;&nbsp;<input type='submit' value='Send Message'></form>";
}

echo "<p align='center''>";
echo "<br><br><form method='post' action='battlemode.php'><p align='center'><input type='submit' value='Return'></form>";





