<?php  include "includes/header.php"; ?>
    
<?php

if(isset($_POST['submit'])) {
    
$username = $_POST['username'];
$user_email = $_POST['user_email'];
$user_password = $_POST['user_password'];

$username = mysqli_real_escape_string($conn, $username);
$user_email = mysqli_real_escape_string($conn, $user_email);
$user_password = mysqli_real_escape_string($conn, $user_password);

$user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));
    
if(!empty($username) && !empty($user_email) && !empty($user_password)) {
    
$query = "INSERT INTO users (username, user_password, user_email, user_role) ";
$query .= "VALUES ('{$username}', '{$user_password}', '{$user_email}', 'subscriber')";
$add_user_query = mysqli_query($conn, $query);
    
    $message = "Subscription has been submitted successfully.";
    
} else {
    
    $message = "All the fields must be filled out.";
    
}
    
} else {
    
    $message = "";
    
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
                <h1>Register</h1>
                   
                    <h6 class="text-center"><?php echo $message; ?></h6>               
                    <form role="form" action="registration_old.php" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="user_email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="user_password" id="key" class="form-control" placeholder="Password">
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>

        <hr>

<?php include "includes/footer.php";?>
