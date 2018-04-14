 <?php
    function confirm($result){
        global $connection;
        if(!$result){
                die("QUERY FAILED.". mysqli_error($connection));
        }
    }
    function redirect($location){
        return header("Location: $location");
    }
    function searchEngine(){
        global $connection;
         if(isset($_POST['submit'])){
            $post = $_POST['search'];
              $query = "SELECT * FROM posts WHERE post_tags LIKE '%$post%' ";
              $search_query = mysqli_query($connection, $query);
                if(!$search_query){
                  die("QUERY FAILED" . mysqli_error($connection));
                }
                $count = mysqli_num_rows($search_query);
                  if($count == 0){
                    echo "<h1>No result</h1>";
                }else{
                    while($row = mysqli_fetch_assoc($search_query)){
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = $row['post_content'];
                        ?>
                        <h1 class="page-header">
                            Page Heading
                            <small>Secondary Text</small>
                        </h1>

                        <!-- First Blog Post -->
                        <h2>
                            <a href="#"><?php echo $post_title ?></a>
                        </h2>
                        <p class="lead">
                            by <a href="index.php"><?php echo $post_author ?></a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date?></p>
                        <hr>
                        <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
                        <hr>
                        <p><?php echo $post_content ?></p>
                        <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                        <hr>
                    <?php    
                    }  
                }
            }
    }
    function selectSidebarCategories(){
        global $connection;
            $query = "SELECT * FROM categories";
            $select_categories_sidebar = mysqli_query($connection,$query);
            ?>
            <h4>Blog Categories</h4>
            <div class="row">
                <div class="col-lg-12">
                    <ul class="list-unstyled">
                    <?php
                        while($row = mysqli_fetch_assoc($select_categories_sidebar)){
                            $cat_id = $row['cat_id'];
                            $cat_title = $row['cat_title'];
                            echo "<li><a href='categories.php?category=$cat_id'>{$cat_title}</a></li>";
                    }
    }
    //display all the posts in a front page.
    function viewAllPost(){
        global $count;
        global $connection;
        global $page;
         $per_page = 5;
            if(isset($_GET['page'])){
                
              $page = $_GET['page'];  
            }else{
                $page = "";
            }
            if($page =="" || $page ==1){
                $page_1 = 0;
            }else{
                $page_1 = ($page * $per_page) - $per_page;
            }
            if(isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'){
                      $post_count = "SELECT * FROM posts";
                  }else{
                     $post_count = "SELECT * FROM posts WHERE post_status = 'published'"; 
                  }
            $find_count = mysqli_query($connection,$post_count);
            $count = mysqli_num_rows($find_count);
            if($count < 1){
                echo "<h1 class='text-center'>No post available </h1>";
            }else{
            $count = ceil($count / $per_page);
            
                $query = "SELECT * FROM posts LIMIT $page_1,$per_page ";
                $select_all_posts_query = mysqli_query($connection,$query);
                    while($row = mysqli_fetch_assoc($select_all_posts_query)){
                        $post_id = $row['post_id'];
                        $post_title = $row['post_title'];
                        $post_user = $row['post_user'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = substr($row['post_content'],0,100);
                        $post_status = $row['post_status'];
                        
                    ?>
                          <!-- First Blog Post -->
                        <h2>
                            <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title ?></a>
                        </h2>
                            <p class="lead">
                                by <a href="authors_post.php?user=<?php echo $post_user ?>&p_id=<?php echo $post_id ?>"><?php echo $post_user ?></a>
                            </p>
                            <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date?></p>
                            <hr>
                            <a href="post.php?p_id=<?php echo $post_id; ?>">
                            <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
                            </a>
                            <hr>
                            <p><?php echo $post_content ?></p>
                            <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                            <hr>
                        <?php   
                    }    
            }        
    }       
    //display a specific post from the id in the front page
    function viewSpecificPost(){
        global $connection;
        if(isset($_GET['category'])){
            $post_category_id = $_GET['category'];
            if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin'){
                      $query = "SELECT * FROM posts WHERE post_category_id = $post_category_id ";
                  }else{
                     $query = "SELECT * FROM posts WHERE post_category_id = $post_category_id AND post_status = 'published'"; 
                  }
                $select_all_posts_query = mysqli_query($connection,$query);
                    if(mysqli_num_rows($select_all_posts_query) < 1){
                        echo "<h1 class='text-center'>No category available </h1>";
                    }else{
                    while($row = mysqli_fetch_assoc($select_all_posts_query)){
                        $post_id = $row['post_id'];
                        $post_title = $row['post_title'];
                        $post_author = $row['post_user'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = substr($row['post_content'],0,100);
                        ?>
                        <h1 class="page-header">Posts</h1>
                      <!-- First Blog Post -->
                      <h2>
                          <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title ?></a>
                      </h2>
                      <p class="lead">
                          by <a href="index.php"><?php echo $post_author ?></a>
                      </p>
                      <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date?></p>
                      <hr>
                      <img class="img-responsive" src="images/<?php echo $post_image ?>" alt="">
                      <hr>
                      <p><?php echo $post_content ?></p>
                      <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                      <hr>
                    <?php  
                    }
                }    
        }else{
            header("Location: index.php");
        }            
    }
    function registerUser($user_name,$user_email,$user_password){
        global $connection;         
        $user_name = mysqli_real_escape_string($connection,$user_name);
        $user_email = mysqli_real_escape_string($connection,$user_email);
        $user_password = mysqli_real_escape_string($connection,$user_password);
        $user_password = password_hash($user_password,PASSWORD_BCRYPT,array('cost' =>12));
            $query = "INSERT INTO users(user_name,user_email,user_password,user_role)";
            $query .="VALUES ('{$user_name}','{$user_email}','{$user_password}','subscriber')";
            $register_query = mysqli_query($connection, $query);
            confirm($register_query);
    }
    function loginUsers($user_name,$user_password){
        global $connection; 
        $user_name = trim($user_name);
        $user_password = trim($user_password);
        $user_name = trim(mysqli_real_escape_string($connection,$user_name));
        $user_password = trim(mysqli_real_escape_string($connection,$user_password));
        $query = "SELECT * FROM users WHERE user_name = '{$user_name}' ";
        $select_user_query = mysqli_query($connection, $query);
        confirm($select_user_query);
            while($row = mysqli_fetch_array($select_user_query)){
                $db_id = $row['user_id'];
                $db_user_name = $row['user_name'];
                $db_password = $row['user_password'];
                $db_firstname = $row['user_firstname'];
                $db_lastname = $row['user_lastname'];
                $db_role = $row['user_role'];         
            }
            if(password_verify($user_password,$db_password)){
                $_SESSION['user_name'] = $db_user_name;
                $_SESSION['user_firstname'] = $db_firstname;
                $_SESSION['user_lastname'] = $db_lastname;
                $_SESSION['user_role'] = $db_role;
                redirect("/cms/admin");
            }else{
                redirect("/cms/index.php");
            }
    }
    function logOutUsers(){       
        $_SESSION['user_name'] = null;
        $_SESSION['user_firstname'] = null;
        $_SESSION['user_lastname'] = null;
        $_SESSION['user_role'] = null;
        header("Location: ../index.php");
    }
    function username_exist($user_name){
        global $connection;
        $query = "SELECT user_name FROM users WHERE user_name = '$user_name'";
        $result = mysqli_query($connection, $query);
        confirm($result);
        if(mysqli_num_rows($result) > 0){
            return true;
        }else{
            return false;
        }
    }
    function email_exist($user_email){
        global $connection;
        $query = "SELECT user_email FROM users WHERE user_email = '$user_email'";
        $result = mysqli_query($connection, $query);
        confirm($result);
        if(mysqli_num_rows($result) > 0){
            return true;
        }else{
            return false;
        }
    }

    
    
    
    