<?php

session_start();

if (isset($_SESSION['accountid']) && isset($_GET['file'])) //MINIMUM compte-fichier
{
$accountid=$_SESSION['accountid'];
$file=basename($_GET['file']);

$category_field[1]='Charges and Taxes';
$category_field[2]='Clothing';
$category_field[3]='Foods';
$category_field[4]='Health';
$category_field[5]='Insurance';
$category_field[6]='Internet and phone';
$category_field[7]='Recreation';


if (!empty($_POST['date']) AND !empty($_POST['subject']) AND isset($_POST['category']) AND isset($_POST['loss']) AND isset($_POST['gain']))
{
if($_POST['category'] >= 1 AND $_POST['category'] <=7)
{
$_POST['loss'] = strtr($_POST['loss'],",",".");
$_POST['gain'] = strtr($_POST['gain'],",",".");

$_POST['date'] = strtr($_POST['date'],"-","/");
$date = explode("/", $_POST['date']);
$datewidth=count($date);
$i2=0;

//if (is_float($_POST['loss']) && is_float($_POST['gain'])) {

if($date[$i2] >= 1980)
{ 
$i2++;
if($date[$i2] >= 1 && $date[$i2] <= 12)
{
$i2++;
if ($date[$i2] >= 1 && $date[$i2] <= 31)
{ $result = 0; $i2=0;}}}   //yyyy/mm/jj

else if($date[$i2] >= 1 && $date[$i2] <= 31)
{ 
$i2++;
if($date[$i2] >= 1 && $date[$i2] <= 12)
{
$i2++;
if($date[$i2] >= 1980)
{ $result = 1; $i2=0;}}} //jj/mm/yyyy


else { $result = 2;} 


if ($result == 0)
{
$handle = fopen("userdata/$accountid/$file", 'r+');
fseek($handle, 0, SEEK_END);
if ($date[2] <10 AND strlen($date[2])==1 ){$date[2]= '0'.$date[2].'';}
if ($date[1] <10 AND strlen($date[1])==1 ){$date[1]= '0'.$date[1].'';}
fprintf($handle, "%s/%s/%s\t%s\t%s\t%01.2f\t%01.2f\n", $date[0], $date[1], $date[2], $_POST['subject'], $_POST['category'], $_POST['loss'], $_POST['gain']);
fclose($handle);
}

else if ($result == 1)
{
$handle = fopen("userdata/$accountid/$file", 'r+');
fseek($handle, 0, SEEK_END);
if ($date[0] <10 AND strlen($date[0])==1 ){$date[0]= '0'.$date[0].'';}
if ($date[1] <10 AND strlen($date[1])==1 ){$date[1]= '0'.$date[1].'';}
fprintf($handle, "%s/%s/%s\t%s\t%s\t%01.2f\t%01.2f\n", $date[2], $date[1], $date[0], $_POST['subject'], $_POST['category'], $_POST['loss'], $_POST['gain']);
fclose($handle);
}

}
}


if(isset($_GET['newentry']))
{
?>
<html>
<body style="text-align: center; background-color: rgb(240,240,240); font-family: 'Century Gothic', Arial; color: rgb(180,180,180);">

<div class="newentrymyaccount">

<form action="myaccount.php?file=<?php echo"$file";?>" method="post" >
<p>Date: <input type="date" name="date"/></p>
<p>Subject: <input type="text" name="subject"/></p>
<p>Category: <SELECT name="category" size="1">
<?php
echo '<OPTION value="" selected="selected" hidden>Choose..';
for ($i=1; $i<=7; $i++){
echo '<OPTION value="'.$i.'">'.$category_field[$i].'';
}
?>
</SELECT>
<p>Loss: <input type="text" name="loss"/></p>
<p>Gain: <input type="text" name="gain"/></p>
<input type="submit" value="Add" />
</form>

</div>
</body>
</html>

<?php
}


else //pas newentry
{

if(isset($_POST['editor'])) //SAUVEGARDE
{
$handle = fopen("userdata/$accountid/$file", 'w');
fputs($handle, $_POST['editor']);
fclose($handle);
} //FIN

	?>
	
	<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8" />
       <link rel="stylesheet" href="style.css" />
        <title></title>
		<link rel="icon" type="image/png" href="cloud.png" />
    </head>

<body  onload="document.getElementById('foo').select();" style="text-align: center; background-color: rgb(240,240,240)">	
<?php include_once("piwiktrack.php"); ?>
<a href="mydocs.php" style="text-decoration: none;"><h1 style="font-size: 150%; font-family: 'Century Gothic', Arial; color: rgb(180,180,180);">iData</h1></a>

<form method="post" action="">

<div id="menu" style="width: 330px; margin-left: auto; margin-right: auto;">
<ul>

<li><a href="#">File</a>
<ul>
<li><a href="http://idata.no-ip.info/mydocs.php">New</a></li>
<li><a href="http://idata.no-ip.info/mydocs.php">Open</a></li>
<li><a><input class="editorbutton" type="submit" value="Save"></a></li>
<li><a href="http://idata.no-ip.info/mydocs.php?file=<?php echo"$file"; ?> ">Download</a></li>
<li> <a href="#">Print</a></li>
</ul>

<li><a href="#">Entry</a>
<ul>
<li><a href="http://idata.no-ip.info/myaccount.php?file=<?php echo"$file";?>&newentry">Add</a></li>
<li><a href="#">Delete</a></li>
</ul>

<li><a href="#">View</a>
<ul>
<li><a href="#">Font</a></li>
</ul>
</div>

<?php
if (isset($_POST['targetperiod'])){ //PERIODE SPECIFIEE
	$targetperiod = $_POST['targetperiod'];
	
		$targetperiod = strtr($targetperiod,"-","/");
		$dispmonth = explode("/", $targetperiod);
		
		if($dispmonth[0] >= 1980)
		{ 
			if($dispmonth[1] >= 1 && $dispmonth[1] <= 12){
			$year = $dispmonth[0];
			$month = $dispmonth[1];
			$showdate= ''.$dispmonth[0].'/'.$dispmonth[1].'';
			}}   //yyyy/mm/jj

		else if($dispmonth[0] >= 1 && $dispmonth[0] <= 12)
		{
		if($dispmonth[1] >= 1980){
		$year = $dispmonth[1];
		$month = $dispmonth[0];
		$showdate= ''.$dispmonth[1].'/'.$dispmonth[2].'';
		}} //jj/mm/yyyy

		else {
		$showdate= ''.date('Y').'/'.date('m').'';
		} 
}
else {
$showdate= ''.date('Y').'/'.date('m').'';
} 

echo '<h3 style="font-family: \'Century Gothic\', Arial;">'.$showdate.'</h3>';
?>

<div class="tableaccount">
	<table style="width : 500px; margin: auto;">
   <tr>
   <th>Date</th>
   <th>Title</th>
   <th>Category</th>
   <th>Loss</th>
   <th>Gain</th>
   <th>Subtotal</th>
   <th>Total</th>
   </tr>
   <?php
   
$cat1=0;
$cat2=0;
$cat3=0;
$cat4=0;
$cat5=0;
$cat6=0;
$cat7=0;

   $handle = fopen("userdata/$accountid/$file", 'r+'); //LECTURE
if ($handle)
{
$i=0;

	$year=date('Y');
	$month=date('m');
	
	while ($filecontent = fscanf($handle, "%s\t%s\t%s\t%s\t%s\n")) { //ENTRY
	list ($rawdate, $title, $category, $debit, $credit) = $filecontent;
	$date = explode("/", $rawdate);
	
	if (isset($_POST['targetperiod'])){ //PERIODE SPECIFIEE
	$targetperiod = $_POST['targetperiod'];
	
		$targetperiod = strtr($targetperiod,"-","/");
		$dispmonth = explode("/", $targetperiod);
		
		if($dispmonth[0] >= 1980)
		{ 
			if($dispmonth[1] >= 1 && $dispmonth[1] <= 12){
			$year = $dispmonth[0];
			$month = $dispmonth[1];
		}}   //yyyy/mm/jj

		else if($dispmonth[0] >= 1 && $dispmonth[0] <= 12)
		{
		if($dispmonth[1] >= 1980){
		$year = $dispmonth[1];
		$month = $dispmonth[0];
		}} //jj/mm/yyyy

		else {} 
	}

	
	if ($date[0] ==  $year && $date[1] == $month){
	$globaldebit[$i] = $debit;
	$globalcredit[$i] = $credit;
	$category2=$category;
	$category = $category_field[$category];
	$entry[$i]	= '<tr><td>'.$rawdate.'</td><td>'.$title.'</td><td>'.$category.'</td><td>';
	$i++;
	//echo'<tr><td>'.$rawdate.'</td><td>'.$title.'</td><td>'.$category.'</td><td>'.$debit.'</td><td>'.$credit.'</td><td>'.$stt.'</td><td>'.$tt.'</td></tr>';
	////
	
		$stt= $globalcredit[$key] - $globaldebit[$key];
	$tt= $tt + $stt;
	

	if($category2 == "1"){$cat1= $cat1 + $credit - $debit;}
	else if($category2 == "2"){$cat2= $cat2 + $credit - $debit;}
	else if($category2 == "3"){$cat3= $cat3 + $credit - $debit;}
	else if($category2 == "4"){$cat4= $cat4 + $credit - $debit;}
	else if($category2 == "5"){$cat5= $cat5 + $credit - $debit;}
	else if($category2 == "6"){$cat6= $cat6 + $credit - $debit;}
	else if($category2 == "7"){$cat7= $cat7 + $credit - $debit;}
	
	///
	}}
	
$tt=0;
$stt=0;

	sort($entry);
	foreach ($entry as $key => $val) {
	//$stt=10;
	$stt= $globalcredit[$key] - $globaldebit[$key];
	$tt= $tt + $stt;
	
    echo ''. $val .''.$globaldebit[$key].'</td><td>'.$globalcredit[$key].'</td><td>'.$stt.'</td><td>'.$tt.'</td></tr>';
}

}
	fclose($handle);
	
	?>

</table>
<form action="myaccount.php?file=<?php echo"$file";?>" method="post" >
<p><input type="month" name="targetperiod" value="YYYY/MM"></p>
<input type="submit" value="Change month">
</form>
<?php
echo "<a href=\"graph.php?cat1=$cat1&cat2=$cat2&cat3=$cat3&cat4=$cat4&cat5=$cat5&cat6=$cat6&cat7=$cat7&year=$year&month=$month&file=$file\">Stats</a>";
?>
</div>
	</form>
</body>
</html>
	
<?php	
}
}

else
{
header("Location: mydocs.php");
}

?>