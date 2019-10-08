<?php 
class category extends manage{
	public $obj_name = "category";
  private $table =  "categories";
	private static $field_id;
	public $id_update;
	public $cat_name;
	public $cat_des;
	public $cat_status;
	public $user_info;
	public $act;
  private $add_file = "add_category.php";
  private $view_file = "view_cat.php";
  private $update_file = "update_category.php";
 

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
      $condition = "and c.cat_status = 1";
    }
    else $condition = "";

		if(@$_GET["add"]) $id = "c.cat_id desc";
    else if(@$_GET['name'] == "desc") $id = "c.cat_name desc";
    else if(@$_GET['date'] == "desc")$id = "c.cat_date_create desc";
    else if(@isset($_GET['update'])){$id ="c.cat_id desc" ;$color = COL_OVER; }//$condition = "c.cat_id =".$_GET["update"];
    else  $id = "c.cat_id asc";
		  $data = $this->query($this->select_table("$this->table c inner join tbl_users u on c.cat_user_id=u.user_id","c.cat_user_id=$this->user_info $condition", $id, "" ));
      $i=1;
        while($row=mysql_fetch_array($data)){
          $color = $i %2 == 0 ? COL_ODD:COL_EVERT;
				echo "<tr bgcolor='".$color."'>";
				  echo "<td><input type='checkbox' name='chdel[]' value=".$row['cat_id']." /></td>";
					echo "<td>$i</td>";
					echo "<td><a href='?obj=$this->obj_name&act=do_edit&iden=".$row['cat_id']."'>".$row['cat_name']."</a></td>";				
					echo "<td>".$this->record_Dolookup("u.user_username", "tbl_users u inner join tbl_posts p on u.user_id = p.post_user_id","u.user_id=".$row["cat_user_id"])."</td>";
					echo "<td align='center'>";
					echo $row['cat_status']==1?"<a class='enabled' href='?obj=$this->obj_name&act=do_status&iden=".$row['cat_id']."&status=".$row['cat_status']." '></a>":"<a class='disabled' href='?obj=$this->obj_name&act=do_status&iden=".$row['cat_id']."&status=".$row['cat_status']." '></a>";
					echo "</td>";
          echo "<td>".$row['cat_date_create']."</td>";
          echo "<td>".$row['cat_id']."</td>";
					echo "<td>";
						echo "<a class='edit' href='?obj=$this->obj_name&act=do_edit&iden=".$row['cat_id']."'></a>";
						//echo "<a class='delete' onclick='comfirm(\"Are you sure?\")' href='?obj=$this->obj_name&act=do_delete&iden=".$row['cat_id']."'></a>";
            echo "<a class='delete' onclick=\"javascript: return confirm('Are you sure?')\" href='?obj=$this->obj_name&act=do_delete&iden=".$row['cat_id']."'></a>";
					echo "</td>";
				echo "</tr>";
				$i++;
		}				  
	}
	function set_info(){
		$this->cat_name = $this->varlidatestring($_POST["catname"]);
		$this->cat_des = $this->varlidatestring($_POST["catdes"]);
		$this->cat_status = $this->varlidatestring($_POST["status"]);		
	}
  function set_update(){
		if(isset($_POST["id_edit"]) || isset($_POST["btnapply"])){    
      $this->id_update = $this->varlidatestring($_POST["id_edit"]);
      $this->set_info();
    }
   else  $this->id_update  = self::$field_id;
  }
  function insert_record(){
    $this->insert_into($this->table, array("cat_name"=>$this->cat_name, "cat_des"=>$this->cat_des, "cat_user_id"=>$this->user_info, "cat_status"=>$this->cat_status));
		self::$field_id = mysql_insert_id();
    return true;
  }
	function do_save(){
	 $this->set_info();
   if(isset($_POST["apply"])){
      if($this->cat_name != ""){
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
        $this->update_table($this->table, array("cat_name"=>$this->cat_name, "cat_des"=>$this->cat_des, "cat_user_id"=>$this->user_info, "cat_status"=>$this->cat_status), "cat_id = $this->id_update");
        Message::concatSuccess("Successful for edit"); 
        $this->redirectUrl("?obj=$this->obj_name&act=do_view&update=".$this->id_update);
     }
     else if(isset ($_POST["btnapply"])){
          $this->set_update();
          $this->update_table($this->table, array("cat_name"=>$this->cat_name, "cat_des"=>$this->cat_des, "cat_user_id"=>$this->user_info, "cat_status"=>$this->cat_status), "cat_id = $this->id_update");                           
          $this->redirectUrl("?obj=$this->obj_name&act=do_edit&iden=".$this->id_update."&update=1");        
	   }
     else if(isset($_GET["iden"])){
       $id =(isset($_GET["iden"]))?$this->varlidatestring($_GET["iden"]):self::$field_id;
       $valueedit = $this->query($this->select_table($this->table, "cat_id =".$id,"cat_id asc", "limit 1" ));
       if(mysql_num_rows($valueedit) > 0){
        while($row = mysql_fetch_array($valueedit)){
          $this->cat_name = $row["cat_name"];
          $this->cat_des = $row["cat_des"];
          $this->cat_status = $row["cat_status"];
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
          $this->delete($this->table, "cat_id = $id limit 1");
        }$this->redirectUrl("?obj=$this->obj_name&act=do_view&delete=1");
      }else {
        $this->redirectUrl("?obj=$this->obj_name&act=do_view&delete=2");
      }
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
		$this->status($this->table, array("cat_status"=>$status), "cat_id = $idedit");
		$this->redirectUrl("?obj=$this->obj_name&act=do_view");
	}
 }
?>