<?php

if (isset($_GET['p_id'])) {
    $the_post_id = $_GET['p_id'];
    $query = "SELECT * FROM posts WHERE post_id = '{$the_post_id}'";
    $select_post_by_id = mysqli_query($conn, $query);
    confirmQuery($select_post_by_id);
    while ($row = mysqli_fetch_assoc($select_post_by_id)) {
        $post_title = $row['post_title'];
        $post_category_id = $row['post_category_id'];
        $post_user = $row['post_user'];
        $post_status = $row['post_status'];
        $post_image = $row['post_image'];
        $post_tags = $row['post_tags'];
        $post_content = $row['post_content'];
    }
}

if (isset($_POST['edit_post'])) {
    $the_post_id = $_GET['p_id'];
    $post_title = $_POST['post_title'];
    $post_category_id = $_POST['post_category_id'];
    $post_user = $_POST['post_user'];
    $post_status = $_POST['post_status'];
    $post_image = $_FILES['post_image']['name'];
    $post_image_temp = $_FILES['post_image']['tmp_name'];
    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    move_uploaded_file($post_image_temp, "../images/$post_image");
    if (empty($post_image)) {
        $query = "SELECT * FROM posts WHERE post_id = '{$the_post_id}'";
        $get_image_query = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($get_image_query)) {
            $post_image = $row['post_image'];
        }
    }
    $query = "UPDATE posts SET ";
    $query .= "post_category_id = '{$post_category_id}', ";
    $query .= "post_title = '{$post_title}', ";
    $query .= "post_user = '{$post_user}', ";
    $query .= "post_date = 'now()', ";
    $query .= "post_image = '{$post_image}', ";
    $query .= "post_content = '{$post_content}', ";
    $query .= "post_tags = '{$post_tags}', ";
    $query .= "post_status = '{$post_status}' ";
    $query .= "WHERE post_id = '{$the_post_id}' ";
    $add_post_query = mysqli_query($conn, $query);
    confirmQuery($add_post_query);
}
// }
echo "<p class='bg-success'>Post Updated.<a href='../index.php'> View Posts</a> or <a href='posts.php'>Edit More Posts</a></p>";
?>

<div class="col-xs-6">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="post-title">Post Title</label>
            <input type="text" name="post_title" class="form-control" value="<?php echo $post_title; ?>">
        </div>
        <div class="form-group">
            <label for="">Post Category</label><br>
            <select name="post_category_id" id="" class="form-control">

                <?php
                $query = "SELECT * FROM categories";
                $select_categories = mysqli_query($conn, $query);
                confirmQuery($select_categories);
                while ($row = mysqli_fetch_assoc($select_categories)) {
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];
                    // echo "<option value=''>{$post_category_id}</option>";
                    if ($cat_id == $post_category_id) {
                        echo "<option selected value='{$cat_id}'>{$cat_title}</option>";
                    } else {
                        echo "<option value='{$cat_id}'>{$cat_title}</option>";
                    }
                }
                //            $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id}";
                //            $select_categories = mysqli_query($conn, $query);
                //            confirmQuery($select_categories);
                //            
                //            while($row = mysqli_fetch_assoc($select_categories)) {
                //                
                //                $cat_id = $row['cat_id'];
                //                $cat_title = $row['cat_title'];
                //                
                //                echo "<option value='$cat_id'>$cat_title</option>";
                //                
                //            }
                //            
                //            $query = "SELECT * FROM categories WHERE cat_id != {$post_category_id}";
                //            $select_categories = mysqli_query($conn, $query);
                //            confirmQuery($select_categories);
                //            
                //            while($row = mysqli_fetch_assoc($select_categories)) {
                //                
                //                $cat_id = $row['cat_id'];
                //                $cat_title = $row['cat_title'];
                //                
                //                echo "<option value='$cat_id'>$cat_title</option>";
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="post-user">Post Author</label>
            <input type="text" name="post_user" class="form-control" value="<?php echo $post_user; ?>">
        </div>
        <div class="form-group">
            <label for="post-status">Post Status</label><br>
            <select name="post_status" id="post-status" class="form-control">
                <?php
                echo "<option value='{$post_status}'>{$post_status}</option>";
                if ($post_status == 'published') {
                    echo "<option value='draft'>draft</option>";
                } else {
                    echo "<option value='published'>published</option>";
                }
                ?>
            </select>

            <!-- <input type="text" name="post_status" class="form-control" value="<?php echo $post_status; ?>" >-->
        </div>
        <img width="100" src="../images/<?php echo $post_image; ?>">
        <div class="form-group">
            <label for="post-image">Post Image</label><br>
            <input type="file" name="post_image">
        </div>
        <div class="form-group">
            <label for="post-tags">Post Tags</label>
            <input type="text" name="post_tags" class="form-control" value="<?php echo $post_tags; ?>">
        </div>
        <div class="form-group">
            <label for="post-content">Post Content</label>
            <textarea name="post_content" class="form-control" cols="30" id="body"><?php echo str_replace('\r\n', '<br>', $post_content); // ova funkcija cisti $post_content koji dolazi iz baze 
                                                                                    ?></textarea>
        </div>
        <div class="form-group">
            <input type="submit" name="edit_post" class="btn btn-primary" value="Update Post">
        </div>
    </form>
</div>