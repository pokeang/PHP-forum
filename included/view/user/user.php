<form action="<?php echo "?obj=".$this->obj_name."&act=do_delete"; ?>" method="post">
  
<section id="main" class="column">
  <?php Message::raiseError();Message::raiseSuccess(); Message::raiseWarning();  ?>   
	<article class="module width_full">
		<header><h3 class="tabs_involved">User Manager</h3>
      
		</header>
    
		<div class="tab_container">
			<div id="tab1" class="tab_content">       
          <table class="tablesorter" cellspacing="0">
            	<thead>
                <tr>
				        	  <th class="header"><input type='checkbox' name='chk_all' onclick='selectChk(this,"chdel[]")' /></th>
                	  <th class="header">No</th>
                    <th class="header"><a href="?obj=<?php echo $this->obj_name; ?>&act=do_view&name=desc">User Name</a></th>
                    <th class="header">User Email</th>
                    <th class="header">User Level</th>
                    <th class="header"><a href="?obj=<?php echo $this->obj_name; ?>&act=do_view&status=status">Enable</a></th>
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