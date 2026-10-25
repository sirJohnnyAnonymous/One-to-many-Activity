<?php
require_once __DIR__ . '/dbConfig.php';
require_once __DIR__ . '/models.php';

function redirectTo($location)
{
    header('Location: ' . $location);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Method not allowed');
}

if (isset($_POST['insertWebDevBtn'])) {
    $success = insertGameDev(
        $pdo,
        trim($_POST['firstName'] ?? ''),
        trim($_POST['lastName'] ?? ''),
        $_POST['dateOfBirth'] ?? '',
        trim($_POST['specialization'] ?? '')
    );

    if ($success) {
        redirectTo('../index.php');
    }
    exit('Unable to add game developer.');
}

if (isset($_POST['editGameDevBtn'])) {
    $success = updateGameDev(
        $pdo,
        trim($_POST['firstName'] ?? ''),
        trim($_POST['lastName'] ?? ''),
        $_POST['dateOfBirth'] ?? '',
        trim($_POST['specialization'] ?? ''),
        (int) ($_GET['game_dev_id'] ?? 0)
    );

    if ($success) {
        redirectTo('../index.php');
    }
    exit('Unable to update game developer.');
}

if (isset($_POST['deleteGameDevBtn'])) {
    $success = deleteGameDev($pdo, (int) ($_GET['game_dev_id'] ?? 0));

    if ($success) {
        redirectTo('../index.php');
    }
    exit('Unable to delete game developer.');
}

if (isset($_POST['insertNewProjectBtn'])) {
    $gameDevId = (int) ($_GET['game_dev_id'] ?? 0);
    $success = insertProject(
        $pdo,
        trim($_POST['projectName'] ?? ''),
        trim($_POST['technologiesUsed'] ?? ''),
        $gameDevId
    );

    if ($success) {
        redirectTo('../viewprojects.php?game_dev_id=' . $gameDevId);
    }
    exit('Unable to add project.');
}

if (isset($_POST['editProjectBtn'])) {
    $gameDevId = (int) ($_GET['game_dev_id'] ?? 0);
    $success = updateProject(
        $pdo,
        trim($_POST['projectName'] ?? ''),
        trim($_POST['technologiesUsed'] ?? ''),
        (string) ($_GET['project_id'] ?? '')
    );

    if ($success) {
        redirectTo('../viewprojects.php?game_dev_id=' . $gameDevId);
    }
    exit('Unable to update project.');
}

if (isset($_POST['deleteProjectBtn'])) {
    $gameDevId = (int) ($_GET['game_dev_id'] ?? 0);
    $success = deleteProject($pdo, (string) ($_GET['project_id'] ?? ''));

    if ($success) {
        redirectTo('../viewprojects.php?game_dev_id=' . $gameDevId);
    }
    exit('Unable to delete project.');
}

http_response_code(400);
exit('Unknown form submission.');
