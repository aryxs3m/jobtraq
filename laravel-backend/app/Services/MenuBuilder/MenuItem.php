<?php

namespace App\Services\MenuBuilder;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MenuItem
{
    public string $label;
    public ?string $icon = null;
    public ?string $url = null;
    private ?string $permission = null;

    /** @var MenuItem[] */
    public array $children = [];

    public static function make(): MenuItem
    {
        return new MenuItem();
    }

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIcon(?string $icon): MenuItem
    {
        $this->icon = $icon;

        return $this;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function setLabel(string $label): MenuItem
    {
        $this->label = $label;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): MenuItem
    {
        $this->url = $url;

        return $this;
    }

    public function getPermission(): ?string
    {
        return $this->permission;
    }

    public function setPermission(?string $permission): MenuItem
    {
        $this->permission = $permission;

        return $this;
    }

    public function getChildren(): array
    {
        return $this->children;
    }

    public function setChildren(array $children): MenuItem
    {
        $this->children = $children;

        return $this;
    }

    public function addChild(MenuItem $item): MenuItem
    {
        $this->children[] = $item;

        return $this;
    }

    public function isGranted(): bool
    {
        if (null === $this->permission) {
            return true;
        }

        /** @var User $user */
        $user = Auth::user();

        return $user->can($this->permission);
    }

    public function isAtLeastOneChildrenGranted(): bool
    {
        foreach ($this->children as $child) {
            if ($child->isGranted()) {
                return true;
            }
        }

        return false;
    }

    public function filterGrantedChildren(): MenuItem
    {
        $grantedChildren = [];

        foreach ($this->children as $child) {
            if ($child->isGranted()) {
                $grantedChildren[] = $child;
            }
        }

        $this->children = $grantedChildren;

        return $this;
    }

    public function hasChildren(): bool
    {
        return count($this->children) > 0;
    }
}
