<?php
    function confirm($result){
            global $connection;
            if(!$result){
                    die("QUERY FAILED.". mysqli_error($connection));
            }
    }
    function insert_categories(){
            global $connection;
            if(isset($_POST['submit'])){
            $cat_title = $_POST['cat_title'];
                if($cat_title =="" || empty($cat_title)){
                    echo "This field should not be empty";
                }else{
                    $query = "INSERT INTO categories(cat_title)";
                    $query .="VALUES('{$cat_title}')";
                    $create_category_query = mysqli_query($connection,$query);
                            if(!$create_category_query){
                                      die("QUERY FAILED" . mysqli_error());
                            }
                }
            }
    }
    function findAllCategories(){
            global $connection;
                $query = "SELECT * FROM categories";
            $select_categories = mysqli_query($connection,$query);
                while($row = mysqli_fetch_assoc($select_categories)){
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];
                echo "<tr>";
                echo "<td>{$cat_id}</td>";
                echo "<td>{$cat_title}</td>";
                echo "<td class = 'BTN_edit'><a class = 'btn btn-primary' href='categories.php?edit={$cat_id}'>
                          <i class='fa fa-pencil-square-o' aria-hidden='true'></i> Edit</a></td>";
                echo "<td class = 'BTN_delete'><a class = 'btn btn-danger ' href='categories.php?delete={$cat_id}'>
                         <i class='fa fa-trash-o' aria-hidden='true'></i> Delete</a></td>";

                echo "</tr>";
                }
    }
    function deleteCategories(){
            global $connection;
            //Delete query
                if(isset($_GET['delete'])){
                $the_cat_id = $_GET['delete'];
                  $query  = "DELETE FROM categories WHERE cat_id = {$the_cat_id} ";
                  $delete_query = mysqli_query($connection,$query);
                  header("Location:categories.php");
                }
    }
    function createPost(){
            global $connection;

            if(isset($_POST['create_post'])){
            $post_title = $_POST['post_title'];
            $post_category_id = $_POST['post_category'];
            $post_user = $_POST['post_user'];
            $post_status = $_POST['post_status'];
            $post_image = $_FILES['image']['name'];
            $post_image_temp = $_FILES['image']['tmp_name'];
            $post_tags = $_POST['post_tags'];
            $post_content = $_POST['post_content'];
            $post_date = date('d-m-y');
            move_uploaded_file($post_image_temp,"../images/$post_image");
                $query = "INSERT INTO posts(post_category_id,post_title,post_user,post_date,
                                                          post_image,post_content,post_tags,post_status)";
                $query .= "VALUES({$post_category_id},'{$post_title}', '{$post_user}',
                                   now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_status}' ) ";

                $create_post_query = mysqli_query($connection,$query);	
                confirm($create_post_query);
                $the_post_id= mysqli_insert_id($connection);
                echo "<p class='bg-success'>Post Created . <a href = '../post.php?p_id={$the_post_id}'>View Post</a> or <a href='posts.php'>Edit More post</a></p>";
            }
    }
    function selectUsers(){
            global $connection;
            
                $query = "SELECT * FROM users";
                $select_users = mysqli_query($connection,$query);
                confirm($select_users);
                    while($row = mysqli_fetch_assoc($select_users)){
                      $user_id = $row['user_id'];
                      $user_name = $row['user_name'];
                      echo "<option selected value = '$user_name'>{$user_name}</option>";
                    }  

    }
    
    function viewAllPosts(){
            global $connection;
            $query = "SELECT * FROM posts ORDER BY post_id DESC ";
            $select_posts = mysqli_query($connection,$query);
            while($row = mysqli_fetch_assoc($select_posts)){
                $post_id = $row['post_id'];
                $post_author = $row['post_author'];
                $post_user = $row['post_user'];
                $post_title = $row['post_title'];
                $post_category_id = $row['post_category_id'];
                $post_status = $row['post_status'];
                $post_image = $row['post_image'];
                $post_tags = $row['post_tags'];
                $post_comment_count = $row['post_comment_count'];
                $post_date = $row['post_date'];
                $post_views_count = $row['post_views_count'];
                  echo "<tr>";
                  echo "<td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='$post_id'></td>";
                  echo "<td>$post_id</td>";
                  if( !empty($post_author)){
                    echo "<td>$post_author</td>";
                  }elseif(!empty($post_user)){
                      echo "<td>$post_user</td>";
                  }
                  
                  echo "<td>$post_title</td>";

                  $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id} ";
                    $select_categories_id = mysqli_query($connection,$query);
                      while($row = mysqli_fetch_assoc($select_categories_id)){
                        $cat_id = $row['cat_id'];
                        $cat_title = $row['cat_title'];
                  echo "<td>{$cat_title}</td>";
                      }
                      
                  echo "<td>$post_status</td>";
                  echo "<td><img width='100' src='../images/$post_image' alt='image'></td>";
                  echo "<td>$post_tags</td>";
                  $query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
                  $send_query_count = mysqli_query($connection, $query);
                  $row = mysqli_fetch_array($send_query_count);
                  $comment_id = $row['comment_id'];
                  $post_comment_count = mysqli_num_rows($send_query_count);
                  echo "<td><a href='post_comments.php?id=$post_id'>$post_comment_count</a></td>";
                  echo "<td>$post_date</td>";
                  
                  echo "<td><a href='posts.php?reset={$post_id}'>$post_views_count</a></td>";
                  echo "<td class='BTN_view'><a class='btn btn-primary' href='../post.php?p_id={$post_id}'>
                            <i class='fa fa-eye' aria-hidden='true'></i> View Post</a></td>";
                  echo "<td class='BTN_edit'><a class='btn btn-primary' href='posts.php?source=edit_post&p_id={$post_id}'>
                            <i class='fa fa-pencil-square-o' aria-hidden='true'></i>Edit</a></td>";
                  echo "<td class = 'BTN_delete'><a rel='$post_id'class = 'btn btn-danger delete_link' href='javascript:void(0)'>
                            <i class='fa fa-trash-o' aria-hidden='true'></i> Delete</a></td>";
                  echo "</tr>";
            }
    }

    function deletePosts(){
        global $connection;
            if(isset($_GET['delete'])){
                $the_post_id = $_GET['delete'];
                $query = "DELETE FROM posts WHERE post_id = {$the_post_id} ";
                $delete_query = mysqli_query($connection,$query);
                header("Location:posts.php");
            } 
    }
    function resetPostViews(){
        global $connection;
        if(isset($_GET['reset'])){
                $the_post_id = $_GET['reset'];
                $query = "UPDATE posts SET post_views_count = 0 WHERE post_id=$the_post_id";
                $reset_query = mysqli_query($connection,$query);
                header("Location:posts.php");
            }
    }
    /*
     * this function select all the comment table from the database and display it
     * in the admin page.
     */
    function viewAllComments(){
            global $connection;
            $query = "SELECT * FROM comments";
            $select_comments = mysqli_query($connection,$query);
              while($row = mysqli_fetch_assoc($select_comments)){
                $comment_id = $row['comment_id'];
                $comment_post_id = $row['comment_post_id'];
                $comment_author = $row['comment_author'];
                $comment_content = $row['comment_content'];
                $comment_email = $row['comment_email'];
                $comment_status = $row['comment_status'];
                $comment_date = $row['comment_date'];
                
                echo "<tr>";
                echo "<td>$comment_id</td>";
                echo "<td>$comment_author</td>";
                echo "<td>$comment_content</td>";
                echo "<td>$comment_email</td>";
                echo "<td>$comment_status</td>";
                $query = "SELECT * FROM posts WHERE post_id = $comment_post_id ";
                $select_post_id_query = mysqli_query($connection,$query);
                  while($row = mysqli_fetch_assoc($select_post_id_query)){
                      $post_id = $row['post_id'];
                      $post_title = $row['post_title'];
                      echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";

                  }

                echo "<td>$comment_date</td>";
                echo "<td class='BTN_edit'><a class='btn btn-success' href='comments.php?approve={$comment_id}'>
                          <i class='fa fa-check' aria-hidden='true'></i></i>Approve</a></td>";
                echo "<td class = 'BTN_delete'><a class = 'btn btn-danger' href='comments.php?unapprove={$comment_id}'>
                          <i class='fa fa-ban' aria-hidden='true'></i> Unapprove</a></td>";
                echo "<td class = 'BTN_delete'><a class = 'btn btn-danger' href='comments.php?delete={$comment_id}'>
                          <i class='fa fa-trash-o' aria-hidden='true'></i> Delete</a></td>";
                echo "</tr>";

              }
    }
    /*
     *This function activated when we click to comment from a specific post.
     * It opens a new page where we can see all the comments from this specific post.
     */
    function viewCountComments(){
            global $connection;
            $query = "SELECT * FROM comments WHERE comment_post_id =" . mysqli_real_escape_string($connection,$_GET['id']). " ";
            $select_comments = mysqli_query($connection,$query);
              while($row = mysqli_fetch_assoc($select_comments)){
                $comment_id = $row['comment_id'];
                $comment_post_id = $row['comment_post_id'];
                $comment_author = $row['comment_author'];
                $comment_content = $row['comment_content'];
                $comment_email = $row['comment_email'];
                $comment_status = $row['comment_status'];
                $comment_date = $row['comment_date'];
                
                echo "<tr>";
                echo "<td>$comment_id</td>";
                echo "<td>$comment_author</td>";
                echo "<td>$comment_content</td>";
                echo "<td>$comment_email</td>";
                echo "<td>$comment_status</td>";
                $query = "SELECT * FROM posts WHERE post_id = $comment_post_id ";
                $select_post_id_query = mysqli_query($connection,$query);
                  while($row = mysqli_fetch_assoc($select_post_id_query)){
                      $post_id = $row['post_id'];
                      $post_title = $row['post_title'];
                      echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";

                  }

                echo "<td>$comment_date</td>";
                echo "<td class='BTN_edit'><a class='btn btn-success' href='post_comments.php?approve=$comment_id&id=".$_GET['id']."'>
                          <i class='fa fa-check' aria-hidden='true'></i></i>Approve</a></td>";
                echo "<td class = 'BTN_delete'><a class = 'btn btn-danger' href='post_comments.php?unapprove=$comment_id&id=".$_GET['id']."'>
                          <i class='fa fa-ban' aria-hidden='true'></i> Unapprove</a></td>";
                echo "<td class = 'BTN_delete'><a class = 'btn btn-danger' href='post_comments.php?delete=$comment_id&id=".$_GET['id']."'>
                          <i class='fa fa-trash-o' aria-hidden='true'></i> Delete</a></td>";
                echo "</tr>";

              }
    }
    /*
     * Delete a specific comment which we are selecting to delete.
     * it makes also a refresh automatically to the page and to the database.
     */
    function deleteComments(){
        global $connection;
            if(isset($_GET['delete'])){
                $the_comment_id = $_GET['delete'];
                $query = "DELETE FROM comments WHERE comment_id = {$the_comment_id} ";
                $delete_query = mysqli_query($connection,$query);
                header("Location:comments.php");
            } 
    }
    function deleteCountComments(){
        global $connection;
            if(isset($_GET['delete'])){
                $the_comment_id = $_GET['delete'];
                $query = "DELETE FROM comments WHERE comment_id = {$the_comment_id} ";
                $delete_query = mysqli_query($connection,$query);
                header("Location:post_comments.php?id=".$_GET['id']."");
            } 
    }
    function viewAllUsers(){
            global $connection;
            $query = "SELECT * FROM users";
            $select_users = mysqli_query($connection,$query);
              while($row = mysqli_fetch_assoc($select_users)){
                $user_id = $row['user_id'];
                $user_name = $row['user_name'];
                $user_password = $row['user_password'];
                $user_firstname = $row['user_firstname'];
                $user_lastname = $row['user_lastname'];
                $user_email = $row['user_email'];
                $user_image = $row['user_image'];
                $user_role = $row['user_role'];
                
                echo "<tr>";
                echo "<td>$user_id</td>";
                echo "<td>$user_name</td>";
                echo "<td>$user_firstname</td>";
                echo "<td>$user_lastname</td>";
                echo "<td>$user_email</td>";
                echo "<td>$user_image</td>";
                echo "<td>$user_role</td>";
                echo "<td class='BTN_edit'><a class='btn btn-primary' href='users.php?source=edit_user&edit_user={$user_id}'>
                        <i class='fa fa-pencil-square-o' aria-hidden='true' ></i>Edit</a></td>";
                echo "<td class='BTN_edit'><a class='btn btn-primary' href='users.php?change_to_admin={$user_id}'>
                        <i class='fa fa-pencil-square-o' aria-hidden='true'></i>Admin</a></td>";
                echo "<td class='BTN_edit'><a class='btn btn-primary' href='users.php?change_to_sub={$user_id}'>
                        <i class='fa fa-pencil-square-o' aria-hidden='true'></i>Subscriber</a></td>";
                echo "<td class = 'BTN_delete'><a class = 'btn btn-danger' href='users.php?delete={$user_id}'>
                          <i class='fa fa-trash-o' aria-hidden='true'></i> Delete</a></td>";
                echo "</tr>";

              }
    }
    function createUser(){
            global $connection;

            if(isset($_POST['create_user'])){
                $user_name = $_POST['user_name'];
                $user_password = $_POST['user_password'];
                $user_firstname = $_POST['user_firstname'];
                $user_lastname = $_POST['user_lastname'];
                $user_role = $_POST['user_role'];
               /* $post_image = $_FILES['image']['name'];
                $post_image_temp = $_FILES['image']['tmp_name'];*/
                $user_email = $_POST['user_email'];
                $user_password = password_hash($user_password,PASSWORD_BCRYPT,array('cost' =>12));
                $query = "INSERT INTO users(user_firstname,user_lastname,user_role,
                                            user_name,user_email,user_password)";
                $query .= "VALUES('{$user_firstname}', '{$user_lastname}',
                                  '{$user_role}','{$user_name}','{$user_email}','{$user_password}' ) ";

                $create_user_query = mysqli_query($connection,$query);	
                confirm($create_user_query);
                echo "User Created" . " " . "<a href = 'users.php'>View Users </a> ";
            }
    }
    function deleteUser(){
        global $connection;
            if(isset($_GET['delete'])){
                if(isset($_SESSION['user_role'])){
                    if($_SESSION['user_role'] =='admin'){
                        $the_user_id = mysqli_real_escape_string($connection,$_GET['delete']);
                        $query = "DELETE FROM users WHERE user_id = {$the_user_id} ";
                        $delete_query = mysqli_query($connection,$query);
                        header("Location:users.php");
                    }
                }            
            } 
    }
    function changeToAdminAndSub(){
        global $connection;
         if(isset($_GET['change_to_admin'])){
                $admin_user_id = $_GET['change_to_admin'];
                $query = "UPDATE users SET user_role = 'admin' WHERE user_id = $admin_user_id ";
                $change_admin_query = mysqli_query($connection,$query);
                header("Location:users.php");
            }
        if(isset($_GET['change_to_sub'])){
                $sub_user_id = $_GET['change_to_sub'];
                $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = $sub_user_id ";
                $change_admin_query = mysqli_query($connection,$query);
                header("Location:users.php");
            }    
    }
    function bulkAllOptions(){
        global $connection;
        if(isset($_POST['checkBoxArray'])){
        $chkBox = $_POST['checkBoxArray'];
            foreach($chkBox as $postValueId){
             $bulk_options = $_POST['bulk_options'];
                switch($bulk_options){
                    case 'published':
                        $query = "UPDATE posts SET post_status = '$bulk_options' WHERE post_id = $postValueId ";
                        $updateToPublished = mysqli_query($connection, $query);
                        break;
                    case 'draft':
                        $query = "UPDATE posts SET post_status = '$bulk_options' WHERE post_id = $postValueId ";
                        $updateToDraft = mysqli_query($connection, $query);
                        break;
                    case 'delete':
                        $query = "DELETE FROM posts WHERE post_id = $postValueId";
                        $deleteBulk = mysqli_query($connection, $query);
                        break;
                    case 'clone':
                        $query = "SELECT * FROM posts WHERE post_id = '{$postValueId}'";
                        $select_post_query = mysqli_query($connection, $query);
                        while ($row = mysqli_fetch_array($select_post_query)){
                            $post_title = $row['post_title'];
                            $post_category_id = $row['post_category_id'];
                            $post_date = $row['post_date'];
                            $post_user = $row['post_user'];                            
                            $post_status = $row['post_status'];
                            $post_image = $row['post_image'];
                            $post_tags = $row['post_tags'];
                            $post_content = $row['post_content'];         
                        }
                        $query = "INSERT INTO posts(post_category_id, post_title, post_date, post_user, post_status, post_image, post_tags, post_content)";
                        $query .="VALUES({$post_category_id},'{$post_title}',now(),'{$post_user}','{$post_status}','{$post_image}','{$post_tags}','{$post_content}')";
                        $insert_values = mysqli_query($connection, $query);
                            if(!$insert_values){
                                die("QUERY FAILED" . mysqli_error($connection));
                            }
                        break;    
                }
            } 
        }
    }

    function usersOnline(){
        if(isset($_GET['onlineusers'])){
            global $connection;
            if(!$connection){
                session_start();
                include("../includes/db.php");
                $session = session_id();
                $time = time();
                $time_out_in_seconds = 05;
                $time_out = $time - $time_out_in_seconds;
                $query = "SELECT * FROM users_online WHERE session = '$session'";
                $send_query = mysqli_query($connection,$query);
                $count = mysqli_num_rows($send_query);
                    if($count == NULL){
                        mysqli_query($connection,"INSERT INTO users_online(session,time) VALUES('$session','$time')");
                    }else{
                         mysqli_query($connection,"UPDATE users_online SET time = '$time' WHERE session = '$session'");                   
                    }
                        $users_online = mysqli_query($connection,"SELECT * FROM users_online WHERE time > '$time_out'");
                        echo $count_users = mysqli_num_rows($users_online);
            }

        }
    }
    usersOnline();
    function is_admin($username){
        global $connection;
        $query = "SELECT user_role FROM users WHERE user_name = '$username'";
        $result = mysqli_query($connection, $query);
        confirm($result);
        $row = mysqli_fetch_array($result);
        if($row['user_role'] == 'admin'){
            return true;
        }else{
            return false;
        }
    }
    
       
?>
