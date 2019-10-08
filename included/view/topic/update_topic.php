<?php
  ($_GET["act"] == "do_edit")?$obj = new topic($_SESSION["id"]):"";
   $obj->do_edit();
?>
<section id="main" class="column">
	<form action="?obj=<?php echo $this->obj_name ?>&act=do_edit" id="admin_form" method="post">
	<input type="hidden" name="id_edit" value="<?php echo $_GET["iden"]; ?>"  />
  <?php @$this->varlidatestring($_GET["update"])?Message::concatSuccess("Successful for Edit"):"" ;echo Message::raiseError();Message::raiseSuccess() ?>
	<article class="module width_full" style="height:545px">
			<header><h3>Update Topic <span style="color:blue;font-size: 10px; text-transform: lowercase;">(Label color red need require field)</span>
         <div class="submit_link" style="margin-top:-4px;padding:0px;">
            <input type="submit" value="Apply" class="alt_btn" name="btnapply">
            <input type="submit" value="Save" class="alt_btn" name="updatebtn">
					  <input type="submit" class="alt_btn" value="Cancel">
				</div>
        </h3></header>
				<div class="module_content">
						<fieldset>
							<label for="topname">Topic Name</label>
							<input type="text" id="topname" name="topname" class="required" value="<?php echo $obj->top_name; ?>">
						</fieldset>
						<fieldset>
							<label class="black">Description</label>
							<textarea rows="12" name="topdes"><?php echo $obj->top_des; ?></textarea>
						</fieldset>
						<fieldset>
              <div style="width:230px;border-right:1px solid #ccc;float: left; margin-right:15px;">
              <label class="black">Choose Category</label>
              <?php echo $this->selectoption("cat_dropdown","tbl_categories", "cat_status = 1", "cat_name asc", "", array("cat_id", "cat_name"), $obj->top_cat_id,"") ;?>
              </div>
              <div style="width:100px;float: left; border-right:1px solid #ccc; margin-right:15px;">
							<label>Status</label>
							<?php $check = $obj->top_status; ?>
							yes<input type="radio" name="status" value="1" <?php echo $checked = ($check == 1)? "checked":"" ?> />
							no<input type="radio" name="status" value="0" <?php echo $checked = ($check == 0)? "checked":"" ?> />
              </div>
              <div style="width:230px; float: left">
              <label class="black">Choose Tags</label>
              <?php echo $this->selectoption("tag_dropdown","tbl_tag", "tag_status = 1", "tag_name asc", "", array("tag_id", "tag_name"), $obj->top_tag, "") ;?>
              </div>
						</fieldset>
				</div>
			<footer>
				 <div class="submit_link" style="margin-top:4px;padding:0px;">
            <input type="submit" value="Apply" class="alt_btn" name="btnapply">
            <input type="submit" value="Save" class="alt_btn" name="updatebtn">
					  <input type="submit" class="alt_btn" value="Cancel">
				</div>		
			</footer>
		</article>
</form>
</section>