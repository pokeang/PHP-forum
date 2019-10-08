<?php
  if(isset($_POST["signin"])){
    $username = $_POST["uname"];
    $password = $_POST["password"];
    $result = $obj_class->user_login(array("user_id","user_username","user_password"),"tbl_users","user_username='".$username."' and user_password='".md5($password)."' and user_status=1");
    if($result != ""){
      $obj_class->redirectUrl("index.php");
    }
    else {
        Message::concatError("Invalid Username or Password !");
        Message::raiseError();
    }
  }
?>
<section class="grid col-three-quarters mq2-col-two-thirds mq3-col-full">
	<h3>Sign In</h3>	
		<form id="contact_form" class="contact_form" action="" method="post" name="contact_form">	
				<ul>					
            <li>
              <label for="uname">Username:</label>
              <input type="text" name="uname" id="uname" class="required" >
            </li>
            <li>
              <label for="password">Password:</label>
              <input type="password" name="password" id="password" class="required" minlength="4" >
            </li>
					  <li>
						  <button type="submit" id="submit" name="signin" class="button fleft">Login</button>
					  </li>
				</ul>			
		</form>
</section>	