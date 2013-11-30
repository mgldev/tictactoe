<?php

namespace Mgldev\Game\Board;
use Mgldev\Game\Player;

class Piece {

    protected $symbol = null;
    protected $player = null;

    public function __construct($symbol) {

        $this->setSymbol($symbol);
    }

    public function setPlayer(Player $player)
    {
        $this->player = $player;
    }

    public function getPlayer()
    {
        return $this->player;
    }

    public function setSymbol($symbol)
    {
        $this->symbol = $symbol;
    }

    public function getSymbol()
    {
        return $this->symbol;
    }
}