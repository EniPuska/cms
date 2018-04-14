<div class="col-md-4">

    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <form action="search.php" method="post">
            <div class="input-group">
                <input name = "search" type="text"  class="form-control">
                <span class="input-group-btn">
                    <button name="submit" class="btn btn-default" type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                </button>
                </span>
            </div>
        </form><!--search form -->
    </div>    
            <!-- Login -->
        
            <?php if(isset($_SESSION['user_role'])): ?>
            
            <?php else: ?>
            <div class="well">
                <h4>Login</h4>
                <form action="includes/login.php" method="post">
                    <div class="form-group">
                        <input name = "user_name" type="text"  placeholder= "Enter Username" class="form-control">
                    </div>
                    <div class="input-group">
                        <input name = "user_password" type="password"  placeholder= "Enter Password" class="form-control">
                        <span class="input-group-btn">
                            <button class="btn btn-primary" name="login" type="submit"><span>Submit</span></button>                   
                        </span>
                    </div>
                </form><!--login form -->
                </div>
            <?php endif; ?>
        <!-- /.input-group -->
    

    <!-- Blog Categories Well -->
    <div class="well">
      <?php selectSidebarCategories(); ?>
               
            </div>
            <!-- /.col-lg-6 -->

        <!-- /.row -->
    </div>
</div>
    <!-- Side Widget Well -->
    <?php
      include "widget.php";
     ?>

</div>
