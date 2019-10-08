<section id="main" class="column">
<form action="?obj=<?php echo $this->obj_name; ?>&act=do_save" method="post" id="admin_form">
<article class="module width_full" style="height:611px;">
			<header><h3>Add New User
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
							<input type="text" name="username" id="username" minlength="4" class="required" style="width:92%;" />
						</fieldset>
						<fieldset style="width:48%; float:left;"> <!-- to make two field float next to one another, adjust values accordingly -->
							<label for="useremail">User Email</label>
							<input type="text" name="useremail" id="useremail" class="required email" style="width:92%;">
						</fieldset>
            <fieldset style="width:48%; float:left; margin-right: 3%;"> <!-- to make two field float next to one another, adjust values accordingly -->
							<label for="fname">First Name</label>
							<input type="text" name="fname" class="required" id="fname" style="width:92%;" />
						</fieldset>
						<fieldset style="width:48%; float:left;"> <!-- to make two field float next to one another, adjust values accordingly -->
							<label for="lname">Last Name</label>
							<input type="text" name="lname" id="lname" class="required" style="width:92%;">
						</fieldset>
            <fieldset style="width:48%; float:left; margin-right: 3%;"> <!-- to make two field float next to one another, adjust values accordingly -->
							<label for="password">Password</label>
							<input type="password" name="password" id="password" minlength="4" class="required" style="width:92%;" />
						</fieldset>
						<fieldset style="width:48%; float:left;"> <!-- to make two field float next to one another, adjust values accordingly -->
							<label for="conpass">Confirm Password</label>
							<input type="password" name="conpass" id="conpass" class="required" style="width:92%;">
						</fieldset>                        
            <fieldset style="width:48%; float:left; margin-right: 3%;"> <!-- to make two field float next to one another, adjust values accordingly -->
							<label for="userrule">User Role</label>
							<select name="userrule" id="userrule" class="required" style="width:92%;">
								<option>Administrator</option>
								<option>Simple User</option>
							</select>
						</fieldset>
						<fieldset style="width:48%; float:left;"> <!-- to make two field float next to one another, adjust values accordingly -->
							<label style="width:100%;">User Enable</label>
							<input type="radio" checked="checked" name="active" value="1" />Yes
              <input type="radio" name="active" value="0" />No
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
</section>