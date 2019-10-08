<form action="<?php echo "?obj=".$this->obj_name."&act=do_delete"; ?>" method="post">
<section id="main" class="column">
 <?php Message::raiseError();Message::raiseSuccess(); Message::raiseWarning();  ?>
	<article class="module width_full">     
		<header><h3 class="tabs_involved">Answer Manager</h3>
      <a onclick="javascript: return confirm('Are you sure?');" href="<?php echo "?obj=".$this->obj_name."&act=do_delete"; ?>" ><input type="submit" value="Delete" name="delete" style="background:none; height: 25px;float: right; margin: 3px;"/></a>
		<!--<ul class="tabs">
   			<li class="" style=""><a href="#tab1">ALL</a></li>
    		<li class="active"><a href="#tab2">YOURS</a></li>
		</ul>-->
     
		</header>
		<div class="tab_container">
			<div id="tab1" class="tab_content">
				<table class="tablesorter" cellspacing="0">
            	<thead>
            	<tr>
					        <th class="header"><input type='checkbox' name='chk_all' onclick='selectChk(this,"chdel[]")' /></th>
                	<th class="header">No</th>
                  <th class="header"><a href="?obj=<?php echo $this->obj_name; ?>&act=do_view&name=desc">Name</a></th>
                  <th class="header">User</th>
                  <th class="header">Topic</th>
                  <th class="header"><a href="?obj=<?php echo $this->obj_name; ?>&act=do_view&status=status">Enable</a></th>
                  <th class="header"><a href="?obj=<?php echo $this->obj_name; ?>&act=do_view&date=desc">Created</a></th>
                  <th class="header">ID</th>
                  <th class="header">Action</th>
                </tr>
              </thead>
              <tbody>             
                	<?php 
                    $this->record_list();
                  ?>
                </tbody>
            </table>
			</div><!-- end of #tab1 -->		
		</div><!-- end of .tab_container -->	
		</article>           	
	</section>
</form>