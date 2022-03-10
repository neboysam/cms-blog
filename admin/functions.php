<?php

function users_online() {
    global $conn;
    $session = session_id(); // id of the user who is logged into the admin. The function session_start() should be activated in the admin_header.php
    $time = time(); // current time which is reset each time the user performs an action in the admin
    $time_out_in_seconds = 60; // after 60 sec of inactivity the user will not be counted to be in the admin (online)
    $time_out = $time - $time_out_in_seconds;
    $query = "SELECT * FROM users_online WHERE session = '{$session}'";
    $send_query = mysqli_query($conn, $query);
    $count = mysqli_num_rows($send_query);
    if($count == NULL) {
      mysqli_query($conn, "INSERT INTO users_online (session, time) VALUES ('{$session}', '{$time}')");
    } else {
      mysqli_query($conn, "UPDATE users_online SET time = '$time' WHERE session = '{$session}'");
    }
    $users_online_query = mysqli_query($conn, "SELECT * FROM users_online WHERE time > '$time_out'");
    return $count_user = mysqli_num_rows($users_online_query);
}

function confirmQuery($result) {
    global $conn;
    if(!$result) {    
        die("Query failed." . mysqli_error($conn));
    }
}

function recordCount($table) {
    global $conn;
    $query = "SELECT * FROM " . $table;
    $select_posts = mysqli_query($conn, $query);
    $result = mysqli_num_rows($select_posts);
    confirmQuery($result);
    return $result;
}

function checkStatus($table, $column, $status) {
    global $conn;
    $query = "SELECT * FROM $table WHERE $column = '$status'";
    $result = mysqli_query($conn, $query);
    confirmQuery($result);
    return mysqli_num_rows($result);
}

function is_admin($username = '') {
    global $conn;
    $query = "SELECT user_role FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $query);
   // confirmQuery($result);
    $row = mysqli_fetch_assoc($result);
    if($row['user_role'] == 'admin') {
        return true;
    } else {
        return false;
       }
}

function username_exists($username) {
    global $conn;
    $query = "SELECT username FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}

function user_email_exists($user_email) {
    global $conn;
    $query = "SELECT username FROM users WHERE user_email = '$user_email'";
    $select_user = mysqli_query($conn, $query);
    $result = mysqli_num_rows($select_user);
    if($result > 0) {
        return true;
    } else {
        return false;
    }
}

 function redirect($location) { // ovu je izmijenio za Forgot Password, bila je sa return
    header("Location:" . $location);
    exit;
 }

function ifItIsMethod($method=null) { // dodata za Forgot Password
    if($_SERVER['REQUEST_METHOD'] == strtoupper($method)) { // $_SERVER['REQUEST_METHOD'] determines whether the request was a POST or GET request. This can help determine whether to parse incoming parameters from $_GET or $_POST.
        return true;
    }
}

function isLoggedIn() { // dodata za Forgot Password
    if(isset($_SESSION['user_role'])) {
        return true;
    }
    return false;
}

function checkIfUserIsLoggedInAndRedirect($redirectLocation=null) { // dodata za Forgot Password
    if(IsLoggedIn()) {
        redirect($redirectLocation);
    }
}

function register_user($username, $email, $password) {
    global $conn;
//    if(username_exists($username) || user_email_exists($email)) {
//        $message = "User already exists.";
//    } else { this part of the code has been replaced by pieces of code in functions username_exists and user_email_exists

        $username = mysqli_real_escape_string($conn, $username);
        $password = mysqli_real_escape_string($conn, $password);
        $email    = mysqli_real_escape_string($conn, $email);
        $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

//                    $query = "SELECT randSalt FROM users";
//                    $select_randSalt = mysqli_query($conn, $query);
//                    confirmQuery($select_randSalt);
//                    $row = mysqli_fetch_assoc($select_randSalt);
//                    $randSalt = $row['randSalt'];
//                    if(empty($randSalt)) {
//                        $randSalt = '$2y$10$iusesomecrazystrings22';
//                        $password = crypt($password, $randSalt);
//                    } else {
//                        $password = crypt($password, $randSalt);
//                    }

        $query = "INSERT INTO users (username, user_password, user_email, user_role) ";
        $query .= "VALUES ('{$username}', '{$password}', '{$email}', 'subscriber')";
        $register_user = mysqli_query($conn, $query);
        confirmQuery($register_user);

        // $message = "Subscription has been submitted successfully.";
   // } else {
        // $message = "Fields cannot be empty.";
    }

function login_user($username, $password) {
    global $conn;
    $username = trim($username);
    $password = trim($password);
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);
    $query = "SELECT * FROM users WHERE username = '{$username}'";
    $select_user_query = mysqli_query($conn, $query);
    while($row = mysqli_fetch_assoc($select_user_query)) {
        $db_username = $row['username'];
        $db_user_password = $row['user_password'];
        $db_user_role = $row['user_role'];
        $db_user_id = $row['user_id'];
        $db_user_lastname = $row['user_lastname'];
    }
    
    if(password_verify($password, $db_user_password)) {
        $_SESSION['username'] = $db_username;
        $_SESSION['password'] = $db_user_password;
        $_SESSION['user_role'] = $db_user_role;
        $_SESSION['user_id'] = $db_user_id;
        $_SESSION['user_lastname'] = $db_user_lastname;
        redirect('admin');
    } else {
       redirect('index.php');
       redirect ('login.php');
    }
}
?>