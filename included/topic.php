<?php
if(@$_GET['id'] != ""){
 $condition = "t.top_id=".$_GET['id'];
 $conditioncat = ""; // "and top_cat_id=".$_GET['id'];
}
 else {
   $condition = "q.que_top_id=".@$_GET['cat_id'];
   $conditioncat = "";
 }
 echo $obj_class->show_course("tbl_questions q inner join tbl_topics t on t.top_id = q.que_top_id", "t.top_status = 1 and q.que_status = 1 and ".$condition, "t.top_id desc", "", array("top_name", "que_text", "top_id", "que_id"),"tbl_topics", "top_status=1 ".$conditioncat, "question");
?>