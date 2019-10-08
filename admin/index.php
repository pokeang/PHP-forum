<?php
session_start();
include_once("controller/login.php");
$login_obj = new login();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8" />
	<title>4Forum</title>
	<link rel="stylesheet" href="css/layout.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="css/me.css" type="text/css" media="screen" />
	<!--[if lt IE 9]>
	<link rel="stylesheet" href="css/ie.css" type="text/css" media="screen" />
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<script src="js/jquery-1.5.2.min.js" type="text/javascript"></script>
	<script src="js/hideshow.js" type="text/javascript"></script>
	<script src="js/jquery.tablesorter.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/jquery.equalHeight.js"></script>
    <script type="text/javascript" src="js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="js/scripts.js"></script>
	 <link rel="stylesheet" href="css/screen.css" type="text/css" media="screen" title="default" />
    <script type="text/javascript">
    $(function(){
        $('.column').equalHeight();
    });
</script>
<!--Login style-->
   <script src="js/jquery/jquery.pngFix.pack.js" type="text/javascript"></script>
    <script type="text/javascript">
    $(document).ready(function(){
    $(document).pngFix( );
    });
    </script>
<!--End login-->
   <script src="js/jsfunction.js" type="text/javascript"></script>
</head>
<body>
 <?php 
  $session_user = $login_obj->session_user;
	$login_status = true;// $user_info = array();
	function __autoload($class_name){
		$page = "controller/".strtolower($class_name).".php"; //echo $page;die();
		if(file_exists($page)){
			require_once($page);
		}
	}
	if(@$_GET["obj"] == "logout"){
	  unset($_SESSION[$_SESSION[$session_user]]);	  
	  session_destroy();
	  echo "<script type='text/javascript'>location.href='?logout';</script>";
	}   
	if(isset($_POST["loginsubmit"])){
		$user=$_POST['txt_user']; 
		$pwd=$_POST['txt_pwd']; 
		$condition="user_username='".mysql_real_escape_string($user)."' AND user_password='".md5(mysql_real_escape_string($pwd))."' AND user_status=1 AND user_role=1";
		$_SESSION['condition'] = $condition;
		$login_status=$login_obj->user_Login("tbl_users", "user_id",$condition,$session_user,$login_obj->encrypt_decrypt_key); //echo $login_status;die();
		
		if($login_status){ 
			$_SESSION["userid"] = $login_obj->record_Dolookup("user_id", "tbl_users", $condition); 
		} 
  }
	if($login_obj->is_Login(@$_SESSION[$session_user],"tbl_users","user_id", @$_SESSION['condition'], $login_obj->encrypt_decrypt_key)){
		$user_info=mysql_fetch_assoc(mysql_query($login_obj->select_table("tbl_users",$_SESSION['condition'],"user_id asc","limit 1")));
		 $obj = new manage($user_info);
     
	}
	else if(isset($_GET["obj"]) == "forgot_pwd" && $login_obj->is_Login($_SESSION[$session_user],"user_id")==false){
		//$login_obj = new forgot_pwd();
	}	
	else 
	{	
		$login_obj->login_form($login_status);
	}
		
	
 ?>
</body>
</html>