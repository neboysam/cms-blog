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
                
            <?php

            if(isset($_POST['submit'])) {

                $search = $_POST['search'];
                
                if($search == '' || empty($search)) {
                    
                    echo "This field should not be empty.";
                    
                } else {

                $query = "SELECT * FROM posts WHERE post_tags LIKE '%{$search}%'";
                $search_posts = mysqli_query($conn, $query);
                confirmQuery($search_posts);
                
                $count = mysqli_num_rows($search_posts);
                    
                if($count == 0) {
                    
                    echo "No results found.";
                    
                } else { 
                
                while($row = mysqli_fetch_assoc($search_posts)) {

                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                $post_user = $row['post_user'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = $row['post_content'];

            ?>

            <!-- First Blog Post -->
            <h2>
                <a href="#"><?php echo $post_title; ?></a>
            </h2>
            <p class="lead">
                by <a href="index.php"><?php echo $post_user; ?></a>
            </p>
            <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date; ?></p>
            <hr>
            <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
            <hr>
            <p><?php echo $post_content; ?></p>
            <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

            <hr>

            <?php 

            }
                
                }
                
                }
                
            }

            ?>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <?php include "includes/footer.php"; ?>