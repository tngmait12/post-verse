<?php 
if(isset($_SESSION['message'])) {
    echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
            ".$_SESSION['message']."
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
    unset($_SESSION['message']);
}
?>