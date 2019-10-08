<?php
class user extends manage{
	public $obj_name = "user";
	private $table =  "users";
	private static $field_id;
	public $id_update;
	public $user_username;
	public $user_email;
	public $user_fname;
	public $user_lname;
	public $user_password;
  public $user_newpassword;
  public $user_rold;
	public $user_status;
	public $act;
	private $add_file = "add_user.php";
	private $view_file = "user.php";
	private $update_file = "update_user.php";
	private $prefix_field = "user_";

	function __construct($user_info){	
		$this->user_info = $_SESSION["userid"];
		$this->table = TABLE_PREFIX.$this->table;
	}
	function do_view(){
    if(@$_GET["delete"] == 1){
       Message::concatSuccess("Successful for Delete");
    }else if(@$_GET["delete"] == 2){
      Message::concatWarning("Please Select checkbox !");
    }else if(@$_GET["update"]){
       Message::concatSuccess("Successful for Edit");
    }else if(@$_GET["add"]){
       Message::concatSuccess("Successful for Add New");
    }      
     $this->path_folder(VIEWFOLDER.DS.$this->obj_name.DS.$this->view_file);
	}
	function do_add(){
    $this->path_folder(VIEWFOLDER.DS.$this->obj_name.DS.$this->add_file);//view/category/add_category.php
	}
	function record_list(){
    if($this->varlidatestring(@$_GET['status']) == "status")
      $condition = "and $this->prefix_field"."status = 1";
    else if($this->varlidatestring(@$_GET['user']) == "all")
      $condition = "$this->prefix_field"."id <> 1";
    else if($this->varlidatestring(@$_GET['user']) == "single")
      $condition = "$this->prefix_field"."id = ".$_SESSION["userid"];
    else $condition = $this->prefix_field."id != 1";
		if(@$_GET["add"]) $id = $this->prefix_field."id desc";
    else if(@$_GET['name'] == "desc") $id = $this->prefix_field."username desc";
    else if(@$_GET['update'] == "desc")$id = $this->prefix_field."id desc";   
    else  $id = $this->prefix_field."id asc";
		  $data = $this->query($this->select_table("$this->table", "$condition", $id, "" ));
      $i=1; 
      if($this->numRows($data) > 0){
        while($row=mysql_fetch_array($data)){
          $color = $i %2 == 0 ? COL_ODD:COL_EVERT;
            echo "<tr bgcolor='".$color."'>";
              echo "<td><input type='checkbox' name='chdel[]' value=".$row[$this->prefix_field.'id']." /></td>";
              echo "<td>$i</td>";
              echo "<td><a href='?obj=$this->obj_name&act=do_edit&iden=".$row[$this->prefix_field.'id']."'>".$row['user_fname']." ".$row['user_lname']."</a></td>";
              echo "<td>".$row[$this->prefix_field.'email']."</td>";
						  echo "<td>".$row[$this->prefix_field.'role']."</td>";
							echo "<td align='center'>";
              echo $row[$this->prefix_field.'status']==1?"<a class='enabled' href='?obj=$this->obj_name&act=do_status&iden=".$row[$this->prefix_field.'id']."&status=".$row[$this->prefix_field.'status']." '></a>":"<a class='disabled' href='?obj=$this->obj_name&act=do_status&iden=".$row[$this->prefix_field.'id']."&status=".$row[$this->prefix_field.'status']." '></a>";
              echo "</td>";
              echo "<td>".$row[$this->prefix_field.'id']."</td>";
              echo "<td>";
                echo "<a class='edit' href='?obj=$this->obj_name&act=do_edit&iden=".$row[$this->prefix_field.'id']."'></a>";              
                echo "<a class='delete' onclick=\"javascript: return confirm('Are you sure?')\" href='?obj=$this->obj_name&act=do_delete&iden=".$row[$this->prefix_field.'id']."'></a>";
              echo "</td>";
            echo "</tr>";
            $i++;
		  }
   }else{
      echo "<tr><td><span style='color:red;font-size:20px'>No Record !</span></td></tr>";
   }
	}
	function set_info(){
		$this->user_username = $this->varlidatestring($_POST["username"]);
		$this->user_email = $this->varlidatestring($_POST["useremail"]);
		$this->user_fname = $this->varlidatestring($_POST["fname"]);
		$this->user_lname = $this->varlidatestring($_POST["lname"]);
		$this->user_password = $this->varlidatestring($_POST["password"]);
    $this->newpassword = $this->varlidatestring($_POST["newpassword"]);
		$this->user_rold = $_POST["userrule"];
    $this->user_status = $_POST["active"];
	}
  function set_update(){
		if(isset($_POST["id_edit"]) || isset($_POST["btnapply"])){
      $this->id_update = $this->varlidatestring($_POST["id_edit"]);
      $this->set_info();
      if($this->newpassword == "" ){
        $this->user_password = $this->user_password;
      }else $this->user_password = $this->newpassword;
      
    }
   else  $this->id_update  = self::$field_id;
  }
  function insert_record(){
    $this->insert_into($this->table, array($this->prefix_field."username"=>$this->user_username, $this->prefix_field."email"=>$this->user_email, $this->prefix_field."fname"=>$this->user_fname, $this->prefix_field."lname"=>$this->user_lname, $this->prefix_field."password"=>$this->user_password, $this->prefix_field."role"=>$this->user_role, $this->prefix_field."status"=>$this->user_status));
		self::$field_id = mysql_insert_id();
    return true;
  }
	function do_save(){
	 $this->set_info();
   if(isset($_POST["apply"])){
      if($this->user_username != ""){
        $this->insert_record();
        $this->redirectUrl("?obj=$this->obj_name&act=do_edit&iden=".self::$field_id);
      }
	 }else if(isset($_POST["submitnew"])) {
      $this->insert_record();
			$this->redirectUrl("?obj=$this->obj_name&act=do_add");
   }else if(isset($_POST["close"])){
      $this->insert_record();
       $this->redirectUrl("?obj=$this->obj_name&act=do_view&add=".self::$field_id);
   }
	}
  function do_edit(){
	   if(isset($_POST["close"])){
        $this->set_update();
        $this->update_table($this->table, array($this->prefix_field."username"=>$this->user_username, $this->prefix_field."email"=>$this->user_email, $this->prefix_field."fname"=>$this->user_fname, $this->prefix_field."lname"=>$this->user_lname, $this->prefix_field."password"=>$this->user_password, $this->prefix_field."role"=>$this->user_role, $this->prefix_field."status"=>$this->user_status), $this->prefix_field."id = $this->id_update");
        Message::concatSuccess("Successful for edit");
        $this->redirectUrl("?obj=$this->obj_name&act=do_view&update=1");
     }
     else if(isset ($_POST["btnapply"])){
          $this->set_update();
          $this->update_table($this->table, array($this->prefix_field."username"=>$this->user_username, $this->prefix_field."email"=>$this->user_email, $this->prefix_field."fname"=>$this->user_fname, $this->prefix_field."lname"=>$this->user_lname, $this->prefix_field."password"=>$this->user_password, $this->prefix_field."role"=>$this->user_role, $this->prefix_field."status"=>$this->user_status), $this->prefix_field."id = $this->id_update");
          $this->redirectUrl("?obj=$this->obj_name&act=do_edit&iden=".$this->id_update."&update=1");
	   }
     else if(isset($_GET["iden"])){
       $id =(isset($_GET["iden"]))?$this->varlidatestring($_GET["iden"]):self::$field_id;
       $valueedit = $this->query($this->select_table($this->table, $this->prefix_field."id =".$id, $this->prefix_field."id asc", "limit 1" ));
       if(mysql_num_rows($valueedit) > 0){
        while($row = mysql_fetch_array($valueedit)){
					$this->user_username = $row[$this->prefix_field.'username'];
					$this->user_email = $row[$this->prefix_field."email"];
					$this->user_fname = $row[$this->prefix_field."fname"];
					$this->user_lname = $row[$this->prefix_field."lname"];
					$this->user_password = $row[$this->prefix_field."password"];
					$this->user_rold = $row[$this->prefix_field."role"];
					$this->user_status = $row[$this->prefix_field."status"];
        }
       $this->path_folder(VIEWFOLDER.DS.$this->obj_name.DS.$this->update_file);
      }
	} else {
    $this->redirectUrl("?obj=$this->obj_name&act=do_view");
  }
 }
	function do_delete(){
		if(isset($_POST["delete"])){
      if(isset($_POST["chdel"])){
        $count = $_POST["chdel"];
        for($i=0;$i<count($count);$i++){
          $id = $count[$i];
          $this->delete($this->table, $this->prefix_field."id = $id limit 1");

        }$this->redirectUrl("?obj=$this->obj_name&act=do_view&delete=1");
      }else {        
        $this->redirectUrl("?obj=$this->obj_name&act=do_view&delete=2");
      }
      }
     
      else {
      $id = $this->varlidatestring($_GET["iden"]);
      $this->delete($this->table, $this->prefix_field."id = $id limit 1");
      $this->redirectUrl("?obj=$this->obj_name&act=do_view&delete=1");
     }
	}
	function do_status(){
		$idedit = $this->varlidatestring($_GET["iden"]);
		$statusid = $this->varlidatestring($_GET["status"]);
		$status = ($statusid==1)?0:1;
		$this->status($this->table, array($this->prefix_field."status"=>$status), $this->prefix_field."id = $idedit");
		$this->redirectUrl("?obj=$this->obj_name&act=do_view");
	}
 }
?>