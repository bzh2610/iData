<?php
session_start();

if(isset($_SESSION['accountid']) && isset($_GET['file']))
{
if (isset ($_GET['container']))
{
$container= "". basename($_GET['container'])."/";
}
else
{
$container= "";
}

$accountid=$_SESSION['accountid'];
$file=$_GET['file'];

copy('userdata/'.$accountid.'/'.$container.''.$file.'', 'tmp/'.$accountid.''.$file.'');
?>

<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8" />
       <link rel="stylesheet" href="style.css" />
        <title>Picture viewer</title>
		<link rel="icon" type="image/png" href="cloud.png" />
<meta name="viewport" content="width=device-width"/>

    </head>

<body  onload="document.getElementById('foo').select();" style="text-align: center; background-color: rgb(240,240,240)">	
<?php include_once("piwiktrack.php"); ?>

<a href="mydocs.php" style="text-decoration: none;"><h1 style="font-size: 150%; font-family: 'Century Gothic', Arial; color: rgb(180,180,180);">iData</h1></a>

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

<li><a href="#">Insert</a>
<ul>
<li><a href="#">Time</a></li>
<li><a href="#">Paste</a></li>
</ul>

<li><a href="#">View</a>
<ul>
<li><a href="http://idata.no-ip.info/text.php?file=<?php echo"$file";?>&settings ">Font</a></li>
</ul>
</div>


<div id="printarea">
	<img src="<? echo 'tmp/'.$accountid.''.basename($file).''; ?>" style="max-width : 90%; max-height: 90%;" alt="picture">
	</div>
</body>
</html>

<?php
//unlink('tmp/'.$accountid.''.basename($file).'');
}


else
{
header("Location: mydocs.php");
}

?>