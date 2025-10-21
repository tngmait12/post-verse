<?php 
  $slug = $_GET["slug"] ?? '';
  $source_reaction = 'post_reactions';

  include('includes/config.php');

  $stmt = mysqli_prepare($con,'SELECT p.*, u.fname, u.lname FROM posts AS p JOIN users AS u ON p.user_id = u.id WHERE slug = ?');
  mysqli_stmt_bind_param($stmt,'s', $slug);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  $post_result = mysqli_fetch_assoc($result);
  
  $reaction_id = $post_result['id'];

  include('includes/header.php');
  
  header("single-blog.php?slug=" . urldecode($slug));
?>

<body>
<section class="blog-single">
  <div class="container sticky">
    <div class="row">
      <div class="col-lg-5 order-2 order-lg-2">
        <div id="comments-section" class="border p-2 d-flex flex-column" style="border-color: black; border-radius: 20px; border-width: 20px;">
          <?php include "section/comment.php" ?>
        </div>
      </div>
      <div class="col-lg-7 order-1 order-lg-1">
        <article class="single-blog">
          <!-- <a href="#" class="tag">Travel</a> -->
          <p class="title"><?= $post_result['name'] ?></p>
          <ul class="meta">
            <li>By <a href="about.html"><?= $post_result['lname'] . ' ' . $post_result['fname'] ?></a></li>
            <li>
              <i class="fa fa-clock-o"></i>
              <?php 
                  $created_at = strtotime($post_result['created_at']); 
                  echo date('F j, Y, H:i', $created_at);
              ?>
            </li>
            <li class="flex-fill d-flex justify-content-end align-items-top">
              <?php include('features/reaction.php'); ?>
            </li>
          </ul>
          <img src="uploads/posts/<?= $post_result['image'] ?>" width="100%" alt="banner">
          
          <div style="display: block;"><?= $post_result['description'] ?></div>
        </article>
        
      </div>
    </div>
  </div>
</section>

<style>
  input[type="radio"] {
    display: none;
  }
  div.btn_reac {
    cursor: pointer;
  }
</style>

<script>
  const status = { 'like':'bi bi-hand-thumbs-up', 'dislike':'bi bi-hand-thumbs-down'}

  document.addEventListener('click', function (e) {
    var reac_status = null
    var source_reac = null
    var reac_id = null

    btn = e.target.closest('.btn_reac')
    if (!btn) return;
    reac_id = btn.getAttribute('data-id')

    parent_div = document.querySelector('.reaction-' + btn.getAttribute('data-id'))
    if (!parent_div) return;
    source_reac = parent_div.getAttribute('data-source')

    Array.from(parent_div.getElementsByClassName('btn_reac')).forEach(function(element) {
      if (element != btn) {
        element.classList.remove('active')
      } else {
        if (element.classList.contains('active')) {
          element.classList.remove('active')
        } else {
          element.classList.add('active')
          reac_status = element.getAttribute('data-status')
        }
      }
      i_tag = element.querySelector('i')
      i_tag.className = status[element.getAttribute('data-status')]
      if (element.classList.contains('active')) {
        i_tag.className += '-fill'
      }
    })
    // send ajax request to update reaction
    const xhr = new XMLHttpRequest()
    xhr.open('POST', 'features/reaction-handle.php', true)
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
    xhr.send('reaction_id=' + reac_id + '&reaction_status=' + reac_status + '&source=' + source_reac)
    xhr.onload = function () {
      if (xhr.status === 200) {
        console.log(xhr.responseText)
      }
    }
  })
</script>

<?php include('includes/footer.php') ?>