<?php
	class database{
		public $cn;    
		function __construct(){ 
			$this->openMySQLConnection();
		}
		public function openMySQLConnection(){ 
			
			$this->cn = mysql_connect(SERVER_NAME,USER_NAME,PASSWORD);
			//$this->cn = mysql_connect("localhot","root","");
			if(!$this->cn){
				die(mysql_error());	
			}else{
				$this->selectDB();	
			}
		}
		public function selectDB(){
			if(!mysql_select_db(DATABASE_NAME, $this->cn)){
				die(mysql_error());	
			}
		}		
		public function numRows($result){
			return mysql_num_rows($result);	
		}
		public function fetchObject($result){
			return mysql_fetch_object($result);	
		}
		public function fetchArray($result){
			return mysql_fetch_array($result);
   
		}
		public function fetchAssoc($result){
			return mysql_fetch_assoc($result);	
		}
		public function fetchRow($result){
			return mysql_fetch_row($result);	
		}
		public function insertedId(){
			return mysql_insert_id();	
		}
		public function query($sql){
			$result = mysql_query($sql);
			if(!$result){
				Message::concatError("Executed SQL statement failed. Last SQL statement: $sql
				<br />. MySQL said: " . mysql_error());	
			}
			return $result;
		}

	}
?>