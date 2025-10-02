<?php 
include('authentication.php');

//Crud user

if(isset($_POST['add_user'])){
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role_as = $_POST['role_as'];
    $status = $_POST['status'] == true ? '1':'0';

    // Check if email already exists
    $check_email_query = "SELECT email FROM users WHERE email='$email' LIMIT 1";
    $check_email_query_run = mysqli_query($con, $check_email_query);

    if(mysqli_num_rows($check_email_query_run) > 0){
        $_SESSION['message'] = "Email Already Exists";
        header('Location: add-register.php');
        exit(0);
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO users (fname, lname, email, password, role_as, status) VALUES ('$fname', '$lname', '$email', '$hashed_password', '$role_as', '$status')";
        $query_run = mysqli_query($con, $query);

        if($query_run){
            $_SESSION['message'] = "User Added Successfully";
            header('Location: view-register.php');
            exit(0);
        }
        else{
            $_SESSION['message'] = "User Not Added";
            header('Location: add-register.php');
            exit(0);
        }
    }
}

if(isset($_POST['update_user'])){
    $user_id = $_POST['user_id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $role_as = $_POST['role_as'];
    $status = $_POST['status'] == true ? '1':'0';
    $password = $_POST['password'];

    $query = "UPDATE users SET fname='$fname', lname='$lname', role_as='$role_as', status='$status' WHERE id='$user_id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run){
        if(!empty($password)){
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $update_password = "UPDATE users SET password='$hashed_password' WHERE id='$user_id' ";
            $update_password_run = mysqli_query($con, $update_password);
        }
        $_SESSION['message'] = "User Updated Successfully";
        header('Location: view-register.php');
        exit(0);
    }
    else{
        $_SESSION['message'] = "User Not Updated";
        header('Location: view-register.php');
        exit(0);
    }
}

if(isset($_POST['delete_user'])){
    $user_id = mysqli_real_escape_string($con, $_POST['delete_user']);

    $query = "DELETE FROM users WHERE id='$user_id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run){
        $_SESSION['message'] = "User Deleted Successfully";
        header('Location: view-register.php');
        exit(0);
    }
    else{
        $_SESSION['message'] = "User Not Deleted";
        header('Location: view-register.php');
        exit(0);
    }
}

//Crud category

if(isset($_POST['add_category'])){
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $description = $_POST['description'];
    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keyword = $_POST['meta_keyword'];
    $status = $_POST['status'] == true ? '1':'0';
    $navbar_status = $_POST['navbar_status'] == true ? '1':'0';

    // Check if category name already exists
    $check_name_query = "SELECT name FROM categories WHERE name='$name' LIMIT 1";
    $check_name_query_run = mysqli_query($con, $check_name_query);
    if(mysqli_num_rows($check_name_query_run) > 0){
        $_SESSION['message'] = "Category Name Already Exists";
        header('Location: add-category.php');
        exit(0);
    } else {
        $query = "INSERT INTO categories (name, slug, description, meta_title, meta_description, meta_keyword, navbar_status,status) VALUES 
        ('$name', '$slug', '$description', '$meta_title', '$meta_description', '$meta_keyword', '$navbar_status', '$status')";
        $query_run = mysqli_query($con, $query);

        if($query_run){
            $_SESSION['message'] = "Category Added Successfully";
            header('Location: view-categories.php');
            exit(0);
        }
        else{
            $_SESSION['message'] = "Category Not Added";
            header('Location: add-category.php');
            exit(0);
        }
    }
}

if(isset($_POST['update_category'])){
    $cat_id = $_POST['cat_id'];
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $description = $_POST['description'];
    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keyword = $_POST['meta_keyword'];
    $status = $_POST['status'] == true ? '1':'0';
    $navbar_status = $_POST['navbar_status'] == true ? '1':'0';

    $query = "UPDATE categories SET name='$name', slug='$slug', description='$description', meta_title='$meta_title', 
    meta_description='$meta_description', meta_keyword='$meta_keyword', navbar_status='$navbar_status', status='$status' WHERE id='$cat_id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run){
        $_SESSION['message'] = "Category Updated Successfully";
        header('Location: view-categories.php');
        exit(0);
    }
    else{
        $_SESSION['message'] = "Category Not Updated";
        header('Location: view-categories.php');
        exit(0);
    }
}

if(isset($_POST['delete_category'])){
    $category_id = mysqli_real_escape_string($con, $_POST['delete_category']);

    $query = "UPDATE categories SET status='2' WHERE id='$category_id' ";
    $query_run = mysqli_query($con, $query);

    if($query_run){
        $_SESSION['message'] = "Category Deleted Successfully";
        header('Location: view-categories.php');
        exit(0);
    }
    else{
        $_SESSION['message'] = "Category Not Deleted";
        header('Location: view-categories.php');
        exit(0);
    }
}

//Crud post
if(isset($_POST['add_post'])){
    $category_id = $_POST['category_id'];
    $user_id = $_SESSION['auth_user']['user_id'];
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $description = $_POST['description'];
    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keyword = $_POST['meta_keyword'];
    $status = $_POST['status'] == true ? '1':'0';
    $image = $_FILES['image']['name'];

    if($image != NULL){
        $image_extension = pathinfo($image, PATHINFO_EXTENSION);
        $filename = time().'.'.$image_extension;
        
    }
    $query = "INSERT INTO posts (name, slug, description, image, meta_title, meta_description, meta_keyword, status,category_id, user_id) VALUES 
    ('$name', '$slug', '$description', '$filename', '$meta_title', '$meta_description', '$meta_keyword', '$status','$category_id', '$user_id')";
    $query_run = mysqli_query($con, $query);
    if($query_run){
        if($image != NULL){
            move_uploaded_file($_FILES['image']['tmp_name'], "../uploads/posts/".$filename);
        }
        $_SESSION['message'] = "Post Added Successfully";
        header('Location: add-post.php');
        exit(0);
    }else{
        $_SESSION['message'] = "Post Not Added";
        header('Location: add-post.php');
        exit(0);
    }
}else{
    $_SESSION['message'] = "Something Went Wrong";
    header('Location: add-post.php');
    exit(0);
}
?>