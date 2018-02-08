<?php

if(isset($_GET['file']))
{

$folder = $_GET['file'];
$folder = substr($folder, 0, 23);
$folder = basename($folder);

$file= basename($_GET['file']);


$size=16;
if( isset($_POST['size'])){
	$size=$_POST['size'];
		if ($size < 6 || $size > 80){
		$size=16;
		}
}

if( isset($_GET['settings'])) 
{
?>
<h1>Text editor settings</h1>

<form method="POST" action="<?php echo 'http://idata.no-ip.info/text.php?file='.$file.''; ?>">
<p>Font size : <input type="number" name="size" value="16"/></p>
<p>Font family : <SELECT name="font" size="1">
<OPTION>Arial
<OPTION>Century Gothic
<OPTION>Courrier New
<OPTION>Times New Roman
</SELECT>
</p>
<input type="submit" value="Apply" />
</form>
<p>

<?php
}

else
{
$handle = fopen("public/$folder/$file", 'r+'); //LECTURE
if ($handle)
{
		while (!feof($handle))
	{
		$buffer = fgets($handle);
		$fulltext = "$fulltext$buffer";
	}
	fclose($handle); //FIN
	?>
	
	<!DOCTYPE html>

<html>
<head>
        <meta charset="utf-8" />
       <link rel="stylesheet" href="style.css" />
        <title>Text editor</title>
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
<li><a href="http://idata.no-ip.info/mydocs.php">Save</a></li>
<li><a href="http://idata.no-ip.info/publicdownload.php?file=<?php echo $_GET['file']; ?>&valid=1">Download</a></li>
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
	<textarea  name="editor" id="editor" style="font-size:<?php echo ''.$size.'px;' ?>;height: 1123px; width: 794px; font-family: 'Century Gothic', Arial;" rows="70" cols="100"><?php echo $fulltext; ?></textarea>

<script type="text/javascript">
document.querySelector("textarea").addEventListener('keydown',function(e) {
    if(e.keyCode === 9) { 
        var start = this.selectionStart;
        var end = this.selectionEnd;

        var target = e.target;
        var value = target.value;

        target.value = value.substring(0, start)
                    + "\t"
                    + value.substring(end);

        this.selectionStart = this.selectionEnd = start + 1;

        e.preventDefault();
    }
},false);
</script>

	</div>
	</form>
</body>
</html>
	
<?php	
}}}

else{
header("Location: http://idata.no-ip.info/mydocs.php");}
?>