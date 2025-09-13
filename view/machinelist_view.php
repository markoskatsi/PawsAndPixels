<!doctype html>
<html>
    <head>
        <title>Paws & Pixels</title>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script type="text/javascript" src="../js/clientcode_machines.js"></script>
        <link rel="stylesheet" href="../css/machineliststyle.css">
    </head>
    <body>
        <h1>Book A Machine</h1>
        <form method="get" action="machinelist.php" id="searchForm">
            Search for machine:
            <input name="search" placeholder="Search by machine name" value="<?=($_GET['search'] ?? '') ?>" autocomplete="off"/>
            <input type="submit" value="Search"/>
            <div id="autocomplete-results" class="autocomplete-results"></div>
        </form>
        <a href="../controller/logout.php" id="logout"><button>Log Out</button></a>
        <div class="navbtns">
            <?php if (isset($user) && $user["admin"] == 1): ?>
                <a href="../controller/adminOptions.php" id="update">Admin Options</a>
            <?php endif ?>
            <a href="gamelist.php" class="navbtn">Back</a>
            <a href="basket.php" class="navbtn">Basket</a>
            <a href="bookinglist.php" class="navbtn">View Bookings</a>
        </div>

        <h2>Welcome <?= htmlspecialchars($_SESSION['username'] ?? '') ?></h2>

        <table>
            <thead>
                <tr>
                    <th>Machine Name</th>
                    <th>Company</th>
                    <th>Year Released</th>
                    <th>RAM Size</th>
                    <th>Bit Size</th>
                    <th>Available Time Slots</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($results as $machine): ?>
                   <tr>
                        <td><?=$machine->machineName ?></td>
                        <td><?=$machine->company?></td>
                        <td><?=$machine->yearOfRelease?></td>
                        <td><?=$machine->ramSize?></td>
                        <td><?=$machine->bitSize?></td>
                        <td>
                            <form method="get" action="basket.php" class="bookingForm">
                                <input type="hidden" name="addToBasket" value="<?= $machine->machineId ?>">
                                
                                <label for="date_<?= $machine->machineId ?>">Select Date:</label>
                                <input type="date" name="date" id="date_<?= $machine->machineId ?>" value="<?= htmlspecialchars($_GET['date'] ?? '') ?>" required>
                                
                                <div class="timeSlots">
                                    <label>Select Time Slots:</label><br>
                                    <?php foreach ($timeSlots as $slot): ?>
                                        <label class="timeSlotOptions">
                                            <input type="checkbox" name="slot[]" value="<?= htmlspecialchars($slot) ?>">
                                            <?= htmlspecialchars($slot) ?>
                                        </label><br>
                                    <?php endforeach; ?>
                                </div>
                            
                                <input type="submit" value="Add to Basket">
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </body>
</html>


