		<?php 
    if(@$_GET["page"] == "logout")
    { unset($_SESSION['username']); unset($_SESSION['id']);}
    ?>
     <ul>
				<li><a href="index.php" class="navactive">Home</a></li>
			</ul>
			<?php 
				if(@$_SESSION['username'] != ""){
			?>
       <ul>
				<li><a href="index.php?page=profile">Profile</a></li>
			</ul>			 
        <?php 
					 echo "<ul><li>";
						 echo "<h6>Hi ".$_SESSION['username']." </h6>";
						 echo "<a href='?page=logout'>Log Out</a>";
           echo "</li></ul>";
			   }
					else{
            echo "<ul><li>";
				     echo "<a href='index.php?page=signin' id='signin'>Sign In</a>";
            echo "</li>";
            echo "</ul>";
					}
					?>			
			
			<ul>
       <?php
				if(!isset($_SESSION['front_login_status'])){?>
        <li>Not yet have account?&nbsp; <a href="index.php?page=signup">Sign Up</a></li>
				<?php }
				?>
			</ul>
<?php
 if(isset($_GET["obj"]) || isset($_GET["page"]) && (isset($_SESSION['username']))){ 
    $id = $_SESSION["id"];   
?>
 <ul>
  <div style="float:left; width:100%">      
      <li>
         <a href="?obj=topic&act=do_view"><span class='left'></span><span class='middle'>Add Topic</span><span class='right'></span></a>
      </li>
      <li>
        <a class="noseperate" href="?obj=question&act=do_view"><span class='left'></span><span class='middle'>Post Question</span><span class='right'></span></a>
      </li>
      <li>
        <a class="noseperate" href="?obj=post&act=do_view"><span class='left'></span><span class='middle'>Replay Answer</span><span class='right'></span></a>
      </li>
      <li>
        <a class="noseperate" href="<?php echo '?obj=user&act=do_edit&iden='.$id; ?>" >
           <span class='left'></span><span class='middle'>Edit Profile</span><span class='right'></span>
        </a>
      </li>
  </div>
 </ul>
<?php   }?>
