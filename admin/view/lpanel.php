<aside id="sidebar" class="column">
		<form class="quick_search">
			<input type="text" value="Quick Search" onFocus="if(!this._haschanged){this.value=''};this._haschanged=true;">
		</form>
		<hr/>
		<h3>Categories</h3>
		<ul class="toggle">
			<li class="icn_new_article"><a href="?obj=category&act=do_add">New category</a></li>
			<li class="icn_categories"><a href="?obj=category&act=do_view">Manage category</a></li>
			<li class="icn_tags" style="display:none;"><a href="#">Tags</a></li>
		</ul>
		<h3>Topics</h3>
		<ul class="toggle">
			<li class="icn_new_article"><a href="?obj=topic&act=do_add"><?php echo "New Topic" ?></a></li>
			<li class="icn_categories"><a href="?obj=topic&act=do_view">Manage Topic</a></li>
			<li class="icn_tags" style="display:none;"><a href="#">Recycle Bin</a></li>
		</ul>
		<h3>Question</h3>
		<ul class="toggle">
			<li class="icn_new_article"><a href="?obj=question&act=do_add"><?php echo "New Question" ?></a></li>
			<li class="icn_categories"><a href="?obj=question&act=do_view">Manage question</a></li>			
			<li class="icn_tags" style="display:none;"><a href="#">Recycle Bin</a></li>
		</ul>
    <h3>Post</h3>
		<ul class="toggle">
			<li class="icn_new_article"><a href="?obj=post&act=do_add"><?php echo "New Post" ?></a></li>
			<li class="icn_categories"><a href="?obj=post&act=do_view">Manage Post</a></li>
			<li class="icn_tags" style="display:none;"><a href="#">Recycle Bin</a></li>
		</ul>
		<h3>Users</h3>
		<ul class="toggle">
			<li class="icn_add_user"><a href="?obj=user&act=do_add">Add New User</a></li>
			<li class="icn_view_users"><a href="?obj=user&act=do_view">View Users</a></li>
			<li class="icn_profile"><a href="#">Your Profile</a></li>
		</ul>
		<!--<h3>Media</h3>
		<ul class="toggle">
			<li class="icn_folder"><a href="#">File Manager</a></li>
			<li class="icn_photo"><a href="#">Gallery</a></li>
			<li class="icn_audio"><a href="#">Audio</a></li>
			<li class="icn_video"><a href="#">Video</a></li>
		</ul>-->
		<h3>Admin</h3>
		<ul class="toggle" style="display:none;">
			<li class="icn_settings"><a href="#">Options</a></li>
			<li class="icn_security"><a href="#">Security</a></li>
			<li class="icn_jump_back"><a href="#">Logout</a></li>
		</ul>		
</aside>