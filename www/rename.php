<?php
session_start();


if (isset($_SESSION['accountid']))
{
$accountid=$_SESSION['accountid'];

if (isset ($_GET['container']))
{
$container= "".basename($_GET['container'])."/";
}
else
{
$container= "";
}

if (isset($_GET['file']) AND isset($_GET['name']))
{
$file=$_GET['file'];
$name=$_GET['name'];

$file = preg_replace("/%u([0-9a-f]{3,4})/i","&#x\\1;",urldecode($file)); 
$file = html_entity_decode($file,null,'UTF-8');

$folderornot = substr($file, 35, 6);

if ($folderornot == "folder")
{
$file = substr($file, 75);
}

else
{
$file = substr($file, 57);
}

$file = basename ($file);
echo"$file";
$extension=strrchr($file,'.');

if($extension!==FALSE)
{
if (file_exists("userdata/$accountid/$container$file")) 
{
echo"BIIIIIIIIIITE";
rename("userdata/$accountid/$container$file", "userdata/$accountid/$container$name$extension");
}
}//extension

else if (is_dir('userdata/'.$accountid.'/'.$file.''));
{
rename('userdata/'.$accountid.'/'.$file.'', "userdata/$accountid/$name");
}//dossier


}
}

header("Location: mydocs.php");




//////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////

/*
if (isset($_GET['name']) && isset($_GET['file']) && isset($_SESSION['accountid']))
{


$file = substr($file, 57);
//$file = str_replace('%20', ' ', $file);
$file = preg_replace("/%u([0-9a-f]{3,4})/i","&#x\\1;",urldecode($file)); 
$file = html_entity_decode($file,null,'UTF-8');
$file = basename ($file);
$name = basename ($name);

	
if (file_exists("userdata/$accountid/$file")) 
{
rename("userdata/$accountid/$file", "userdata/$accountid/$name$extension");
}
}
}*/

//header("Location: http://idata.no-ip.info/mydocs.php");

?>
