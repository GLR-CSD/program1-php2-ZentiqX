<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Album Overzicht</title>
    <link rel="stylesheet" href="../public/css/simple.css">
</head>
<body>
<h1>Album Overzicht</h1>
<table>
    <tr>
        <th>ID</th>
        <th>Naam</th>
        <th>Artiesten</th>
        <th>Release Datum</th>
        <th>URL</th>
        <th>Afbeelding</th>
        <th>Prijs</th>
    </tr>
    <?php foreach ($album as $album): ?>
        <tr>
            <td><?= htmlspecialchars($album->getId()) ?></td>
            <td><?= htmlspecialchars($album->getNaam()) ?></td>
            <td><?= htmlspecialchars($album->getArtiesten()) ?></td>
            <td><?= htmlspecialchars($album->getReleaseDatum()) ?></td>
            <td><a href="<?= htmlspecialchars($album->getUrl()) ?>"><?= htmlspecialchars($album->getUrl()) ?></a></td>
            <td><img src="<?= htmlspecialchars($album->getAfbeelding()) ?>" alt="Afbeelding" width="100"></td>
            <td><?= htmlspecialchars($album->getPrijs()) ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<h2>Nieuw Album Toevoegen</h2>
<form action="toevoegen.php" method="post" enctype="multipart/form-data">
    <label for="naam">Naam:</label>
    <input type="text" id="naam" name="naam" required>
    <br>

    <label for="artiesten">Artiesten:</label>
    <input type="text" id="artiesten" name="artiesten" required>
    <br>

    <label for="release_datum">Datum:</label>
    <input type="text" id="release_datum" name="release_datum" required>
    <br>

    <label for="url">URL link:</label>
    <input type="text" id="url" name="url" required>
    <br>

    <label for="afbeelding">Afbeelding:</label>
    <input type="file" id="afbeelding" name="afbeelding" required>
    <br>

    <label for="prijs">Prijs:</label>
    <input type="text" id="prijs" name="prijs" required>
    <br>
    <button type="submit">Opslaan</button>
</form>
</body>
</html>