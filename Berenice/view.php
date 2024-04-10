<?php
    require('connection.inc.php');
    require('functions.inc.php');
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Dashboard</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/dashboard/">

    

    <!-- Bootstrap core CSS -->
<link href="./css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="./fontawesome-free-6.1.1-web/css/all.min.css">
<link rel="stylesheet" href="./css/test.css">

    
    <!-- Custom styles for this template -->
    <link href="./css/dashboard.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/view.css">
  </head>
  <body>
    
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Dashboard</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <input class="form-control form-control-dark w-100" type="text" id="search" onkeyup="filtrer()" placeholder="Search" aria-label="Search">
  <div class="navbar-nav">
    <div class="nav-item text-nowrap">
      <a class="nav-link px-3" href="#">Sign out</a>
    </div>
  </div>
</header>

<div class="container-fluid">
    <main class="px-md-4">

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"><?php echo $_SESSION['ue'] ?></h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
            <button type="button" class="btn btn-outline-primary" onclick="window.print();">PDF</button>
            <button type="button" class="btn btn-outline-primary" id="exportButton">Excel (xls)</button>
          </div>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table table-striped table-sm" id="tableId">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Matricules</th>
              <th scope="col">Noms</th>
              <th scope="col">CC</th>
              <?php
                $request=$connexion -> prepare("SELECT statut FROM `ue` WHERE `id_ue`='".$_SESSION['ue']."'");
                $request -> execute();
                $resultat=$request -> fetchall();
                if ($resultat[0][0]==1) {
                  $_SESSION['tp']=true;
                  echo '<th scope="col">TP</th>';
                }
              ?>
              <th scope="col">EE</th>
            </tr>
          </thead>
          <tbody id="list">
            <?php
              $request=$connexion -> prepare("SELECT * FROM `uejoinetudiant` WHERE `id_ue`='".$_SESSION['ue']."'");
              $request -> execute();
              $resultat=$request -> fetchall();
              if($_SESSION['tp']==true){
                for ($i=0; $i < count($resultat); $i++) { 
                  $a1=$resultat[$i][1];
                  $request=$connexion -> prepare("SELECT * FROM `etudiant` WHERE `matricule`='$a1'");
                  $request -> execute();
                  $resultat2=$request -> fetchall();
                  $a11=$resultat2[0][0];
                  $a12=$resultat2[0][1];
                  $a2=$resultat[$i][2];
                  $a3=$resultat[$i][3];
                  $a4=$resultat[$i][4];
                  echo"
                  <tr>
                    <td>".($i+1)."</td>
                    <td>$a11</td>
                    <td class='No'>$a12</td>
                    <td>$a2</td>
                    <td>$a3</td>
                    <td>$a4</td>
                  </tr>";  
                }
              }
              else {
                for ($i=0; $i < count($resultat); $i++) { 
                  $a1=$resultat[$i][1];
                  $request=$connexion -> prepare("SELECT * FROM `etudiant` WHERE `matricule`='$a1'");
                  $request -> execute();
                  $resultat2=$request -> fetchall();
                  $a11=$resultat2[0][0];
                  $a12=$resultat2[0][1];
                  $a2=$resultat[$i][2];
                  $a3=$resultat[$i][3];
                  $a4=$resultat[$i][4];
                  echo"
                  <tr>
                    <td>".($i+1)."</td>
                    <td>$a11</td>
                    <td class='No'>$a12</td>
                    <td>$a2</td>
                    <td>$a4</td>
                  </tr>";  
                }
              }
            ?>
          </tbody>
        </table>
      </div>
      <p>Mr/Mm/Mlle <span><?php echo $_SESSION['name']; ?></span></p>
    </main>
</div>


    <script src="./js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">
      function exportTableToExcel(tableId) {
        // Get the table element using the provided ID
        const table = document.getElementById(tableId);

        // Extract the HTML content of the table
        const html = table.outerHTML;

        // Create a Blob containing the HTML data with Excel MIME type
        const blob = new Blob([html], {type: 'application/vnd.ms-excel'});

        // Create a URL for the Blob
        const url = URL.createObjectURL(blob);

        // Create a temporary anchor element for downloading
        const a = document.createElement('a');
        a.href = url;

        // Set the desired filename for the downloaded file
        a.download = 'table.xls';

        // Simulate a click on the anchor to trigger download
        a.click();

        // Release the URL object to free up resources
        URL.revokeObjectURL(url);
      }

      // Attach the function to the export button's click event
      document.getElementById('exportButton').addEventListener('click', function() {
        exportTableToExcel('tableId');
      });
    </script>
    <script>
      //recherche
      function filtrer() {
        var filtre, liste, ligne, cellule, texte ;
        filtre=document.getElementById('search').value.toUpperCase();
        liste=document.getElementById('list');
        ligne=document.getElementsByTagName('td');
        for (let i = 0; i < ligne.length; i++) {
          if(ligne[i].classList.contains("No")){
          cellule=ligne[i];
            if (cellule) {
              texte=cellule.innerText;
              if(texte.toUpperCase().indexOf(filtre)>-1) ligne[i].parentElement.style.display="";
            else ligne[i].parentElement.style.display="none";
            }
          }
        }
      }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dashboard.js"></script>
  </body>
</html>
