<?php
declare(strict_types=1);

namespace Scrabble\Domain\API\Query\FindWinnerQuery;

use Scrabble\Domain\Model\Cell\CellCoordinate;
use Scrabble\Domain\Model\Player\Player;
use Scrabble\Domain\Model\PlayingField\PlayingField;

class FindWinnerQueryHandler
{
    private const WINNING_WORDS = ['world', 'sun', 'tea', 'science', 'love'];

    public function handle(FindWinnerQuery $query): ?Player
    {
        $word = $query->getPlayingField()->getCell($query->getLastOccupiedCellCoordinate())
            ->getValue()
            ->getValue();

        $this->addTopLetters($query->getPlayingField(), $query->getLastOccupiedCellCoordinate(), $word);
        $this->addBottomLtters($query->getPlayingField(), $query->getLastOccupiedCellCoordinate(), $word);
        $this->addLeftLetters($query->getPlayingField(), $query->getLastOccupiedCellCoordinate(), $word);
        $this->addRightLetters($query->getPlayingField(), $query->getLastOccupiedCellCoordinate(), $word);

        return true === \in_array(\strtolower($word), static::WINNING_WORDS, true)
            ? $query->getPlayingField()->getCell($query->getLastOccupiedCellCoordinate())->getValue()->getOccupant()
            : null;
    }

    private function addTopLetters(PlayingField $playingField, CellCoordinate $cellCoordinate, &$word): void
    {
        $currentCoordinate = ((int) $cellCoordinate->getY()) - 1;

        while (true) {
            $cell = $playingField->getCell(new CellCoordinate($cellCoordinate->getX(), $currentCoordinate));

            if (null === $cell || null === $cell->getValue()) {
                break;
            }

            $word = $cell->getValue()->getValue() . $word;
            $currentCoordinate--;
        }
    }

    private function addBottomLtters(PlayingField $playingField, CellCoordinate $cellCoordinate, &$word): void
    {
        $currentCoordinate = ((int) $cellCoordinate->getY()) + 1;

        while (true) {
            $cell = $playingField->getCell(new CellCoordinate($cellCoordinate->getX(), $currentCoordinate));

            if (null === $cell || null === $cell->getValue()) {
                break;
            }

            $word = $cell->getValue()->getValue() . $word;
            $currentCoordinate++;
        }
    }

    private function addLeftLetters(PlayingField $playingField, CellCoordinate $cellCoordinate, &$word): void
    {
        $currentCoordinate = ((int) $cellCoordinate->getX()) - 1;

        while (true) {
            $cell = $playingField->getCell(new CellCoordinate($currentCoordinate, $cellCoordinate->getY()));

            if (null === $cell || null === $cell->getValue()) {
                break;
            }

            $word = $cell->getValue()->getValue() . $word;
            $currentCoordinate--;
        }
    }

    private function addRightLetters(PlayingField $playingField, CellCoordinate $cellCoordinate, &$word): void
    {
        $currentCoordinate = ((int) $cellCoordinate->getX()) + 1;

        while (true) {
            $cell = $playingField->getCell(new CellCoordinate($currentCoordinate, $cellCoordinate->getY()));

            if (null === $cell || null === $cell->getValue()) {
                break;
            }

            $word = $cell->getValue()->getValue() . $word;
            $currentCoordinate++;
        }
    }
}
