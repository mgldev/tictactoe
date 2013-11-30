<?php

namespace Mgldev\Game;

use Mgldev\Game\Board\Cell;
use Mgldev\Game\Board\Piece;

/**
 * Models a game board which can be created to a specified size
 * comprised of a collection of cells which may contain pieces
 *
 * Class Board
 * @package Mgldev\Game
 */
class Board {

    protected $cells = [];
    protected $rows = null;
    protected $cols = null;

    /**
     * Create a number board to the provided dimensions
     * @param int   $rows
     * @param int   $cols
     */
    public function __construct($rows, $cols) {

        $this->rows = $rows;
        $this->cols = $cols;
        $this->reset();
    }

    /**
     * Retrieve all cells on the board
     * @return array
     */
    public function getCells() {

        return $this->cells;
    }

    /**
     * Determine if there are any available (unoccupied by pieces) cells on the board
     * @return bool
     */
    public function hasAvailableCells() {

        $retval = false;

        for ($row = 0; $row < $this->getRowCount(); $row++) {
            for ($col = 0; $col < $this->getColumnCount(); $col++) {
                $cell = $this->getCell($row, $col);
                if ($cell->getPiece() === null) {
                    $retval = true;
                    break 2;
                }
            }
        }

        return $retval;
    }

    /**
     * Retrieve number of rows
     * @return int
     */
    public function getRowCount() {

        return $this->rows;
    }

    /**
     * Retrieve number of columns
     * @return int
     */
    public function getColumnCount() {

        return $this->cols;
    }

    /**
     * Clear / reset the board
     * @return  void
     */
    public function reset() {

        for ($row = 0; $row < $this->getRowCount(); $row++) {
            for ($col = 0; $col < $this->getColumnCount(); $col++) {
                $this->cells[$row][$col] = new Cell;
            }
        }
    }

    /**
     * Get cell on board for a given row / col
     * @param $row
     * @param $col
     * @return Cell
     */
    public function getCell($row, $col) {

        return $this->cells[$row][$col];
    }

    /**
     * Position a piece on the board
     *
     * @param Piece $piece
     * @param $row
     * @param $col
     * @return $this
     * @throws \DomainException
     */
    public function setPiece(Piece $piece, $row, $col) {

        $cell = $this->getCell($row, $col);

        if (!is_null($cell->getPiece())) {
            throw new \DomainException('Piece already in this position');
        }

        $cell->setPiece($piece);
        return $this;
    }
}