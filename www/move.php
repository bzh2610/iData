<?php
session_start();

if (isset($_SESSION['accountid']))
{
$accountid=$_SESSION['accountid'];
}


if (isset($_GET['file_tomove']) AND isset($_GET['folder_tomove']))
{
$file=$_GET['file_tomove'];
$folder=$_GET['folder_tomove'];

$file = preg_replace("/%u([0-9a-f]{3,4})/i","&#x\\1;",urldecode($file)); 
$file = html_entity_decode($file,null,'UTF-8');

$folder = preg_replace("/%u([0-9a-f]{3,4})/i","&#x\\1;",urldecode($folder)); 
$folder = html_entity_decode($folder,null,'UTF-8');

if (isset ($_GET['container']))
{
$container= "".basename($_GET['container'])."/";
}
else
{
$container= "";
}

$file = ''.basename($file).'';
$folder = ''.basename($folder).'';

if($folder == "mydocs.php")
{
rename("userdata/$accountid/$container$file", "userdata/$accountid/$file");
}
else
{
rename("userdata/$accountid/$container$file", "userdata/$accountid/$folder/$file");
}
header('Location: mydocs.php');
}


?>