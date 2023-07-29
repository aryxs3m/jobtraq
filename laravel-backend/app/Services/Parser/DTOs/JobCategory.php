<?php

namespace App\Services\Parser\DTOs;

class JobCategory
{
    private ?string $position = null;
    private ?string $stack = null;
    private ?string $level = null;

    /**
     * @return string|null
     */
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

    /**
     * @return string|null
     */
    public function getStack(): ?string
    {
        return $this->stack;
    }

    /**
     * @param string|null $stack
     */
    public function setStack(?string $stack): void
    {
        $this->stack = $stack;
    }

    /**
     * @return string|null
     */
    public function getLevel(): ?string
    {
        return $this->level;
    }

    /**
     * @param string|null $level
     */
    public function setLevel(?string $level): void
    {
        $this->level = $level;
    }
}
