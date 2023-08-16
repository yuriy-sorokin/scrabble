<?php
declare(strict_types=1);

namespace Scrabble\Domain\Model\PlayingField;

use Scrabble\Domain\Model\Cell\Cell;
use Scrabble\Domain\Model\Cell\CellCoordinate;
use Scrabble\Domain\Model\Cell\CellValue;
use Scrabble\Domain\Model\Player\Player;

class PlayingField
{
    private const ROWS = 15;
    private const COLUMNS = 15;

    /**
     * @var Cell[]
     */
    private $cells = [];

    /**
     * @param Cell[] $cells
     */
    public function __construct()
    {
        for ($row = 1; $row <= static::ROWS; $row++) {
            for ($column = 1; $column <= static::COLUMNS; $column++) {
                $cell = new Cell(new CellCoordinate($column, $row));
                $this->cells[$this->getCellCoordinate($cell->getCoordinate())] = $cell;
            }
        }
    }

    public function getRows(): int
    {
        return static::ROWS;
    }

    public function getColumns(): int
    {
        return static::COLUMNS;
    }

    public function getCells(): array
    {
        return $this->cells;
    }

    public function getCell(CellCoordinate $cellCoordinate): ?Cell
    {
        return $this->cells[$this->getCellCoordinate($cellCoordinate)];
    }

    public function occupyCell(CellCoordinate $cellCoordinate, Player $player, string $value): void
    {
        $this->cells[$this->getCellCoordinate($cellCoordinate)]->occupy(
            new CellValue($value, $player)
        );
    }

    private function getCellCoordinate(CellCoordinate $cellCoordinate): string
    {
        return \sprintf('%sx%s', $cellCoordinate->getX(), $cellCoordinate->getY());
    }
}
