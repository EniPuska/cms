<?php include "delete_modal.php";?>
<?php bulkAllOptions();?>

<form action="" method='post'>
    <div class="post_table">
    <table class="table table-bordered table-hover">
        <div id="bulkOptionContainer" class="col-xs-4">
            <select class="form-control" name="bulk_options" id="">
                <option value="">Select Option</option>
                <option value="published">Publish</option>
                <option value="draft">Draft</option>
                <option value="delete">Delete</option>
                 <option value="clone">Clone</option>
            </select>
        </div>
        <div class="col-xs-4">
            <input type="submit" name="submit" class="btn btn-success" value="Apply">
            <a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>
        </div>
        
      <thead>
        <tr>
            <th><input id="selectAllBoxes" type="checkbox"></th>  
            <th>Id</th>
            <th>User</td>
            <th>Title</th>
            <th>Category</th>
            <th>Status</th>
            <th>Image</th>
            <th>Tags</th>
            <th>Comments</th>
            <th>Date</th>
            <th>Post Count</th>
            <th>View Post</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>  
      </thead>
        <tbody>   
          <?php viewAllPosts(); ?>       
      </tbody>
    </table>
    </div>    
</form>    
<?php deletePosts(); ?>
<?php resetPostViews(); ?>

