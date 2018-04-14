<?php include "includes/admin_header.php" ?>
<?php 
    if(isset($_SESSION['user_name'])){
        $user_name = $_SESSION['user_name'];
        $query = "SELECT * FROM users WHERE user_name = '{$user_name}' ";
        $select_user_profile = mysqli_query($connection, $query);
            while($row = mysqli_fetch_array($select_user_profile)){
                $user_id = $row['user_id'];
                $user_name = $row['user_name'];
                $user_password = $row['user_password'];
                $user_firstname = $row['user_firstname'];
                $user_lastname = $row['user_lastname'];
                $user_email = $row['user_email'];
                $user_image = $row['user_image'];
                $user_role = $row['user_role'];
            }
    }
?>
<?php 
    if(isset($_POST['edit_profile'])){           
        $user_name = $_POST['user_name'];
        $user_password = $_POST['user_password'];
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_email = $_POST['user_email'];
        $user_role = $_POST['user_role'];

        $query = "UPDATE users SET ";
        $query .= "user_name = '{$user_name}', ";
        $query .= "user_password = '{$user_password}', ";
        $query .= "user_firstname = '{$user_firstname}', ";
        $query .= "user_lastname = '{$user_lastname}', ";
        $query .= "user_email = '{$user_email}', ";
        $query .= "user_role = '{$user_role}' ";
        $query .= "WHERE user_name = '{$user_name}' ";
            $update_user = mysqli_query($connection,$query);
            confirm($update_user);

            }

?>

<div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/admin_navigation.php" ?>

        <div id="page-wrapper">

                <div class="container-fluid">

                    <!-- Page Heading -->
                        <div class="row">
                                <div class="col-lg-12">
                                    <h1 class="page-header">
                                        Welcome to Admin
                                        <small>Author</small>
                                    </h1>
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


                                            <option value="subscirber"><?php echo $user_role?></option>;


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
                                            <input type="submit" name="edit_profile" class="btn btn-primary" value="Update Profile">
                                    </div>
                                </form>    
                                </div>
                        </div>
                    <!-- /.row -->

                </div>
        <!-- /.container-fluid -->

        </div>
    <!-- /#page-wrapper -->

<?php include "includes/admin_footer.php" ?>
