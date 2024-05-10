
<?php

require('./SpreadsheetReader_XLS.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $file = $_FILES['file'];

    // Chemin où enregistrer le fichier Excel
    $uploadDir = 'uploads/';
    $uploadFile = $uploadDir . basename($file['name']);

    if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
        try {
            // Créer une instance de la classe SpreadsheetReader_XLS
            $xlsReader = new SpreadsheetReader_XLS($uploadFile);


            $sheets = $xlsReader->Sheets();


            
            // Vérifie si une erreur s'est produite lors de l'ouverture du fichier
            if ($xlsReader->Error) {
                
                throw new Exception('Une erreur s\'est produite lors de l\'ouverture du fichier Excel.');
            }

            // Parcours des feuilles du classeur
        
            foreach ($sheets as $sheetName) {
                // Changer de feuille si nécessaire
                $xlsReader->ChangeSheet($sheetName);

                // Parcours des lignes de la feuille
                foreach ($xlsReader as $row) {
                    // Traitement de chaque ligne
                    // $row contient les données de la ligne actuelle
                    // Par exemple : enregistrement des données dans une base de données
                    // ou affichage des données sur une page web
                }
            }

            echo 'Importation du fichier Excel réussie.';
        } catch (Exception $e) {
            // Gestion des erreurs
            echo 'Erreur : ' . $e->getMessage();
        }
    } else {
        echo 'Erreur lors de l\'enregistrement du fichier.';
    }
} else {
    echo 'Aucun fichier n\'a été téléchargé.';
}
?>
