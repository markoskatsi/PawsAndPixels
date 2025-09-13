<!doctype html>
<html>
  <head>
    <title>Add Machine/Game</title>
    <link rel="stylesheet" type="text/css" href="../css/adminAddstyle.css">
  </head>
  <h1>Welcome <?=$username?></h1>
  <body>

    <form action="adminAdd.php" method="post">
      <h2>Add a New Machine</h2>
      Machine Name: <input name="machineName" required/><br/>
      Company: <input name="company" required><br/>
      Year Of Release: <input name="yearOfRelease" pattern="\d{4}" required title="4 digit number"/><br/>
      Ram Size: <input name="ramSize" required/><br/>
      Bit Size: <input name="bitSize" required/><br/>
      <input type="submit" required/>
    </form>

    <?php if ($machineStatus): ?>
      <p style="color: green"><?=$machineStatus?></p>
    <?php endif ?>

    <form action="adminAdd.php" method="get">
      <?php if ($gameStatus): ?>
        <p style="color: green"><?=$gameStatus?></p>
      <?php endif ?>

      <h2>Add a New Game</h2>

      Game Name: <input name="title" required/><br/>
      Publisher: <input name="publisher" required/><br/>

      <label>Supported Platforms:</label><br/>
        <?php foreach ($machines as $machine): ?>
          <input type="checkbox" name="machineIds[]" value="<?= $machine->machineId ?>">
          <?= htmlspecialchars($machine->machineName) ?><br/>
        <?php endforeach; ?>

        Genre: <input name="genre" required/><br/>
        Rating: <input name="rating" type="number" step="0.1" min="0" max="10" required/><br/>
        <input type="submit"/>
    </form>

            
    <div class="btns">
      <a href="../controller/gamelist.php"><button>Games</button></a>
      <a href="../controller/adminOptions.php"><button>Back</button></a>
    </div>
    
  </body>
</html>