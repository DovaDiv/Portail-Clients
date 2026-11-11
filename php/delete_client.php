
<?php
$file = "../data/clients.json";

$clients = [];

if (file_exists($file)) {
    $clients = json_decode(file_get_contents($file), true) ?? [];
}

$id = (int) ($_GET["id"] ?? 0);

$clients = array_filter($clients, function ($client) use ($id) {
    return (int) $client["id"] !== $id;
});

$clients = array_values($clients);

file_put_contents(
    $file,
    json_encode($clients, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
);

header("Location: clients.php");
exit;
