<?php
include_once("main_class.php");
class manage extends main_class{
	public $user_info;
	public $valueid;
	public $action;
	function manage($user_info){ 
		$this->user_info	=	$user_info; 
		$obj	=	trim(@($_GET['obj']));
		$act	=	trim(@($_GET['act']));		
		$obj_file_name	=	"controller/".$obj	.	".php";
		include("view/header.php");
		include("view/lpanel.php");
			if	(!empty($obj)	&&	$obj	!=	"home"	&&	file_exists($obj_file_name)){			
			include_once($obj_file_name);
				$bad_message	=	"";  			
			}elseif	(empty($obj)	||	$obj	==	"home")	{
			  include_once("front.php");
				$obj	=	"front";
				$act	=	"save";
				$bad_message	=	"";
			}else	{				
				include_once("front.php");
				$obj	=	"front";
				$act	=	"save";
				$bad_message	=	"<p><div class='err_alert_container en err alert' style='margin-left:20px'>Unable to load OBJECT...</div></p>";
			} 
		if(class_exists($obj)){
		//	echo $bad_message;
			$this->action(new $obj($this->user_info,""),$act);	
			
		}else if(!isset($_GET['obj'])){
      
    }
    ////end if class_exists
		else{
			echo "<div class='form_login_record login_err en label_red' style='margin-left:0px'>Unable to load OBJECT...</div>";
		}	
	}
	function action($object, $act){
	  $this->action = trim($_REQUEST['act']);
		$object->$act();
	}
}
//end class admin_class
?>