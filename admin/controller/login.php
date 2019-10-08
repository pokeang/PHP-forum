<?php
include_once("mod_login.php");
class login extends mod_login{ 
 function login_form($login_status){
?>
<!-- Start: login-holder -->
<div id="login-bg" style="width:100%;height:100%;">
<div id="login-holder">
	<!-- start logo -->
	<div id="logo-login">
		<a href="index.html"><img src="../img/logo.png" width="156" height="40" alt="" /></a>
	</div>
	<!-- end logo -->
	<div class="clear"></div>
	<!--  start loginbox ................................................................................. -->
	<div id="loginbox">
	<!--  start login-inner -->
     <?php
		if($login_status==false){
				?>
                <!-- erro --><div  style=" width:251px; height:auto;border:0px solid red; text-align:center;margin-left:116px;">
                    <div class="login_err en label_red">Invalid user name or password</div>
                    <span id="ms"></span>
                <!-- end erro --></div> 
    <?php }?>
	<div id="login-inner">
    
    <form action="" method="post">
		<table border="0" cellpadding="0" cellspacing="0">
	  <tr>
			<th>Username</th>
      <input type="hidden" name="loginsubmit" value="submit" />
			<td><input type="text" name="txt_user" value="Username"  onfocus="this.value=''" class="login-inp" /></td>
		</tr>
		<tr>
			<th>Password</th>
			<td><input type="password" name="txt_pwd" value="************"  onfocus="this.value=''" class="login-inp" /></td>
		</tr>
		<tr>
			<th></th>
			<td valign="top"><input type="checkbox" class="checkbox-size" id="login-check" /><label for="login-check">Remember me</label></td>
		</tr>
		<tr>
			<th></th>
			<td><input type="submit" class="submit-login" name="submit" /></td>
		</tr>
		</table>
    </form>
	</div>
 	<!--  end login-inner -->
	<div class="clear"></div>
	<a href="" class="forgot-pwd">Forgot Password?</a>
 </div>
 <!--  end loginbox -->
	<!--  start forgotbox ................................................................................... -->
	<div id="forgotbox">
		<div id="forgotbox-text">Please send us your email and we'll reset your password.</div>
		<!--  start forgot-inner -->
		<div id="forgot-inner">
		<table border="0" cellpadding="0" cellspacing="0">
		<tr>
			<th>Email address:</th>
			<td><input type="text" value=""   class="login-inp" /></td>
		</tr>
		<tr>
			<th> </th>
			<td><input type="button" class="submit-login"  /></td>
		</tr>
		</table>
		</div>
		<!--  end forgot-inner -->
		<div class="clear"></div>
		<a href="" class="back-login">Back to login</a>
	</div>
	<!--  end forgotbox -->
</div>
</div>
<!-- End: login-holder -->
<?php
	}
 }?>