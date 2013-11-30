<?php

use Mgldev\Game\Board;
use Mgldev\TicTacToe\Game as TicTacToe;
use Mgldev\Game\Board\Piece;
use Mgldev\TicTacToe\Player;

session_start();

$game = null;
$winner = null;
$draw = false;

if (isset($_SESSION['tictactoe'])) {
    $game = @unserialize($_SESSION['tictactoe']);
} else {
    $game = new TicTacToe(new Board(3,3));
    $mark = new Player('Mark', new Piece('O'));
    $mike = new Player('Mike', new Piece('X'));
    $game->addPlayer($mike)->addPlayer($mark);
    $game->restart();
    $_SESSION['tictactoe'] = @serialize($game);
}

switch(true) {

    case isset($_POST['play']):
        $player = $game->getCurrentPlayer();
        $player->move($_POST['position']['row'], $_POST['position']['col']);
        $winner = $game->getWinner();
        if (!$winner && !$game->getBoard()->hasAvailableCells()) {
            $draw = true;
            $game->restart();
        }
        $_SESSION['tictactoe'] = @serialize($game);
        break;

    case isset($_POST['restart']):
        $game->restart();
        $_SESSION['tictactoe'] = @serialize($game);
        break;
}