<?php 
include("../includes/database.php");
class Db_action extends Database{
	function select_table($table, $field, $condition){
		$sql = mysql_query("select $field from $table where $condition");
		return $sql;
	}
}
?>