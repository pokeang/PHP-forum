<?php

include_once "initialize.php";

class Db_action extends database {
    function clearString($data) {
        return mysql_real_escape_string($data);
    }
    function record_Dolookup($Field, $Table, $Condition) {
        $F = "";
        $result = mysql_query("SELECT distinct $Field FROM $Table WHERE $Condition");
        if (mysql_affected_rows() > 0) {
            $row = mysql_fetch_row($result);
            $F = stripslashes(stripcslashes($row[0]));
        } else {
            $F = "";
        }
        return $F;
    }

//end fun record 	

    function select_table($table, $condition, $orderby, $limit) {
        $sql = "SELECT distinct * FROM $table WHERE " . $condition . " ORDER BY " . $orderby . " " . $limit;
        //echo $sql;
        return $sql;
    }
 
    function insert_into($table, $data) {
        foreach ($data as $key => $value) {
            $keys[] = $key;
            $values[] = "'" . $value . "'";
        }
        $key = implode(",", $keys);
        $value = implode(",", $values);
        $sql = mysql_query("Insert Into $table($key) Values ($value)") or die(mysql_error());
        $sql = mysql_insert_id();
        return $sql;
    }

    function update_table($table, $data, $condition) {
        $items = array();
        foreach ($data as $key => $value) {
            $items[] = $key . " = '" . $value . "'";
        }
        $values = implode(' , ', $items);

        $sql = mysql_query("update $table set $values where $condition") or die(mysql_error());

        return $sql;
    }

    function delete($table, $condition) {
        $sql = mysql_query("DELETE FROM $table where $condition");
        return $sql;
    }

    function status($table, $data, $condition) {
        $this->update_table($table, $data, $condition);
        return true;
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
                $option .="<option value='" . $row[$field[0]] . "' $selected >" . $this->sub_string($row[$field[1]], 0, 30) . "</option>";
            }
        }
        $option .="</select>";
        return $option;
    }

    function path_folder($path) {
        return include_once($path);
    }

    function varlidatestring($string) {
        return mysql_real_escape_string(trim($string));
    }

    function redirectUrl($direction) {
        header("Location:$direction");
    }

    function sub_string($string, $start, $length) {
        return substr($string, $start, $length);
    }

    /* ------------------------- thumb nail image --------------------------------------- */

    function moveFile($tmpName, $name, $img_sub_extension, $getId) {

        $error = TRUE;
        if ($img_sub_extension == 'jpg' || $img_sub_extension == 'jpeg') {
            $uploadedfile = $tmpName;
            $src = imagecreatefromjpeg($uploadedfile);
        } else if ($img_sub_extension == 'png') {
            $uploadedfile = $tmpName;
            $src = imagecreatefrompng($uploadedfile);
        } else if ($img_sub_extension == 'gif') {
            $uploadedfile = $tmpName;
            $src = imagecreatefromgif($uploadedfile);
        } else {
            $error = FALSE;
        }

        list($width, $height) = getimagesize($uploadedfile);
        //resize image
        $newwidth = 68;
        $newheight = ($height / $width) * $newwidth;
        $tmp = imagecreatetruecolor($newwidth, $newheight);

        imagecopyresampled($tmp, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
        $filename = "photo/thumb/" . $getId . '_' . $name;
        imagejpeg($tmp, $filename, 68);
        move_uploaded_file($tmpName, 'photo/' . $getId . '_' . $name);
        imagedestroy($src);
        imagedestroy($tmp);

        if ($error == FALSE) {
            echo '<p style="color:red">Error upload file</p>';
        } else {
            //echo '<p style="color:blue">Successful upload!</p>';
        }
    }

}

?>