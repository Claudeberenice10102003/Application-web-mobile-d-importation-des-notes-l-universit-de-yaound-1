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
</head>
<body>
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Dashboard</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <input class="form-control form-control-dark w-100" type="text" id="search" onkeyup="filtrer()"
           placeholder="Search" aria-label="Search">
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
                    <?php
                    require('connection.inc.php');
                    require('functions.inc.php');
                    $a = $_SESSION['id'];
                    $request=$connexion -> prepare("SELECT * FROM `ue` WHERE `id_prof`='$a'");
                    $request -> execute();
                    $resultat=$request -> fetchall();
                    printUe($resultat);
                    if (isset($_POST['btn'])) {
                        $_SESSION['ue']=$_POST['id'];
                    }
                    ?>
            </div>
        </nav>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2"> <?php echo $_SESSION['ue'] ?></h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group me-2">
                    <button type="button" id='actionButton' class="btn btn-primary" onclick="importationSimple()">Importation simple</button>
<button type="button" id='advancedImportButton' class="btn btn-primary" onclick="importationAvancee()">Importation avancée</button>

<script>
    function importationSimple() {
        // Redirection vers la page interface.php
        window.location.href = 'interface.php';
    }

    function importationAvancee() {
        // Redirection vers la page interface2.php
        window.location.href = 'interface2.php';
    }
    // Ouvrir la boîte de dialogue modale
function openModal() {
  document.getElementById('myModal').style.display = "block";
}

// Fermer la boîte de dialogue modale
function closeModal() {
  document.getElementById('myModal').style.display = "none";
}

// Fonction pour importer le fichier
function importFile() {
  var fileInput = document.getElementById('fileInput');
  var file = fileInput.files[0];
  
  if (file) {
    // Ici, vous pouvez envoyer le fichier au serveur pour l'importer dans la base de données en utilisant AJAX ou un formulaire HTML
    // Par exemple, avec AJAX :
    var formData = new FormData();
    formData.append('file', file);
    
    fetch('upload.php', {
      method: 'POST',
      body: formData
    })
    .then(response => response.text())
    .then(data => {
      // Traiter la réponse du serveur
      console.log(data);
    })
    .catch(error => {
      console.error('Erreur :', error);
    });
  } else {
    alert("Veuillez sélectionner un fichier.");
  }
}

    

    
</script>

                        <button type="button" class="btn btn-primary">Save</button>
                        <a href="./view.php" class="btn btn-outline-primary">Print</a>
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
    <td>
        <input type='number' id='inp' name='cc".$a1."' value='$a2' min='0' max='20'>
    </td>
    <td>
        <input type='number' id='inp' name='tp".$a1."' value='$a3' min='0' max='40'>
    </td>
    <td>
        <input type='number' id='inp' name='ee".$a1."' value='$a4' min='0' max='40'>
    </td>
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
    <td>
        <input type='number' id='inp' name='title' value='$a2' min='0' max='30'>
    </td>
    <td>
        <input type='number' id='inp' name='title' value='$a4' min='0' max='70'>
    </td>
</tr>";  
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $file = $_FILES['file'];
    $request=$connexion -> prepare("SELECT * FROM `importerfichier` WHERE `nom`='");
    $request -> execute();

    // Assurez-vous que le fichier est un fichier CSV ou Excel
    if ($file['type'] === 'text/csv' || $file['type'] === 'application/vnd.ms-excel' || $file['type'] === 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') {
        // Ici, vous pouvez traiter le fichier et l'importer dans la base de données
        // Par exemple :
        move_uploaded_file($file['tmp_name'], 'uploads/' . $file['name']);
        echo "Fichier importé avec succès.";
    } else {
        echo "Le format de fichier n'est pas pris en charge. Veuillez sélectionner un fichier CSV ou Excel.";
    }
} else {
   // echo "Erreur lors de l'envoi du fichier.";
}

?>
<!---<div class="container">
        <section>
            
        </section>
    </div>

     Liste des différentes importations 
    <div class="container">
        <section>
            <h2>Liste des importations</h2>
            <ul>
               // <?php
                // Ici, vous devez récupérer et afficher les importations de votre base de données
                // Pour l'instant, je vais simplement simuler quelques entrées statiques
                //$importations = array(
                    //array('nom_fichier1.xls', '2024-04-05'),
                   // array('nom_fichier2.xlsx', '2024-04-04'),
                    // Ajoutez d'autres entrées si nécessaire
                //);

                //foreach ($importations as $importation) {
                   // $nomFichier = $importation[0];
                    //$dateImportation = $importation[1];
                   // echo "<li>$nomFichier - Importé le $dateImportation ";
                    //echo "<button style='color: red;'>Sifier</button></li>";
                //}
                // ?>
            </ul>supprimer</button>";
                    echo "<button style='color: blue;'>
        </section>
    </div> ---->
    <button onclick="openModal()">Importer un fichier</button>

<div id="myModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="closeModal()">&times;</span>
    <h2>Importation de fichier</h2>
    <input type="file" id="fileInput">
    <button onclick="importFile()">Importer</button>
  </div>
</div>
<style>
  .modal {
  display: none;
  position: fixed;
  z-index: 1;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgba(0,0,0,0.4);
}

.modal-content {
  background-color: #fefefe;
  margin: 15% auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
}

.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}
.button{
  color:green;
  text-align:center;
}
.close:hover,
.close:focus {
  color: blue;
  text-decoration: none;
  cursor: pointer;
}
</style>
</tbody>


                   