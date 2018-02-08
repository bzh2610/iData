<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
<meta name="Description" content="iData, the secure cloud computing system"/>
<meta name="Keywords" content="cloud, computing, data, online"/>

       <link rel="stylesheet" href="style.css" />
        <title>Create a reminder</title>
		<link rel="icon" type="image/png" href="cloud.png" />
    </head>
	<body>
	<div class="remindpage">

<?php

if (isset($_POST['title']) && isset($_POST['date']) && isset($_POST['hour']) &&isset($_SESSION['accountid']) &&isset($_SESSION['email']) &&isset($_SESSION['firstname']))
{
$priority=0;
if (isset($_POST['priority'])) 
{$priority=$_POST['priority'];}

$accountid=$_SESSION['accountid'];
$firstname=$_SESSION['firstname'];
$email=$_SESSION['email'];

$title = htmlspecialchars($_POST['title']);
$date=$_POST['date'];
$time=$_POST['hour'];

$tdday = date("j"); 
$tdmonth = date("n"); 
$tdyear = date("Y"); 
$tdhour = date("H");
$tdminute = date("i");


$year = substr($date, 0, 4);
$month = substr($date, 5, 2);
$day = substr($date, 8, 10);




/*$day = substr($date, 0, 2);
$month = substr($date, 3, 2);
$year = substr($date, 6);*/

$lessthan10 = substr($time, 1, 1);
if(preg_match("#^(0|1|2|3|4|5|6|7|8|9)$#",$lessthan10)) {
$hour = substr($time, 0, 2);//si 2 chiffres
$minute = substr($time, 3);
}
else {
$hour = substr($time, 0, 1); 
$minute = substr($time, 2);
}//si 1 chiffre

   


//echo "--$day-$month-$year-- @ $hour-:-$minute  --- $tdday/$tdmonth/$tdyear @ $tdhour:$tdminute";
//->VERIF DATE dd/mm/yyyy
if ($day > 0 && $day <=31 && $month > 0 && $month <=12 && $year >= $tdyear && $hour < 24 && $minute < 60 && $hour > 0 && $minute >= 0)  
{
	if($year == $tdyear && $month <= $tdmonth && $day < $tdday)
	{
	echo "<p>Sorry, but I can't remind you something in the past</p>";
	}
		else
		{
		//>Verif heure
		//DATE CORRECTE
		if ($year== $tdyear && $month == $tdmonth && $day == $tdday) //->OJD
		{
	
			if ($hour <= $tdhour && $minute <= $tdminute) //->OJD, PLUS TOT
			{	echo "Sorry, but I can't remind you something in the past";	}
	
		else//OJD HEURE ET MINUTE CORRECTE
		{
		create_reminder();
		}
		}//FIN OJD
		
		else//DANS LE FUTUR
		{
		create_reminder();
		}
	
	}
	
}
else{echo 'INCORECT DATE'; }


}

else
{	
echo "<p>Oops : it seems that you haven't sumbited the required informations</p>"; 
}

?>

<p><a href="mydocs.php">Return to your cloud !</a></p>
</div>
</body>
</html>

<?php
//header("Location: http://idata.no-ip.info/mydocs.php");


//////////////////////////////////////////// RAPPEL ////////////////////////////////////////////////////
function create_reminder() {																		 ///													
global $hour, $minute, $day, $month, $year, $title, $tdhour, $tdminute, $tdday, $tdmonth, $tdyear, $firstname, $email, $accountid, $priority;   ///

if($priority == 1){$priority = "little important";}
else if($priority == 2){$priority = "normaly important";}
else if($priority == 3){$priority = "important";}
else if($priority == 4){$priority = "very important";}
else{$priority = "normally important";}

$minutesend = $minute-5;

//->RAPPEL HEURE MIN
//$monfichier = fopen("$accountid-1.txt", "a+");
//fputs($monfichier, "$minute $hour $day $month * echo \"Hello $firstname, \\n\\nYou asked iData to remind you : '$title' today at $hour:$minute. You have defined this event as : $priority.\\n\\nThank you for using iData.\" |  mail -r reminder@idata.no-ip.info -s \"Do not forget : $title\" -- $email\n");
//fclose($monfichier);
//$out=shell_exec("crontab /var/www/$accountid-1.txt");
//unlink("$accountid-1.txt");

//->RAPPEL DEBUT JOURNEE
$out=shell_exec("crontab -l > /var/www/$accountid.txt");
$monfichier = fopen("$accountid.txt", "a+");
fputs($monfichier, "0 0 $day $month * echo \"Hello $firstname, \\n\\nYou asked iData to remind you : '$title' today at $hour:$minute. You have defined this event as : $priority. We will send you another email at this time.\\n\\nThank you for using iData.\" |  mail -r reminder@idata.no-ip.info -s \"Do not forget : $title\" -- $email\n$minute $hour $day $month * echo \"Hello $firstname, \\n\\nYou asked iData to remind you : '$title' today at $hour:$minute. You have defined this event as : $priority.\\n\\nThank you for using iData.\" |  mail -r reminder@idata.no-ip.info -s \"Do not forget : $title\" -- $email\n");
fclose($monfichier);
$out=shell_exec("crontab /var/www/$accountid.txt");
unlink("$accountid.txt");

if($month == 1){ $write_month= "January"; }
else if($month == 2){ $write_month= "February"; }
else if($month == 3){ $write_month= "March"; }
else if($month == 4){ $write_month= "April"; }
else if($month == 5){ $write_month= "May"; }
else if($month == 6){ $write_month= "June"; }
else if($month == 7){ $write_month= "July"; }
else if($month == 8){ $write_month= "August"; }
else if($month == 9){ $write_month= "September"; }
else if($month == 10){ $write_month= "October"; }
else if($month == 11){ $write_month= "November"; }
else if($month == 12){ $write_month= "December"; }

if ($day == 12 || $day == 13 || $day == 11){ $extdate="th";}

else{
 $extdate = substr($day, 1);
 }

	if ($extdate == 1){ $extdate="st";}
	else if ($extdate == 2){ $extdate="nd";}
	else if ($extdate == 3){ $extdate="rd";}
	else { $extdate="th"; }


echo"<h3>I will send you an email to remind you to : \"$title\". <br />";

if ($tdday == $day && $tdmonth == $month && $tdyear == $year){//si c'est ojd
echo "Today, " ;
}

else {
echo "On $write_month, $day$extdate $year, "; 
}

echo "at $hour:$minute</h3>";

}//end function

?>