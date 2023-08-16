<?php
declare(strict_types=1);

include(__DIR__.'/../vendor/autoload.php');

$gameStateRepository = new \Scrabble\Domain\Persistence\GameStateRepository();

$players = [];

for ($player = 1; $player <= $_POST['playersAmount']; $player++) {
    $players[] = new Scrabble\Domain\Model\Player\Player((string) $player);
}

$gameState = new \Scrabble\Domain\Model\Game\GameState(
    new \Scrabble\Domain\Model\PlayingField\PlayingField(),
    $players
);

$gameStateRepository->save($gameState);

header('location: index.php');
