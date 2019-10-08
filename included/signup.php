<?php
$id = "";
if (isset($_POST["signup"]) && $_POST["signup"] != "") {
  $username = $_POST["uname"];
  $fname = $_POST["fname"];
  $lname = $_POST["lname"];
  $email = $_POST["email"];
  $data = array('user_username' => $username, 'user_email' => $email, "user_fname" => $fname, "user_lname" => $lname, "user_password" => md5($_POST["password"]), "image" => $_FILES['txtphoto']['name'], "user_role" => 0, "user_status" => 0);
  $massage = array("Successful for singup with this forum !", "Wrong with confirm Password !", "Need Input Require Field !", "Email Address Already Exit !");
  $condition = array($_POST["password"], $_POST["conpass"], $_POST["uname"], $_POST["fname"], $_POST["email"]);

  if ($_FILES["txtphoto"]["name"] != "") {
    $img_extension = substr($_FILES['txtphoto']['type'], 0, 5);
    $img_sub_extenstion = explode('/', $_FILES['txtphoto']['type']);
    $img_sub_extenstion = strtolower($img_sub_extenstion[1]);
    if ($img_extension == 'image' && $_FILES['txtphoto']["size"] < (1024 * 1024)) {

      $name = $_FILES['txtphoto']['name'];
      $size = $_FILES['txtphoto']['size'];
      $id = $obj_class->signup("tbl_users", $data, $condition, $massage);
      $obj_class->moveFile($_FILES['txtphoto']['tmp_name'], $_FILES['txtphoto']['name'], $img_sub_extenstion, $id);
      $username = "";
      $fname = "";
      $lname = "";
      $email = "";
    }
  } else {
    $id = $obj_class->signup("tbl_users", $data, $condition, $massage);
    if ($id != "") {
      $username = "";
      $fname = "";
      $lname = "";
      $email = "";
    }
  }
} else {
  $username = "";
  $fname = "";
  $lname = "";
  $email = "";
}
?>
<section class="grid col-three-quarters mq2-col-two-thirds mq3-col-full">
<?php if ($id != "") { ?>
  <h4><a href="?page=signin" style="color:red;">Login</a></h4>
<?php } ?>
  <h3>Sign Up New Account</h3>
  <form id="contact_form" class="contact_form" action="" method="post" name="contact_form" enctype="multipart/form-data">
    <ul>
      <li>
        <label for="fname"> First Name:(<span style="color:red;">*</span>)</label>
        <input type="text" name="fname" id="fname" class="required" value="<?php echo $fname; ?>">
      </li>
      <li>
        <label for="lname">Last Name:</label>
        <input type="text" name="lname" id="lname" class="required" value="<?php echo $lname; ?>" >
      </li>
      <li>
        <label for="uname"> Username:(<span style="color:red;">*</span>)</label>
        <input type="text" name="uname" id="uname" class="required" value="<?php echo $username; ?>"  >
      </li>
      <li>
        <label for="email"> Email:(<span style="color:red;">*</span>)</label>
        <input type="email" name="email" id="email" value="<?php echo $email; ?>" placeholder="JohnDoe@gmail.com" class="required email">
      </li>
      <li>
        <label for="password"> Password:(<span style="color:red;">*</span>)</label>
        <input type="password" name="password" id="password" class="required" minlength="4" >
      </li>
      <li>
        <label for="conpass"> Confirm Password:(<span style="color:red;">*</span>)</label>
        <input type="password" name="conpass" id="conpass" class="required" >
      </li>
      <li>
        <label for="password">Your Photo:</label>
        <input type="file" name="txtphoto" id="txtphoto" />
      </li>
      <li>
        <input type="submit" id="submit" name="signup" class="button fleft" value="Sent" />
        <input type="reset" name="reset" class="button fleft" value="Cancel" style="margin-left: 10px;width: 70px;"/>
      </li>
    </ul>
  </form>
</section>