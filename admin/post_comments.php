
<?php include "includes/admin_header.php" ?>

<div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/admin_navigation.php" ?>
    <?php bulkAllOptions();?>
    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
                <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">
                                Welcome to Comments
                                <small>Author</small>
                            </h1>

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
  <thead>
    <tr>
      <td>Id</td>
      <td>Author</td>
      <td>Comment</td>
      <td>Email</td>
      <td>Status</td>
      <td>In response to</td> 
      <td>Date</td>
      <td>Approve</td>
      <td>Unapprove</td>
      <td>Delete</td>
    </tr>  
  </thead>
    <tbody>   
      <?php viewCountComments(); ?>       
  </tbody>
</table>
<?php deleteCountComments(); ?>


<?php 
    if(isset($_GET['unapprove'])){
                $unapprove_comment_id = $_GET['unapprove'];
                $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = $unapprove_comment_id ";
                $unapprove_comment_query = mysqli_query($connection,$query);
                header("Location:post_comments.php?id=".$_GET['id']."");
            } 
?>

<?php 
    if(isset($_GET['approve'])){
                $approve_comment_id = $_GET['approve'];
                $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $approve_comment_id  ";
                $approve_comment_query = mysqli_query($connection,$query);
                header("Location:post_comments.php?id=".$_GET['id']."");
            } 
?>
 </div>
                        </div>
                    <!-- /.row -->

                </div>
        <!-- /.container-fluid -->

        </div>
    <!-- /#page-wrapper -->

<?php include "includes/admin_footer.php" ?>

