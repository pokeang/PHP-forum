<?php

    $id = isset($_SESSION["id"])?$_SESSION["id"]:0;
	$query=mysql_query("select * from tbl_users where user_id=$id limit 1");
	$userInfo=mysql_fetch_assoc($query);
?>
<section class="grid col-three-quarters mq2-col-two-thirds mq3-col-full">
			
			<h3>Your Profile</h3>
            <table>
            	<tr>
                	<td>First Name:</td>
                    <td><?php echo $userInfo['user_fname']; ?></td>
                </tr>
                <tr>
                	<td>Last Name:</td>
                    <td><?php echo $userInfo['user_lname']; ?></td>
                </tr>
                <tr>
                	<td>Email:</td>
                    <td><?php echo $userInfo['user_email']; ?></td>
                </tr>
            </table>
            	
	</section>