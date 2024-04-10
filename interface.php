<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Importation de fichiers Excel</title>
</head>
<body>
    <h1>Importation de fichiers Excel</h1>

    <!-- Formulaire pour sélectionner un fichier Excel -->
    <form id="formImportation" enctype="multipart/form-data">
        <label for="fichier_excel">Sélectionnez un fichier Excel :</label>
        <input type="file" id="fichier_excel" name="fichier_excel" accept=".xls, .xlsx">
        <button type="button" onclick="importerFichier()">Importer</button>
    </form>

    <!-- Liste des fichiers importés -->
    <h2>Liste des fichiers importés :</h2>
    <ul id="listeFichiers"></ul>

    <script>
        function importerFichier() {
            var inputFichier = document.getElementById('fichier_excel');
            var fichier = inputFichier.files[0];

            if (!fichier) {
                alert("Veuillez sélectionner un fichier Excel.");
                return;
            }

            // Supposons que 'import.php' soit le script qui gère l'importation sur le serveur
            var formData = new FormData();
            formData.append('fichier_excel', fichier);

            fetch('import.js', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Ajouter le fichier à la liste des fichiers importés
                    ajouterFichierListe(data.nomFichier);
                    alert("Le fichier a été importé avec succès.");
                } else {
                    alert("Erreur lors de l'importation du fichier.");
                }
            })
            .catch(error => {
                console.error('Erreur :', error);
            });
        }

        function ajouterFichierListe(nomFichier) {
            var listeFichiers = document.getElementById('listeFichiers');
            var listItem = document.createElement('li');
            listItem.textContent = nomFichier;

            // Ajouter un bouton pour supprimer le fichier
            var boutonSupprimer = document.createElement('button');
            boutonSupprimer.textContent = 'Supprimer';
            boutonSupprimer.addEventListener('click', function() {
                // Supprimer le fichier et l'élément de la liste
                listItem.remove();
                // Envoyer une requête au serveur pour supprimer le fichier
                // Ajouter ici le code pour la suppression côté serveur
            });
            listItem.appendChild(boutonSupprimer);

            // Ajouter un bouton pour modifier le fichier
            var boutonModifier = document.createElement('button');
            boutonModifier.textContent = 'Modifier';
            boutonModifier.addEventListener('click', function() {
                // Ajouter ici le code pour la modification
                alert("Fonctionnalité de modification à implémenter.");
            });
            listItem.appendChild(boutonModifier);

            listeFichiers.appendChild(listItem);
        }
    </script>
</body>
</html>
