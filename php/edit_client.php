
<?php
$file = "../data/clients.json";

$clients = [];

if (file_exists($file)) {
    $clients = json_decode(file_get_contents($file), true) ?? [];
}

$id = (int) ($_GET["id"] ?? 0);
$clientIndex = null;

foreach ($clients as $index => $client) {
    if ((int) $client["id"] === $id) {
        $clientIndex = $index;
        break;
    }
}

if ($clientIndex === null) {
    die("Client introuvable.");
}

$client = $clients[$clientIndex];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = trim($_POST["nom"] ?? "");
    $email = trim($_POST["email"] ?? "");

    if ($nom !== "" && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $clients[$clientIndex]["nom"] = $nom;
        $clients[$clientIndex]["email"] = $email;

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
    <title>Modifier un client</title>
</head>
<body>

    <h1>Modifier un client</h1>

    <?php if (isset($error)): ?>
        <p><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="POST">
        <label>Nom :</label>
        <input type="text" name="nom"
               value="<?= htmlspecialchars($client["nom"]) ?>" required>

        <br><br>

        <label>Email :</label>
        <input type="email" name="email"
               value="<?= htmlspecialchars($client["email"]) ?>" required>

        <br><br>

        <button type="submit">Enregistrer</button>
    </form>

    <br>
    <a href="clients.php">Retour à la liste</a>

</body>
</html>
