<?php

//for ForgotPassword functionality
/* if(ifItIsMethod('post')) {
    if(isset($_POST['username']) && isset($_POST['password'])) {
        login_user($_POST['username'], $_POST['password']);
    } else {
        redirect('index.php');
    }
} */
    
?>    

<div class="col-md-4">

    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <form action="search.php" method="POST">
            <div class="input-group">
                <input type="text" class="form-control" name="search" placeholder="Search">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit" name="submit">
                        <span class="glyphicon glyphicon-search"></span>
                </button>
                </span>
            </div>
        </form>
        <!-- /.input-group -->
    </div>
    
    <div class="well">
        
        <?php if(isset($_SESSION['user_role'])): ?>
        
            <h4>Logged in as <?php echo $_SESSION['username']; ?></h4>
            
            <a href="includes/logout.php" class="btn btn-primary">Logout</a>
        
        <?php else: ?>
        
            <h4>Login</h4> 
                <form method="post"> <!-- odavde je izbrisano action="includes/login.php" i dodat je kod na vrhu -->
                <div class="form-group">
                    <input type="text" class="form-control" name="username" placeholder="Enter Username">
                    </div>
                <div class="input-group">
                    <input type="password" class="form-control" name="password" placeholder="Enter Password">
                    <span class="input-group-btn">
                        <button class="btn btn-primary" type="submit" name="login">Submit</button>
                    </span>
                </div>
                </form>
        
        <?php endif; ?>
        
    </div>
        <!-- /.input-group -->

    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-6">
                <ul class="list-unstyled">
                   
                   <?php
                    
                    $query = "SELECT * FROM categories";
                    $select_categories = mysqli_query($conn, $query);
                    confirmQuery($select_categories);
                    
                    while($row = mysqli_fetch_assoc($select_categories)) {
                        
                        $cat_id = $row['cat_id'];
                        $cat_title = $row['cat_title'];
                        
                        echo "<li><a href='/cms_odnule/category_new/$cat_id'>$cat_title</a></li>"; 
                        
                    }
                    
                    ?>
                   
<!--
                    <li><a href="#">Category Name</a>
                    </li>
                    <li><a href="#">Category Name</a>
                    </li>
                    <li><a href="#">Category Name</a>
                    </li>
                    <li><a href="#">Category Name</a>
                    </li>
-->
                </ul>
            </div>
            <!-- /.col-lg-6 -->
        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <div class="well">
        <h4>Side Widget Well</h4>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
    </div>

</div>