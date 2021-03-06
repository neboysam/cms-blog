<?php include "includes/header.php"; ?>

<!-- Navigation -->
<?php include "includes/navigation.php"; ?>

<!-- Page Content -->
<div class="container">
    <div class="row">
        <!-- Blog Entries Column -->
        <div class="col-md-8">
            <h1 class="page-header">
                CMS System
                <small>Blog</small>
            </h1>

            <!--<?php echo $_SESSION['user_role']; ?>-->

            <?php
            $per_page = 5;
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
            } else {
                $page = "";
            }
            if ($page == "" || $page == 1) {
                $page_1 = 0;
            } else {
                $page_1 = ($page * $per_page) - $per_page;
            }
            if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') {
                $query = "SELECT * FROM posts";
            } else {
                $query = "SELECT * FROM posts WHERE post_status = 'published'";
            }
            $count_posts = mysqli_query($conn, $query);
            $count = mysqli_num_rows($count_posts);
            if ($count < 1) {
                echo "<h1 class='text-center'>No posts available.</h1>";
            } else {
                $count = ceil($count / $per_page);
                if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') {
                    $query = "SELECT * FROM posts LIMIT $page_1, $per_page";
                    $select_posts = mysqli_query($conn, $query);
                } else {
                    $query = "SELECT * FROM posts WHERE post_status = 'published' LIMIT $page_1, $per_page";
                    $select_posts = mysqli_query($conn, $query);
                }
                confirmQuery($select_posts);
                while ($row = mysqli_fetch_assoc($select_posts)) {
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_status = $row['post_status'];
                    $post_user = $row['post_user'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = substr($row['post_content'], 0, 100);
                    // if($post_status == 'published') { // ako se ovdje stavi, na prvoj stranici ce biti manji broj postova a ne $per_page. Zato treba staviti u drugom kveriju uslov WHERE post_status = 'published', tada ce na zadnjoj stranici biti manji broj postova a na svim ostalim $per_page
            ?>

                    <!-- First Blog Post -->
                    <h2>
                        <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                    </h2>
                    <p class="lead">
                        by <a href="author_posts.php?author_post=<?php echo $post_user; ?>"><?php echo $post_user; ?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date; ?></p>
                    <hr>
                    <a href="post.php?p_id=<?php echo $post_id; ?>"><img class="img-responsive" src="images/<?php echo $post_image; ?>" alt=""></a>
                    <hr>
                    <p><?php echo $post_content; ?></p>
                    <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                    <hr>

            <?php
                }
            }
            // }
            ?>

        </div>
        <!-- Blog Sidebar Widgets Column -->
        <?php include "includes/sidebar.php"; ?>

    </div>
    <!-- /.row -->
    <hr>
    <ul class="pager">
        <?php
        for ($i = 1; $i <= $count; $i++) {
            if ($page == $i) {
                echo "<li ><a class='active_link' href='index.php?page={$i}'>{$i}</a></li>";
            } else {
                echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";
            }
        }
        ?>
    </ul>

    <!-- Footer -->
    <?php include "includes/footer.php"; ?>