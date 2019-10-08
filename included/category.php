<?php
$cid = $_GET['id'];
 echo $obj_class->show_course("tbl_topics t inner join tbl_categories c on t.top_cat_id = c.cat_id", "t.top_status = 1 and c.cat_status =1 and c.cat_id=".$cid, "c.cat_id desc", "", array("cat_name", "top_name", "cat_id", "top_id"),"tbl_categories", "cat_status=1 and cat_id=".$cid, "topic");
?>