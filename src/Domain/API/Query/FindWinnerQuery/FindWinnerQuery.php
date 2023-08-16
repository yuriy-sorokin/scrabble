<?php
declare(strict_types=1);

namespace Scrabble\Domain\API\Query\FindWinnerQuery;

use Scrabble\Domain\Model\Cell\CellCoordinate;
use Scrabble\Domain\Model\PlayingField\PlayingField;

class FindWinnerQuery
{
    /**
     * @var PlayingField
     */
    private $playingField;
    /**
     * @var CellCoordinate
     */
    private $lastOccupiedCellCoordinate;

    /**
     * @param PlayingField $playingField
     * @param CellCoordinate $lastOccupiedCellCoordinate
     */
    public function __construct(PlayingField $playingField, CellCoordinate $lastOccupiedCellCoordinate)
    {
        $this->playingField = $playingField;
        $this->lastOccupiedCellCoordinate = $lastOccupiedCellCoordinate;
    }

    public function getPlayingField(): PlayingField
    {
        return $this->playingField;
    }

    public function getLastOccupiedCellCoordinate(): CellCoordinate
    {
        return $this->lastOccupiedCellCoordinate;
    }
}
