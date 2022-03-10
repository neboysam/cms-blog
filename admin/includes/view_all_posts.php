<form action="" method="POST">

    <?php

    if (isset($_POST['checkBoxArray'])) {

        $bulk_options = $_POST['bulk_options'];

        foreach ($_POST['checkBoxArray'] as $postIdValue) {

            switch ($bulk_options) {

                case "published":
                    $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postIdValue}";
                    $set_to_published = mysqli_query($conn, $query);
                    break;

                case "draft":
                    $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postIdValue}";
                    $set_to_draft = mysqli_query($conn, $query);
                    break;

                case "clone":
                    $query = "SELECT * FROM posts WHERE post_id = {$postIdValue}";
                    $select_posts = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_assoc($select_posts)) {

                        $post_id = $row['post_id'];
                        $post_category_id = $row['post_category_id'];
                        $post_title = $row['post_title'];
                        $post_user = $row['post_user'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = $row['post_content'];
                        $post_tags = $row['post_tags'];
                        $post_status = $row['post_status'];

                        if (empty($post_tags)) {

                            $post_tags = "No tags.";
                        }

                        $query = "INSERT INTO posts (post_category_id, post_title, post_user, post_date, post_image, post_content, post_tags, post_status) ";
                        $query .= "VALUES ('{$post_category_id}', '{$post_title}', '{$post_user}', '{$post_date}', '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}')";
                        $clone_posts_query = mysqli_query($conn, $query);
                    }
                    break;

                case "delete":
                    $query = "DELETE FROM posts WHERE post_id = {$postIdValue}";
                    $delete_posts = mysqli_query($conn, $query);
                    break;
            }
        }
    }

    ?>

    <div class="col-xs-4" style="margin-bottom: 1em;">
        <select name="bulk_options" id="" class="form-control">
            <option value="published">Select Options</option>
            <option value="published">Publish</option>
            <option value="draft">Draft</option>
            <option value="clone">Clone</option>
            <option value="delete">Delete</option>
        </select>
    </div>

    <div class="col-xs-4">
        <input type="submit" name="submit" class="btn btn-success" value="Apply"> <a href="posts.php?source=add_post" class="btn btn-primary">Add New</a>
    </div>

    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th><input type="checkbox" id="selectAllBoxes"></th>
                <th>ID</th>
                <th>Post Category</th>
                <th>Title</th>
                <th>Author</th>
                <th>Date</th>
                <th>Image</th>
                <th>Content</th>
                <th>Tags</th>
                <th>Comment Count</th>
                <th>Status</th>
                <th>View Post</th>
                <th>Delete</th>
                <th>Edit</th>
                <th>Views</th>
            </tr>
        </thead>
        <tbody>

            <?php
            $logged_user = $_SESSION['username'];
            $query = "SELECT posts.post_id, posts.post_user, posts.post_title, posts.post_category_id, posts.post_status, posts.post_image, posts.post_content, ";
            $query .= "posts.post_tags, posts.post_comment_count, posts.post_date, posts.post_views_count, categories.cat_id, categories.cat_title ";
            $query .= "FROM posts ";
            $query .= "LEFT JOIN categories ON posts.post_category_id = categories.cat_id WHERE posts.post_user =  '{$logged_user}' ORDER BY posts.post_id";

            $select_posts = mysqli_query($conn, $query);
            confirmQuery($select_posts);

            while ($row = mysqli_fetch_assoc($select_posts)) {
                $post_id = $row['post_id'];
                $post_category_id = $row['post_category_id'];
                $post_title = $row['post_title'];
                $post_user = $row['post_user'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = $row['post_content'];
                $post_tags = $row['post_tags'];
                $post_status = $row['post_status'];
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];
                echo "<tr>";
            ?>

                <td><input type="checkbox" class="checkBox" name="checkBoxArray[]" value='<?php echo $post_id; ?>'></td>

                <?php

                echo "<td>$post_id</td>";

                //        $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id}";
                //        $select_category_query = mysqli_query($conn, $query);
                //        confirmQuery($select_category_query);
                //        
                //        while($row = mysqli_fetch_assoc($select_category_query)) {
                //            
                //            $cat_id = $row['cat_id'];
                //            $cat_title = $row['cat_title']; This code is not necessary as we used LEFT JOIN above.

                echo "<td><a target='_blank' href='../index.php?category=$cat_id'>$cat_title</a></td>";

                echo "<td><a target='_blank' href='../post.php?p_id=$post_id'>$post_title</a></td>";
                echo "<td>$post_user</td>";
                echo "<td>$post_date</td>";
                echo "<td><img class='img-responsive' src='../images/$post_image'</td>";
                echo "<td>$post_content</td>";
                echo "<td>$post_tags</td>";

                $query = "SELECT * FROM comments WHERE comment_post_id = {$post_id}";
                $select_comments_by_post = mysqli_query($conn, $query);
                $post_comment_count = mysqli_num_rows($select_comments_by_post);
                echo "<td><a href='post_comments.php?id={$post_id}'>$post_comment_count</a></td>";

                echo "<td>$post_status</td>";
                echo "<td><a href='../post.php?p_id=$post_id'>View Post</a></td>";

                ?>

                <form method="post">
                    <input type="hidden" name="post_id" value="<?php echo $post_id ?>">
                    <?php
                    echo "<td><input class='btn btn-danger' type='submit' name='delete' value='Delete'></td>";
                    ?>
                </form>

            <?php

                //        echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete it?'); \" href='posts.php?delete={$post_id}'>Delete</a></td>";

                echo "<td><a href='posts.php?source=update_post&p_id={$post_id}'>Edit</a></td>";

                $query = "SELECT * FROM posts WHERE post_id = {$post_id}";
                $select_view_post_count = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($select_view_post_count)) {
                    $post_view_count = $row['post_views_count'];
                }
                echo "<td><a href='posts.php?reset={$post_id}'>$post_view_count</a></td>";
                echo "</tr>";
            }

            if (isset($_POST['delete'])) {
                $the_post_id = $_POST['post_id'];
                $query = "DELETE FROM posts WHERE post_id = {$the_post_id}";
                $delete_post = mysqli_query($conn, $query);
                confirmQuery($delete_post);
                header("Location: posts.php");
            }

            if (isset($_GET['reset'])) {
                $the_post_id = $_GET['reset'];
                $query = "UPDATE posts SET post_views_count = '0' WHERE post_id = {$the_post_id}";
                $reset_post_view_count = mysqli_query($conn, $query);
                confirmQuery($reset_post_view_count);
                header("Location: posts.php");
            }
            ?>

        </tbody>
    </table>
</form>