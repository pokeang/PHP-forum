<?php
  ($_GET["act"] == "do_edit")?$obj = new user($_SESSION["id"]):"";
   $obj->do_edit();
?>
	<form action="?obj=<?php echo $this->obj_name ?>&act=do_edit" id="admin_form" method="post" enctype="multipart/form-data">
  <input type="hidden" name="id_edit" value="<?php echo $_GET["iden"]; ?>"  />
  <?php @$this->varlidatestring($_GET["update"])?Message::concatSuccess("Successful for Edit"):"" ;echo Message::raiseError();Message::raiseSuccess(); $userpassword ="";?>
	<article class="module width_full" style="height:630px;">
   
			<header><h3>Your Profile
      	<div class="submit_link" style="margin-top:-4px;padding:0px;">
				  <input type="submit" value="Apply" class="alt_btn" name="apply">
          <input type="submit" value="Save New" class="alt_btn" name="submitnew">
          <input type="submit" value="Save Close" class="alt_btn" name="close">
					<input type="reset" class="alt_btn" value="Reset" name="Reset">
        </div>
      </h3></header>

				<div class="module_content">
            <fieldset style="width:48%; float:left; margin-right: 3%;"> <!-- to make two field float next to one another, adjust values accordingly -->
							<label for="username">Username</label>
							<input type="text" name="username" id="username" minlength="4" class="required" style="width:92%;" value="<?php echo $obj->user_username; ?>" />
						</fieldset>
						 <fieldset style="width:48%; float:left;"> <!-- to make two field float next to one another, adjust values accordingly -->
							<label for="useremail">User Email</label>
							<input type="text" name="useremail" id="useremail" class="required email" style="width:92%;" value="<?php echo $obj->user_email; ?>">
						</fieldset>
             <fieldset style="width:48%; float:left; margin-right: 3%;"> <!-- to make two field float next to one another, adjust values accordingly -->
							<label for="fname">First Name</label>
							<input type="text" name="fname" class="required" id="fname" style="width:92%;" value="<?php echo $obj->user_fname; ?>" />
						</fieldset>
						 <fieldset style="width:48%; float:left;"> <!-- to make two field float next to one another, adjust values accordingly -->
							<label for="lname">Last Name</label>
							<input type="text" name="lname" id="lname" class="required" style="width:92%;" value="<?php echo $obj->user_lname; ?>">
						</fieldset>
              <fieldset style="width:48%; float:left; margin-right: 1%;"> <!-- to make two field float next to one another, adjust values accordingly -->
							<label for="password">Current Password</label>
              <input type="hidden" name="currentspassword" value="<?php echo $obj->user_password ?>"/>
							<input type="text" name="currentpassword" id="password" style="width:92%;" value=""/>
						  </fieldset>
						  <fieldset style="width:48%; float:right; margin-right: 1%;"> <!-- to make two field float next to one another, adjust values accordingly -->
							<label for="password">New Password</label>
							<input type="text" name="newpassword" id="password" style="width:92%;" />
						 </fieldset>
              <fieldset style="width:48%; float:left; margin-right: 1%;"> <!-- to make two field float next to one another, adjust values accordingly -->
							<label for="password">Confirm Password</label>
							<input type="text" name="newpassword" id="password" style="width:92%;" />
						 </fieldset>
              <fieldset style="width:48%; float:right; margin-right: 1%;">
                 <label for="password">Your Photo:</label>
                 <input type="hidden" name="oldimage" value="<?php echo $obj->user_image; ?>" />
                 <input type="file" name="txtphoto" id="txtphoto" style="margin-left:20px;"/>
                  <img src="photo/thumb/<?php echo $_SESSION["id"]."_".$obj->user_image; ?>" height="50px"/>
              </fieldset>
             <fieldset style="width:48%; float:right; margin-right: 2%;"> <!-- to make two field float next to one another, adjust values accordingly -->
							<label for="userrule">User Role</label>
							<select name="userrule" id="userrule" class="required" style="width:92%;">
                <option value="">---Choose Role-----</option>
                <option value="1" <?php echo ($obj->user_rule == 1) ? "selected=selected":"" ?> >Administrator</option>
								<option value="0" <?php echo ($obj->user_rule == 0) ? "selected=selected":"" ?> >Simple User</option>
							</select>
						</fieldset>
						<fieldset style="width:47%; float:left; padding-left:10px;"> <!-- to make two field float next to one another, adjust values accordingly -->
							<label style="width:100%;">User Enable</label>
							<?php $check = $obj->user_status; ?>
							yes<input type="radio" name="active" value="1" <?php echo $checked = ($check == 1)? "checked":"" ?> />
							no<input type="radio" name="active" value="0" <?php echo $checked = ($check == 0)? "checked":"" ?> />
						</fieldset>
             <div class="clear"></div>
				</div>
			<footer>
				<div class="submit_link">
				  <input type="submit" value="Apply" class="alt_btn" name="apply">
          <input type="submit" value="Save New" class="alt_btn" name="submitnew">
          <input type="submit" value="Save Close" class="alt_btn" name="close">
					<input type="reset" class="alt_btn" value="Reset" name="Reset">
        </div>
			</footer>
		</article>
</form>
