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

if (isset($_GET['file']))
{
$file=$_GET['file'];

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


if (file_exists("userdata/$accountid/$container$file")) 
{
unlink("userdata/$accountid/$container$file");
}

else if (file_exists("public/$accountid/$file")) 
{
unlink("public/$accountid/$file");
}


else if (is_dir('userdata/'.$accountid.'/'.$file.''));
{
rmdir('userdata/'.$accountid.'/'.$file.'');
}


}
}

header("Location: mydocs.php");

?>
