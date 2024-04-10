function importerFichier() {
    // Obtenez le fichier sélectionné par l'utilisateur
    var inputFichier = document.getElementById('fichier_excel');
    var fichier = inputFichier.files[0];

    // Vérifiez si un fichier a été sélectionné
    if (!fichier) {
        alert("Veuillez sélectionner un fichier Excel.");
        return;
    }

    // Vérifiez la nomenclature du fichier
    if (!verifierNomenclature(fichier.name)) {
        alert("Erreur de nomenclature du fichier. Le nom doit être au format 'nom_examen_annee.xls'.");
        return;
    }

    // Envoi du fichier au serveur
    var formData = new FormData();
    formData.append('fichier_excel', fichier);

    fetch('import.php', { // Changer import.js à import.php si c'est un script PHP
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

function verifierNomenclature(nomFichier) {
    // Vérifiez si le nom du fichier respecte la nomenclature
    var regexNomenclature = /^[a-zA-Z0-9_]+_examen_[0-9]{4}\.(xls|xlsx)$/;

    return regexNomenclature.test(nomFichier);
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
