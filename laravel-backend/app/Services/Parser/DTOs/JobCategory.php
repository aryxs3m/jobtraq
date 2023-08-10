<?php

namespace App\Services\Parser\DTOs;

class JobCategory
{
    private ?string $position = null;

    private ?string $stack = null;

    private ?string $level = null;

    public function getPosition(): ?string
    {
        return $this->position;
    }

    /**
     * @param string $position
     */
    public function setPosition(?string $position): void
    {
        $this->position = $position;
    }

    public function getStack(): ?string
    {
        return $this->stack;
    }

    public function setStack(?string $stack): void
    {
        $this->stack = $stack;
    }

    public function getLevel(): ?string
    {
        return $this->level;
    }

    public function setLevel(?string $level): void
    {
        $this->level = $level;
    }
}
