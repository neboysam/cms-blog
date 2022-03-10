<?php include "includes/header.php"; ?>

    <!-- Navigation -->
    <?php include "includes/navigation.php"; ?>
    
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>
                
        <?php

        if(isset($_GET['category'])) {

            $cat_id = $_GET['category'];

            $per_page = 5;

            if(isset($_GET['page'])) {

                $page = $_GET['page'];

            } else {

                $page = '';

            }

            if($page == 0 || $page == 1) {

                $page_1 = 0;

            } else {

                $page_1 = ($page*$per_page) - $per_page;

            }

    if(isset($_SESSION['username']) && is_admin($_SESSION['username'])) {

    $stmt1 = mysqli_prepare($conn, "SELECT post_id, post_title, post_author, post_date, post_image, post_content FROM posts WHERE post_category_id = ?");        
                
            // $select_posts = mysqli_query($conn, $query);
            // confirmQuery($select_posts);

            // $count_posts = mysqli_num_rows($select_posts);

            } else {
                
    $stmt2 = mysqli_prepare($conn, "SELECT post_id, post_title, post_author, post_date, post_image, post_content FROM posts WHERE post_category_id = ? AND post_status= ?");
                
    $published = 'published';
    
            // $select_posts = mysqli_query($conn, $query);
            // confirmQuery($select_posts);

            // $count_posts = mysqli_num_rows($select_posts);
                
            //   $count_posts = mysqli_stmt_num_rows($stmt2);
                
            }
            
    if(isset($stmt1)) {
        
        mysqli_stmt_bind_param($stmt1, "i", $cat_id);
        
        mysqli_stmt_execute($stmt1);
        
        mysqli_stmt_bind_result($stmt1, $post_id, $post_title, $post_author, $post_date, $post_image, $post_content);
        
        $stmt = $stmt1;
        
        $count_posts = mysqli_stmt_num_rows($stmt);
        
    } else {
        
        mysqli_stmt_bind_param($stmt2, "is", $cat_id, $published);
        
        mysqli_stmt_execute($stmt2);
        
        $count_posts = mysqli_stmt_num_rows($stmt2);
        
        mysqli_stmt_bind_result($stmt2, $post_id, $post_title, $post_author, $post_date, $post_image, $post_content);
        
        $stmt = $stmt2;
        
        $count_posts = mysqli_stmt_num_rows($stmt);
        
    }
            
            if($count_posts < 1) {
                
                echo "<h2 class='text-center'>No posts available.</h2>";
                
            } else {
                
//            $count = ceil($count_posts/$per_page);
//                
//            if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') {
//                
//            $query = "SELECT * FROM posts WHERE post_category_id = {$cat_id} LIMIT $page_1, $per_page";
//            $select_posts_query = mysqli_query($conn, $query);
//            confirmQuery($select_posts_query);   
//                
//            } else {
//                
//            $query = "SELECT * FROM posts WHERE post_category_id = {$cat_id} AND post_status = 'published' LIMIT $page_1, $per_page";
//            $select_posts_query = mysqli_query($conn, $query);
//            confirmQuery($select_posts_query);
//                
//            }            

            while(mysqli_stmt_fetch($stmt)) {

        ?>

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                <hr>
                <p><?php echo $post_content; ?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More<span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
                
                <?php
                    
                }
                
                }
            
                }
                
                ?>

            </div>
            
                <!-- Blog Categories Well -->
                <?php include "includes/sidebar.php"; ?>

        </div>
        <!-- /.row -->

        <hr>
        
        <ul class="pager">
        
        <?php
        
        for($i=1; $i<=$count; $i++) {
            
            $cat_id = $_GET['category'];
            
            if($page == $i) {
                
            echo "<li><a class='active_link' href='category.php?category=$cat_id&page=$i'>{$i}</a></li>";    
                
            } else {
            
            echo "<li><a href='category.php?category=$cat_id&page=$i'>{$i}</a></li>";
                
            }
            
        }
        
        ?>
        
        </ul>

        <!-- Footer -->
        <?php include "includes/footer.php"; ?>