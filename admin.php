<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Sign in</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">

    <link href="./css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    <!-- Custom styles for this template -->
    <link href="./css/signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
    <main class="form-signin">
      <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
        <img class="mb-4" src="univ.jpg" alt="" width="72" height="57">
        <h1 class="h3 mb-3 fw-normal">Please log in</h1>

        <div class="form-floating">
          <input type="text" name="identifiant" class="form-control" id="floatingInput" placeholder="name@example.com">
          <label for="floatingInput">Identifiant</label>
        </div>
        <div class="form-floating">
          <input type="password" name="mdp" class="form-control" id="floatingPassword" placeholder="Password">
          <label for="floatingPassword">Mot de passe</label>
        </div>

        <div class="checkbox mb-3">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit" name="valider">Log in</button>

        <?php
          //session_start();
          require('connection.inc.php');
          require('functions.inc.php');
          
          if (isset($_POST['valider'])){
            if(!empty($_POST ['identifiant']) AND !empty($_POST['mdp'])){
                $identifiant="admin";
                $mdp_defaut="admin1234";
                $identifiant_saisi=htmlspecialchars($_POST['identifiant']);
                $mdp_saisi=htmlspecialchars($_POST['mdp']);
            
                if($identifiant_saisi==$identifiant AND $mdp_saisi==$mdp_defaut ){
                    $_SESSION['mdp']=$mdp_saisi;
                    header("Location: index_pref.php");
                    exit();
                }
                else{
                    echo "Votre mot de passe ou identifiant est incorrect";
                }
            }else{
                    echo "Remplissez tous les champs";
                }
          }
        ?>
        <p class="mt-5 mb-3 text-muted">&copy; 2023–2024</p>
      </form>
    </main>
  </body>
</html>
