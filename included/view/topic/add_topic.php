<form action="?obj=topic&act=do_save" id="admin_form" method="post">
	<input type="hidden" name="submitsave" />
	<article class="module width_full" style="height:545px;">
			<header><h3>Add New Topic <span style="color:blue;font-size: 10px; text-transform: lowercase;">(Label color red need require field)</span>
        <div class="submit_link" style="margin-top:-4px;padding:0px;">
				  <input type="submit" value="Apply" class="alt_btn" name="apply">
          <input type="submit" value="Save New" class="alt_btn" name="submitnew">
          <input type="submit" value="Save Close" class="alt_btn" name="close">
					<input type="reset" class="alt_btn" value="Reset" name="Reset">
        </div>
        </h3></header>
				<div class="module_content">
						<fieldset>
							<label for="topname">Topic Name</label>
							<input type="text" id="topname" name="topname" class="required" >
						</fieldset>
						<fieldset>
							<label class="black">Description</label>
							<textarea rows="12" name="topdes"></textarea>
						</fieldset>
						<fieldset>
              <div style="width:230px;border-right:1px solid #ccc;float: left; margin-right:15px;">
              <label>Choose Category</label>
              <?php echo $this->selectoption("cat_dropdown","tbl_categories", "cat_status = 1", "cat_name asc", "", array("cat_id", "cat_name"), "", "") ;?>
              </div>
              <div style="width:100px;float: left; border-right:1px solid #ccc; margin-right:15px;">
							<label>Status</label>             
							yes<input type="radio" name="status" value="1" checked="checked"/>
							no<input type="radio" name="status" value="0" />
              </div>
              <div style="width:230px; float: left">
              <label class="black">Choose Tags</label>
              <?php echo $this->selectoption("tag_dropdown","tbl_tag", "tag_status = 1", "tag_name asc", "", array("tag_id", "tag_name"), "", "") ;?>
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
