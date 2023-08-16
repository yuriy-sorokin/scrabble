<?php
declare(strict_types=1);

namespace Scrabble\Application\Browser\View\PlayingFieldDrawer;

use Scrabble\Domain\Model\Cell\CellCoordinate;
use Scrabble\Domain\Model\PlayingField\PlayingField;

class PlayingFieldDrawer
{
    public function draw(PlayingField $playingField): string
    {
        $playingFieldLayout = '<table><tr>';

        for ($column = 0; $column <= $playingField->getColumns(); $column++) {
            $playingFieldLayout .= \sprintf('<td>%d</td>', $column);
        }

        $playingFieldLayout .= '</tr>';

        for ($row = 1; $row <= $playingField->getRows(); $row++) {
            $playingFieldLayout .= \sprintf('<tr><td>%d</td>', $row);

            for ($column = 1; $column <= $playingField->getColumns(); $column++) {
                $cellValue = $playingField->getCell(new CellCoordinate($column, $row))->getValue();
                $playingFieldLayout .= \sprintf(
                    '<td>%s</td>',
                    null !== $cellValue ? $cellValue->getValue() : '&nbsp;'
                );
            }

            $playingFieldLayout .= '</tr>';
        }

        $playingFieldLayout .= '</table>';

        return $playingFieldLayout;
    }
}
