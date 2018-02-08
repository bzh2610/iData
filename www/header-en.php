<header style="background-color: rgb(104,104,104); height: 45px; width: 100%; position: absolute; right: 0px; top: 0px;">
<div style="display: block; width: 720px; margin: auto;">
<a href="index.php"
onMouseOver="document.img_01.src='images/hoverhome.png';"
onMouseOut="document.img_01.src='images/home.png';">
<img src="images/home.png" alt="home" style="height: 45px;" class="img" id="img_01"></a>

<a href="plans.php"
onMouseOver="document.img_02.src='images/hoverplans.png';"
onMouseOut="document.img_02.src='images/plans.png';">
<img src="images/plans.png" alt="plans" style="height: 45px;" class="img" id="img_02"></a>

<a href="features.php"
onMouseOver="document.img_03.src='images/hoverfeatures.png';"
onMouseOut="document.img_03.src='images/features.png';">
<img src="images/features.png" alt="features" style="height: 45px;" class="img" id="img_03"></a>


<a href="#" onclick="signin.style.display='block'; talkbox.style.display='block'; upbtn.style.display='none';"
onMouseOver="document.img_04.src='images/hoversignin.png';"
onMouseOut="document.img_04.src='images/signin.png';">
<img src="images/signin.png" alt="home" style="height: 45px;" class="img" id="img_04"></a>

<a href="signup.php"
onMouseOver="document.img_00.src='images/hoversignup.png';"
onMouseOut="document.img_00.src='images/signup.png';">
<img src="images/signup.png" alt="home" style="height: 45px;" class="img" id="img_00"></a>

</div>
</header>


<div id="signin" onclick="location.reload()" style="z-index: 1; display: none; width: 100%; height: 100%; px; position: fixed; top: 0px; right:0px; background-color: rgb(0,0,0); opacity: 0.5;">
</div>

<div id="talkbox" style="z-index: 2; opacity: 1; display: none; background-color: rgb(255,255,255);	top: 50%;	left: 50%;	padding:10px;	border:1px solid rgb(100,100,100); -moz-border-radius:10px; -webkit-border-radius:10px; border-radius:10px; font-family: 'Century Gothic', Arial; width: 320px; height: 400px; position: fixed; margin: -200px 0 0 -160px;  text-align: center;">
	<div style="position: relative; top: -20px;">
	<h2 style="text-align: center; font-size: 35px; font-family: 'Century Gothic', Arial; color: rgb(190,190,190);">iData</h2>
	<img src="cloud.png" alt="cloud" style="top: -20px; width: 200px; position: relative; margin: auto;">
	<form method="post" action="signin.php">
	<p style="font-size: 18px;">Username : <input type="text" name="username"/></p>
	<p style="font-size: 18px;">Password : <input type="password" name="password"/></p>
	<p style="font-size: 18px;"><input type="checkbox" name="rememberme"/>Remember me</p>
	<input type="submit" value="Login">
	</form>
	</div>
</div>
