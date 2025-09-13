<!DOCTYPE html>
<head>
    <title>Modify Machine/Game</title>
    <link rel="stylesheet" type="text/css" href="../css/adminModifystyle.css">
</head>
<body>

    <h1>Welcome <?= htmlspecialchars($username) ?></h1>

    <h2>Select a Machine or Game to Modify</h2>

    <h3>Games</h3>
    <form action="adminModify.php" method="GET">
        <label for="gameId">Select a Game:</label>
        <select name="gameId" required>
            <option value="">-----------≽ܫ≼≽ܫ≼-----------</option>
            <?php foreach ($games as $gameItem): ?>
                <option value="<?= $gameItem->gameId ?>"><?= htmlspecialchars($gameItem->title) ?></option>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="Modify Game">
    </form>

    <h3>Machines</h3>
    <form action="adminModify.php" method="GET">
        <label for="machineId">Select a Machine:</label>
        <select name="machineId" required>
            <option value="">------------------------≽ܫ≼≽ܫ≼------------------------</option>
            <?php foreach ($machines as $machineItem): ?>
                <option value="<?= $machineItem->machineId ?>"><?= htmlspecialchars($machineItem->machineName) ?></option>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="Modify Machine">
    </form>

    <?php if (isset($machine)): ?>
        <h2>Modify Machine: <?= htmlspecialchars($machine->machineName) ?></h2>
        <form action="adminModify.php" method="GET"> 
            <input type="hidden" name="machineId" value="<?= $machine->machineId ?>">

            <label for="machineName">Machine Name:</label>
            <input name="machineName" value="<?= htmlspecialchars($machine->machineName) ?>" required><br>

            <label for="company">Company:</label>
            <input name="company" value="<?= htmlspecialchars($machine->company) ?>" required><br>

            <label for="yearOfRelease">Year of Release:</label>
            <input name="yearOfRelease" value="<?= htmlspecialchars($machine->yearOfRelease) ?>" pattern="\d{4}" required><br>

            <label for="ramSize">RAM Size:</label>
            <input name="ramSize" value="<?= htmlspecialchars($machine->ramSize) ?>" required><br>

            <label for="bitSize">Bit Size:</label>
            <input name="bitSize" value="<?= htmlspecialchars($machine->bitSize) ?>" required><br>

            <input type="submit" value="Update Machine">

            <?php if ($machineStatus): ?>
                <p style="color: green;"><?= htmlspecialchars($machineStatus) ?></p>
            <?php endif; ?>
        </form>
    <?php endif; ?>


    <?php if (isset($game)): ?>
        <h2>Modify Game: <?= htmlspecialchars($game->title) ?></h2>

        <?php if ($gameStatus): ?>
            <p style="color: green;"><?= htmlspecialchars($gameStatus) ?></p>
        <?php endif; ?>
        
        <form action="adminModify.php" method="GET">
            <input type="hidden" name="gameId" value="<?= $game->gameId ?>">

            <label for="title">Game Title:</label>
            <input name="title" value="<?= htmlspecialchars($game->title) ?>" required><br>

            <label for="publisher">Publisher:</label>
            <input name="publisher" value="<?= htmlspecialchars($game->publisher) ?>" required><br>

            <label for="genre">Genre:</label>
            <input name="genre" value="<?= htmlspecialchars($game->genre) ?>" required><br>

            <?php $selectedMachineIds = getAllPlatformsId($gameId);?>

            <label for="machineIds">Select Platforms:</label><br>
            <?php foreach ($machines as $machine): ?>
                <input type="checkbox" name="machineIds[]" value="<?= $machine->machineId ?>"
                <?= in_array((int)$machine->machineId, $selectedMachineIds) ? 'checked' : '' ?>>
                <?= htmlspecialchars($machine->machineName) ?><br>
            <?php endforeach; ?>

            <label for="rating">Rating:</label>
            <input name="rating" value="<?= htmlspecialchars($game->rating) ?>" type="number" step="0.1" min="0" max="10" required><br>

            <input type="submit" value="Update Game">
        </form>
    <?php endif; ?>

    <h1></h1>

    <div class="btns">
        <a href="../controller/gamelist.php"><button>Games List</button></a>
        <a href="../controller/machinelist.php"><button>Machines List</button></a>
        <a href="../controller/adminOptions.php"><button>Back</button></a>
    </div>

</body>
</html>







