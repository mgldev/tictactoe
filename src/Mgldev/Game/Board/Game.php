<?php

namespace Mgldev\Game\Board;
use Mgldev\Game as BaseGame;
use Mgldev\Game\Board;

abstract class Game extends BaseGame {

    protected $board = null;

    public function __construct(Board $board) {

        $this->board = $board;
    }

    public function setBoard(Board $board) {

        $this->board = $board;
    }

    /**
     * @return Board
     */
    public function getBoard() {

        return $this->board;
    }

    public function restart() {

        parent::restart();
        $this->getBoard()->reset();
    }
}