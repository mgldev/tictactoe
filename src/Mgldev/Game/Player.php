<?php

namespace Mgldev\Game;
use Mgldev\Game;

abstract class Player {

    protected $name = null;
    protected $game = null;

    public function setName($name) {

        $this->name = $name;
    }

    public function getName() {

        return $this->name;
    }

    public function setGame(Game $game) {

        $this->game = $game;
    }

    public function getGame() {

        return $this->game;
    }
}