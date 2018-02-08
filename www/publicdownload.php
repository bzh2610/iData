<?
if( isset($_GET['file'])){

$infosfichier = pathinfo(basename($_GET['file']));
$extension_upload = $infosfichier['extension'];

$folder = $_GET['file'];
$folder = substr($folder, 0, 23);
$folder = basename($folder);

$images_ext= array("png","jpg","bmp","jpeg","gif");

if (file_exists("public/$folder/" . basename($_GET['file']) .""))
{
	if ( isset($_GET['valid']) and (basename($_GET['file']) != ""))
	{
	$size = filesize("public/$folder/" . basename($_GET['file']));
	header("Content-Type: application/force-download; name=\"" . basename($_GET['file']) . "\"");
	header("Content-Transfer-Encoding: binary");
	header("Content-Length: $size");
	header("Content-Disposition: attachment; filename=\"" . basename($_GET['file']) . "\"");
	header("Expires: 0");
	header("Cache-Control: no-cache, must-revalidate");	
	header("Pragma: no-cache");
	readfile("public/$folder/" . basename($_GET['file']));
	exit();
	}

	else if ($extension_upload == ("txt"))
	{
	header("Location: text-viewer.php?file=$folder/".basename($_GET['file'])."");
	}
	
	else if (in_array ($extension_upload, $images_ext))
	{
	header("Location: publicpicture.php?file=$folder/".basename($_GET['file'])."");
	}


?>
    <html>
    <head>
	<title>Download</title>
    </head>
	
    <body style="background-color: rgb(230,230,254);" >
	<?php include_once("piwiktrack.php"); ?>
	<?php include_once("header-en.php"); ?>
	<div style="margin-top: 70px;">
           <h2 style="font-family: 'Century Gothic', Arial; text-align: center;">
		   <a style="text-decoration: underline; color: rgb(180,180,180);" href="<?php echo 'publicdownload.php?file='.$_GET['file'].'&valid=1'; ?>">Download now !</a></h2>
		<br /><br />
	</div>
	</body>
    </html>
<?
}
else
{
?>
    <html>
    <head>
	<title>Download</title>
    </head>
	
    <body style="background-color: rgb(230,230,254);" >
	<?php include_once("piwiktrack.php"); ?>
	<?php include_once("header-en.php"); ?>
	<div style="margin-top: 70px;">
           <h1 style="font-family: 'Century Gothic', Arial; text-align: center;"> Sorry :'(</h1>
		   <h2 style="font-family: 'Century Gothic', Arial; text-align: center; color: rgb(180,180,180);">This file does not exist or has been removed.</h2>
		<br /><br />
	</div>
	</body>
    </html>
<?
}


}
else{
header('Location: index.php');
}

?>