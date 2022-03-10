<?php  include "includes/header.php"; ?>
    
    <?php

    if($_SERVER['REQUEST_METHOD'] == "POST") { // if(isset($_POST['register']))...
        
    $username = trim($_POST['username']);
    $password = trim($_POST['user_password']);
    $email    = trim($_POST['user_email']);
        
    $error = [
        
        'username' => '',
        'email' => '',
        'password' => ''
        
    ];
        
    if(strlen($username) < 3) {
        
        $error['username'] = 'Username has to be longer than 2 characters.';
        
        
    }
        
    if($username == '') {
        
        $error['username'] = 'Username cannot be empty.';
        
        
    }
        
    if(username_exists($username)) {
        
        $error['username'] = 'Username already exists, please choose another one.';
        
        
    }
        
    if($email == '') {
        
        $error['email'] = 'Email cannot be empty.';
        
        
    }
        
    if(user_email_exists($email)) {
        
        $error['email'] = 'Email already exists, <a href="index.php">Please log in.</a>';
        
        
    }
        
    if($password == '') {
        
        $error['password'] = 'Password cannot be empty.';
        
        
    }
        
    foreach($error as $key => $value) {
        
        if(empty($value)) {
            
        // echo $key . " " . "<br>"; to check the action of the above code
            
        unset($error[$key]);
            
        }
        
    }
        
    if(empty($error)) {
        
       register_user($username, $email, $password);
        
       login_user($username, $password);
        
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
                <h1>Register</h1>
                  
<!--                  <h6><?php echo $message; ?></h6>-->
                   
    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
        <div class="form-group">
            <label for="username" class="sr-only">Username</label>
            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username" autocomplete="on" value="<?php echo isset($username) ? $username : '' ?>">

            <p><?php echo isset($error['username']) ? $error['username'] : '' ?></p>

        </div>
         <div class="form-group">
            <label for="email" class="sr-only">Email</label>
            <input type="email" name="user_email" id="email" class="form-control" placeholder="somebody@example.com" autocomplete="on" value="<?php echo isset($email) ? $email : '' ?>">
            
            <p><?php echo isset($error['email']) ? $error['email'] : '' ?></p>
            
        </div>
        
         <div class="form-group">
            <label for="password" class="sr-only">Password</label>
            <input type="password" name="user_password" id="key" class="form-control" placeholder="Password">
            
            <p><?php echo isset($error['password']) ? $error['password'] : '' ?></p>
            
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