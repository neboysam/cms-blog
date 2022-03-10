<?php

if (isset($_POST['add_post'])) {
    $post_title = $_POST['post_title'];
    $post_category_id = $_POST['post_category_id'];
    $post_user = $_POST['post_user'];
    $post_status = $_POST['post_status'];
    $post_image = $_FILES['post_image']['name'];
    $post_image_temp = $_FILES['post_image']['tmp_name'];
    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_date = date('d-m-y');
    $query = "INSERT INTO posts (post_category_id, post_title, post_user, post_date, post_image, post_content, post_tags, post_status) ";
    $query .= "VALUES ('{$post_category_id}', '{$post_title}', '{$post_user}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}')";
    $add_post_query = mysqli_query($conn, $query);
    confirmQuery($add_post_query);
}
?>

<div class="col-xs-6">
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="post-title">Post Title</label>
            <input type="text" name="post_title" class="form-control">
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
                    echo "<option value='$cat_id'>$cat_title</option>";
                }
                ?>

            </select>
        </div>
        <div class="form-group">
            <label for="post-author">Post Author</label>
            <!--        <input type="text" name="post_author" class="form-control">-->
            <select name="post_user" id="" class="form-control">
                <option value="<?php echo $_SESSION['username']; ?>"><?php echo $_SESSION['username']; ?></option>
            </select>
        </div>
        <div class="form-group">
            <label for="post-status">Post Status</label><br>
            <!--        <input type="text" name="post_status" class="form-control">-->
            <select name="post_status" id="" class="form-control">
                <option value="draft">Select Option</option>
                <option value="draft">Draft</option>
                <option value="published">Publish</option>
            </select>
        </div>
        <div class="form-group">
            <label for="post-image">Post Image</label><br>
            <input type="file" name="post_image">
        </div>
        <div class="form-group">
            <label for="post-tags">Post Tags</label>
            <input type="text" name="post_tags" class="form-control">
        </div>
        <div class="form-group">
            <label for="post-content">Post Content</label>
            <textarea type="text" name="post_content" class="form-control" id="body"></textarea>
        </div>
        <div class="form-group">
            <input type="submit" name="add_post" class="btn btn-primary" value="Add Post">
        </div>
    </form>
</div>