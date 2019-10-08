<?php
class post extends manage{
	public $obj_name = "post";
  private $table =  "posts";
	public static $field_id;
	public $id_update;
	public $post_text;
  public $post_que_id;
	public $post_status;
  private $add_file = "add_post.php";
  private $view_file = "view_post.php";
  private $update_file = "update_post.php";
  private $prefix_field = "post_";

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
      $condition = "and q.".$this->prefix_field."status = 1";
    }
    else $condition = "q.post_user_id > 0";
		if(@$_GET["add"]) $id = "q.".$this->prefix_field."id desc";
    else if(@$_GET['name'] == "desc") $id = "q.".$this->prefix_field."text desc";
    else if(@$_GET['date'] == "desc")$id = "q.".$this->prefix_field ."create_date desc";
    else if(@$_GET['update'] == "desc")$id = "q.".$this->prefix_field."id desc";
    else  {$id = "q.".$this->prefix_field."id asc";$condition = "q.".$this->prefix_field."id > 0";}
		  $data = $this->query($this->select_table("$this->table q inner join tbl_users as u on q.".$this->prefix_field."user_id=u.user_id", "$condition", $id, "" ));
      $i=1;   //  echo $this->select_table("$this->table q inner join tbl_users as u on q.".$this->prefix_field."user_id=u.user_id", "$condition", $id, "" );
      if($this->numRows($data) > 0){
       $Table = "tbl_questions t inner join $this->table p on p.".$this->prefix_field."que_id = t.que_id";
       $Feild = "t.que_text";
       $Condition = "p.".$this->prefix_field."status = 1 and t.que_status=1 and p.post_que_id=7";
       echo "";
        while($row=mysql_fetch_array($data)){
          $color = $i %2 == 0 ? COL_ODD:COL_EVERT;
            echo "<tr bgcolor='".$color."'>";
              echo "<td><input type='checkbox' name='chdel[]' value=".$row[$this->prefix_field.'id']." /></td>";
              echo "<td>$i</td>";
              echo "<td><a href='?obj=$this->obj_name&act=do_edit&iden=".$row[$this->prefix_field.'id']."'>".$this->sub_string($row[$this->prefix_field.'text'], 0, 30)."</a></td>";
              echo "<td>".$this->record_Dolookup("u.user_username", "tbl_users u inner join tbl_posts p on ".$row[$this->prefix_field ."user_id"]."= u.user_id","u.user_id=".$row[$this->prefix_field ."user_id"])."</td>";
              echo "<td>".$this->sub_string($this->record_Dolookup("t.que_text", "tbl_questions t inner join $this->table p on p.".$this->prefix_field."que_id = t.que_id", "p.".$this->prefix_field."status = 1 and t.que_status=1 and p.post_que_id=".$row["post_que_id"]),0,20)."</td>";
              echo "<td align='center'>";
              echo $row[$this->prefix_field .'status']==1?"<a class='enabled' href='?obj=$this->obj_name&act=do_status&iden=".$row[$this->prefix_field .'id']."&status=".$row[$this->prefix_field .'status']." '></a>":"<a class='disabled' href='?obj=$this->obj_name&act=do_status&iden=".$row[$this->prefix_field .'id']."&status=".$row[$this->prefix_field .'status']." '></a>";
              echo "</td>";
              echo "<td>".$row[$this->prefix_field .'create_date']."</td>";
              echo "<td>".$row[$this->prefix_field .'id']."</td>";
              echo "<td>";
                echo "<a class='edit' href='?obj=$this->obj_name&act=do_edit&iden=".$row[$this->prefix_field .'id']."'></a>";
                echo "<a class='delete' onclick=\"javascript: return confirm('Are you sure?')\" href='?obj=$this->obj_name&act=do_delete&iden=".$row[$this->prefix_field .'id']."'></a>";
              echo "</td>";
            echo "</tr>";
            $i++;
		  }
   }else{
      echo "<tr><td><span style='color:red;font-size:20px'>No Record !</span></td></tr>";
   }
	}
	function set_info(){
		
		$this->post_text = $this->varlidatestring($_POST["posttext"]);
		$this->post_status = $this->varlidatestring($_POST["status"]);
    $this->post_que_id = $_POST["que_dropdown"];
    
	}
  function set_update(){
		if(isset($_POST["id_edit"]) || isset($_POST["btnapply"])){
      $this->id_update = $this->varlidatestring($_POST["id_edit"]);
      $this->set_info();
    }
   else  $this->id_update  = self::$field_id;
  }
  function insert_record(){
    $this->insert_into($this->table, array($this->prefix_field."text"=>$this->post_text, $this->prefix_field."que_id"=>$this->post_que_id, $this->prefix_field."user_id"=>$this->user_info,  $this->prefix_field."status"=>$this->post_status));
		self::$field_id = mysql_insert_id();
    return true;
  }
	function do_save(){
	 $this->set_info();
   if(isset($_POST["apply"])){   
        $this->insert_record();
        $this->redirectUrl("?obj=$this->obj_name&act=do_edit&iden=".self::$field_id);
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
        $this->update_table($this->table,  array($this->prefix_field."text"=>$this->post_text, $this->prefix_field."que_id"=>$this->post_que_id, $this->prefix_field."user_id"=>$this->user_info,  $this->prefix_field."status"=>$this->post_status), $this->prefix_field."id = $this->id_update");
        Message::concatSuccess("Successful for edit");
        $this->redirectUrl("?obj=$this->obj_name&act=do_view&update=1");
     }
     else if(isset ($_POST["btnapply"])){
          $this->set_update();
          $this->update_table($this->table,  array($this->prefix_field."text"=>$this->post_text, $this->prefix_field."que_id"=>$this->post_que_id, $this->prefix_field."user_id"=>$this->user_info,  $this->prefix_field."status"=>$this->post_status), $this->prefix_field."id = $this->id_update");
          $this->redirectUrl("?obj=$this->obj_name&act=do_edit&iden=".$this->id_update."&update=1");
	   }
     else if(isset($_GET["iden"])){
       $id =(isset($_GET["iden"]))?$this->varlidatestring($_GET["iden"]):self::$field_id;
       $valueedit = $this->query($this->select_table($this->table, $this->prefix_field."id =".$id, $this->prefix_field."id asc", "limit 1" ));
       if(mysql_num_rows($valueedit) > 0){
        while($row = mysql_fetch_array($valueedit)){         
          $this->post_text = $row[$this->prefix_field."text"];
          $this->post_status = $row[$this->prefix_field."status"];
          $this->post_que_id = $row[$this->prefix_field."que_id"];
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
          $this->delete($this->table, "post_id = $id limit 1");

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
		$this->status($this->table, array($this->prefix_field."status"=>$status), $this->prefix_field."id = $idedit");
		$this->redirectUrl("?obj=$this->obj_name&act=do_view");
	}
 }
?>