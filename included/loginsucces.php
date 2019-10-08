<div id="container-1">
<!-- TAB MENU -->
<ul class="ui-tabs-nav1">
  <div style="float:left; width:100%">    
      <li class="ui-tabs-selected">
          <a href="#tab-1"><span class='left'></span><span class='middle'>Your news</span><span class='right'></span></a>
      </li>
      <li>
         <a href="?obj=topic&act=do_add"><span class='left'></span><span class='middle'>Add Topic</span><span class='right'></span></a>
      </li>
     
       <li>
        <a class="noseperate" href="?obj=question&act=do_add"><span class='left'></span><span class='middle'>Post Question</span><span class='right'></span></a>
      </li>
       <li>
        <a class="noseperate" href="?obj=post&act=do_add"><span class='left'></span><span class='middle'>Replay Answer</span><span class='right'></span></a>
      </li>
  </div>
 </ul>
<br/><br/>
<!--TAB I-->
<div class="ui-tabs-panel1" id="tab-1"><br/>
   <h2>Your Topic</h2>
   <div id="tab1" class="tab_content">
      <table class="tablesorter" cellspacing="0">
        <thead>
        <tr>
             <th class="header">No</th>
              <th class="header"><a href="?obj=topic&act=do_view&name=desc">Name</a></th>
              <th class="header">User</th>
              <th class="header">Category</th>
              <th class="header">Tag</th>
              <th class="header"><a href="?obj=topic&act=do_view&status=status">Enable</a></th>
              <th class="header"><a href="?obj=topic&act=do_view&date=desc">Created</a></th>
              <th class="header">ID</th>
              <th class="header">Action</th>
          </tr>
          </thead>
        <tbody>
            <?php
              $obj_class->select_responuser(array("top_name","top_id","top_status","top_created","top_cat_id","top_user_id","topic"),array("tbl_categories","tbl_topics", "cat_name", "cat_id", "cat_status"),"tbl_topics t inner join tbl_users as u on t.top_user_id=u.user_id");
             //argument 1 feild of column argument 2 field table inner join , argument 3 is table 
            ?>
        </tbody>
      </table>
	 </div>
   <br/>
   <h2>Your Question</h2>
   <div id="tab1" class="tab_content">
      <table class="tablesorter" cellspacing="0">
        <thead>
        <tr>
             <th class="header">No</th>
              <th class="header"><a href="?obj=topic&act=do_view&name=desc">Name</a></th>
              <th class="header">User</th>
              <th class="header">Topic</th>
              <th class="header">Tag</th>
              <th class="header"><a href="?obj=topic&act=do_view&status=status">Enable</a></th>
              <th class="header"><a href="?obj=topic&act=do_view&date=desc">Created</a></th>
              <th class="header">ID</th>
              <th class="header">Action</th>
          </tr>
        </thead>
        <tbody>
            <?php
              $obj_class->select_responuser(array("que_text", "que_id","que_status","que_create_date","que_top_id","que_user_id","question"), array("tbl_topics","tbl_questions", "top_name", "top_id", "top_status"),"tbl_questions t inner join tbl_users as u on t.que_user_id=u.user_id");
            ?>
        </tbody>
      </table>
	 </div>
   <br/>
    <h2>Your Answer</h2>
   <div id="tab1" class="tab_content">
      <table class="tablesorter" cellspacing="0">
        <thead>
        <tr>
              <th class="header">No</th>
              <th class="header"><a href="?obj=topic&act=do_view&name=desc">Name</a></th>
              <th class="header">User</th>
              <th class="header">Category</th>
              <th class="header">Tag</th>
              <th class="header"><a href="?obj=topic&act=do_view&status=status">Enable</a></th>
              <th class="header"><a href="?obj=topic&act=do_view&date=desc">Created</a></th>
              <th class="header">ID</th>
              <th class="header">Action</th>
          </tr>
        </thead>
        <tbody>
            <?php
              $obj_class->select_responuser(array("post_text","post_id","post_status","post_create_date","post_que_id","post_user_id","post"), array("tbl_questions","tbl_posts", "post_text", "post_id", "post_status"), "tbl_posts t inner join tbl_users as u on t.post_user_id=u.user_id");
            ?>
        </tbody>
      </table>
	 </div>

   <!-- end of #tab1 -->
<!--End TAB I-->
 </div>
<!--TAB II-->
<div class="ui-tabs-panel1 ui-tabs-hide" id="tab-2">

<!--TAB II-->
</div>
<!--TAB IIII-->
<div class="ui-tabs-panel1 ui-tabs-hide" id="tab-3">
<h1>Hello Tab three</h1>
<!--TAB III--></div>
</div> 