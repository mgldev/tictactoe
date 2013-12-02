<?php

namespace Mgldev\TicTacToe;

use Mgldev\Game\Board\Game as BoardGame;
use Mgldev\Game\Board\SquareBoard;
use Mgldev\Game\Player;

class Game extends BoardGame {

    const DIRECTION_VERTICAL = 0;
    const DIRECTION_HORIZONTAL = 1;

    public function __construct(SquareBoard $board) {

        parent::__construct($board);
    }

    /**
     * Add a player to the game, ensuring we pass the game to the player as a reference
     * @param Player $player
     * @return $this
     */
    public function addPlayer(Player $player) {

        $player->setGame($this);
        $this->players[] = $player;
        return $this;
    }

    /**
     * Chexk the board for a linear win
     *
     * @param $direction    Horizontal or vertical (see class constants)
     * @return null|Player
     */
    protected function checkLinearWin($direction) {

        $retval = null;
        $board = $this->getBoard();
        $count = $board->getColumnCount();

        for ($x = 0; $x < $count; $x++) {
            $lastPiece = null;
            $score = 0;
            $winningCells = [];
            for ($y = 0; $y < $count; $y++) {
                $posX = $x;
                $posY = $y;
                if ($direction == self::DIRECTION_VERTICAL) {
                    list($posX, $posY) = [$posY, $posX];
                }
                $cell = $board->getCell($posX, $posY);
                if (is_null($lastPiece) || $cell->getPiece() === $lastPiece) {
                    if ($lastPiece !== null) {
                        $score += (int) ($cell->getPiece() === $lastPiece);
                    }
                    $winningCells[] = $cell;
                    $lastPiece = $cell->getPiece();
                }
            }

            if ($score == ($count - 1)) {
                foreach ($winningCells as $cell) {
                    $cell->setAttribute('winner', true);
                }
                $retval = $lastPiece->getPlayer();
            }
        }

        return $retval;
    }

    /**
     * Check the board for a diagonal win
     *
     * @param bool $invert  Flip the check from \ to /
     * @return null|Player
     */
    protected function checkDiagonalWin($invert = false) {

        $retval = null;
        $board = $this->getBoard();

        $lastPiece = null;
        $score = 0;
        $winningCells = [];
        for ($x = 0; $x < $board->getRowCount(); $x++) {
            $posX = $x;
            $posY = $x;
            if ($invert) {
                $posY = ($board->getRowCount() - 1) - $posX;
            }
            $cell = $board->getCell($posX, $posY);
            if (is_null($lastPiece) || $cell->getPiece() === $lastPiece) {
                if ($lastPiece !== null && $cell->getPiece() === $lastPiece) {
                    $score ++;
                }
                $winningCells[] = $cell;
                $lastPiece = $cell->getPiece();
            }
        }

        if ($score == ($board->getRowCount() -1)) {
            foreach ($winningCells as $cell) {
                $cell->setAttribute('winner', true);
            }
            $retval = $lastPiece->getPlayer();
        }

        return $retval;
    }

    /**
     * Retrieve the winner of the game
     * @return Player
     */
    public function getWinner() {

        $retval = null;

        $retval = $this->checkLinearWin(self::DIRECTION_HORIZONTAL);
        if (!$retval) {
            $retval = $this->checkLinearWin(self::DIRECTION_VERTICAL);
            if (!$retval) {
                $retval = $this->checkDiagonalWin(false);
                if (!$retval) {
                    $retval = $this->checkDiagonalWin(true);
                }
            }
        }

        return $retval;
    }
}