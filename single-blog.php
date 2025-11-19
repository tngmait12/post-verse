<?php 
  $slug = $_GET["slug"] ?? '';
  $source_reaction = 'post_reactions';

  include('includes/config.php');

  $query = "SELECT p.*, u.fname, u.lname, c.name AS category_name 
    FROM posts AS p 
    JOIN users AS u ON p.user_id = u.id 
    JOIN categories AS c ON p.category_id = c.id 
    WHERE p.slug = ?";

  $stmt = mysqli_prepare($con, $query);
  mysqli_stmt_bind_param($stmt,'s', $slug);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  $post_result = mysqli_fetch_assoc($result);

  $source_id = $post_result['id'];

  include('includes/header.php');
  
  header("single-blog.php?slug=" . urldecode($slug));
?>

<section class="blog-single">
  <div class="container sticky">
    <div class="row">
      <div class="col-lg-5 order-2 order-lg-2">
        <div id="comments-section" class="border p-2 d-flex flex-column" 
          style="
            border-color: black; 
            border-radius: 20px; 
            border-width: 20px;"
          >
          <?php include "section/comment.php" ?>
        </div>
      </div>
      <div class="col-lg-7 order-1 order-lg-1">
        <article class="single-blog">
          <a href="#" class="tag"><?= $post_result['category_name'] ?></a>
          <p class="title"><?= $post_result['name'] ?></p>
          <ul class="meta">
            <li>By <a href="about.html"><?= $post_result['fname'] . ' ' . $post_result['lname'] ?></a></li>
            <li>
              <i class="fa fa-clock-o"></i>
              <?php 
                  $created_at = strtotime($post_result['created_at']); 
                  echo date('F j, Y, H:i', $created_at);
              ?>
            </li>
            <li class="flex-fill d-flex justify-content-end align-items-top">
              <div class="reaction-<?= $source_id ?>" data-source="<?= $source_reaction ?>">
                <?php include("features/reaction.php"); ?>
              </div>
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
  document.addEventListener('click', function (e) {
    var reac_status = null // status of reaction(like or dislike)
    var source_reac = null // name table(post_reactions or comment_reactions)
    var source_id = null // id of post or comment

    btn = e.target.closest('.btn_reac')
    if (!btn) return;
    source_id = btn.getAttribute('data-id')

    parent_div = document.querySelector('.reaction-' + source_id)
    if (!parent_div) return;
    source_reac = parent_div.getAttribute('data-source')

    reac_status = btn.getAttribute('data-status')
    console.log(source_id, reac_status, source_reac)
    
    const xhr = new XMLHttpRequest()
    xhr.open('POST', 'features/reaction-handle.php', true)
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
    xhr.send('source_id=' + source_id + '&reaction_status=' + reac_status + '&source=' + source_reac)
    xhr.onload = function () {
      if (xhr.status === 200) {
        var get_status = JSON.parse(xhr.responseText)
        
        if (!get_status || get_status.status === 'error') return;

        const xhr2 = new XMLHttpRequest()
        xhr2.open('GET', 'features/reaction.php?source=' + source_reac + '&source_id=' + source_id, true)
        xhr2.send()
        xhr2.onload = function () {
          if (xhr2.status === 200) {
            parent_div.innerHTML = xhr2.responseText
          }
        }
      }
    }
  })
</script>

<?php include('includes/footer.php') ?>