<?php
declare(strict_types=1);

namespace Scrabble\Domain\Persistence;

use Scrabble\Domain\Model\Game\GameState;

class GameStateRepository
{
    public function __construct()
    {
        \session_start();
    }

    public function find(): ?GameState
    {
        return $_SESSION['gameState'] ?? null;
    }

    public function save(GameState $gameState): void
    {
        $_SESSION['gameState'] = $gameState;
    }
}
