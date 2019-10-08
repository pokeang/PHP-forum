<?php
  ($_GET["act"] == "do_edit")?$catobj = new category($_SESSION["userid"]):""; 
   $catobj->do_edit(); 
?>
<section id="main" class="column">
	<form action="?obj=category&act=do_edit" id="admin_form" method="post">
	<input type="hidden" name="id_edit" value="<?php echo $_GET["iden"]; ?>"  />
  <?php @$this->varlidatestring($_GET["update"])?Message::concatSuccess("Successful for Edit"):"" ;echo Message::raiseError();Message::raiseSuccess() ?>
	<article class="module width_full">
			<header><h3>Edit Category
        <div class="submit_link" style="margin-top:-4px;padding:0px;">			    
            <input type="submit" value="Apply" class="alt_btn" name="btnapply">
            <input type="submit" value="Save" class="alt_btn" name="updatebtn">
					  <input type="submit" class="alt_btn" value="Cancel">
				</div>		
        </h3></header>       
				<div class="module_content">
						<fieldset>
							<label for="catname">Category Name</label>
							<input type="text" id="catname" name="catname" class="required" value="<?php  echo $catobj->cat_name ?>" >
						</fieldset>
						<fieldset>
							<label>Description</label>
							<textarea rows="12" name="catdes" value=""><?php echo $catobj->cat_des; ?></textarea>
						</fieldset>
						<fieldset>
							<label>Status</label>
              <?php $check = $catobj->cat_status; ?>
							yes<input type="radio" name="status" value="1" <?php echo $checked = ($check == 1)? "checked":"" ?> />
							no<input type="radio" name="status" value="0" <?php echo $checked = ($check == 0)? "checked":"" ?> />
						</fieldset>
				</div>
			<footer>
				<div class="submit_link">
           <input type="submit" value="Apply" class="alt_btn" name="btnapply" />
				  <input type="submit" value="Save" class="alt_btn" name="updatebtn" />
          <a href="?obj=category&act=do_view"><input type="submit" class="alt_btn" value="Cancel" name="cancel" /></a>
				</div>			
			</footer>
		</article>
</form>
</section>