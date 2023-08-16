<?php
declare(strict_types=1);

namespace Scrabble\Domain\Model\Player;

class Player
{
    /**
     * @var string
     */
    private $id;

    /**
     * @param string $id
     */
    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function getId(): string
    {
        return $this->id;
    }
}
