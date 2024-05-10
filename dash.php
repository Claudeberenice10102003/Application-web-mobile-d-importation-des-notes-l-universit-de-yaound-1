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
        window.location.href = 'nouveau.php';
    }

    function importationAvancee() {
        // Redirection vers la page interface2.php
        window.location.href = 'interface2.php';
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
   <!-- Ajoutez une ligne vide à la fin du tableau pour l'ajout d'un étudiant -->
<!--<tr id="newRow">
    <td></td>
    <td><input type="text" id="newMatricule" name="newMatricule"></td>
    <td><input type="text" id="newNom" name="newNom"></td>
    <td><input type="number" id="newCC" name="newCC" min="0" max="20"></td>
    //<
        <td><input type="number" id="newTP" name="newTP" min="0" max="40"></td>
    //
    <td><input type="number" id="newEE" name="newEE" min="0" max="40"></td>
</tr> --->
<button type="button" class="btn btn-success" id="addStudent">Ajouter un étudiant</button>

<script>
    document.getElementById('addStudent').addEventListener('click', function() {
        // Créez une nouvelle ligne
        var newRow = document.createElement('tr');

        // Ajoutez les cellules pour les différentes colonnes
        newRow.innerHTML = 
        `
            <td><input type="number" name="#[]"></td>
            <td><input type="text" name="matricule[]"></td>
            <td><input type="text" name="nom[]"></td>
            <td><input type="number" name="cc[]"></td>
            <td><input type="number" name="tp[]"></td>
            <td><input type="number" name="ee[]"></td>
            `;

        // Ajoutez la nouvelle ligne à la fin du tableau
        document.getElementById('list').appendChild(newRow);
    });
</script>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $matricules = $_POST['matricule'];
    $noms = $_POST['nom'];
    $ccs = $_POST['cc'];
    $tps = $_POST['tp'];
    $ees = $_POST['ee'];

    //if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // $matricules = $_POST['matricule'];
        // $noms = $_POST['nom'];
        // $ccs = $_POST['cc'];
        // $tps = $_POST['tp'];
        // $ees = $_POST['ee'];
    
        // Assurez-vous que les tableaux ont la même taille
        if (count($matricules) === count($noms) && count($matricules) === count($ccs) && count($matricules) === count($tps) && count($matricules) === count($ees)) {
            // Bouclez sur les tableaux pour insérer chaque étudiant dans la base de données
            for ($i = 0; $i < count($matricules); $i++) {
                // Récupérez les valeurs et nettoyez-les si nécessaire
                $matricule = $matricules[$i];
                $nom = $noms[$i];
                $cc = $ccs[$i];
                $tp = $tps[$i];
                $ee = $ees[$i];
    
                // Exécutez la requête SQL INSERT
                $insertQuery = $connexion->prepare("INSERT INTO uejoinetudiant FROM soutenance (matricule, nom, cc, tp, ee) VALUES (?, ?, ?, ?, ?)");
                die(gg);
                $insertQuery->execute([$matricule, $nom, $cc, $tp, $ee]);
    
                // Vérifiez si l'insertion a réussi
                if ($insertQuery) {
                    echo "L'étudiant $nom avec le matricule $matricule a été ajouté avec succès à la base de données de soutenance.<br>";
                } else {
                    echo "Erreur lors de l'ajout de l'étudiant $nom avec le matricule $matricule à la base de données de soutenance.<br>";
                }
            }
        } else {
            echo "Les tableaux de données ne sont pas de même taille.";
        }
    }
    

    // Insérez les nouveaux étudiants dans la base de données
    //for ($i = 0; $i < count($matricules); $i++) {
        // Utilisez les valeurs de $matricules[$i], $noms[$i], $ccs[$i], $tps[$i], $ees[$i] pour insérer les données dans la base de données
        // Assurez-vous de sécuriser vos requêtes SQL contre les injections SQL
    //}

    // Affichez un message pour confirmer l'ajout des étudiants
   // echo "Les nouveaux étudiants ont été ajoutés avec succès.";
//}
?>


</tbody>


                   