<?php
$enseignant_identifie = true; // Mettez ici la logique d'identification de l'enseignant

if (!$enseignant_identifie) {
    die("Identification de l'enseignant échouée.");
}

// Traitement de l'importation du fichier Excel
if (isset($_FILES['fichier_excel']) && $_FILES['fichier_excel']['error'] == 0) {
    $nom_fichier = $_FILES['fichier_excel']['name'];
    $chemin_temporaire = $_FILES['fichier_excel']['tmp_name'];

    // Déplacez le fichier vers le dossier d'importation (à personnaliser)
    $dossier_importation = 'chemin/vers/dossier/importation/';
    $chemin_destination = $dossier_importation . $nom_fichier;

    if (move_uploaded_file($chemin_temporaire, $chemin_destination)) {
        // Le fichier a été importé avec succès, vous pouvez maintenant le traiter avec PHPExcel

        // Exemple de code pour lire le fichier Excel
        $excelReader = PHPExcel_IOFactory::createReader('Excel2007');
        $excel = $excelReader->load($chemin_destination);

        // Traitez le fichier Excel selon vos besoins

        // Enregistrez le nom du fichier dans la base de données
        $sql = "INSERT INTO fichiers_importes (nom_fichier) VALUES ('$nom_fichier')";
        $conn->query($sql);

        echo "Le fichier a été importé avec succès.";
    } else {
        echo "Erreur lors de l'importation du fichier.";
    }
}

// Affichage de la liste des fichiers importés
$liste_fichiers_sql = "SELECT * FROM fichiers_importes";
//$resultat = $conn->query($liste_fichiers_sql);

echo "<h2>Liste des fichiers importés :</h2>";
echo "<ul>";

while ($row = $resultat->fetch_assoc()) {
    echo "<li>" . $row['nom_fichier'] . "</li>";
}

echo "</ul>";

// Fermer la connexion à la base de données
$conn->close();
?>