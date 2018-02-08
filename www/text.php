<?php
session_start();
if(isset($_SESSION['accountid'])){
if (isset($_GET['file'])){
if (isset ($_GET['container'])){
$container= "". basename($_GET['container'])."/";

if ($container == "../"){
$container = "";
}}

else{
$container= "";
}

$accountid=$_SESSION['accountid'];
$file=basename($_GET['file']);

$size=16;
if( isset($_POST['size'])){
	$size=$_POST['size'];
		if ($size < 6 || $size > 80){
		$size=16;
		}
}

if( isset($_GET['settings'])) {
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

else{

if(isset($_POST['editor'])) //SAUVEGARDE
{
$handle = fopen("userdata/$accountid/$container$file", 'w');
fputs($handle, $_POST['editor']);
fclose($handle);

if (file_exists("public/$accountid/$file")) //partage
{
$handle = fopen("public/$accountid/$file", 'w');
fputs($handle, $_POST['editor']);
fclose($handle);
}

} //FIN

if (!file_exists("userdata/$accountid/$container$file")) {
header("Location: mydocs.php");
exit();
}

else{
$infosfichier = pathinfo(''.$container.''.$file.'');
$extension_upload = $infosfichier['extension'];

if ($extension_upload != 'txt'){
header("Location: mydocs.php");
exit();
}}

$handle = fopen("userdata/$accountid/$container$file", 'r+'); //LECTURE
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
<li><a href="http://idata.no-ip.info/text.php">New</a></li>
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
?>
<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8" />
       <link rel="stylesheet" href="style.css" />
        <title>Text editor</title>
		<link rel="icon" type="image/png" href="cloud.png" />
    </head>

<body style="text-align: center; background-color: rgb(240,240,240)">	
<?php include_once("piwiktrack.php"); ?>
<?php include_once("header-en.php"); ?>
<div style="background-color: rgb(150,150,150);	top: 50%; left: 50%; padding:10px;
 border:1px solid rgb(250,250,250);-moz-border-radius:10px; -webkit-border-radius:10px; border-radius:10px;
 font-family:'Century Gothic', Arial; width: 500px; height: 400px; position: absolute; margin: -200px 0 0 -250px;
 text-align: center;">
 <h2 style="color: white">Hello ! What do you want to do ?</h2>
<table style="border: none; width: 100%; position: relative;">
<tr style="border: none;">
	<th style="border: none;"><img src="new.png" style="width: 150px;"  alt="new document"/>
	<th style="border: none;"><img src="txt.png" style="height: 150px;" alt="Exisiting document"/>
</tr>

<tr style="border: none;">
	<td style="border: none;"> <p style="color: white; font-size: 18px;">Create a new document</p>
	<td style="border: none;"> <p style="color: white; font-size: 18px;">Open an existing document</p>
</tr>

</table>
 </div>


</body>
</html>

<?php
}
}

else{

header("Location: mydocs.php");
exit();
}
?>