<?php

if (isset($_POST['add_user'])) {

    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];
    $username = $_POST['username'];

    //    $post_image = $_FILES['post_image']['name'];
    //    $post_image_temp = $_FILES['post_image']['tmp_name'];

    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];

    $hashed_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));

    //    $post_date = date('d-m-y');

    // provjera da li username postoji u tabeli users

    $query = "SELECT * FROM users";
    $select_users = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($select_users)) {
        $db_username = $row['username'];
        $db_user_email = $row['user_email'];
    }

    if ($username == $db_username || $user_email == $db_user_email) {
        echo "<p class='bg-success'>This username is already in use.</p>";
    } else {
        $query = "INSERT INTO users (username, user_password, user_firstname, user_lastname, user_email, user_role) ";
        $query .= "VALUES ('{$username}', '{$hashed_password}', '{$user_firstname}', '{$user_lastname}', '{$user_email}', '{$user_role}')";
        $add_user_query = mysqli_query($conn, $query);
        confirmQuery($add_user_query);
        echo "<p class='bg-success'>User added successfully.</p>";
    }
}

?>

<div class="col-xs-6">
    <form action="" method="POST" enctype="multipart/form-data">
        <!--
<div class="form-group">
<label for="post-title">Post Title</label>
<input type="text" name="post_title" class="form-control">
</div>
-->

        <!--
<div class="form-group">
<label for="">Post Category</label><br>
<select name="post_category_id" id="">

<?php
$query = "SELECT * FROM categories";
$select_categories = mysqli_query($conn, $query);
confirmQuery($select_categories);

while ($row = mysqli_fetch_assoc($select_categories)) {

    $cat_id = $row['cat_id'];
    $cat_title = $row['cat_title'];

    echo "<option value='$cat_id'>$cat_title</option>";
}

?>

</select>
</div>
-->

        <div class="form-group">
            <label for="firstname">Firstname</label>
            <input type="text" name="user_firstname" class="form-control">
        </div>

        <div class="form-group">
            <label for="lastname">Lastname</label>
            <input type="text" name="user_lastname" class="form-control">
        </div>

        <div class="form-group">
            <label for="role">User Role</label><br>
            <select name="user_role" id="" class="form-control">

                <option value="subscriber">Select Options</option>
                <option value="admin">Admin</option>
                <option value="subscriber">Subscriber</option>

            </select>
        </div>

        <div class="form-group">
            <label for="username">Username</label><br>
            <input type="text" name="username" class="form-control" >
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="user_email" class="form-control">
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="user_password" class="form-control">
        </div>

        <div class="form-group">
            <input type="submit" name="add_user" class="btn btn-primary" value="Add User">
        </div>

    </form>
</div>