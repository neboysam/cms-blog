<?php  include "includes/header.php"; ?>


    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            
            <div class="col-md-8">
               
          <?php
                
          if(isset($_GET['category'])) {
            $count = '';
              
             $cat_id = $_GET['category'];
              
              $per_page = 2;
              
            if(isset($_GET['page'])) {
                
                $page = $_GET['page'];
                
            } else {
                
                $page = '';
                
            }
              
            if($page == '' || $page == 1) {
                
                $page_1 = 0;
                
            } else {
                
                $page_1 = ($page*$per_page) - $per_page;
                
            }
              
        if(isset($_SESSION['username']) && is_admin($_SESSION['username'])) {
            
            $stmt1 = mysqli_prepare($conn, "SELECT post_id, post_title, post_user, post_date, post_image, post_content FROM posts WHERE post_category_id = ?");
            
        } else {
            
            $stmt2 = mysqli_prepare($conn, "SELECT post_id, post_title, post_user, post_date, post_image, post_content FROM posts WHERE post_category_id = ? AND post_status = ?");
            
            $published = 'published';
            
        }
              
        if(isset($stmt1)) {
            
            mysqli_stmt_bind_param($stmt1, "i", $cat_id);
            
            mysqli_stmt_execute($stmt1);
            
            mysqli_stmt_store_result($stmt1);
            
            mysqli_stmt_bind_result($stmt1, $post_id, $post_title, $post_user, $post_date, $post_image, $post_content);
            
            $stmt = $stmt1;
            
            $post_count = mysqli_stmt_num_rows($stmt);
            
        } else {
            
            mysqli_stmt_bind_param($stmt2, "is", $cat_id, $published);
            
            mysqli_stmt_execute($stmt2);
            
            mysqli_stmt_store_result($stmt2);
            
            mysqli_stmt_bind_result($stmt2, $post_id, $post_title, $post_user, $post_date, $post_image, $post_content);
            
            $stmt = $stmt2;
            
            $post_count = mysqli_stmt_num_rows($stmt);
              
          }
              
        if($post_count < 1) {
            
            echo "<h1 class='text-center'>No posts available.</h1>";
            
        } else {
            
    $count = ceil($post_count/$per_page);
            
    if(isset($_SESSION['username']) && is_admin($_SESSION['username'])) {
        
     $stmt1 = mysqli_prepare($conn, "SELECT post_id, post_title, post_user, post_date, post_image, post_content, post_tags FROM posts WHERE post_category_id = ? LIMIT ?, ?");   
        
    } else {
        
    $stmt2 = mysqli_prepare($conn, "SELECT post_id, post_title, post_user, post_date, post_image, post_content, post_tags FROM posts WHERE post_category_id = ? AND post_status = ? LIMIT ?, ?");
        
    $published = "published";
        
    }
            
    if(isset($stmt1)) {
        
        mysqli_stmt_bind_param($stmt1, "iii", $cat_id, $page_1, $per_page);
        
        mysqli_stmt_execute($stmt1);
        
        // mysqli_stmt_store_result($stmt1);
        
        mysqli_stmt_bind_result($stmt1, $post_id, $post_title, $post_user, $post_date, $post_image, $post_content, $post_tags);
        
        $stmt = $stmt1;
        
    } else {
        
        mysqli_stmt_bind_param($stmt2, "isii", $cat_id, $published, $page_1, $per_page);
        
        mysqli_stmt_execute($stmt2);
        
        // mysqli_stmt_store_result($stmt2);
        
        mysqli_stmt_bind_result($stmt2, $post_id, $post_title, $post_user, $post_date, $post_image, $post_content, $post_tags);
        
        $stmt = $stmt2;
        
    }
              
          while(mysqli_stmt_fetch($stmt)) {
                      
          ?> 
        
          <h1 class="page-header">
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_user ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
                <hr>
                
                <img class="img-responsive" src="images/<?php echo $post_image;?>" alt="">
                <hr>
                <p><?php echo(substr($post_content, 0, 200) . '...'); ?></p>
                <hr>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
                
                <?php
                
                }
                    
                }
              
                } else {
              
              header("Location: index.php");
              
          }
                
                ?>
                
   
            </div>
            
              

            <!-- Blog Sidebar Widgets Column -->
            
            
            <?php include "includes/sidebar.php";?>
             

        </div>
        <!-- /.row -->

        <hr>

   <ul class="pager">
       
      <?php
       
       for($i=1; $i<=$count; $i++) {
           
           $cat_id = $_GET['category'];
           
           if($page == $i) {
               
           echo "<li><a class='active_link' href='category_new.php?category=$cat_id&page=$i'>$i</a></li>";    
               
           } else {
           
           echo "<li><a href='category_new.php?category=$cat_id&page=$i'>$i</a></li>";
               
           }
           
       }
       
       ?> 
       
   </ul>

<?php include "includes/footer.php";?>
