<?php
declare(strict_types=1);

include(__DIR__.'/../vendor/autoload.php');

$gameStateRepository = new \Scrabble\Domain\Persistence\GameStateRepository();
$gameState = $gameStateRepository->find();
$player = $gameState->getPlayer($_POST['player']);
$occupiedCellCoordinate = new \Scrabble\Domain\Model\Cell\CellCoordinate($_POST['cellXIndex'], $_POST['cellYIndex']);
$gameState->getPlayingField()->occupyCell(
    $occupiedCellCoordinate,
    $player,
    \strtoupper($_POST['letter'])
);
$gameState->setLastMovePlayer($player);

$findWinnerQueryHandler = new \Scrabble\Domain\API\Query\FindWinnerQuery\FindWinnerQueryHandler();
$winner = $findWinnerQueryHandler->handle(new \Scrabble\Domain\API\Query\FindWinnerQuery\FindWinnerQuery(
    $gameState->getPlayingField(),
    $occupiedCellCoordinate
));

if (null !== $winner) {
    $gameState->setWinner($winner);
}

header('location: index.php');
