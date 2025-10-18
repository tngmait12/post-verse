<!DOCTYPE html>
<html lang="zxx">

<head>
  <meta charset="utf-8" />
  <!-- <title>Blogge | Personal Blog Site</title> -->
  <title><?php if(isset($page_title)) echo "$page_title"; else {echo "PostVerse Blog Website";} ?></title>
  <meta name="description" content="<?php if(isset($meta_description)) {echo "$meta_description";} ?>" />
  <meta name="keyword" content="<?php if(isset($meta_keyword)) {echo "$meta_keyword";} ?>" />
  <meta name="author" content="Blue" />

  <!--Meta For No Index-->
  <meta name="robots" content="noindex, Nofollow, Noimageindex">

  <!-- mobile responsive meta -->
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

  <!-- Theme Stylesheet -->
  <link href="css/style.css" rel="stylesheet" />

  <!--Favicon-->
  <link rel="shortcut icon" href="images/favicon.svg" type="image/x-icon" />
  <link rel="icon" href="images/favicon.svg" type="image/x-icon" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

</head>

<body>
  <?php include('includes/navbar.php'); ?>