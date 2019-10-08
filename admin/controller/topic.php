<?php
class topic extends manage{
	public $obj_name = "topic";
	private $table =  "topics";
	private static $field_id;
	public $id_update;
	public $top_name;
	public $top_des;
	public $top_tag;
	public $top_cat_id;
	public $top_user_id;
	public $user_status;
	public $act;
	private $add_file = "add_topic.php";
	private $view_file = "topic.php";
	private $update_file = "update_topic.php";

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
    if($this->varlidatestring(@$_GET['status']) == "status"){
      $condition = "and t.top_status = 1";
    }
    else $condition = "top_id <> 0";;
		if(@$_GET["add"]) $id = "t.top_id desc";
    else if(@$_GET['name'] == "desc") $id = "t.top_name desc";
    else if(@$_GET['date'] == "desc")$id = "t.top_created desc";
    else if(@$_GET['update'] == "desc")$id = "t.top_id desc";
    else if(@($_GET['fsearch'] != "") && @($_GET['vsearch'] != "")){ 
      $condition = "and t.top_cat_id=".$this->varlidatestring($_GET['vsearch']);
      $id = "t.top_id asc";
    }
    else  {$id = "t.top_id asc"; $condition = "t.top_id <> 0";}
		  $data = $this->query($this->select_table("$this->table t inner join tbl_users as u on t.top_user_id=u.user_id",
              "$condition", $id, "" ));
      $i=1; 
      if($this->numRows($data) > 0){
        while($row=mysql_fetch_array($data)){
          $color = $i %2 == 0 ? COL_ODD:COL_EVERT;
            echo "<tr bgcolor='".$color."'>";
              echo "<td><input type='checkbox' name='chdel[]' value=".$row['top_id']." /></td>";
              echo "<td>$i</td>";
              echo "<td><a href='?obj=$this->obj_name&act=do_edit&iden=".$row['top_id']."'>".$row['top_name']."</a></td>";
              echo "<td>".$this->record_Dolookup("u.user_username", "tbl_users u inner join $this->table t on '".$row['top_user_id']."' = u.user_id",$row["top_user_id"] <> 0)."</td>";
              echo "<td>".$this->record_Dolookup("c.cat_name", "tbl_categories c inner join $this->table t on '".$row['top_cat_id']."' = c.cat_id", "t.top_status =1 and c.cat_status=1")."</td>";
              echo "<td>".$this->record_Dolookup("tt.tag_name", "tbl_tag tt inner join $this->table t on '".$row['top_tag']."' = tt.tag_id", "t.top_status =1 and tt.tag_status=1")."</td>";
              echo "<td align='center'>";
              echo $row['top_status']==1?"<a class='enabled' href='?obj=$this->obj_name&act=do_status&iden=".$row['top_id']."&status=".$row['top_status']." '></a>":"<a class='disabled' href='?obj=$this->obj_name&act=do_status&iden=".$row['top_id']."&status=".$row['top_status']." '></a>";
              echo "</td>";
              echo "<td>".$row['top_created']."</td>";
              echo "<td>".$row['top_id']."</td>";
              echo "<td>";
                echo "<a class='edit' href='?obj=$this->obj_name&act=do_edit&iden=".$row['top_id']."'></a>";              
                echo "<a class='delete' onclick=\"javascript: return confirm('Are you sure?')\" href='?obj=$this->obj_name&act=do_delete&iden=".$row['top_id']."'></a>";
              echo "</td>";
            echo "</tr>";
            $i++;
		  }
   }else{
      echo "<tr><td><span style='color:red;font-size:20px'>No Record !</span></td></tr>";
   }
	}
	function set_info(){
		$this->top_name = $this->varlidatestring($_POST["topname"]);
		$this->top_des = $this->varlidatestring($_POST["topdes"]);
		$this->top_status = $this->varlidatestring($_POST["status"]);
    $this->top_cat_id = $_POST["cat_dropdown"];
    $this->top_tag = $_POST["tag_dropdown"];
	}
  function set_update(){
		if(isset($_POST["id_edit"]) || isset($_POST["btnapply"])){
      $this->id_update = $this->varlidatestring($_POST["id_edit"]);
      $this->set_info();
    }
   else  $this->id_update  = self::$field_id;
  }
  function insert_record(){
    $this->insert_into($this->table, array("top_name"=>$this->top_name, "top_des"=>$this->top_des,"top_tag"=>$this->top_tag, "top_user_id"=>$this->user_info, "top_cat_id"=>$this->top_cat_id, "top_status"=>$this->top_status));
		self::$field_id = mysql_insert_id();
    return true;
  }
	function do_save(){
	 $this->set_info();
   if(isset($_POST["apply"])){
      if($this->top_name != ""){
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
	   if(isset($_POST["updatebtn"])){ $this->set_update();
        $this->update_table($this->table, array("top_name"=>$this->top_name, "top_des"=>$this->top_des,"top_tag"=>$this->top_tag, "top_user_id"=>$this->user_info, "top_cat_id"=>$this->top_cat_id, "top_status"=>$this->top_status), "top_id = $this->id_update");
        Message::concatSuccess("Successful for edit");
        $this->redirectUrl("?obj=$this->obj_name&act=do_view&update=1");
     }
     else if(isset ($_POST["btnapply"])){
          $this->set_update();
          $this->update_table($this->table, array("top_name"=>$this->top_name, "top_des"=>$this->top_des,"top_tag"=>$this->top_tag, "top_user_id"=>$this->user_info, "top_cat_id"=>$this->top_cat_id, "top_status"=>$this->top_status), "top_id = $this->id_update");
          $this->redirectUrl("?obj=$this->obj_name&act=do_edit&iden=".$this->id_update."&update=1");
	   }
     else if(isset($_GET["iden"])){
       $id =(isset($_GET["iden"]))?$this->varlidatestring($_GET["iden"]):self::$field_id;
       $valueedit = $this->query($this->select_table($this->table, "top_id =".$id,"top_id asc", "limit 1" ));
       if(mysql_num_rows($valueedit) > 0){
        while($row = mysql_fetch_array($valueedit)){
          $this->top_name = $row["top_name"];
          $this->top_des = $row["top_des"];
          $this->top_status = $row["top_status"];
          $this->top_cat_id = $row["top_cat_id"];
          $this->top_tag = $row["top_tag"];
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
          $this->delete($this->table, "top_id = $id limit 1");

        }$this->redirectUrl("?obj=$this->obj_name&act=do_view&delete=1");
      }else {        
        $this->redirectUrl("?obj=$this->obj_name&act=do_view&delete=2");
      }
      }
      else if(isset($_POST["cat_filter"])){
        echo "have";die();
      }
      else {
      $id = $this->varlidatestring($_GET["iden"]);
      $this->delete($this->table, "top_id = $id limit 1");
      $this->redirectUrl("?obj=$this->obj_name&act=do_view&delete=1");
     }
	}
	function do_status(){
		$idedit = $this->varlidatestring($_GET["iden"]);
		$statusid = $this->varlidatestring($_GET["status"]);
		$status = ($statusid==1)?0:1;
		$this->status($this->table, array("top_status"=>$status), "top_id = $idedit");
		$this->redirectUrl("?obj=$this->obj_name&act=do_view");
	}
 }
?>