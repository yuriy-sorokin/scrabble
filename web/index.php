<?php
declare(strict_types=1);

include(__DIR__.'/../vendor/autoload.php');

$gameStateRepository = new \Scrabble\Domain\Persistence\GameStateRepository();
$gameState = $gameStateRepository->find();

$templateVariables = [
    'variables' => ['{{ playingField }}', '{{ players }}', '{{ winner }}'],
    'replacements' => ['', '', ''],
];

if (null !== $gameState) {
    $lastPlayerId = $gameState->getLastMovePlayer() ? (int) $gameState->getLastMovePlayer()->getId() : 0;
    $playingFieldDrawer = new \Scrabble\Application\Browser\View\PlayingFieldDrawer\PlayingFieldDrawer();
    $templateVariables['replacements'][0] = $playingFieldDrawer->draw($gameState->getPlayingField());

    $players = [];

    foreach ($gameState->getPlayers() as $player) {
        $selected = '';

        if ($lastPlayerId + 1 === (int) $player->getId()) {
            $selected = ' selected';
        }

        $players[] = \sprintf(
            '<option value="%s"%s>%s</option>',
            $player->getId(),
            $selected,
            $player->getId(),
        );
    }

    $templateVariables['replacements'][1] = \implode('', $players);

    if (null !== $gameState->getWinner()) {
        $templateVariables['replacements'][2] =
            \sprintf('<h1 style="color: green">The winner is Player %s</h1>', $gameState->getWinner()->getId());
    }
}

echo \str_replace(
    $templateVariables['variables'],
    $templateVariables['replacements'],
    \file_get_contents(__DIR__.'/../src/Application/Browser/ViewTemplate/template.html')
);
