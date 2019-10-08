<?php

include_once("db_action.php");

class functions extends Db_action {

    function assignaction() {
        if (isset($_GET["obj"]) && trim($_GET['act']) != "") {
            $obj = trim(@($_GET['obj']));
            $act = mysql_real_escape_string(trim(@($_GET['act'])));
            $obj_file_name = "includes/" . $_GET["obj"] . ".php";
            if (!empty($obj) && $obj != "home" && file_exists($obj_file_name)) {
                include_once($obj_file_name);
                $bad_message = "";
            } elseif (empty($obj) || $obj == "home") {
                include_once("included/front_page.php");
                $obj = "front";
                $act = "save";
                $bad_message = "";
            } else {
                include_once("included/front_page.php");
                $obj = "front";
                $act = "save";
                $bad_message = "<p><div class='err_alert_container en err alert' style='margin-left:20px'>Unable to load OBJECT...</div></p>";
            }
            if (class_exists($obj)) {
                //	echo $bad_message;
                $this->action(new $obj($_SESSION['username'], ""), $act);
            }
        }//end condition of get page first
    }

    function action($object, $act) {
        $this->action = trim($_REQUEST['act']);
        $object->$act();
    }

    function menu_cat($table, $field, $condition, $orderby, $limit) {
        $result = $this->query($this->select_table($table, $condition, $orderby, $limit));
        $value = "";
        if ($this->numRows($result) > 0) {
            $value .= "<ul>";
            while ($row = $this->fetchAssoc($result)) {
                $id = $field[0];
                $title = $field[1];
                $num_topic = $this->record_Dolookup("count(*) as total", "tbl_topics t inner join tbl_categories c on c.cat_id = t.top_cat_id", "t.top_cat_id=" . $row[$id], "");
                $value .="<li><a href='?page=category&id=" . $row[$id] . "' title='' >" . $row[$title] . "(<font style='font-size:12px'>" . $num_topic . "</font>)" . "</a></li>";
            }
            $value .= "</ul>";
        }
        return $value;
    }

    function menu_left($table, $field, $condition, $orderby, $limit, $linkto) { //echo $this->select_table($table, $condition, $orderby, $limit);
        $result = $this->query($this->select_table($table, $condition, $orderby, $limit));
        $value = "";
        if ($this->numRows($result) > 0) {
            $value .= "<ul>";
            while ($row = $this->fetchAssoc($result)) {
                $id = $field[0];
                $title = $field[1];
                $page = mysql_real_escape_string(@$_GET['page']);
                $current = (@$_GET['id'] == $row[$id] && $page == $linkto) ? "class='current'" : "";
                $value .="<li><a href='?page=$linkto&id=" . $row[$id] . "' title='" . $row[$title] . "' $current>" . $row[$title] . "</a></li>";
            }
            $value .= "</ul>";
        }
        return $value;
    }

    function show_course($table, $condition, $orderby, $limit, $field, $table_cate, $conditioncate, $field_message) {
        $div = ''; // echo $this->select_table($table, $condition, $orderby, $limit)."<br/>";echo $this->select_table($table_cate, $conditioncate, $field[2]." desc", "");
        $topic = $this->query($this->select_table($table, $condition, $orderby, $limit));
        $cat = $this->query($this->select_table($table_cate, $conditioncate, $field[2] . " desc", ""));
        if ($rowcat = $this->fetchAssoc($cat)) {
            $div .="<div><h4 style='color:blue; font-weight:bold'>" . $rowcat[$field[0]] . "</h4></div>";
            if ($this->numRows($topic) > 0) {
                while ($row = $this->fetchAssoc($topic)) {
                    $id = $row[$field[3]];
                    $div .="<div class='topic'><h5 class='black'><a href='?page=$field_message&$field[2]=$id'>" . $row[$field[1]] . "</a></h5></div>";
                }
            } else
                $div .="<h5>Not have " . $field_message . " yet !</h5>";
        }
        return $div;
    }

    function signup($table, $data, $condition, $message) {
        if (isset($_POST['signup'])) {
            if ($this->validate_email($condition[4]) != "") {
                Message::concatWarning($message[3]);
                Message::raiseWarning();
            } else if (strcasecmp($condition[0], $condition[1]) == 0) {
                $id = $this->insert_into($table, $data);
                Message::concatSuccess($message[0]);
                Message::raiseSuccess();
                return $id;
            } else if ($condition[2] == "" || $condition[3] == "" || $condition[0] == "") {
                Message::concatError($message[2]);
                Message::raiseError();
            } else {
                Message::concatWarning($message[1]);
                Message::raiseWarning();
            }
        }
    }

    function user_login($field, $table_name, $condition) {
        $sql = $this->query($this->select_table($table_name, $condition, $field[0] . " desc", "limit 1"));
        $row = mysql_num_rows($sql);
        //when usre name and password is correct
        while ($rows = $this->fetchAssoc($sql)) {
            $_SESSION['id'] = $rows[$field[0]];
            echo $rows[$field[0]];
            $_SESSION['username'] = $rows[$field[1]];
            //add security to database
            $log_date = (string) (date("Y-m-d G:i:s"));
            return true;
        }
    }

    function validate_email($email) {
        $result = $this->record_Dolookup("user_email", "tbl_users", "user_email='" . $email . "'");
        return $result;
    }

    function redirectUrl($direction) {
        header("Location:$direction");
    }

    function select_responuser($feild, $feild_inner, $table) {

        if (@$_GET['status'] == "status") {
            $condition = "and t." . $feild[2] . " = 1";
        } else
            $condition = "t." . $feild[5] . "=" . $_SESSION['id'];
        if (@$_GET["add"])
            $id = "t." . $feild[1] . " desc";
        else if (@$_GET['name'] == "desc")
            $id = "t." . $feild[0] . " desc";
        else if (@$_GET['date'] == "desc")
            $id = "t." . $feild[3] . " desc";
        else if (@$_GET['update'] == "desc")
            $id = "t." . $feild[0] . " desc";
        else if (@($_GET['fsearch'] != "") && @($_GET['vsearch'] != "")) {
            $condition = "t." . $feild[5] . "=" . $_SESSION['id'] . "and t." . $feild[4] . "=" . $this->varlidatestring($_GET['vsearch']);
            $id = "t." . $feild[1] . " asc";
        } else
            $id = "t." . $feild[1] . " asc";

        $data = $this->query($this->select_table($table, "$condition", $id, ""));
        //echo $this->select_table($table,$condition, $id, "" );

        $i = 1;
        array("top_name", "top_id", "top_status", "top_created", "top_cat_id", "top_user_id", "topic");
        array("tbl_categories", "tbl_topics", "cat_name", "cat_id", "cat_status");

        array("que_text", "que_id", "que_status", "que_create_date", "que_top_id", "que_user_id", "question");
        array("tbl_topics", "tbl_questions", "top_name", "top_id", "top_status");

        array("post_text", "post_id", "post_status", "post_create_date", "post_que_id", "post_user_id", "post");
        array("tbl_questions", "tbl_posts", "post_text", "post_id", "post_status");


        if ($this->numRows($data) > 0) {

            while ($row = mysql_fetch_array($data)) {
                $Field = "c." . $feild_inner[2];
                $Table = $feild_inner[0] . " c inner join $feild_inner[1] t on '" . $row[$feild[4]] . "' = c." . $feild_inner[3];
                $Condition = "t." . $feild[2] . " =1 and c." . $feild_inner[4] . "=1";
                //echo "SELECT distinct $Field FROM $Table WHERE $Condition";
                $color = $i % 2 == 0 ? COL_ODD : COL_EVERT;
                echo "<tr bgcolor='" . $color . "'>";
                echo "<td>$i</td>";
                echo "<td><a href='?obj=" . $feild[6] . "&act=do_edit&iden=" . $row[$feild[1]] . "'>" . $this->sub_string($row[$feild[0]], 0, 40) . "</a></td>";
                echo "<td>" . $row['user_fname'] . " " . $row['user_lname'] . "</td>";
                echo "<td>" . $this->record_Dolookup("c." . $feild_inner[2], $feild_inner[0] . " c inner join $feild_inner[1] t on '" . $row[$feild[4]] . "' = c." . $feild_inner[3], "t." . $feild[2] . " =1 and c." . $feild_inner[4] . "=1") . "</td>";
                echo $feild[6] == "topic" ? "<td>" . $this->record_Dolookup("tt.tag_name", "tbl_tag tt inner join tbl_topics t on '" . $row['top_tag'] . "' = tt.tag_id", "t." . $feild[2] . " =1 and tt.tag_status=1") . "</td>" : "<td></td>";
                echo "<td align='center'>";
                echo $row[$feild[2]] == 1 ? "<a class='enabled' href='?obj=" . $feild[6] . "&act=do_status&iden=" . $row[$feild[1]] . "&status=" . $row[$feild[2]] . " '></a>" : "<a class='disabled' href='?obj=" . $feild[6] . "&act=do_status&iden=" . $row[$feild[1]] . "&status=" . $row[$feild[2]] . " '></a>";
                echo "</td>";
                echo "<td>" . $row[$feild[3]] . "</td>";
                echo "<td>" . $row[$feild[1]] . "</td>";
                echo "<td>";
                echo "<a class='edit' href='?obj=topic&act=do_edit&iden=" . $row[$feild[1]] . "'></a>";
                echo "<a class='delete' onclick=\"javascript: return confirm('Are you sure?')\" href='?obj=" . $feild[6] . "&act=do_delete&iden=" . $row[$feild[1]] . "'></a>";
                echo "</td>";
                echo "</tr>";
                $i++;
            }
        } else {
            echo "<tr><td colspan='10'><span style='color:red;font-size:20px'>No Record !</span></td></tr>";
        }
    }

    function selectoption($select_name, $table, $condition, $orderby, $limit, $field, $filedselected, $onlclick) { // $sql = array($field, $table, $condition);
        $result = $this->query($this->select_table($table, $condition, $orderby, $limit));
        $option = "";
        if ($this->numRows($result) > 0) {
            $select = "selected";
            $option .="<select name='" . $select_name . "' $onlclick>";
            $option .="<option value='0' $filedselected ==''?$select:''><--Choose--></option>";
            while ($row = $this->fetchAssoc($result)) {
                $selected = ($filedselected == $row[$field[0]]) ? $select : "";
                $option .="<option value='" . $row[$field[0]] . "' $selected >" . $row[$field[1]] . "</option>";
            }
        }
        $option .="</select>";
        return $option;
    }

    function show_question($limit) {
        if (isset($_GET['top_id']))
            $condition = "q.que_id=" . $_GET['top_id'] . " group by q.que_id";
        else if (isset($_GET["page"]) == "logout" || @$_GET["page"] == "") {
            $condition = "q.que_id <>0 group by q.que_id";
        } else if (mysql_real_escape_string(@$_GET["page"]) == 'question') {
            $condition = "q.que_id=" . $_GET["id"] . " group by q.que_id";
        } else
            $condition = "q.que_id=" . $_GET["id"] . " group by q.que_id";

        $table = "tbl_questions q inner join tbl_topics t on q.que_top_id = t.top_id inner join tbl_users u on q.que_user_id = u.user_id left join tbl_posts p on p.post_que_id = q.que_id";
        $orderby = "t.top_id desc";
        $query = "select *,count(post_id) as count_reply from " . $table . " where " . $condition . " " . $limit;

        $que = $this->query($query);
        //$que = $this->query($this->select_table($table, $condition, $orderby, $limit));//echo $this->select_table($table, $condition, $orderby, $limit);
        if ($this->numRows($que) > 0) {
            return $que;
        }
    }

    function show_answer($condition, $orderby, $limit) {
        $table = "tbl_questions q inner join tbl_topics t on q.que_top_id = t.top_id
    inner join tbl_posts p on p.post_que_id = q.que_id inner join tbl_users u on p.post_user_id = u.user_id";
        $an = $this->query($this->select_table($table, $condition, $orderby, $limit));
        if ($this->numRows($an) > 0) {
            $result = "";
            $result .='<table class="tbl_recent_topic" width="100%" border="0" style="border-collapse:collapse; text-align:left;">';
            $que = $this->show_question('limit 1');
            while ($row = $this->fetchAssoc($que)) {
                $topictitle = $row["top_name"];
                $datequse = $row["que_create_date"];
                $questiontitile = $row["que_text"];
                $username = $row["user_username"];
                $image = $row["image"];
                $images = "photo/thumb/" . $row["user_id"] . "_" . $image;
                $result .='<tr><td><h5 style="color:blue">' . $topictitle . '  (<span class="small">1 views</span>)</h5></td></tr>';
                $result .="<td style='padding-right:0px'><img src='$images' width='35px' height='34px' />" . "</td>";
                $result .='<td>' . $questiontitile . '</td></tr>';
                $result .="<tr style='border-bottom:1px solid #ccc;'><td align='right'><span class='small'>Started by $username ,$datequse</span></td>";
                $result .="</tr>";
            }
            $result .="<tr><td><h5 style='color:blue'>Answer</h5></td></tr>";
            while ($row1 = $this->fetchAssoc($an)) {
                $topictitle = $row1["top_name"];
                $datequse = $row1["que_create_date"];
                $questiontitile = $row1["que_text"];
                $answer = $row1["post_text"];
                $username = $row1["user_username"];
                $useremail = explode("@", $row1["email_reply"]);
                $image = $row1["image"];
                $images = "photo/thumb/" . $row1["user_id"] . "_" . $image;
                $dateanswer = $row1["post_create_date"];
                $result .="<tr>";
                $result .="<td><img src='$images' /></td>";
                $result .="<td style='float:left;'>$answer</td></tr>";
                $result .="<tr><td><td align='right'><span class='small'>Started by $useremail[0].$username ,$dateanswer</span></td></tr>";
            }
        } else {
            $que = $this->show_question('limit 1');
            while ($row = $this->fetchAssoc($que)) {
                echo "<h5>" . $row["que_text"] . "</h5>";
            }
            $result = "Not have answer yet !";
        }
        $result .="</table>";
        return $result;
    }

}

?>