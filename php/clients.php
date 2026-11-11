
<?php
$file = "../data/clients.json";

$clients = [];

if (file_exists($file)) {
    $clients = json_decode(file_get_contents($file), true) ?? [];
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des clients</title>
</head>
<body>

    <h1>Liste des clients</h1>

    <a href="add_client.php">Ajouter un client</a>

    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>

        <?php foreach ($clients as $client): ?>
        <tr>
            <td><?= htmlspecialchars($client['id']) ?></td>
            <td><?= htmlspecialchars($client['nom']) ?></td>
            <td><?= htmlspecialchars($client['email']) ?></td>
            <td>
                <a href="edit_client.php?id=<?= $client['id'] ?>">Modifier</a>
                |
                <a href="delete_client.php?id=<?= $client['id'] ?>">Supprimer</a>
            </td>
        </tr>
        <?php endforeach; ?>

    </table>

    <br>
    <a href="../index.html">Retour à l'accueil</a>

</body>
</html>
