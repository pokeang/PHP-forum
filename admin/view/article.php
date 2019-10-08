<?php 

class article{
	public $obj_name = "article";
	public $tblname = "tbl_categories";
	public $cat_name;
	public $cat_des;
	public $cat_user_id;
	public $cat_status;
	public $user_info;
  public $permission_allow;
	public $act;
	
	function __construct($user_info, $permission_allow){
		$this->user_info = $user_info;
		$this->permission = $permission_allow;
	}
	
	function do_view(){
	echo '<section id="main" class="column">';
	echo '<form action="model/mod_action.php" id="admin_form" method="post">
	<input type="hidden" name="submitsave" />
	<article class="module width_full">
			<header><h3>Add New Category</h3></header>
				<div class="module_content">
						<fieldset>
							<label for="catname">Category Name</label>
							<input type="text" id="catname" name="catname" class="required">
						</fieldset>
						<fieldset>
							<label>Description</label>
							<textarea rows="12" name="catdes"></textarea>
						</fieldset>
				</div>
			<footer>
				<div class="submit_link">';
				    echo "<a href='?obj=$this->obj_name&amp;act=save' class='alt_btn'><span class='task_menu'>Add</span></a>";					
					echo '<input type="reset" value="Reset">
				</div>
				
			</footer>
		</article>
</form>
</section>';
}
 }?>