<?php
declare(strict_types=1);

namespace Scrabble\Domain\Model\Cell;

class Cell
{
    /**
     * @var CellCoordinate
     */
    private $coordinate;
    /**
     * @var CellValue|null
     */
    private $value;

    /**
     * @param CellCoordinate $coordinate
     */
    public function __construct(CellCoordinate $coordinate)
    {
        $this->coordinate = $coordinate;
    }

    public function getCoordinate(): CellCoordinate
    {
        return $this->coordinate;
    }

    public function occupy(CellValue $cellValue): void
    {
        $this->value = $cellValue;
    }

    public function getValue(): ?CellValue
    {
        return $this->value;
    }
}
