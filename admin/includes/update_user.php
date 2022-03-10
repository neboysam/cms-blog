<?php

if(isset($_GET['edit_user'])) {
    
    $the_user_id = $_GET['edit_user'];
    
    $query = "SELECT * FROM users WHERE user_id = '$the_user_id'";
    $select_user_by_id = mysqli_query($conn, $query);
    confirmQuery($select_user_by_id);
    while($row = mysqli_fetch_assoc($select_user_by_id)) {
        
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_role = $row['user_role'];
        $username = $row['username'];
        $user_email = $row['user_email'];
        $user_password = $row['user_password'];
        
    }
    
}

if(isset($_POST['edit_user'])) {
    
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];
    $username = $_POST['username'];
    
//    $post_image = $_FILES['post_image']['name'];
//    $post_image_temp = $_FILES['post_image']['tmp_name'];
    
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    
//    move_uploaded_file($post_image_temp, "../images/$post_image");
    
//    if(empty($post_image)) {
//        
//        $query = "SELECT * FROM posts WHERE post_id = '$the_post_id'";
//        $get_image_query = mysqli_query($conn, $query);
//        
//        while($row = mysqli_fetch_assoc($get_image_query)) {
//            
//            $post_image = $row['post_image'];
//            
//        }
    
//    $query = "SELECT randSalt FROM users";
//    $select_randSalt = mysqli_query($conn, $query);
//    confirmQuery($select_randSalt);
//
//    $row = mysqli_fetch_assoc($select_randSalt);
//    $randSalt = $row['randSalt'];
//    
//    if(empty($randSalt)) {
//                        
//        $randSalt = '$2y$10$iusesomecrazystrings22';
//
//        $hashed_password = crypt($user_password, $randSalt);
//
//    } else {
//
//        $hashed_password = crypt($user_password, $randSalt);
//
//    }
    
    if(!empty($user_password)) {
        
    $query_password = "SELECT user_password FROM users WHERE user_id = '{$the_user_id}'";
    $get_user_query = mysqli_query($conn, $query_password);
    confirmQuery($get_user_query);

    $row = mysqli_fetch_assoc($get_user_query);
    $db_user_password = $row['user_password'];   
        
    if($db_user_password != $user_password) { // ako se unese nova lozinka, onda ona treba da se sifruje u narednom koraku:
//        
      $hashed_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 10));  
        
    }
//    
    $query = "UPDATE users SET ";
    $query .= "username = '{$username}', ";
    $query .= "user_password = '{$hashed_password}', ";
    $query .= "user_firstname = '{$user_firstname}', ";
    $query .= "user_lastname = '{$user_lastname}', ";
    $query .= "user_email = '{$user_email}', ";
    $query .= "user_role = '{$user_role}' ";
    $query .= "WHERE user_id = '{$the_user_id}' ";
    
    $add_user_query = mysqli_query($conn, $query);
    confirmQuery($add_user_query);
    
   echo "<p class='bg-success'>User Updated. <a href='users.php'>Edit More Users</a></p>";
        
//    echo $db_user_password;
//        
//    echo $user_password;
//    
//    echo $hashed_password;
        
    } else {
        echo "Password field could not be empty.";
    }
    
}

// }

?>

<div class="col-xs-6">
<form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="firstname">Firstname</label>
        <input type="text" name="user_firstname" class="form-control" value="<?php echo $user_firstname; ?>" >
    </div>
    
    <div class="form-group">
        <label for="lastname">Lastname</label>
        <input type="text" name="user_lastname" class="form-control" value="<?php echo $user_lastname; ?>" >
    </div>
    
    <div class="form-group">
       <label for="user-role">User Role</label><br>
        <select name="user_role" id="user-role" class="form-control">
           
           <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>
            
            <?php
            
            if($user_role == 'admin') {
                
               echo "<option value='subscriber'>Subscriber</option>";
                
            } else {
                
               echo "<option value='admin'>Admin</option>";
                
            }
            
            ?>
            
        </select>
    </div>
    
    <div class="form-group">
        <label for="username">Username</label><br>
        <input type="text" class="form-control" name="username" value="<?php echo $username; ?>" >
   </div>
   
   <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="user_email" class="form-control" value="<?php echo $user_email; ?>" >
   </div>
   
   <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="user_password" class="form-control" value="<?php echo $user_password; ?>" >
   </div>
   
    <div class="form-group">
        <input type="submit" name="edit_user" class="btn btn-primary" value="Update User">
   </div>      
    
</form>
</div>