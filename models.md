<?php
function insertGameDev($pdo, $firstname, $lastname, $dateOfBirth, $specialization)
{
    $sql = 'INSERT INTO game_dev (firstname, lastname, date_of_birth, specialization)
            VALUES (?, ?, ?, ?)';
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$firstname, $lastname, $dateOfBirth, $specialization]);
}

function getAllGameDevs($pdo)
{
    $stmt = $pdo->query('SELECT * FROM game_dev ORDER BY game_dev_id');
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getGameDevByID($pdo, $gameDevId)
{
    $stmt = $pdo->prepare('SELECT * FROM game_dev WHERE game_dev_id = ?');
    $stmt->execute([$gameDevId]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function updateGameDev($pdo, $firstname, $lastname, $dateOfBirth, $specialization, $gameDevId)
{
    $sql = 'UPDATE game_dev
            SET firstname = ?, lastname = ?, date_of_birth = ?, specialization = ?
            WHERE game_dev_id = ?';
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$firstname, $lastname, $dateOfBirth, $specialization, $gameDevId]);
}

function deleteGameDev($pdo, $gameDevId)
{
    $stmt = $pdo->prepare('DELETE FROM game_dev WHERE game_dev_id = ?');
    return $stmt->execute([$gameDevId]);
}

function getProjectsByGameDev($pdo, $gameDevId)
{
    $sql = "SELECT game_project.game_project_id AS project_id,
                   game_project.project_name,
                   game_project.technologies_used,
                   game_project.date_added,
                   CONCAT(game_dev.firstname, ' ', game_dev.lastname) AS project_owner
            FROM game_project
            JOIN game_dev ON game_project.game_dev_id = game_dev.game_dev_id
            WHERE game_project.game_dev_id = ?
            ORDER BY game_project.date_added DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$gameDevId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function insertProject($pdo, $projectName, $technologiesUsed, $gameDevId)
{
    $sql = 'INSERT INTO game_project
                (game_project_id, project_name, technologies_used, game_dev_id)
            VALUES (?, ?, ?, ?)';
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([
        bin2hex(random_bytes(16)),
        $projectName,
        $technologiesUsed,
        $gameDevId
    ]);
}

function getProjectByID($pdo, $projectId)
{
    $sql = "SELECT game_project.game_project_id AS project_id,
                   game_project.project_name,
                   game_project.technologies_used,
                   game_project.date_added,
                   CONCAT(game_dev.firstname, ' ', game_dev.lastname) AS project_owner
            FROM game_project
            JOIN game_dev ON game_project.game_dev_id = game_dev.game_dev_id
            WHERE game_project.game_project_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$projectId]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function updateProject($pdo, $projectName, $technologiesUsed, $projectId)
{
    $sql = 'UPDATE game_project
            SET project_name = ?, technologies_used = ?
            WHERE game_project_id = ?';
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$projectName, $technologiesUsed, $projectId]);
}

function deleteProject($pdo, $projectId)
{
    $stmt = $pdo->prepare('DELETE FROM game_project WHERE game_project_id = ?');
    return $stmt->execute([$projectId]);
}
