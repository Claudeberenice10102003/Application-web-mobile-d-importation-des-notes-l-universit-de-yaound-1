<?php $title = "Login Form";?>

<?php ob_start();?>

<div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
  <div class="container row">
    <div class="col-md-12 col-lg-6">
      <form action="../index.php?action=login" method="post">
        <h2>Sign in</h2>
        <?php 
            if(isset($_GET["message"])){
                $message = $_GET["message"];
                $badge_class = isset($_GET['type']) && $_GET['type'] === 'success' ? 'bg-success' : 'bg-danger';
                echo '<span class="badge ' . $badge_class . '">' . $message . '</span>';
            } 
        ?>
        <p>If you don’t have an account, <a href="../index.php?action=signup_page">Register here!</a></p>
        <div class="form-group">
          <div class="input-field py-4">
            <label for="matricule">Matricule</label><br>
            <input type="text" class="form-control" id="matricule" name="matricule" placeholder="entrer votre matricule" />
          </div>
          <button type="submit" class="btn btn-primary">Login</button>
        </div>
      </form>
    </div>
    <div class="col-md-12 col-lg-6 text-white d-flex justify-content-center align-items-center p-4 rounded mt-4" style="background-color: #000842;">
      <img src="assets/image/Saly-10.png" alt="Login Image" />
    </div>
  </div>
</div>

<?php $content = ob_get_clean();?>

<?php require 'layout.php'?>
