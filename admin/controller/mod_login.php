<?php 
include_once("main_class.php");
class mod_login extends main_class{
  public $session_user;
	public $encrypt_decrypt_key ="forum";
	function is_Login($member, $table_user ,$fieldid, $condition, $encrypt_decrypt_key){
    if($member != ""){
    $sql="SELECT $fieldid FROM $table_user  WHERE $condition";
		$r=mysql_query($sql)or die(mysql_error());
		$row=mysql_num_rows($r);
		if($row==1){
      if($member == $this->encrypt(mysql_result($r,0),$encrypt_decrypt_key)){
        return true;
      }
    }
  }
	else{unset($_SESSION[$member]);return false;}
}
	function user_Login($table_user,$fieldid,$condition,$session_user,$encrypt_decrypt_key){
		$sql="SELECT $fieldid FROM $table_user  WHERE $condition";		
		$r=mysql_query($sql)or die(mysql_error());
		$row=mysql_num_rows($r); 
		if($row==1){ //when usre name and password is correct
			$_SESSION[$session_user]=$this->encrypt(mysql_result($r,0),$encrypt_decrypt_key);     
			//add security to database
			$log_date=(string)(date("Y-m-d G:i:s"));
			return true;
		}//end if
		else{ ////when usre name and password is not correct
			return false;
		}//end else
	}
}
?>