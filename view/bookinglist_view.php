<!doctype html>
<html>
    <head>
        <title>Your Bookings</title>
        <link rel="stylesheet" type="text/css" href="../css/bookingliststyle.css">
    </head>
    <body>
        <h1>Your Bookings</h1>

        <div><a href="machinelist.php" class="machines">Book a Machine</a></div>
        <div class="logout"><a href="logout.php" class="logout">Logout</a></div>

        <?php if (empty($results)): ?>
            <p style="color: red;">You currently have no bookings.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Machine</th>
                        <th>Date</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($results as $booking): ?>
                    <tr>
                        <td><?=$booking->machineName?></td>
                        <td><?= date('F d, Y', strtotime($booking->slotStartTime)) ?></td>
                        <td><?= date('H:i', strtotime($booking->slotStartTime)) ?></td>
                        <td><?= date('H:i', strtotime($booking->slotEndTime)) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </body>
</html>


