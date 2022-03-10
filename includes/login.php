<?php include "db.php"; ?>
<?php include "../admin/functions.php"; ?>
<?php session_start(); ?>

<?php

if(isset($_POST['login'])) {
    
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
//        $password = crypt($password, $randSalt);
//
//    } else {
//
//        $password = crypt($password, $randSalt);
//
//    }
//    
//    $query = "SELECT * FROM users WHERE username = '{$username}' AND user_password = '{$password}'";
//    $select_credentials = mysqli_query($conn, $query);
    
//    if($username === $db_username && $password === $db_user_password) {
        
    login_user($_POST['username'], $_POST['password']);
    
}

?>