<?php
  ($_GET["act"] == "do_edit")?$obj = new post($_SESSION["userid"]):"";
   $obj->do_edit();
?>
<section id="main" class="column">
	<form action="?obj=<?php echo $this->obj_name ?>&act=do_edit" id="admin_form" method="post">
	<input type="hidden" name="id_edit" value="<?php echo $_GET["iden"]; ?>"  />
  <?php @$this->varlidatestring($_GET["update"])?Message::concatSuccess("Successful for Edit"):"" ;echo Message::raiseError();Message::raiseSuccess() ?>
	<article class="module width_full">
			<header><h3>Edit Post<span style="color:blue;font-size: 10px; text-transform: lowercase;">(Label color red need require field)</span>
        <div class="submit_link" style="margin-top:-4px;padding:0px;">
				    <input type="submit" value="Apply" class="alt_btn" name="btnapply">
            <input type="submit" value="Save" class="alt_btn" name="updatebtn">
					  <input type="submit" class="alt_btn" value="Cancel">
        </div>
        </h3></header>
				<div class="module_content">
						<fieldset>
							<label class="required">Post Description</label>
							<textarea rows="12" name="posttext" class="required"><?php echo $obj->post_text; ?></textarea>
						</fieldset>
						<fieldset>
              <div style="width:230px;border-right:1px solid #ccc;float: left; margin-right:15px;">
                <label class="required">Choose Question</label>
                <?php echo $this->selectoption("que_dropdown","tbl_questions", "que_status = 1", "que_text asc", "", array("que_id", "que_text"), $obj->post_que_id, "") ;?>
              </div>
              <div style="width:100px;float: left; border-right:1px solid #ccc; margin-right:15px;">
							<label>Status</label>
							<?php $check = $obj->post_status; ?>
							yes<input type="radio" name="status" value="1" <?php echo $checked = ($check == 1)? "checked":"" ?> />
							no<input type="radio" name="status" value="0" <?php echo $checked = ($check == 0)? "checked":"" ?> />
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