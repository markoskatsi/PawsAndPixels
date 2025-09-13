<?php

require_once "../model/user.php";
require_once "../model/machine.php";

$pdo = new PDO(
    "mysql:host=localhost;dbname=db_k2328632",
    "k2328632",
    "ewaejaez",
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
);

function isSlotAvailable($machineId, $startTime, $endTime) {
    global $pdo;
    $statement = $pdo->prepare("SELECT COUNT(*) FROM bookingMachine 
                          WHERE machineId = ? 
                          AND slotStartTime = ? 
                          AND slotEndTime = ?");
    $statement->execute([$machineId, $startTime, $endTime]);
    $results = $statement->fetchColumn() == 0;
    return $results;
}

function addGame($game)
{
    global $pdo;
    $statement = $pdo->prepare("INSERT INTO games
    (title, publisher, genre, rating) VALUES (?,?,?,?)");
    $statement->execute(
        [
            $game->title,
            $game->publisher,
            $game->genre,
            $game->rating,
        ]
    );
    return $pdo->lastInsertId();
}

function addBooking($booking) {
    global $pdo;
    $statement = $pdo->prepare("INSERT INTO bookings (userId, bookingDate) VALUES (?, ?)");
    $statement->execute(
        [
            $booking->userId, 
            $booking->bookingDate
            ]
        );
    return $pdo->lastInsertId();
}

function addBookingMachine($bookingMachine) {
    global $pdo;
    $statement = $pdo->prepare("INSERT INTO bookingMachine 
        (bookingId, machineId, slotStartTime, slotEndTime) 
        VALUES (?, ?, ?, ?)");
    $statement->execute([
        $bookingMachine->bookingId,
        $bookingMachine->machineId,
        $bookingMachine->slotStartTime,
        $bookingMachine->slotEndTime
    ]
);
}



function addUser($user)
{
    global $pdo;
    $statement = $pdo->prepare("INSERT INTO users
    (username, password, email) VALUES (?,?,?)");
    $statement->execute(
        [
            $user->username,
            $user->password,
            $user->email,
        ]
    );
}

function addMachine($machine)
{
    global $pdo;
    $statement = $pdo->prepare("INSERT INTO machines
    (machineName, company, yearOfRelease, ramSize, bitSize) VALUES (?,?,?,?,?)");
    $statement->execute(
        [
            $machine->machineName,
            $machine->company,
            $machine->yearOfRelease,
            $machine->ramSize,
            $machine->bitSize,
        ]
    );
}

function getMachineById($machineId)
{
    global $pdo;
    $statement = $pdo->prepare("SELECT * FROM machines WHERE machineId = ?");
    $statement->execute([$machineId]);
    $results = $statement->fetchObject("Machine");
    return $results;
}


function updateMachine($machine)
{
    global $pdo;
    $statement = $pdo->prepare("UPDATE machines 
        SET machineName = ?, company = ?, yearOfRelease = ?, ramSize = ?, bitSize = ? 
        WHERE machineId = ?");
    $statement->execute(
        [
            $machine->machineName,
            $machine->company,
            $machine->yearOfRelease,
            $machine->ramSize,
            $machine->bitSize,
            $machine->machineId
        ]
    );
}

function getGameById($gameId)
{
    global $pdo;
    $statement = $pdo->prepare("SELECT * FROM games WHERE gameId = ?");
    $statement->execute([$gameId]);
    $results = $statement->fetchObject("Game");
    return $results;
}

function updateGame($game)
{
    global $pdo;
    $statement = $pdo->prepare("UPDATE games 
        SET title = ?, publisher = ?, genre = ?, rating = ? 
        WHERE gameId = ?");
    $statement->execute(
        [
            $game->title,
            $game->publisher,
            $game->genre,
            $game->rating,
            $game->gameId
        ]
    );
}

function getAuthorisedUsers($username)
{
    global $pdo;
    $statement = $pdo->prepare("SELECT password, admin, userId FROM users WHERE username = ?");
    $statement->execute([$username]);
    $results = $statement->fetch(PDO::FETCH_ASSOC);
    return $results;
}

function getAllMachines()
{
    global $pdo;
    $statement = $pdo->prepare("SELECT * FROM machines");
    $statement->execute();
    $results = $statement->fetchAll(PDO::FETCH_CLASS, "Machine");
    return $results;
}


function getMachinesByTitle($title)
{
    global $pdo;
    $statement = $pdo->prepare("SELECT * FROM machines WHERE machineName LIKE ?");
    $statement->execute(["%$title%"]);
    $results = $statement->fetchAll(PDO::FETCH_CLASS, "Machine");
    return $results;
}

function getUsername($username)
{
    global $pdo;
    $statement = $pdo->prepare("SELECT * FROM users WHERE username LIKE ?");
    $statement->execute([$username]);
    $results = $statement->fetchAll(PDO::FETCH_COLUMN);
    return $results;
}

function getEmail($email)
{
    global $pdo;
    $statement = $pdo->prepare("SELECT * FROM users WHERE email LIKE ?");
    $statement->execute([$email]);
    $results = $statement->fetchAll(PDO::FETCH_COLUMN);
    return $results;
}

function getAllGames()
{
    global $pdo;
    $statement = $pdo->prepare("SELECT * FROM games");
    $statement->execute();
    $results = $statement->fetchAll(PDO::FETCH_CLASS, "Game");
    return $results;
}

function getGamesByTitle($title)
{
    global $pdo;
    $statement = $pdo->prepare("SELECT * FROM games WHERE title LIKE ?");
    $statement->execute(["%$title%"]);
    $results = $statement->fetchAll(PDO::FETCH_CLASS, "Game");
    return $results;
}

function getGamesByGenre($genre)
{
    global $pdo;
    $statement = $pdo->prepare("SELECT * FROM games WHERE genre LIKE ?");
    $statement->execute(["%$genre%"]);
    $results = $statement->fetchAll(PDO::FETCH_CLASS, "Game");
    return $results;
}

function getGamesByTitleAndGenre($query)
{
    global $pdo;
    $statement = $pdo->prepare("SELECT * FROM games WHERE title LIKE ? OR genre LIKE ?");
    $statement->execute(["%$query%", "%$query%"]);
    $results = $statement->fetchAll(PDO::FETCH_CLASS, "Game");
    return $results;
}


function getAllPlatformsId($gameId) {
    global $pdo;
    $statement = $pdo->prepare("SELECT machines.machineId
                                    FROM machines, gameMachine
                                    WHERE machines.machineId = gameMachine.machineId
                                    AND gameMachine.gameId = ?");
    $statement->execute([$gameId]);
    $results = $statement->fetchAll(PDO::FETCH_COLUMN, 0); // returning an array of maching ids
    return $results;
}

function getUserBookings($userId) {
    global $pdo;
    $statement = $pdo->prepare("
        SELECT machines.machineName, 
               bookingMachine.slotStartTime, 
               bookingMachine.slotEndTime
        FROM bookingMachine
        JOIN machines ON bookingMachine.machineId = machines.machineId
        WHERE bookingMachine.bookingId IN (
            SELECT bookingId FROM bookings WHERE userId = ? )");
    $statement->execute([$userId]);
    $results = $statement->fetchAll(PDO::FETCH_CLASS, "BookingMachine");
    return $results;
}


function getAllPlatformsName($gameId) {
    global $pdo;
    $statement = $pdo->prepare("SELECT machines.machineName
                                    FROM machines, gameMachine
                                    WHERE machines.machineId = gameMachine.machineId
                                    AND gameMachine.gameId = ?");
    $statement->execute([$gameId]);
    $results = $statement->fetchAll(PDO::FETCH_CLASS, "Machine");
    return $results;
}

function addGameMachine($gameId, $machineId)
{
    global $pdo;
    $statement = $pdo->prepare("INSERT INTO gameMachine (gameId, machineId) VALUES (?, ?)");
    $results = $statement->execute([$gameId, $machineId]);
}

function removeAllGameMachine($gameId)
{
    global $pdo;
    $statement = $pdo->prepare("DELETE FROM gameMachine WHERE gameId = ?");
    $statement->execute([$gameId]);
}

function getMachineIdsForGame($gameId)
{
    global $pdo;
    $statement = $pdo->prepare("SELECT machineId FROM gameMachine WHERE gameId = ?");
    $statement->execute([$gameId]);
    $results = $statement->fetchAll(PDO::FETCH_CLASS, "GameMachine");
    return $results;
}


?>