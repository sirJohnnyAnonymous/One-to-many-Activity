<?php
require_once __DIR__ . '/core/dbConfig.php';
require_once __DIR__ . '/core/models.php';

$gameDevs = getAllGameDevs($pdo);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Dev Projects</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Welcome to the Game Dev Projects Management System</h1>
    <h2>Add a game developer</h2>

    <form action="core/handleForms.php" method="POST">
        <p>
            <label for="firstName">First Name</label>
            <input type="text" name="firstName" id="firstName" required>
        </p>
        <p>
            <label for="lastName">Last Name</label>
            <input type="text" name="lastName" id="lastName" required>
        </p>
        <p>
            <label for="dateOfBirth">Date of Birth</label>
            <input type="date" name="dateOfBirth" id="dateOfBirth" required>
        </p>
        <p>
            <label for="specialization">Specialization</label>
            <input type="text" name="specialization" id="specialization" required>
        </p>
        <p>
            <button type="submit" name="insertWebDevBtn">Register Game Dev</button>
        </p>
    </form>

    <h2>Game developers</h2>
    <?php if ($gameDevs): ?>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Date of Birth</th>
                    <th>Specialization</th>
                    <th>Date Added</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($gameDevs as $gameDev): ?>
                    <tr>
                        <td><?= htmlspecialchars($gameDev['firstname'] . ' ' . $gameDev['lastname'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($gameDev['date_of_birth'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($gameDev['specialization'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($gameDev['date_added'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td>
                            <a href="viewprojects.php?game_dev_id=<?= (int) $gameDev['game_dev_id'] ?>">View Projects</a>
                            <a href="editgamedev.php?game_dev_id=<?= (int) $gameDev['game_dev_id'] ?>">Edit</a>
                            <a href="deletewebdev.php?game_dev_id=<?= (int) $gameDev['game_dev_id'] ?>">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No game developers have been added yet.</p>
    <?php endif; ?>
</body>
</html>
