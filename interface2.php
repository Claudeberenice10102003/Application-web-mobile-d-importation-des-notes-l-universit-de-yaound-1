
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
        <h1>Importation avancée de fichiers Excel</h1>

        

<form id="formImportation" enctype="multipart/form-data">
    <label for="fichier_excel">Sélectionnez un fichier Excel :</label>
    <input type="file" id="fichier_excel" name="fichier_excel" accept=".xls, .xlsx">
    
    <div class="pull-right">
								<a
									href=""
									class="btn btn-primary btn-sm scroll-click"
									rel="content-y"
									data-toggle="collapse"
									role="button"
                                    onclick="importerFichier()"
									><i class="fa fa-code"></i> Importer</a
								>
							</div>
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






                   
