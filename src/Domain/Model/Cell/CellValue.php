<?php
declare(strict_types=1);

namespace Scrabble\Domain\Model\Cell;

use Scrabble\Domain\Model\Player\Player;

class CellValue
{
    /**
     * @var string
     */
    private $value;
    /**
     * @var Player
     */
    private $occupant;

    /**
     * @param string $value
     * @param Player $occupant
     */
    public function __construct(string $value, Player $occupant)
    {
        $this->value = $value;
        $this->occupant = $occupant;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function getOccupant(): Player
    {
        return $this->occupant;
    }
}
