<table class="table table-bordered table-hover">
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
      <?php viewAllComments(); ?>       
  </tbody>
</table>
<?php deleteComments(); ?>


<?php 
    if(isset($_GET['unapprove'])){
                $unapprove_comment_id = $_GET['unapprove'];
                $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = $unapprove_comment_id ";
                $unapprove_comment_query = mysqli_query($connection,$query);
                header("Location:comments.php");
            } 
?>

<?php 
    if(isset($_GET['approve'])){
                $approve_comment_id = $_GET['approve'];
                $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $approve_comment_id  ";
                $approve_comment_query = mysqli_query($connection,$query);
                header("Location:comments.php");
            } 
?>

