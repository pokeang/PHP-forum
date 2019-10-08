<section id="main" class="column">
	<form action="?obj=<?php echo $this->obj_name; ?>&act=do_save" id="admin_form" method="post">
	<input type="hidden" name="submitsave" />
	<article class="module width_full">
			<header><h3>New Post <span style="color:blue;font-size: 10px; text-transform: lowercase;">(Label color red need require field)</span>
        <div class="submit_link" style="margin-top:-4px;padding:0px;">
          <input type="submit" value="Apply" class="alt_btn" name="apply">
          <input type="submit" value="Save New" class="alt_btn" name="submitnew">
          <input type="submit" value="Save Close" class="alt_btn" name="close">
					<input type="reset" class="alt_btn" value="Reset" name="Reset">
				</div>
        </h3></header>
				<div class="module_content">				
						<fieldset>
							<label for="topname">Post Description</label>
							<textarea rows="12" name="posttext" class="required"></textarea>
						</fieldset>
						<fieldset>
              <div style="width:290px;border-right:1px solid #ccc;float: left; margin-right:15px;">
              <label class="required" >Choose Topic</label>
              <?php echo $this->selectoption("que_dropdown","tbl_questions", "que_status = 1", "que_text asc", "", array("que_id", "que_text"), "", "") ;?>
              </div>
              <div style="width:100px;float: left; border-right:1px solid #ccc; margin-right:15px;">
							<label>Status</label>
							yes<input type="radio" name="status" value="1" checked="checked"/>
							no<input type="radio" name="status" value="0" />
              </div>              
						</fieldset>
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