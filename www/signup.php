<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
       <link rel="stylesheet" href="style.css" />
	   	<link rel="icon" type="image/png" href="cloud.png" />
        <title>Sign up to iData</title>
    </head>
    <body style="background-color: rgb(155,213,73);">
	<?php include_once("piwiktrack.php"); ?>
	<?php include_once("header-en.php"); ?>
	
<div style="position: absolute; width : 940px; height: 680px; top: 50%; left: 50%; margin: -330px 0 0 -470px;">
<div class="signuppres">
	<div style="margin-left: 15px; margin-right: 15px;">
<h2>Let's see what you can do !</h2>
<h3>Your files everywhere, everytime.</h3>
<p>With iData, no mater wher you are, your files are with you. Just connect to your account ! No more stress to forget your USB devices or to get a virus with them.</p>
<h3>All your office in one cloud.</h3>
<img src="ppt.png" alt="ppt" class="prespics"><img src="avi.png" alt="avi" class="prespics"><img src="mp3.png" alt="mp3" class="prespics"><img src="xls.png" alt="xls" class="prespics"><img src="exe.png" alt="exe" class="prespics"><img src="zip.png" alt="zip" class="prespics">
<p>All your text documents, workbooks, slideshows, pictures and more in the same account</p>
<h3>Easy to use.</h3>
<img src="upload.png" alt="upload" class="prespics"><img src="get.png" alt="download" class="prespics"><img src="share.png" alt="share" class="prespics"><img src="delete.png" alt="delete" class="prespics"><img src="rename.png" alt="rename" class="prespics"><img src="remind.png" alt="reminds" class="prespics">
<p>With less than 10 buttons you can do everything : uploading, downloading, sharing, deleting, renaming and creating reminders. It's very easy to use !</p>

</div>
</div>
	
<div class="signup">
	<div style="margin-left: 7px; margin-right: 7px;">
	<h3>Sign up now ! It takes only 3 minutes</h3>
	
	<form method="post" action="success-sign-up.php">
<!--<p>Gender : <select name="gender">
    <option value="Mrs">Female</option>
    <option value="Mr">Male</option>
	<option value="default" selected="selected" hidden>I am...</option>
</select></p>-->
	<p> First name : <input type="text" name="firstname"/></p>
	<p>Surname : <input type="text" name="surname"/></p>
	<p>Email : <input type="email" name="email" /></p>
	<p>Username : <input type="text" name="username" /></p>
	<p>Password : <input type="password" name="password" /></p>
	<p>Confirm  : <input type="password" name="passwordconfirm" /></p>
	<p><input type="checkbox" name="agree" id="agree" /> <label for="agree">I agree to the iData <a href="tos.php">Terms Of Service</a> and <a href="privacy.php">Privacy Policy</a></label>
	<br />
	<input type="submit" value="Send" />
	</form>
	</div>
	</div>
</div>

</body>
	
	</html>
