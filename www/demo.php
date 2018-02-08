<?php
$fileuploadresult=0;
$taillefichier=0;
$h=0;
$i3=0;
$extension_upload='';

$i=0;
$dir_nom = "demo";


if (isset ($_GET['folder']))
{
$folder = $_GET['folder'];
$dir_nom = "$folder";
$container= "&container=". basename($folder)."";
}
else
{
$container= "";
}

$dir = opendir($dir_nom) or die('Erreur de listage : le répertoire n\'existe pas'); // on ouvre le contenu du dossier courant
$fichier= array(); // on déclare le tableau contenant le nom des fichiers
$dossier= array();
$hta='.htaccess';
$index='index.php';



if (isset ($_GET['file_download']))
{
$file_download=$_GET['file_download'];
	if(isset($_GET['container']))
	{$container = ''.basename($_GET['container']).'/'; }
	else
	{$container= '';}

if (($file_download != "") && (file_exists("demo/$container" . basename($file_download))))
{
$infosfichier = pathinfo(basename($file_download));
$extension_upload = $infosfichier['extension'];
if ($extension_upload == ("txt"))
{
header("Location: http://idata.no-ip.info/text.php?file=".basename($file_download)."&container=$container");
}
else if ($extension_upload == ("idc"))
{
header("Location: http://idata.no-ip.info/myaccount.php?file=".basename($file_download)."&container=$container");
}
else
{
$size = filesize("demo/$container" . basename($file_download));
header("Content-Type: application/force-download; name=\"" . basename($file_download) . "\"");
header("Content-Transfer-Encoding: binary");
header("Content-Length: $size");
header("Content-Disposition: attachment; filename=\"" . basename($file_download) . "\"");
header("Expires: 0");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
readfile("demo/$container" . basename($file_download));
exit();
}
} 
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
       <link rel="stylesheet" href="style.css" />
        <title>iData - My documents</title>
		<link rel="icon" type="image/png" href="cloud.png" />
    </head>
    <body>
<?php include_once("piwiktrack.php");
echo '<nav class="mydocsnav">';
echo '<h2>Hello user</h2>';
?>

<script language="JavaScript">
function show_hide_div(nomdiv){
var lediv = document.getElementById(nomdiv);
if(lediv.style.display=="block")
lediv.style.display="none";
else
lediv.style.display="block";
}
</script>

<a href="demo.php"><img src="home.png" alt="home" class="homebutton" title="Home"></a><br />
<?php
$taille_brute = shell_exec("cd demo; du -s");
$taille = substr($taille_brute, 0, -1);
$taille = round( $taille / 1024, 0, PHP_ROUND_HALF_UP);
echo '<p>Use : '.$taille.'Mo/1Go</p>';
?>

<a href="#"><img src="new.png" alt="new" class="sendlogo" title="New file" onClick="show_hide_div('newfile')"></a><br />
<a href="#"><img src="move.png" alt="move" class="renamebutton" title="Move a file" onClick="show_hide_div('move')"></a>
<br />
<p>&nbsp </p>
<br />
<a href="#"><img src="upload.png" alt="upload" class="sendlogo_2" title="Upload" onClick="show_hide_div('id1')"></a>
<a href="#"><img src="rename.png" alt="rename" class="renamebutton" title="Rename a file" onClick="show_hide_div('rename')"></a>
<br />
<p>&nbsp </p>
<br />
<a href="#"><img src="delete.png" alt="remove" class="removebutton" title="Remove a file" onClick="show_hide_div('del')"></a>
<a href="#"><img src="remind.png" alt="remind" class="remindbutton" title="Remind me something" onClick="show_hide_div('remind')"></a>
<br />
<p>&nbsp </p>
<br />
<a href="#"><img src="get.png" alt="get" class="getbutton" title="Download a file" onClick="show_hide_div('get')"></a>
<a href="http://idata.no-ip.info/logout.php"><img src="logout.png" alt="logout" class="logout" title="Logout"></a>
<br />
<p>&nbsp </p>
<br />
<a href="#"><img src="share.png" alt="share" class="sharebutton" title="Share a file" onClick="show_hide_div('share')"></a>
<a href="http://idata.no-ip.info/settings.php"><img src="settings.png" alt="settings" class="settings" title="Settings"></a>

</nav>

 
<div class="fileexplorer">
<?php
while($element = readdir($dir)) {
	if($element != '.' && $element != '..') {
		if (!is_dir($dir_nom.'/'.$element)) {$fichier[] = $element;}
		else {$dossier[] = $element;}
	}
}

closedir($dir);

if(!empty($dossier)) {
$h=1;
	sort($dossier);
	echo "<p>List of available folders in your cloud :</p> \n\n";
		foreach($dossier as $lien){

			$lienaffiche=$lien;
			$taille_ext= 1 + strlen($extension_upload);
			$taillefichier=strlen($lien);
			
			if ($taillefichier > 10)
			{
			$lienaffiche=substr("$lienaffiche", 0, -$taille_ext);
			}
			$taillefichier=strlen($lienaffiche);
			
			if ($taillefichier > 10)
			{
			$lienaffiche=substr("$lienaffiche", 0, - $tailefichier + 10);
			$lienaffiche="$lienaffiche.";
			}
			
			if($i3==4){
			$i3=0;
			$h++;
			}
			$i3++;

			echo "\n<div class=\"onefile$i3\"><p><a href=\"?folder=demo/$lien \"><img src=\"folder-blue.png\" alt=\"folder\"></a><br />$lienaffiche</p></div>";
		
		
		}
		
}

$w= $h * 210;
echo'<div style="height: '.$w.'px;"><br /></div>';	

if(!empty($fichier)){
	sort($fichier);// pour le tri croissant, rsort() pour le tri décroissant
	echo "<br /> <p>List of available documents in your cloud :</p> \n\n";
		foreach($fichier as $lien) {
			
			$infosfichier = pathinfo($lien);
			$extension_upload = $infosfichier['extension'];

				if ($lien == ".htaccess" || strcmp($lien, $index) == 0)
				{
				}
				else
				{

			$extension_icon = array("ipa", "app", "msi", "exe", "avi", "mkv", "mp4",  "wmv",  "idc",  "psd",  "jpg",  "jpeg", "png",  "gif", "txt", "pdf", "doc", "odt", "rtf", "docx", "ppt", "pptx", "odp", "ods", "xls", "xlsx", "zip", "rar", "7z", "gz");
			
			if ( ! in_array ($extension_upload, $extension_icon))
			{
			$extension_upload = "other";
			}
			$lienaffiche=$lien;
			
			$taille_ext= 1 + strlen($extension_upload);
			$taillefichier=strlen($lien);
			if ($taillefichier > 10)
			{
			$lienaffiche=substr("$lienaffiche", 0, -$taille_ext);
			}
			$taillefichier=strlen($lienaffiche);
			
			if ($taillefichier > 10)
			{
			$lienaffiche=substr("$lienaffiche", 0, - $taillefichier + 10);
			$lienaffiche="$lienaffiche.";
			}
			
			if($i==4){
			$i=0;
			}
			$i++;

			echo "\n<div class=\"onefile$i\"><p><a href=\"$dir_nom/$lien$container \"><img src=\"$extension_upload.png\" alt=\"file\"></a><br />$lienaffiche</p></div>";
				}
		}
 }
 
 if($i==0)
 {
 echo "Your cloud is empty";
 }
 ?>
 </div> 
 </body>

 
 <div id="id1" class="mydocsupload" style="Display: none;">
 <div  class="mydocsuploaddiv">

        <p>Send a file to your cloud.<br />
				<input type="hidden"  name="enable"  value="1">
				<label for="monfichier">500 Mo max</label><br />
				<input type="file" name="monfichier" /><br />
                <input type="submit" value="Send !" onClick="show_hide_div('loading')"/>
        </p>

</div>

<div id="loading" style="Display: none;" class="loadingindicator">
<img src="loading.gif" alt="loading" style="width: 100px;">
</div>
</div>

<!--END OF FIRST DIV-->
 <div id="del" class="mydocsdelete" style="Display: none;">
 <div  class="mydocsuploaddiv">

        <p>Drag&Drop a file to delete :<br />
				<input type="text" name="file_todelete" /><br />
                <input type="submit" value="Delete"/>
        </p>

</div>
</div>


 <div id="get" class="mydocsdelete" style="Display: none;">
 <div  class="mydocsuploaddiv">
 <p>To download a file, just click on it :)</p>
</div>
</div>


 <div id="share" class="mydocsupload" style="Display: none;">
 <div  class="mydocsuploaddiv">

        <p>Drag&Drop a file to share :<br />
				<input type="text" name="file_toshare" /><br />
                <input type="submit" value="Share"/>
        </p>

</div>
</div>


 <div id="move" class="mydocsupload" style="Display: none;">
 <div  class="mydocsuploaddiv">

        <p>Drag&Drop a file to move :<br />
				<input type="text" name="file_tomove" /><br />
		<p>Drag&Drop the destination folder :<br />
				<input type="text" name="folder_tomove" /><br />
                <input type="submit" value="Move"/>
        </p>

</div>
</div>
 

 <div id="rename" class="mydocsupload" style="Display: none;">
 <div  class="mydocsuploaddiv">

        <p>Drag&Drop a file to rename :<br />
				<input type="text" name="file_torename" /><br />
			New name (without extension) :
				<input type="text" name="name_torename" /><br />
                <input type="submit" value="Rename"/>
        </p>

</div>
</div>


 <div id="newfile" class="mydocsupload" style="Display: none;">
 <div  class="mydocsuploaddiv">

        <p>New file : <input type="text" name="newfile" />
		<SELECT name="format" size="1">
		<OPTION value="1">.idc
		<OPTION value="2" selected="selected">.txt
		</SELECT>
		<br /><br />
         New folder : <input type="text" name="newfolder" /><br />
		 <input type="submit" value="Create"/>
        </p>

</div>
</div>


 <div id="remind" class="reminderwidget" style="Display: none;">
 <div  class="mydocsuploaddiv">

        <p>Title :	<input type="text" name="title" /><br />
			Date (YYYY/MM/DD): <input type="date" name="date" /><br />
			Hour&Minute (hh:mm)	: <input type="time" name="hour" /><br /><br />
			Priority :
	<script language="JavaScript">
	function setchecked()
	{
	document.images["1l"].src="1.png";
	document.images["2l"].src="2.png";
	document.images["3l"].src="3.png";
	document.images["4l"].src="4.png";			
	}
	</script>
	
<input type="radio" name="priority" id="1" value="1" style="visibility: hidden"/>
<label for="1"><img id="1l" src="1.png" alt="Low" onclick="setchecked();this.src='c1.png'"/></label>

<input type="radio" name="priority" id="2" value="2" style="visibility: hidden"/>
<label for="2"><img id="2l" src="2.png" alt="Low" onclick="setchecked();this.src='c2.png'"/></label>

<input type="radio" name="priority" id="3" value="3" style="visibility: hidden"/>
<label for="3"><img id="3l" src="3.png" alt="Quite high" onclick="setchecked();this.src='c3.png'"/> </label>

<input type="radio" name="priority" id="4" value="4" style="visibility: hidden"/>
<label for="4"><img id="4l" src="4.png" alt="High" onclick="setchecked();this.src='c4.png'"/> </label><br /><br />

<input type="submit" value="Remind me !"/>
        </p>

</div>
</div>
</body>
 </html>