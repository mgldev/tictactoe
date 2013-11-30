<?php

namespace Mgldev;

use Mgldev\Game\Player;

abstract class Game {

    protected $inGame = false;
    protected $lastPlayer = null;
    protected $players = [];

    public function addPlayer(Player $player) {

        $this->players[] = $player;
        return $this;
    }

    public function getPlayers() {

        return $this->players;
    }

    public function getCurrentPlayer() {

        if (!$this->inGame) {
            throw new \DomainException('Game not started');
        }

        $retval = array_shift($this->getPlayers());

        if (!is_null($this->lastPlayer)) {
            $retval = $this->lastPlayer === $this->getPlayers()[0] ? $this->getPlayers()[1] : $this->getPlayers()[0];
        }

        $this->lastPlayer = $retval;

        return $retval;
    }

    public function restart() {

        if (count($this->players) !== 2) {
            throw new \DomainException('2 players are needed');
        }

        $this->lastPlayer = null;
        $this->inGame = true;
    }

    public abstract function getWinner();
}