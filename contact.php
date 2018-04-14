<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>


    <!-- Navigation -->
<?php  include "includes/navigation.php"; ?>
<?php
// the message
$msg = "First line of text\nSecond line of text";



// send email

    if(isset($_POST['submit'])){
        // use wordwrap() if lines are longer than 70 characters
        $msg = wordwrap($msg,70);
        $to = "eni.puska@gmail.com";
        $subject = wordwrap($_POST['subject']);
        $body = $_POST['body'];
        $header ="From: ". $_POST['email'];
        mail($to,$subject,$body,$header);
    }
?>
    <!-- Page Content -->
    <div class="container">
        <section id="login">
            <div class="container">
                <div class="row">
                    <div class="col-xs-6 col-xs-offset-3">
                        <div class="form-wrap">
                        <h1>Contact</h1>
                            <form role="form" action="contact.php" method="post" id="login-form" autocomplete="off">

                                <div class="form-group">
                                    <label for="subject" >Subject</label>
                                    <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter your subject">
                                </div>
                                <div class="form-group">
                                    <label for="email" >Email</label>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email">
                                </div>
                                <div class="form-group">
                                    <label for="body" >Body</label>
                                    <textarea name="body" id="body" class="form-control"></textarea>
                                </div>
                                <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Submit">
                            </form>

                        </div>
                    </div> <!-- /.col-xs-12 -->
                </div> <!-- /.row -->
            </div> <!-- /.container -->
        </section>
        <hr>
<?php include "includes/footer.php";?>
