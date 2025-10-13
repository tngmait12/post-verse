<?php

include('includes/config.php');

if(isset($_GET['title']))
{
    $slug = mysqli_real_escape_string($con, $_GET['title']);

    $category = "SELECT * FROM categories WHERE slug='$slug' AND status='0' LIMIT 1";
    $category_run = mysqli_query($con, $category);

    if(mysqli_num_rows($category_run) > 0)
    {
        $category_item = mysqli_fetch_array($category_run);

        $page_title = $category_item['meta_title'];
        $meta_description = $category_item['meta_description'];
        $meta_keyword = $category_item['meta_keyword'];
    }
    else
    {
        $page_title = "Category Page";
        $meta_description = "This is Category page of PHP Blog Website";
        $meta_keyword = "PHP, Blog, Website, HTML, CSS, JS, BOOTSTRAP";
    }
}
else
{
    $page_title = "Category Page";
    $meta_description = "This is Category page of PHP Blog Website";
    $meta_keyword = "PHP, Blog, Website, HTML, CSS, JS, BOOTSTRAP";
}

?>