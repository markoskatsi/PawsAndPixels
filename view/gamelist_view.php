<!doctype html>
<html>
    <head>
        <title>Games | Paws & Pixels</title>
        <link rel="stylesheet" type="text/css" href="../css/gameliststyle.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script type="text/javascript" src="../js/clientcode.js"></script>
    </head>
    <body>
        <h1>Paws & Pixels</h1>
        <form method="GET" action="gamelist.php">
            Search for game:
            <input name="search" placeholder="Search by title or genre" autocomplete="off"/>
            <input type="submit" value="Search"/>
            <div id="autocomplete-results" class="autocomplete-results"></div>
        </form>
        

        <a href="../controller/logout.php" id="logout">
            <button>Log Out</button>
        </a>

        <div class="buttons">
            <?php if ($user["admin"] == 1): ?>
                <a href="../controller/adminOptions.php" id="update">Admin Options</a>
            <?php endif ?>
            <a href="../controller/machinelist.php" id="book">Book a Machine</a>
        </div>


        <h2>Welcome <?=$username?></h2>
        <table>
            <thead>
                <tr>
                    <th>Game Title</th>
                    <th>Supported Platform(s)</th>
                    <th>Publisher(s)</th>
                    <th>Genre</th>
                    <th>Rating (Out of 10)</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($results as $game): ?>
                <tr>
                    <td><?=$game->title?></td>
                    <td>
                        <?php $platforms = getAllPlatformsName($game->gameId);
                            foreach ($platforms as $platform): ?>
                                <li><?=$platform->machineName?><br></li>
                        <?php endforeach; ?></td>
                    <td><?=$game->publisher?></td>
                    <td><?=$game->genre?></td>
                    <td><?=$game->rating?></td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </body>
</html>
