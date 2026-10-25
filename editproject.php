<?php
require_once __DIR__ . '/core/dbConfig.php';
require_once __DIR__ . '/core/models.php';

$projectId = (string) ($_GET['project_id'] ?? '');
$gameDevId = filter_input(INPUT_GET, 'game_dev_id', FILTER_VALIDATE_INT);
if ($projectId === '' || !$gameDevId) {
    http_response_code(400);
    exit('A valid project ID and game developer ID are required.');
}

$project = getProjectByID($pdo, $projectId);
if (!$project) {
    http_response_code(404);
    exit('Project not found.');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Project</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <p><a href="viewprojects.php?game_dev_id=<?= $gameDevId ?>">Back to projects</a></p>
    <h1>Edit Project</h1>
    <form action="core/handleForms.php?project_id=<?= rawurlencode($projectId) ?>&amp;game_dev_id=<?= $gameDevId ?>" method="POST">
        <p>
            <label for="projectName">Project Name</label>
            <input type="text" name="projectName" id="projectName" maxlength="50" value="<?= htmlspecialchars($project['project_name'], ENT_QUOTES, 'UTF-8') ?>" required>
        </p>
        <p>
            <label for="technologiesUsed">Technologies Used</label>
            <textarea name="technologiesUsed" id="technologiesUsed" required><?= htmlspecialchars($project['technologies_used'], ENT_QUOTES, 'UTF-8') ?></textarea>
        </p>
        <button type="submit" name="editProjectBtn">Save Changes</button>
    </form>
</body>
</html>
