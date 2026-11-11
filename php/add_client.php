
<?php
$file = "../data/clients.json";

$clients = [];

if (file_exists($file)) {
    $clients = json_decode(file_get_contents($file), true) ?? [];
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = trim($_POST["nom"] ?? "");
    $email = trim($_POST["email"] ?? "");

    if ($nom !== "" && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $id = count($clients) > 0
            ? max(array_column($clients, "id")) + 1
            : 1;

        $clients[] = [
            "id" => $id,
            "nom" => $nom,
            "email" => $email
        ];

        file_put_contents(
            $file,
            json_encode($clients, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
        );

        header("Location: clients.php");
        exit;
    }

    $error = "Veuillez saisir un nom et un email valide.";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un client</title>
</head>
<body>

    <h1>Ajouter un client</h1>

    <?php if (isset($error)): ?>
        <p><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="POST">
        <label>Nom :</label>
        <input type="text" name="nom" required>

        <br><br>

        <label>Email :</label>
        <input type="email" name="email" required>

        <br><br>

        <button type="submit">Ajouter</button>
    </form>

    <br>
    <a href="clients.php">Retour à la liste</a>

</body>
</html>
