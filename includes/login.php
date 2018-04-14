<?php session_start(); ?>
<?php include "db.php"; ?>
<?php include "../functions.php";?>
<?php 
if(isset($_POST['login'])){
    $user_name = $_POST['user_name'];
    $user_password = $_POST['user_password'];
    loginUsers($user_name, $user_password);
}
?>    
        

