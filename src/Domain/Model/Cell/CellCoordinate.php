<?php
declare(strict_types=1);

namespace Scrabble\Domain\Model\Cell;

class
CellCoordinate
{
    private $x;
    private $y;

    /**
     * @param $x
     * @param $y
     */
    public function __construct($x, $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    /**
     * @return mixed
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * @return mixed
     */
    public function getY()
    {
        return $this->y;
    }
}
