<table class="table table-bordered table-hover">
  <thead>
    <tr>
      <td>Id</td>
      <td>Username</td>
      <td>First Name</td>
      <td>Last Name</td>
      <td>Email</td>
      <td>Image</td>
      <td>Role</td> 
      <td>Edit</td>
      <td>Admin</td>
      <td>Subscriber</td>
      <td>Delete</td>
    </tr>  
  </thead>
    <tbody>   
      <?php viewAllUsers(); ?>       
  </tbody>
</table>
<?php deleteUser(); ?>

<?php changeToAdminAndSub(); ?>









