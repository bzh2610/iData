<?php
if (isset ($_GET['file']) AND isset ($_GET['year']) AND isset ($_GET['month']) AND isset ($_GET['cat1']) AND isset ($_GET['cat2']) AND isset ($_GET['cat3']) AND isset ($_GET['cat4']) AND isset ($_GET['cat5']) AND isset ($_GET['cat6']) AND isset ($_GET['cat7']))
{
if ($_GET['year'] >= 1980 AND $_GET['month'] >= 1 AND $_GET['month'] <= 12)
{
$cat1 = $_GET['cat1'];
$cat2 = $_GET['cat2'];
$cat3 = $_GET['cat3'];
$cat4 = $_GET['cat4'];
$cat5 = $_GET['cat5'];
$cat6 = $_GET['cat6'];
$cat7 = $_GET['cat7'];

$total= $cat1 + $cat2 + $cat3 + $cat4 + $cat5 + $cat6 + $cat7;
$coef= 100 / $total;

$p1= $coef* $cat1;
$p2= $coef* $cat2;
$p3= $coef* $cat3;
$p4= $coef* $cat4;
$p5= $coef* $cat5;
$p6= $coef* $cat6;
$p7= $coef* $cat7;

$taille_graph= 5;
echo'
<html>
<body style="font-family: \'Century Gothic\', Arial;background-color: rgb(240,240,240);">
<h2 style="text-decoration: underline; text-align: center;">Costs by category on '.$_GET['year'].'/'.$_GET['month'].'</h2>

<p style="margin: auto; width: 550px;"><img src="grey_bar.png" alt="grey" style="height: 105px; width:'. $taille_graph * $p1.'px"><img src="blue_bar.png" alt="blue" style="height: 105px; width:'. $taille_graph * $p2.'px"><img src="green_bar.png" alt="yellow" style="height: 105px; width:'. $taille_graph * $p3.'px"><img src="yellow_bar.png" alt="orange" style="height: 105px; width:'. $taille_graph * $p4.'px"><img src="orange_bar.png" alt="orange" style="height: 105px; width:'. $taille_graph * $p5.'px"><img src="pink_bar.png" alt="orange" style="height: 105px; width:'. $taille_graph * $p6.'px"><img src="red_bar.png" alt="orange" style="height: 105px; width:'. $taille_graph * $p7.'px"></p>

<div style="width: 500px; margin: auto;">
<div style="position: relative; top: 10px; margin-left: 5px; width: 240px; float: left;"> 
<p style="color: #767676">Charges : '.$cat1.'$</p>
<p style="color: #2e8aff">Clothing : '.$cat2.'$</p>
<p style="color: #4aff52">Foods : '.$cat3.'$</p>
<p style="color: #ffd600">Health : '.$cat4.'$</p>
</div>

<div style="position: relative; top:10px; margin-right: 5px; width: 240px; float: right;">
<p style="color: #ff9600">Insurance : '.$cat5.'$</p>
<p style="color: #cd8aff">Phone : '.$cat6.'$</p>
<p style="color: #ff0000">Recreation : '.$cat7.'$</p>
</div>
</div>
</body>';

/*echo '
<div style="font-family: \'Century Gothic\', Arial;">
<p style="width: 1000px;">
<img src="grey_bar.png" alt="grey" style="width: 105px; height:'. $taille_graph * $p1.'px">&nbsp
<img src="blue_bar.png" alt="blue" style="width: 105px; height:'. $taille_graph * $p2.'px">&nbsp
<img src="green_bar.png" alt="yellow" style="width: 105px; height:'. $taille_graph * $p3.'px">&nbsp
<img src="yellow_bar.png" alt="orange" style="width: 105px; height:'. $taille_graph * $p4.'px">&nbsp
<img src="orange_bar.png" alt="orange" style="width: 105px; height:'. $taille_graph * $p5.'px">&nbsp
<img src="pink_bar.png" alt="orange" style="width: 105px; height:'. $taille_graph * $p6.'px">&nbsp
<img src="red_bar.png" alt="orange" style="width: 105px; height:'. $taille_graph * $p7.'px">&nbsp
</p>

<p style="margin-left: 0px; position: relative; bottom: 0px; width: 105px; text-align: center;">Charges<br />'.$cat1.'$</p>
<p style="margin-left: 115px; position: relative; bottom: 57px; width: 105px; text-align: center;">Clothing<br />'.$cat2.'$</p>
<p style="margin-left: 230px; position: relative; bottom: 115px; width: 105px; text-align: center;">Foods<br />'.$cat3.'$</p>
<p style="margin-left: 345px; position: relative; bottom: 172px; width: 105px; text-align: center;">Health<br />'.$cat4.'$</p>
<p style="margin-left: 455px; position: relative; bottom: 229px; width: 105px; text-align: center;">Insurance<br />'.$cat5.'$</p>
<p style="margin-left: 567px; position: relative; bottom: 286px; width: 105px; text-align: center;">Phone<br />'.$cat6.'$</p>
<p style="margin-left: 685px; position: relative; bottom: 343px; width: 105px; text-align: center;">Recreation<br />'.$cat6.'$</p>
</div>';
/////
echo'<p style="width: 100px; display: inline;"><br /></p>';

echo"
 $Clothing<br />'.$cat2.' $'Foods<br />'.$cat3.' $
Health<br />'.$cat4.' $
Insurance<br />'.$cat5.' 
Internet & phone<br />'.$cat6.' $
Recreation<br />'.$cat7.' $'";*/

echo'
<footer style="position: absolute; bottom: 0px;">
<p><a href="myaccount.php?file='.$_GET['file'].'">Go back</a></p>
</footer>
</html>
';
}
}
?>