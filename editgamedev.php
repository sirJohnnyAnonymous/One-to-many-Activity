<?php
require_once __DIR__ . '/core/dbConfig.php';
require_once __DIR__ . '/core/models.php';

$gameDevId = filter_input(INPUT_GET, 'game_dev_id', FILTER_VALIDATE_INT);
if (!$gameDevId) {
    http_response_code(400);
    exit('A valid game developer ID is required.');
}

$gameDev = getGameDevByID($pdo, $gameDevId);
if (!$gameDev) {
    http_response_code(404);
    exit('Game developer not found.');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Edit the user!</h1>
    <form action="core/handleForms.php?game_dev_id=<?= $gameDevId ?>" method="POST">
        <p>
            <label for="firstName">First Name</label>
            <input type="text" name="firstName" value="<?= htmlspecialchars($gameDev['firstname'], ENT_QUOTES, 'UTF-8') ?>" required>
        </p>
        <p>
            <label for="firstName">Last Name</label>
            <input type="text" name="lastName" value="<?= htmlspecialchars($gameDev['lastname'], ENT_QUOTES, 'UTF-8') ?>" required>
        </p>
        <p>
            <label for="firstName">Date of Birth</label>
            <input type="date" name="dateOfBirth" value="<?= htmlspecialchars($gameDev['date_of_birth'], ENT_QUOTES, 'UTF-8') ?>" required>
        </p>
        <p>
            <label for="firstName">Specialization</label>
            <input type="text" name="specialization" value="<?= htmlspecialchars($gameDev['specialization'], ENT_QUOTES, 'UTF-8') ?>" required>
            <input type="submit" name="editGameDevBtn">
        </p>
    </form>
</body>
</html>
