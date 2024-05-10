</html>
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
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Importation</a>
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
                    
                    ?>
            </div>
        </nav>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <h1>Importation de fichiers Excel</h1>

<form id="uploadForm" enctype="multipart/form-data">
    <input type="file" id="excelFile" name="excelFile" accept=".xls,.xlsx">
   
    <div class="pull-right">
								<a
									href=""
									class="btn btn-primary btn-sm scroll-click"
									rel="content-y"
									data-toggle="collapse"
									role="button"
                                    type="submit"
									><i class="fa fa-code"></i> Importer</a
								>
							</div>
</form>

<h2>Liste des fichiers importés dns le dossier de validation:</h2>
<?php
// Chemin du dossier à explorer
$chemin_dossier = "/uploads";

// Vérifier si le dossier existe
if (is_dir($chemin_dossier)) {
// Lire le contenu du dossier
$contenu_dossier = scandir($chemin_dossier);

 //Afficher le contenu du dossier
echo "<h2>Contenu du dossier :</h2>";
echo "<ul>";
foreach ($contenu_dossier as $element) {
    // Exclure les éléments "." et ".."
    if ($element != "." && $element != "..") {
        echo "<li>$element</li>";
    }
}
echo "</ul>";
} else {
echo "Le dossier spécifié n'existe pas.";
}

// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=soutenance;port=3307', 'root', 'berenice');

// Dossier où les fichiers uploadés seront stockés
$uploadDir = 'uploads/';

if (isset($_FILES['fichier']) && !empty($_FILES['fichier']['name'])) {
    $nomFichier = $_FILES['fichier']['name'];
    $cheminFichier = $uploadDir . $nomFichier;

    // Déplacer le fichier uploadé dans le dossier de destination
    if (move_uploaded_file($_FILES['fichier']['tmp_name'], $cheminFichier)) {
        // Obtenez la date actuelle
        $dateActuelle = date('Y-m-d H:i:s');

        // Insérer les détails du fichier dans la base de données avec la date actuelle
        $stmt = $pdo->prepare("INSERT INTO importerfichier (nom, Date) VALUES (?, ?)");
        $stmt->execute([$nomFichier, $dateActuelle]);

        echo "Le fichier a été téléchargé avec succès.";
    } else {
        echo "Erreur lors du téléchargement du fichier.";
    }
} else {
    echo "Aucun fichier n'a été téléchargé.";
}

?>







<div id="status"></div>


<script>
    document.getElementById('uploadForm').addEventListener('submit', function(event) {
        event.preventDefault();

        var form = this;
        var fileInput = document.getElementById('excelFile');
        var file = fileInput.files[0];

        if (!file) {
            alert('Veuillez sélectionner un fichier Excel.');
            return;
        }

        // Créer un objet FormData pour envoyer le fichier via XMLHttpRequest
        var formData = new FormData();
        formData.append('file', file);

        // Envoyer la requête Ajax à importer_fichier.php
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'importer_fichier.php', true);

        xhr.onload = function() {
            if (xhr.status === 200) {
                // Afficher le statut de l'importation
                document.getElementById('status').innerText = xhr.responseText;
                // Réinitialiser le formulaire après l'importation
                form.reset();
            } else {
                // Gérer les erreurs éventuelles
                alert('Erreur lors de l\'importation du fichier.');
            }
        };

        xhr.send(formData);
    });
</script>


</html>






                   
