<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Role</th>
            <th>To Admin</th>
            <th>To Subscriber</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>

    <tbody>

    <?php
        
    $query = "SELECT * FROM users";
    $select_users = mysqli_query($conn, $query);
    confirmQuery($select_users);
        
    while($row = mysqli_fetch_assoc($select_users)) {
        
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_role = $row['user_role'];
        
//        $query = "SELECT * FROM comments WHERE comment_post_id = '{$post_id}'";
//        $select_comments_by_post = mysqli_query($conn, $query);
//        $post_comment_count = mysqli_num_rows($select_comments_by_post);    
//    
//        $post_status = $row['post_status'];
        
        echo "<tr>";
        echo "<td>$user_id</td>";
        
//        $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id}";
//        $select_category_query = mysqli_query($conn, $query);
//        confirmQuery($select_category_query);
//        
//        while($row = mysqli_fetch_assoc($select_category_query)) {
//            
//            $cat_id = $row['cat_id'];
//            $cat_title = $row['cat_title'];
//            
//            echo "<td><a target='_blank' href='../index.php?c_id=$cat_id'>$cat_title</a></td>";
//            
//        }
        
        echo "<td>$username</td>";
        echo "<td>$user_firstname</td>";
        echo "<td>$user_lastname</td>";
        echo "<td>$user_email</td>";
        echo "<td>$user_role</td>";
        echo "<td><a href='users.php?to_admin=$user_id'>Admin</a></td>";
        echo "<td><a href='users.php?to_subscriber=$user_id'>Subscriber</a></td>";
        echo "<td><a href='users.php?source=update_user&edit_user=$user_id'>Edit</a></td>";
        echo "<td><a href='users.php?delete=$user_id'>Delete</a></td>";
        
//        $query = "SELECT * FROM posts WHERE post_id = {$post_id}";
//        $select_view_post_count = mysqli_query($conn, $query);
//        while($row = mysqli_fetch_assoc($select_view_post_count)) {
//            
//        $post_view_count = $row['post_view_count'];
//            
//        }
//            
//        echo "<td><a href='posts.php?reset=$post_id'>$post_view_count</a></td>";
        echo "</tr>";
        
    }
        
        if(isset($_GET['to_admin'])) {
            
            $the_user_id = $_GET['to_admin'];
            
            $query = "UPDATE users SET user_role = 'admin' WHERE user_id = {$the_user_id} AND user_role = 'subscriber'";
            $role_to_admin = mysqli_query($conn, $query);
            confirmQuery($role_to_admin);
            header("Location: users.php");
            
        }
        
        if(isset($_GET['to_subscriber'])) {
            
            $the_user_id = $_GET['to_subscriber'];
            
            $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = {$the_user_id} AND user_role = 'admin'";
            $role_to_subscriber = mysqli_query($conn, $query);
            confirmQuery($role_to_subscriber);
            header("Location: users.php");
            
        }
        
        if (isset($_GET['delete'])) {

            $the_user_id = $_GET['delete'];

            $query = "DELETE FROM users WHERE user_id = {$the_user_id}";
            $delete_user = mysqli_query($conn, $query);
            confirmQuery($delete_user);
            header("Location: users.php");
        }
        
    ?>

    </tbody>
            
</table>