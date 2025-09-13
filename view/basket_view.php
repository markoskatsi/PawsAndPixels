<!doctype html>
<html>
    <head>
        <title>Basket | Paws & Pixels</title>
        <link rel="stylesheet" type="text/css" href="../css/basketstyle.css">

    </head>
    <body>
        <h1>Your Basket</h1>
        <?php if (empty($basket)): ?>
            <p class="empty">Your basket is empty.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Machine Name</th>
                        <th>Date Selected</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($basket as $item): ?>
                        <tr>
                            <td><?= $item["machineName"] ?></td>
                            <td><?=date('F d, Y', strtotime($item["slotStartTime"]))?></td>
                            <td><?=date('H:i', strtotime($item['slotStartTime'])) ?></td> 
                            <td><?=date('H:i', strtotime($item['slotEndTime'])) ?></td> 
                            <td>
                                <a href="basket.php?remove=<?= $item["machineId"]?>" class="remove">Remove</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <form method="get" action="book.php">
                <?php foreach ($basket as $item): ?>
                    <!-- hidden arrays to store the basket items information-->
                    <input type="hidden" name="machineIds[]" value="<?= $item['machineId'] ?>">
                    <input type="hidden" name="slotStartTimes[]" value="<?= $item['slotStartTime'] ?>">
                    <input type="hidden" name="slotEndTimes[]" value="<?= $item['slotEndTime'] ?>">
                <?php endforeach; ?>
                <input type="submit" value="Book Now">
            </form>
        <?php endif; ?>
        <?php if (!empty($bookingStatus)): ?>
            <p style="color: red;"><?=$bookingStatus?></p>
        <?php endif ?>
        <a href="machinelist.php" class="back">Back to Machines</a>
    </body>
</html>
