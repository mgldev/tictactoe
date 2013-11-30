<?php

namespace Mgldev\Game\Board;

class Cell {


    protected $attributes = [];
    protected $piece = null;

    public function setPiece(Piece $piece) {

        $this->piece = $piece;
    }

    public function getPiece() {

        return $this->piece;
    }

    public function setAttribute($key, $value) {

        $this->attributes[$key] = $value;
        return $this;
    }

    public function getAttribute($key) {

        $retval = null;

        if (isset($this->attributes[$key])) {
            return $this->attributes[$key];
        }

        return $retval;
    }
}