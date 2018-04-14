<?php
	createPost();
	
?>

<form action="" method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label for="title">Post Title</label>
		<input type="text" name="post_title" class="form-control">
	</div>	
        <label for="category">Category:</label> 
        <div class="form-group">
            <select name="post_category" id="">
                <?php selectCategories();?>
            </select>
        </div>
            <label for="category">Author:</label> 
	 <div class="form-group">
            <select name="post_user" id="">
                <?php selectUsers();?>
            </select>
        </div>
        <label for="post_status">Post Status:</label> 
	<div class="form-group">
            <select name="post_status" id="">
                <option value ="draft">Post Status</option>
                <option value ="published">Published</option>
                <option value ="draft">Draft</option>
            </select>
	</div>
	<div class="form-group">
		<label for="post_image">Post Image</label>
		<input type="file" name="image">
	</div>
	<div class="form-group">
		<label for="post_tags">Post Tags</label>
		<input type="text" name="post_tags" class="form-control">
	</div>
	<div class="form-group">
		<label for="post_content">Post Content</label>
		<textarea class="form-control" name="post_content" id="" cols="30" rows="10"></textarea>
	</div>
	<div class="form-group">
		<input type="submit" name="create_post" class="btn btn-primary" value="Publish Post">
	</div>

</form>