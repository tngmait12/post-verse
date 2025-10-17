<?php
include('includes/config.php');

$page_title = "Contact Us";
$meta_description = "Get in touch with our blog team";
$meta_keyword = "contact, message, php blog";

include('includes/header.php');
?>

<section class="py-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card shadow-sm border-0">
          <div class="card-body">
            <h2 class="mb-4 text-center">Contact Us</h2>
            <p class="text-center text-muted">
              Have any questions or feedback? Fill out the form below and we’ll get back to you soon!
            </p>

            <form method="POST" action="">
              <div class="form-group mb-3">
                <label for="name">Full Name</label>
                <input type="text" name="name" id="name" class="form-control" required placeholder="Enter your full name">
              </div>
              <div class="form-group mb-3">
                <label for="email">Email Address</label>
                <input type="email" name="email" id="email" class="form-control" required placeholder="Enter your email">
              </div>
              <div class="form-group mb-3">
                <label for="message">Message</label>
                <textarea name="message" id="message" rows="4" class="form-control" required placeholder="Write your message here"></textarea>
              </div>
              <div class="text-center">
                <button type="submit" name="send_message" class="btn btn-success px-4">Send Message</button>
              </div>
            </form>

            <?php
            if (isset($_POST['send_message'])) {
              echo "<div class='alert alert-success mt-3'>Thank you! Your message has been sent successfully.</div>";
            }
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include('includes/footer.php'); ?>
