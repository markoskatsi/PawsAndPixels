<?

class GameMachine {

    private $gameMachineId;
    private $gameId;
    private $machineId;

    function __get($name) {
        return $this->$name;
    }

    function __set($name,$value) {
        $this->$name = $value;
    }


}

?>