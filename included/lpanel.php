<div class="home-page main">
    <aside class="grid col-one-quarter mq2-col-one-third mq3-col-full blog-sidebar">			
<!--        <div class="widget">
            <input id="search" type="search" name="search" value="Type and hit enter to search" >
        </div>-->

        <div class="widget" style="margin-top:15px;">
            <h2>Popular Topics</h2>
            <?php
            $field = array("top_id", "top_name");
            echo $obj_class->menu_left("tbl_topics tt inner join tbl_tag t on tt.top_tag = t.tag_id", $field, "tt.top_status = 1 and t.tag_status = 1 group by top_name", "tt.top_created desc", "limit 0,8", "topic");
            ?>
        </div>

        <div class="widget">
            <h2>Popular Questions</h2>
            <?php
            $field = array("que_id", "que_text");
            echo $obj_class->menu_left("tbl_questions", $field, "que_status = 1", "que_create_date desc", "limit 0,10", "question");
            ?>

        </div>

        <div class="widget">
            <h2>Categories</h2>
            <?php
            $field = array("cat_id", "cat_name");
            echo $obj_class->menu_cat("tbl_categories", $field, "cat_status = 1", "cat_date_create desc", "limit 0,10", "category");
            ?>

        </div>		
    </aside>
</div>