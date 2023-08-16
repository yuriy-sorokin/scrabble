<?php
declare(strict_types=1);

namespace Scrabble\Domain\Model\Game;

use Scrabble\Domain\Model\Player\Player;
use Scrabble\Domain\Model\PlayingField\PlayingField;
use Scrabble\Domain\Model\Winner\Winner;

class GameState
{
    /**
     * @var PlayingField
     */
    private $playingField;
    /**
     * @var Player[]
     */
    private $players = [];
    /**
     * @var null|Player
     */
    private $lastMovePlayer;
    /**
     * @var null|Player
     */
    private $winner;

    /**
     * @param PlayingField $playingField
     * @param Player[] $players
     */
    public function __construct(PlayingField $playingField, array $players)
    {
        $this->playingField = $playingField;

        foreach ($players as $player) {
            $this->players[$player->getId()] = $player;
        }
    }

    public function getPlayingField(): PlayingField
    {
        return $this->playingField;
    }

    public function getPlayers(): array
    {
        return $this->players;
    }

    public function getPlayer(string $id): Player
    {
        return $this->players[$id];
    }

    public function getLastMovePlayer(): ?Player
    {
        return $this->lastMovePlayer;
    }

    public function setLastMovePlayer(Player $lastMovePlayer): void
    {
        $this->lastMovePlayer = $lastMovePlayer;
    }

    public function setWinner(Player $winner): void
    {
        $this->winner = $winner;
    }

    public function getWinner(): ?Player
    {
        return $this->winner;
    }
}
