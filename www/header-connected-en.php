<header style="background-color: rgb(104,104,104); height: 45px; width: 100%; position: absolute; right: 0px; top: 0px;">
<div style="display: block; width: auto; margin: auto;">

<a href="mydocs.php" style="color: white; text-decoration: none;"
onMouseOver="document.img_01.src='images/hoverhome.png';"
onMouseOut="document.img_01.src='images/home.png';">
<img src="images/home.png" alt="home" style="height: 45px;" class="img" id="img_01">


<p style="display: inline; font-family: 'Century Gothic', Arial; font-size: 18px; color: white; position: relative; left : -5px; top: -17px; ">
 <?php echo $_SESSION['username'];?> </a> | Premium is : </p>

<a href="plans.php">
<?php

if ($taillego == 1){
?>
<img src="o.png" alt="disabled" style="height: 35px; position: relative; top: -4px; display: inline;"></a>
<?php
}

else{
?>
<img src="i.png" alt="enabled" style="height: 35px; position: relative; top: -4px; display: inline;"></a>
<?php
}
?>

<a href="settings.php">
<img src="images/settings.png" alt="enabled" style="height: 35px; position: absolute; right: 75px; display: inline; padding: 5px;"></a>

<a href="logout.php">
<img src="images/logout.png" alt="enabled" style="height: 35px; position: absolute; right: 15px; display: inline; padding: 5px;"></a>
</div>


</header>
