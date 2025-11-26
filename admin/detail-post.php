<?php
include('authentication.php');
include('includes/header.php');
?>

<div class="container">
  <div class="page-inner">
    <div class="page-header">
      <h3 class="fw-bold mb-3">Review Post</h3>
      <ul class="breadcrumbs mb-3">
        <li class="nav-home">
          <a href="index.php">
            <i class="icon-home"></i>
          </a>
        </li>
        <li class="separator">
          <i class="icon-arrow-right"></i>
        </li>
        <li class="nav-item">
          <a href="review-posts.php">Review Posts</a>
        </li>
        <li class="separator">
          <i class="icon-arrow-right"></i>
        </li>
        <li class="nav-item">
          <a href="#">Detail Post</a>
        </li>
      </ul>
    </div>
    <div class="row">
      <div class="col-md-12">
        <?php include('../message.php') ?>
        <div class="card">
          <div class="card-header">
            <div class="card-title">Post Details</div>
          </div>
          <div class="card-body">
            <?php
            if (isset($_GET['id'])) {
              $post_id = $_GET['id'];
              $post = "SELECT posts.*, categories.name as category_name 
                                     FROM posts 
                                     JOIN categories ON posts.category_id = categories.id 
                                     WHERE posts.id='$post_id' LIMIT 1";
              $post_run = mysqli_query($con, $post);
              if (mysqli_num_rows($post_run) > 0) {
                $post_data = mysqli_fetch_assoc($post_run);
                ?>
                <div class="row">
                  <div class="col-md-12 col-lg-12">
                    <form action="code.php" method="POST">
                      <input type="hidden" name="post_id" value="<?= $post_data['id']; ?>">

                      <div class="form-group">
                        <label for="name" class="fw-bold">Name</label>
                        <p class="form-control-static"><?= $post_data['name']; ?></p>
                      </div>

                      <div class="form-group">
                        <label for="category" class="fw-bold">Category</label>
                        <p class="form-control-static"><?= $post_data['category_name']; ?></p>
                      </div>

                      <div class="form-group">
                        <label class="fw-bold">Image</label>
                        <br>
                        <?php if (!empty($post_data['image'])): ?>
                          <img src="../uploads/posts/<?= $post_data['image']; ?>" width="300px"
                            class="mt-2 img-fluid rounded">
                        <?php else: ?>
                          <p>No Image</p>
                        <?php endif; ?>
                      </div>

                      <div class="form-group">
                        <label for="description" class="fw-bold">Content</label>
                        <div class="border p-3 bg-light">
                          <?= $post_data['description']; ?>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="fw-bold">Status</label>
                        <p>
                          <?= $post_data['status'] == 0 ? "<span class='badge badge-warning'>Not Approve</span>" : "<span class='badge badge-success'>Approved</span>" ?>
                        </p>
                      </div>

                      <div class="card-action">
                        <?php if ($post_data['status'] == 0): ?>
                          <button type="submit" name="approve_post" class="btn btn-success">
                            <i class="fa fa-check"></i> Approve
                          </button>
                        <?php endif; ?>

                        <button type="submit" name="delete_post_review" class="btn btn-danger"
                          onclick="return confirm('Bạn có chắc chắn muốn xóa bài viết này?');">
                          <i class="fa fa-trash"></i> Delete
                        </button>

                        <a href="review-posts.php" class="btn btn-secondary">Cancel</a>
                      </div>
                    </form>
                  </div>
                </div>
                <?php
              } else {
                echo "<h4>No Such Id Found</h4>";
              }
            } else {
              echo "<h4>No Id Given</h4>";
            }
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
include('includes/footer.php');
include('includes/script.php');
?>