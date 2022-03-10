<?php

if(isset($_GET['edit'])) {
    
    $the_cat_id = $_GET['edit'];
    
    $query = "SELECT cat_title FROM categories WHERE cat_id = {$the_cat_id}";
    $select_category = mysqli_query($conn, $query);
    confirmQuery($select_category);
    
    $row = mysqli_fetch_assoc($select_category);
    $cat_title = $row['cat_title'];
    
}

if(isset($_POST['update_category'])) {
    
    $cat_title = $_POST['cat_title'];
    
    $query = "UPDATE categories SET cat_title = '{$cat_title}' ";
    $query .= "WHERE cat_id = {$the_cat_id}";
    $update_category = mysqli_query($conn, $query);
    confirmQuery($update_category);
    
}

?>

<form action="" method="post">
 <div class="form-group">
 <label for="cat-title">Update Category</label>
  <input type="text" name="cat_title" class="form-control" value="<?php echo $cat_title; ?>">
  </div>
  <div class="form-group">
  <input type="submit" name="update_category" class="btn btn-primary" value="Update Category">
  </div> 
</form>