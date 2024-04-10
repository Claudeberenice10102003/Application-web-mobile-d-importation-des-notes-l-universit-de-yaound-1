<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Importation de fichiers Excel</title>
</head>
<body>
    <h1>Importation de fichiers Excel</h1>

    <form id="formImportation" enctype="multipart/form-data">
        <label for="fichier_excel">Sélectionnez un fichier Excel :</label>
        <input type="file" id="fichier_excel" name="fichier_excel" accept=".xls, .xlsx">
        <button type="button" onclick="importerFichier()">Importer</button>
    </form>

    <h2>Liste des fichiers importés :</h2>
    <ul id="listeFichiers"></ul>
    <style >
        body{
            background-image:url("accueil.jpg");

        }
        .h1{
            color:"green";
        }
        .form{
            text-align:"center";
        }
    </style>

    <script src="avancee.js"></script>
</body>
</html>
