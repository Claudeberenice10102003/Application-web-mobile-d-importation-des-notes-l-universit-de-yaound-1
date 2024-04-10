function importerFichier() {
    // Obtenez le fichier sélectionné par l'utilisateur
    var inputFichier = document.getElementById('fichier_excel');
    var fichier = inputFichier.files[0];

    // Vérifiez si un fichier a été sélectionné
    if (!fichier) {
        alert("Veuillez sélectionner un fichier Excel.");
        return;
    }

    // Envoi du fichier au serveur
    var formData = new FormData();
    formData.append('fichier_excel', fichier);

    fetch('importer_fichier.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Mise à jour de la liste des fichiers importés
            afficherListeFichiers();
            alert("Le fichier a été importé avec succès.");
        } else {
            alert("Erreur lors de l'importation du fichier.");
        }
    })
    .catch(error => {
        console.error('Erreur :', error);
    });
}

function afficherListeFichiers() {
    // Récupérer la liste des fichiers importés depuis le serveur
    fetch('liste_fichiers.php')
    .then(response => response.json())
    .then(data => {
        var listeFichiers = document.getElementById('listeFichiers');
        listeFichiers.innerHTML = '';

        data.forEach(nomFichier => {
            var listItem = document.createElement('li');
            listItem.textContent = nomFichier;
            listeFichiers.appendChild(listItem);
        });
    })
    .catch(error => {
        console.error('Erreur :', error);
    });
}
