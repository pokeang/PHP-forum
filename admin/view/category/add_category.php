<section id="main" class="column">
	<form action="?obj=category&act=do_save" id="admin_form" method="post">
	<input type="hidden" name="submitsave" />
	<article class="module width_full">
			<header><h3>Add New Category
       	<div class="submit_link" style="margin-top:-4px;padding:0px;">
				  <input type="submit" value="Apply" class="alt_btn" name="apply">
          <input type="submit" value="Save New" class="alt_btn" name="submitnew">
          <input type="submit" value="Save Close" class="alt_btn" name="close">
					<input type="reset" class="alt_btn" value="Reset" name="Reset">
        </div>
			</h3>
      </header>
				<div class="module_content">
						<fieldset>
							<label for="catname">Category Name</label>
							<input type="text" id="catname" name="catname" class="required" >
						</fieldset>
						<fieldset>
							<label>Description</label>
							<textarea rows="12" name="catdes"></textarea>
						</fieldset>
						<fieldset>
							<label style="width:60px;float:left;">Status</label>
             
							yes<input type="radio" name="status" value="1" checked="checked"/>
							no<input type="radio" name="status" value="0" />
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