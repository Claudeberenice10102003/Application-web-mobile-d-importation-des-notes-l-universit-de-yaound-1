function importerFichier() {
    var inputFichier = document.getElementById('fichier_excel');
    var fichier = inputFichier.files[0];

    if (!fichier) {
        alert("Veuillez sélectionner un fichier Excel.");
        return;
    }

    var formData = new FormData();
    formData.append('fichier_excel', fichier);

    fetch('first1.html', { // Assurez-vous que import.php est le script qui gère l'importation sur votre serveur
       method: 'POST',
        body: formData
    })
    
   .then(response => response.json())
    .then(data => {
        if (data.success) {
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
    // Notez que cette fonction suppose que le serveur retourne une liste de fichiers au format JSON
    fetch('liste_fichiers.js') // Assurez-vous que liste_fichiers.php retourne une liste de fichiers au format JSON
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
