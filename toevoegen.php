<?php
require 'classes/Album.php'; // Zorg ervoor dat je Album klasse correct is gedefinieerd

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $naam = $_POST['naam'] ?? '';
    $artiesten = $_POST['artiesten'] ?? '';
    $release_datum = $_POST['release_datum'] ?? '';
    $url = $_POST['url'] ?? '';
    $afbeelding = $_FILES['afbeelding']['name'] ?? '';
    $prijs = $_POST['prijs'] ?? '';

    // Verplaats het geüploade bestand naar een map
    if ($afbeelding) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["afbeelding"]["name"]);
        move_uploaded_file($_FILES["afbeelding"]["tmp_name"], $target_file);
    }

    // Maak een nieuw album object en sla deze op in de database
    $album = new Album(null, $naam, $artiesten, $release_datum, $url, $afbeelding, $prijs);
    $album->save($db); // Geef de databaseverbinding door aan de save-methode

    // Redirect naar de hoofdpagina om het opgeslagen album te tonen
    header('Location: index.php');
    exit;
}
