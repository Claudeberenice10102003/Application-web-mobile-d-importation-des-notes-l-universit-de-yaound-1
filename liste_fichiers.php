<?php

// Répertoire où sont stockés les fichiers importés
$repertoire = 'uploads/';

// Vérifier si le répertoire existe
if (!is_dir($repertoire)) {
    echo json_encode(array('error' => 'Le répertoire des fichiers importés n\'existe pas'));
    exit;
}

// Obtenir la liste des fichiers dans le répertoire
$fichiers = array_diff(scandir($repertoire), array('..', '.'));

// Envoyer la liste de fichiers au format JSON
echo json_encode($fichiers);
