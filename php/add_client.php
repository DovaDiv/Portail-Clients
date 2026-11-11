
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
        $ids = array_column($clients, "id");
        $id = empty($ids) ? 1 : max($ids) + 1;

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

    <form method="POST">

        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required>

        <br><br>

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required>

        <br><br>

        <button type="submit">Ajouter</button>

    </form>

    <a href="clients.php">Retour</a>

</body>
</html>
