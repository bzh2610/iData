<?php
session_start();

if (isset($_GET['file']) && isset($_SESSION['accountid']))
{

$accountid=$_SESSION['accountid'];
$file=$_GET['file'];
$file = substr($file, 57);
$file = preg_replace("/%u([0-9a-f]{3,4})/i","&#x\\1;",urldecode($file)); 
$file = html_entity_decode($file,null,'UTF-8');
$file = basename ($file);

if (isset ($_GET['container']))
{
$container= "".basename($_GET['container'])."/";
}
else
{
$container= "";
}

if(isset($_GET['private'])){
unlink("public/$accountid/$file");
header("Location: mydocs.php");
exit();
}

else{
if (file_exists("userdata/$accountid/$container$file")) 
{
copy("userdata/$accountid/$container$file", "public/$accountid/$file");
}
else
{
}

}
}
//echo "userdata/$accountid/$container$file";

if(isset($_GET['lang'])){
	if($_GET['lang']=='fr')
	{
	header("Location: fr/mydocs.php?share=$file");
	exit();
	}
}
header("Location: mydocs.php?share=$file");

?>
