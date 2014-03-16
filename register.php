<?php require "./sessionstart.php" ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php require "./headlabel.php" ?>
<body>
	<script src="./js/ajax.js"></script>
	<div id="whole">
		<?php require "./headerandbanner.php"; ?>
		<div id="article" style="text-align:center;">
			<h3>Register</h3>
			<form action="./register_check.php" method="post">
				<span style="text-align:left;display:inline-block;width:100px;height:auto;">Username:</span><input style="width:150px;" class="text" name="usernm" type="text" onblur="checkUsername(this.value);" />
				<span id="usernamecheck" class="registercheck">Any character is alright.</span><br />
				<span style="text-align:left;display:inline-block;width:100px;height:auto;">Password:</span><input style="width:150px;" class="text" name="passwd" type="password" onkeyup="checkPassword(this.value);" onblur="checkPassword(this.value);" id="passwd" />
				<span id="passwordcheck" class="registercheck">Strength: <div id="pwd_L" class="pwdStrength"></div><div id="pwd_M" class="pwdStrength"></div><div id="pwd_H" class="pwdStrength"></div></span><br />
				<span style="text-align:left;display:inline-block;width:100px;height:auto;">Repeat:</span><input style="width:150px;" class="text" name="repeat" type="password" onblur="checkRepeatPassword(this.value);" />
				<span id="repeatpasswordcheck" class="registercheck">Enter the password again.</span><br />
				<span style="text-align:left;display:inline-block;width:100px;height:auto;">Verify:</span><span style="width:155px;margin-right:9px;"><input type="text" class="text" name="code" style="width:73px;" onBlur="checkVerifyCode(this.value);" /><img id="code" name="code" src="codenew.php" alt="Change" style="cursor:pointer;margin:-5px 4px;width:53px;height:21px;display:inline-block;" onclick="create_code();checkVerifyCode(this.value);updateVerifyCodeText();" /><div id="checkCode" style="width:16px;height:21px;display:inline-block;margin-top:1px;float:right;"></div></span><span class="registercheck" style="margin-left:-1px;" id="vcode"></span><br /><br />
				<script>updateVerifyCodeText();</script>
				<input class="button" value="Submit" type="submit" />
				<input class="button" value="Reset" type="reset" />
			</form>
			<br />
		</div>
		<?php require "./footer.php"; ?>
	</div>
</body>
</html>
