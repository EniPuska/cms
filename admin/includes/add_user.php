<?php
	createUser();
	
?>

<form action="" method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label for="firstname">FirstName</label>
		<input type="text" name="user_firstname" class="form-control">
	</div>
        <div class="form-group">
		<label for="lastname">LastName</label>
		<input type="text" name="user_lastname" class="form-control">
	</div>
        <div class="form-group">
		<label for="post_author">UserName</label>
		<input type="text" name="user_name" class="form-control">
	</div>
        <label for="role">Role</label>
	<div class="form-group">
           
            <select name="user_role" id="">
                <option value="subscirber">Select Option</option>
                <option value="admin">Admin</option>
                <option value="subscriber">Subscriber</option>
            </select>
	</div>
	
	<div class="form-group">
		<label for="post_status">Email</label>
		<input type="email" name="user_email" class="form-control">
	</div>
	<!--<div class="form-group">
		<label for="post_image">Post Image</label>
		<input type="file" name="image">
	</div>-->
	<div class="form-group">
		<label for="post_tags">Password</label>
		<input type="password" name="user_password" class="form-control">
	</div>
	<div class="form-group">
		<input type="submit" name="create_user" class="btn btn-primary" value="Add User">
	</div>

</form>