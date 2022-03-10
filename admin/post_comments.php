<?php include "includes/admin_header.php"; ?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/admin_navigation.php"; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Blank Page
                            <small>Subheading</small>
                        </h1>

<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Author</th>
            <th>Comment</th>
            <th>Email</th>
            <th>Status</th>
            <th>In Response To</th>
            <th>Date</th>
            <th>Approved</th>
            <th>Unapproved</th>
            <th>Delete</th>
        </tr>
    </thead>

    <tbody>

    <?php
        
    if(isset($_GET['id'])) {
        
        $post_id = $_GET['id'];
        
    $query = "SELECT * FROM comments WHERE comment_post_id =" . mysqli_real_escape_string($conn, $post_id) . "";
    $select_comments = mysqli_query($conn, $query);
    confirmQuery($select_comments);
        
    while($row = mysqli_fetch_assoc($select_comments)) {
        
        $comment_id = $row['comment_id'];
        $comment_post_id = $row['comment_post_id'];
        $comment_author = $row['comment_author'];
        $comment_email = $row['comment_email'];
        $comment_content = $row['comment_content'];
        $comment_status = $row['comment_status'];
        $comment_date = $row['comment_date'];
        
        echo "<tr>";
        echo "<td>$comment_id</td>";
        
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
        
        echo "<td>$comment_author</td>";
        echo "<td>$comment_content</td>";
        echo "<td>$comment_email</td>";
        echo "<td>$comment_status</td>";
        
        $query = "SELECT * FROM posts WHERE post_id = {$comment_post_id}";
        $select_post = mysqli_query($conn, $query);
        while($row = mysqli_fetch_assoc($select_post)) {
            
            $post_id = $row['post_id'];
            $post_title = $row['post_title'];
            
            echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
            
        }
        
        echo "<td>$comment_date</td>";
        echo "<td><a href='comments.php?approve=$comment_id'>Approve</a></td>";
        echo "<td><a href='comments.php?unapprove=$comment_id'>Unapprove</a></td>";
        echo "<td><a href='post_comments.php?id=$post_id&delete=$comment_id'>Delete</a></td>";
        echo "</tr>";
        
    }
        
    }
        
    ?>
    
    <?php
                        
    if(isset($_GET['delete'])) {
        
        $comment_id = $_GET['delete'];
        $post_id = $_GET['id'];
        
        $query = "DELETE FROM comments WHERE comment_id = {$comment_id}";
        $delete_comment = mysqli_query($conn, $query);
        confirmQuery($delete_comment);
        header("Location: post_comments.php?id=" . $post_id . ""); // da bi se uradio refresh mora da se ostane  na istoj stranici tj. adresa mora da ostane ista kao kad se ova stranica poziva u redu 153 u view_all_posts.php      
        
    }
                        
    ?>
                                          
    <?php
                        
    if(isset($_GET['approve'])) {
        
        $comment_id = $_GET['approve'];
        
        $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = {$comment_id} AND comment_status = 'unapproved' ";
        $approve_comment = mysqli_query($conn, $query);
        confirmQuery($approve_comment);
        header("Location: comments.php");        
        
    }
                        
    ?>
                       
    <?php
                        
    if(isset($_GET['unapprove'])) {
        
        $comment_id = $_GET['unapprove'];
        
        $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = {$comment_id} AND comment_status = 'approved' ";
        $unapprove_comment = mysqli_query($conn, $query);
        confirmQuery($unapprove_comment);
        header("Location: comments.php");
        
    }
                        
    ?>

    </tbody>
            
</table>

</div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <?php include "includes/admin_footer.php"; ?>
