
<?php	
	//call a function for selecting a post by the specific p_id
	if(isset($_GET['edit_user'])){
            $the_user_id = $_GET['edit_user'];
            $query = "SELECT * FROM users WHERE user_id = $the_user_id ";
	           $select_user_by_id = mysqli_query($connection,$query);
                while($row = mysqli_fetch_assoc($select_user_by_id)){
                    $user_id = $row['user_id'];
                    $user_name = $row['user_name'];
                    $user_password = $row['user_password'];
                    $user_firstname = $row['user_firstname'];
                    $user_lastname = $row['user_lastname'];
                    $user_email = $row['user_email'];
                    $user_role = $row['user_role'];
                }
        
            if(isset($_POST['edit_user'])){           
                $user_name = $_POST['user_name'];
                $user_password = $_POST['user_password'];
                $user_firstname = $_POST['user_firstname'];
                $user_lastname = $_POST['user_lastname'];
                $user_email = $_POST['user_email'];
                $user_role = $_POST['user_role'];
                $user_password = password_hash($user_password,PASSWORD_BCRYPT,array('cost' =>12));
                $query = "UPDATE users SET ";
                $query .= "user_name = '{$user_name}', ";
                $query .= "user_password = '{$user_password}', ";
                $query .= "user_firstname = '{$user_firstname}', ";
                $query .= "user_lastname = '{$user_lastname}', ";
                $query .= "user_email = '{$user_email}', ";
                $query .= "user_role = '{$user_role}' ";
                $query .= "WHERE user_id = {$the_user_id} ";
                    $update_user = mysqli_query($connection,$query);
                    confirm($update_user);

            }
        }        
?>
<form action="" method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label for="firstname">FirstName</label>
		<input type="text" value = "<?php echo $user_firstname; ?>" name="user_firstname" class="form-control" >
	</div>
        <div class="form-group">
		<label for="lastname">LastName</label>
		<input type="text" value = "<?php echo $user_lastname; ?>" name="user_lastname" class="form-control">
	</div>
        <div class="form-group">
		<label for="post_author">UserName</label>
		<input type="text" value="<?php echo $user_name; ?>" name="user_name" class="form-control">
	</div>
        <label for="role">Role</label>
	<div class="form-group">
           
            <select name="user_role" id="">
                <?php 
                    if($user_role == 'admin'){
                      echo "<option value='subscriber'>subscriber</option>";  
                    }else{
                        echo "<option value='admin'>admin</option>";
                    }
                ?>
                
                
                <option value="<?php echo $user_role?>"><?php echo $user_role?></option>;
               
                
            </select>
	</div>
	
	<div class="form-group">
		<label for="post_status">Email</label>
		<input type="email" value = "<?php echo $user_email; ?>" name="user_email" class="form-control">
	</div>
	<!--<div class="form-group">
		<label for="post_image">Post Image</label>
		<input type="file" name="image">
	</div>-->
	<div class="form-group">
		<label for="post_tags">Password</label>
		<input type="password" value = "<?php echo $user_password; ?>" name="user_password" class="form-control">
	</div>
	<div class="form-group">
		<input type="submit" name="edit_user" class="btn btn-primary" value="Update User">
	</div>

</form>