
<?php

if (isset($_GET['top_id'])) {
    $id = @$_GET['top_id'];
} else
    $id = @$obj_class->clearString($_GET["id"]);
 if(mysql_real_escape_string($_GET['page'] == 'question' && $obj_class->clearString(@$_GET['id']) != '')){
    $count_view = $obj_class->record_Dolookup('que_count_view','tbl_questions', 'que_id = '.  mysql_real_escape_string($_GET['id']));
    $obj_class->update_table('tbl_questions', array('que_count_view' => $count_view + 1), 'que_id = '.  mysql_real_escape_string($_GET['id']));
 }
echo $obj_class->show_answer("q.que_id=$id and p.post_status=1", "p.post_create_date desc", "");
if (isset($_GET["post"]) == "reply")
    $obj_class->redirectUrl("index.php?page=question&id=$id");
if (isset($_POST["close"])) {
    $id = (isset($_GET["id"]) ? @$_GET["id"] : @$_GET["top_id"]);
    $obj_class->insert_into("tbl_posts", array("post_text" => $_POST["description"], "post_que_id" => $id, "post_user_id" => 2, "email_reply" => $_POST["email"], "post_status" => 1));
}
//include_once("answer.php");
?>
<section id="main" class="column">
    <form action="index.php?page=question&id=<?php echo $id; ?>&post=reply" id="admin_form" method="post">
        <input type="hidden" name="submitsave" />
        <article class="module width_full">
            <header><h3>Replay Your Answer
                    <div class="submit_link" style="margin-top:-4px;padding:0px; width:147px;">			
                        <input type="submit" value="Reply" class="alt_btn" name="close">
                        <input type="reset" class="alt_btn" value="Reset" name="Reset">
                    </div>
                </h3>
            </header>
            <div class="module_content">
                <fieldset>
                    <label for="catname">Your Email</label>
                    <input type="text" id="catname" name="email" class="required" >
                </fieldset>
                <fieldset>
                    <label>Description</label>
                    <textarea rows="12" name="description"></textarea>
                </fieldset>

            </div>
            <footer>
                <div class="submit_link" style="width:147px;">
                    <input type="submit" value="Reply" class="alt_btn" name="close">
                    <input type="reset" class="alt_btn" value="Reset" name="Reset">
                </div>
            </footer>
        </article>
    </form>
</section>
