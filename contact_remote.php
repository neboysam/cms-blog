<?php include "includes/header.php";?>
    
<?php
    //if(isset($_POST['submit'])) {
        //$to      = "monte.nemi@gmail.com";
        //$subject = wordwrap($_POST['subject'], 70);
        //$message    = $_POST['message'];
        //$headers  = 'MIME-Version: 1.0' . "\r\n";
        //$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        //$headers .= 'From: ' . $_POST['email'] . "\r\n" .
                 //'Reply-To: webmaster@example.com' . "\r\n" .
                 //'X-Mailer: PHP/' . phpversion();
        //if (mail($to, $subject, $message, $headers)) {
            //echo "Thank you for your email. We will reply to you shortly.";
        //} else {
            //echo "Something went wrong.";
        //}
    //}
    if(isset($_POST['submit'])) {
        if(!empty($_POST['email']) && !empty($_POST['subject']) && !empty($_POST['message'])) {
            $email = $_POST['email'];
        	$subject = $_POST['subject'];
            $message = nl2br($_POST['message']);
          
        	$to = "monte.nemi@gmail.com";	
            $from = $email;
          
            $headers = "From: $from\n";
        	$headers .= "MIME-Version: 1.0\n";
            $headers .= "Content-type: text/html; charset=iso-8859-1\n";
            $emailMessage = '<html><body>';
            $emailMessage .= '<h1 style="color:#f40;">You got a message from Development web/web mobile website</h1>';
            $emailMessage .= '<!DOCTYPE html EN> 
            <html lang="en">
            <head></head>
            <body>
            <table>
                <tr><td width="100">Email: </td><td>' . $email . '</td></tr>
                <tr><td width="100">Message: </td><td>' . nl2br($message) . '</td></tr>
            </table>
            </body>
            </html>';
        	
        	if(mail($to, $subject, $emailMessage, $headers)){
        		echo "Merci pour votre message !";
        	} else {
        	    echo "Il y a eu une erreur lors de l'envoie";
        	}
        } else {
          echo "Tous les champs doivent être remplis !";
        }
    }
?>

<!-- Navigation -->

<?php  include "includes/navigation.php"; ?>

<!-- Page Content -->
<div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Contact</h1>
                <form role="form" action="" method="POST" id="login-form" autocomplete="off">
                    <div class="form-group">
                        <label for="email" class="sr-only">Email</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Enter your Email">
                    </div>
                    <div class="form-group">
                        <label for="subject" class="sr-only">Subject</label>
                        <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter your Subject">
                    </div>
                     <div class="form-group">
                        <label for="message" class="sr-only">Message</label>
                        <textarea name="message" id="message" class="form-control" rows="10" placeholder="Enter your Message"></textarea>
                    </div>
            
                    <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Send">
                </form>
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>

<hr>

<?php include "includes/footer.php"; ?>