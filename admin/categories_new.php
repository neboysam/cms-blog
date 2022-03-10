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
                        
                        
            <?php
                        
            if(isset($_POST['add_category'])) {
                
                $cat_title = $_POST['cat_title'];
                $query = "INSERT INTO categories (cat_title) ";
                $query .= "VALUES ('{$cat_title}')";
                $add_category = mysqli_query($conn, $query);
                confirmQuery($add_category);
                
            }
                        
            ?>
              
              <div class="col-xs-6">
               <form action="" method="post">
                 <div class="form-group">
                 <label for="cat-title">Add Category</label>
                  <input type="text" name="cat_title" class="form-control">
                  </div>
                  <div class="form-group">
                  <input type="submit" name="add_category" class="btn btn-primary" value="Add Category">
                  </div> 
               </form>
               
            <?php
                
            if(isset($_GET['edit'])) {
                
                include "includes/update_category.php";
                
            }
                
            ?>
               
            </div>
                        
            <div class="col-xs-6">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Delete</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                   
       <?php

        $query = "SELECT * FROM categories";
        $select_categories = mysqli_query($conn, $query);
        confirmQuery($select_categories);

        while($row = mysqli_fetch_assoc($select_categories)) {

            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];

            echo "<tr>";
            echo "<td>$cat_id</td>";
            echo "<td>$cat_title</td>";
            ?>
            
            <form method="post">
                
                <input type="hidden" name="cat_id" value="<?php echo $cat_id; ?>">
                
            <?php
                
                echo "<td><input class='btn btn-danger' type='submit' name='delete' value='Delete'></td>";
                    
            ?>
                
            </form>
                                
            <?php
            
            echo "<td><a href='categories.php?edit=$cat_id'>Edit</a></td>";
            echo "</tr>";

        }

        ?>
                    
        <?php

        if(isset($_POST['delete'])) {
            
            $the_cat_id = $_POST['cat_id'];
            
            $query = "DELETE FROM categories WHERE cat_id = $the_cat_id";
            $delete_category = mysqli_query($conn, $query);
            confirmQuery($delete_category);
            header("Location: categories_new.php");
            
        }

        ?>
                   
<!--
                    <tr>
                        <td>Ex</td>
                        <td>Ex</td>
                        <td>Ex</td>
                        <td>Ex</td>
                    </tr>
-->
                </tbody>
            </table>
            </div>
                        
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