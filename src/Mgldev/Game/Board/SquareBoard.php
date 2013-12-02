<?php

namespace Mgldev\Game\Board;
use Mgldev\Game\Board;

/**
 * A square board which must have equal columns and rows
 *
 * Class SquareBoard
 * @package Mgldev\Game\Board
 */
class SquareBoard extends Board {

    /**
     * Create a number board to the provided dimensions
     * @param int   $rows
     * @param int   $cols
     */
    public function __construct($rows, $cols) {

        if ($rows !== $cols) {
            throw new \InvalidArgumentException('A square board must have equal rows and columns');
        }

        parent::__construct($rows, $cols);
    }
}