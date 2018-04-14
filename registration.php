<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>


    <!-- Navigation -->
<?php  include "includes/navigation.php"; ?>
<?php
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $user_name = trim($_POST['username']);
        $user_email = trim($_POST['email']);
        $user_password = trim($_POST['password']);
        $error = [
            'user_name'=>'',
            'user_email'=>'',
            'user_password'=>''
        ];
        if(strlen($user_name)<4){
            $error['user_name'] = 'Username needs to be longer';
        }
        if($user_name == ''){
            $error['user_name'] = 'Username cannot be empty';
        }
        if(username_exist($user_name)){
            $error['user_name'] = 'Username exists pick another one';
        }
        if($user_email == ''){
            $error['user_email'] = 'Email cannot be empty';
        }
        if(email_exist($user_email)){
            $error['user_email'] = 'email already exits , <a href="index.php">Please Login</a>';
        }
        if($user_password == ''){
            $error['user_password'] = 'Password cannot be empty';
        }
        foreach($error as $key=>$value){
            if(empty($value)){
                unset($error[$key]);
            }
        }
        if(empty($error)){
            registerUser($user_name, $user_email, $user_password);
            loginUsers($user_name,$user_password);
        }
    }
?>
    <!-- Page Content -->
    <div class="container">
        <section id="login">
            <div class="container">
                <div class="row">
                    <div class="col-xs-6 col-xs-offset-3">
                        <div class="form-wrap">
                        <h1>Register</h1>
                            <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">                          
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" name="username" id="username"  class="form-control" placeholder="Enter Desired Username" autocomplete="on" value="<?php echo isset($user_name) ? $user_name : '' ?>">
                                    <p><?php echo isset($error['user_name']) ? $error['user_name'] : '' ?></p>
                                </div>
                                
                                 <div class="form-group">
                                    <label for="email" >Email</label>
                                    <input type="email" name="email" id="email" value="<?php echo isset($user_email) ? $user_email : '' ?>" class="form-control" placeholder="somebody@example.com" autocomplete="on">
                                    <p><?php echo isset($error['user_email']) ? $error['user_email'] : '' ?></p>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                                    <p><?php echo isset($error['user_password']) ? $error['user_password'] : '' ?></p>
                                </div>
                                <input type="submit" name="register" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                            </form>

                        </div>
                    </div> <!-- /.col-xs-12 -->
                </div> <!-- /.row -->
            </div> <!-- /.container -->
        </section>
        <hr>
<?php include "includes/footer.php";?>
