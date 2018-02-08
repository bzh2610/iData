<html> 
<head>
    <meta charset="utf-8" />
</head> 
<body style="background-color: rgb(201,201,201); font-family: 'Century Gothic', Arial;">

<?php

if (isset($_FILES['monfichier'])){

	if ($_FILES['monfichier']['error'] == 0){	
	
            // Testons si l'extension est autorisée
               $infosfichier = pathinfo($_FILES['monfichier']['name']);
               $extension_upload = $infosfichier['extension'];
			$extension_upload = strtolower($extension_upload);
				$extension_interdite = array("php", "php3");
			
		if (file_exists("tpe/".basename($_FILES['monfichier']['name'])."")){
		unlink("tpe/".basename($_FILES['monfichier']['name'])."");
		}
		         
			if (!in_array($extension_upload, $extension_interdite)){
			
				$fichier = basename($_FILES['monfichier']['name']);
					$fichier = strtr($fichier,'
					ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
					'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
					$fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
					
                       // On peut valider le fichier et le stocker définitivement
                       move_uploaded_file($_FILES['monfichier']['tmp_name'], "tpe/" . basename($_FILES['monfichier']['name']));
                       
					$filerename = basename($_FILES['monfichier']['name']);
					$extension =strrchr($filerename,'.');
					$extension = strtolower($extension);
					$filerename = substr("$filerename" , 0, -(strlen($extension)));
					
					rename("tpe/".basename($_FILES['monfichier']['name'])."", "tpe/$filerename$extension");
					
					$uploadlog = "The file is on the cloud ;-) !";
					header("Location: color.php?pic=$filerename$extension");
					exit();
					}
					
					else
					{
					$uploadlog = "You are not allowed to post a .php file, sorry";
					}
			
			}
	else //error = 0
	{
	$uploadlog ="Error : it seems that you have not selected any file or that an unknown error occurred.";
	}
$fileuploadresult=1;
//echo "<p>$uploadlog</p>";
}


else if (isset ($_GET['pic'])){
$pic=$_GET['pic'];
$infosfichier = pathinfo("tpe/$pic");
$extension_upload = $infosfichier['extension'];

if(file_exists("tpe/$pic")){

if($extension_upload == 'jpg' || $extension_upload == 'jpeg'){
$im = imagecreatefromjpeg("tpe/$pic");
}

else{
$im = imagecreatefrompng("tpe/$pic");
}

$rgb = imagecolorat($im, 10, 10);
$r = ($rgb >> 16) & 0xFF;
$v = ($rgb >> 8) & 0xFF;
$b = $rgb & 0xFF;


if($b - $v >-10 AND $b - $v < 10 AND $v-$r >-10 AND $v-$r >-10){
$answer="neutre";
}

else if ($b>= 110 && $r<=110 || $b>$r && $v>$r){ 
$answer="froide";
}

else if ($r>= 200 || $b < 90){
$answer="chaude";
}

else{ $answer="?";
}


echo "
<h2 style=\"text-align: center;\">
<img style='max-width: 90%; max-height: 90%;' src='tpe/$pic'>
</img><br />
La dominante colorée de cette image est $answer</h2>
<p style='text-align: center;'><a href='color.php'>Retour</a></p>";
}}



else if (isset ($_POST['r']) AND isset ($_POST['v']) AND isset ($_POST['b'])) {
$r= $_POST['r'];
$v= $_POST['v']; 
$b= $_POST['b']; 

if($b - $v >-10 AND $b - $v < 10 AND $v-$r >-10 AND $v-$r >-10){
$answer="neutre";}

else if ($b>= 110 && $r<=110 || $b>$r && $v>$r){ 
$answer="froide";}

else if ($r>= 200 || $b < 90){
$answer="chaude";}

else{ $answer="inconnue";}

/*
if($b-$v < 5 || $r-$b < 5 || $b-$v > -5 || $r-$b > -5 ){
 $answer="neutre";}
else if ($b>= 110 && $r<=110 || $b>$r && $v>$r){ 
$answer="froide";}
else if ($r>= 240 || $b < 95){
$answer="chaude";}
else if ($r <= $b+10 || $r >= $b+10){
$answer="chaude";}
else if ($b>= $r+$v){
$answer="froide";}
else{ $answer="?";}*/

echo"<div style='z-index: 1; position: fixed; bottom: 50px; right: 50px;
 background-color: rgb($r,$v,$b); width: 250px; height: 250px; -moz-border-radius:10px;
 -webkit-border-radius:10px; border-radius:10px;'>
<p style='color: white; text-align: center;'>
($r; $v; $b) :<br />Cette couleur est $answer</p>
</div>";

echo '
<html> 
<head>
<title>Couleur chaude ou froide ?</title>
</head> 

<body>
<div style="text-align: center;">
<h2>Couleur chaude ou froide ?</h2>
<p>Indiquez une couleur sous forme RGB ou importez une image.</p>
</div>
<div style="width: 620px; height: 260px; position: relative; margin: auto;">
<div style="text-align: center; height: 210px; width: 300px; position: relative; top: 0px; left: 0px; background-color: rgb(150,150,150); -moz-border-radius:10px; -webkit-border-radius:10px; border-radius:10px;">
<p>Valeurs RGB</p>
<form action="" method="post"> 
<p>Rouge : <input type="text" name="r"/></p>
<p>Vert : <input type="text" name="v"/></p>
<p>Bleu : <input type="text" name="b"/></p>
<input type="submit"> 
</form>
</div>
 
<div style="text-align: center; height: 210px; width: 300px; position: absolute; top: 0px; right: 0px; background-color: rgb(150,150,150); -moz-border-radius:10px; -webkit-border-radius:10px; border-radius:10px;">
<p>Image jpg/png</p>
<form action="" method="post" enctype="multipart/form-data"> 
<input type="file" name="monfichier" /><br />
<br />
<input type="submit" value="Envoyer" />
</form>
</div>
</div>
 
 <footer style="position: absolute; left: 0px; margin-bottom: 10px; width: 100%;">
 <p style="text-align: center;">Copyright 2013 Evan Ollivier, Jerome Pennec, Julien Rey</p>
 </p>
 </footer>
</body>
</html>'; 
}

else {
?>
<html> 
<head>
<title>Couleur chaude ou froide ?</title>
</head> 

<body>
<div style="text-align: center;">
<h2>Couleur chaude ou froide ?</h2>
<p>Indiquez une couleur sous forme RGB ou importez une image.</p>
</div>
<div style="width: 620px; height: 260px; position: relative; margin: auto;">
<div style="text-align: center; height: 210px; width: 300px; position: relative; top: 0px; left: 0px; background-color: rgb(150,150,150); -moz-border-radius:10px; -webkit-border-radius:10px; border-radius:10px;">
<p>Valeurs RGB</p>
<form action="" method="post"> 
<p>Rouge : <input type="text" name="r"/></p>
<p>Vert : <input type="text" name="v"/></p>
<p>Bleu : <input type="text" name="b"/></p>
<input type="submit"> 
</form>
</div>
 
<div style="text-align: center; height: 210px; width: 300px; position: absolute; top: 0px; right: 0px; background-color: rgb(150,150,150); -moz-border-radius:10px; -webkit-border-radius:10px; border-radius:10px;">
<p>Image jpg/png</p>
<form action="" method="post" enctype="multipart/form-data"> 
<input type="file" name="monfichier" /><br />
<br />
<input type="submit" value="Envoyer" />
</form>
</div>
</div>
 
 <footer style="position: absolute; left: 0px; margin-bottom: 10px; width: 100%;">
 <p style="text-align: center;">Copyright 2013 Evan Ollivier, Jerome Pennec, Julien Rey</p>
 </p>
 </footer>
</body>
</html>
<?php } ?>
