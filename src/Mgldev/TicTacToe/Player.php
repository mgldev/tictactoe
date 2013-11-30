<?php

namespace Mgldev\TicTacToe;

use Mgldev\Game\Player as BasePlayer;
use Mgldev\Game\Board\Piece;

class Player extends BasePlayer {

    protected $piece = null;

    public function __construct($name, Piece $piece) {

        $this->setName($name);
        $piece->setPlayer($this);
        $this->setPiece($piece);
    }

    public function setPiece($piece) {

        $this->piece = $piece;
    }

    public function getPiece() {

        return $this->piece;
    }

    /**
     * @return TicTacToe
     */
    public function getGame() {

        return parent::getGame();
    }

    public function move($row, $col) {

        $this->getGame()->getBoard()->setPiece($this->getPiece(), $row, $col);
        return $this;
    }
}