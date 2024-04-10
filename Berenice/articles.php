<?php
  $server="localhost";
  $pass="";
  $login="root";
  try{
    $connexion=new PDO("mysql:host=$server;dbname=projet",$login,$pass);
    $connexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if(isset($_POST['delete_btn'])){
        $id=$_POST['delete_id'];
        session_start();
        $_SESSION['id']=$id;
        header('Location:view.php');
    }
  }
  catch(PDOException $e){
      echo "error";
  }
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Dashboard Template · Bootstrap v5.0</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/dashboard/">
<link rel="stylesheet" href="./fontawesome-free-6.1.1-web/css/all.min.css">

    

    <!-- Bootstrap core CSS -->
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
    <link href="./css/dashboard.css" rel="stylesheet">
  </head>
  <body>
    
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Dashboard</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
  <div class="navbar-nav">
    <div class="nav-item text-nowrap">
      <a class="nav-link px-3" href="#">Sign out</a>
    </div>
  </div>
</header>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="./dash.php">
              <span data-feather="home"></span>
              Enseignants
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./addArticles.php">
              <span data-feather="file"></span>
              Add article
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="#">
              <span data-feather="file-text"></span>
              Articles
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      

      <h2>Liste des articles</h2>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col"></th>
              <th scope="col">#</th>
              <th scope="col">Noms</th>
              <th scope="col">Titre</th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody>
          <?php
              $server="localhost";
              $pass="";
              $login="root";
            try{
              $connexion=new PDO("mysql:host=$server;dbname=projet",$login,$pass);
              $connexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              $request=$connexion -> prepare("SELECT * FROM `article`");
              $request -> execute();
              $resultat=$request -> fetchall();
              for ($i=0; $i < count($resultat); $i++) { 
                $a1=$resultat[$i][0];
                $a2=$resultat[$i][1];
                $a3=$resultat[$i][2];
                echo"
                <tr>
                <td>
                  <form action='".htmlspecialchars($_SERVER['PHP_SELF'])."' method='post'>
                    <input type='hidden' name='delete_id' value='$a1'>
                    <button type='submit' name='delete_btn' style='color : #2470dc; border: none'><i class='fas fa-square-plus'></i></button>
                  </form>
                </td>
                  <td>".($i+1)."</td>
                  <td>$a2</td>
                  <td class='No'>$a3</td>
                  <td>
                    <form action='' method='post'>
                      <input type='hidden' name='edit_id' value='$a1'>
                      <button  type='submit' name='edit_btn' style='color : red; border: none'><i class='fas fa-square-xmark'></i></button>
                    </form>
                  </td>
                </tr>";  
              }
            }
            catch(PDOException $e){
              echo "error";
            }
            ?>
          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>


    <script src="./js/bootstrap.bundle.min.js"></script>

      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dashboard.js"></script>
  </body>
</html>
